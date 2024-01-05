<?php

namespace Modules\CreditRequest\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Bank\Entities\Bank;
use Modules\BusinessPermit\Entities\BusinessPermit;
use Modules\BusinessType\Entities\BusinessType;
use Modules\CreditRequest\Entities\CreditRequest;
use Modules\CreditRequest\Entities\CreditRequestType;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\CreditRequest\Events\CreditRequestApproved;
use Modules\CreditRequest\Events\CreditRequestConfirmed;
use Modules\CreditRequest\Events\CreditRequestPending;
use Modules\CreditRequest\Events\CreditRequestRedirected;
use Modules\CreditRequest\Events\CreditRequestRejected;
use Modules\Location\Entities\District;
use Modules\Location\Entities\Regency;
use Modules\Termin\Entities\Termin;
use Modules\User\Entities\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

final class CreditRequestService extends BaseService
{
    public function __construct(CreditRequest $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        /** @var User $user */
        $user = auth()->user();

        $results = $this->with([
            'district',
            'user',
            'user.member',
            'creditRequestType',
            'businessType',
        ])
            ->when($user->isMember(), function ($query) use ($user) {
                $query->createdBy($user->id);
            })
            ->when($user->isAdminBank(), function ($query) use ($user) {
                $user->loadMissing(['profile']);
                $query->where('bank_id', $user->profile->bank_id);
            })
            ->allowedSorts([
                AllowedSort::field('user', 'user_name'),
                AllowedSort::field('address', 'business_address'),
                AllowedSort::field('amount', 'amount'),
                AllowedSort::field('district', 'district_name'),
                AllowedSort::field('type', 'business_type_name'),
                AllowedSort::field('creditRequestType', 'credit_request_type_name'),
                AllowedSort::callback('status', function ($query, $descending) {
                    $direction = $descending ? 'DESC' : 'ASC';
                    $query->orderBy('status', $direction);
                }),
                AllowedSort::field('createdAt', 'created_at'),
            ])
            ->allowedFilters([
                AllowedFilter::callback('status', function ($query, $value) {
                    $status = CreditRequestStatusEnum::fromValue($value);
                    $query->where('status', $status->value);
                }),
            ])
            ->withAggregate('user', 'name')
            ->withAggregate('district', 'name')
            ->withAggregate('businessType', 'name')
            ->withAggregate('creditRequestType', 'name')
            ->toQueryBuilder();

        return $results;
    }

    public function store(array $data = []): CreditRequest
    {
        DB::beginTransaction();

        try {
            $creditRequest = $this->createCreditRequest($data);

            if (isset($data['image'])) {
                /** @var UploadedFile $image */
                $image = $data['image'];
                $imagePath = $this->uploadImage($creditRequest, $image);
                $creditRequest->update([
                    'image' => $imagePath,
                ]);
            }
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this credit request. Please try again.'));
        }

        // event(new CreditRequestCreated($creditRequest));
        DB::commit();

        return $creditRequest;
    }

    public function update(CreditRequest $creditRequest, array $data = []): CreditRequest
    {
        DB::beginTransaction();

        try {
            $creditRequest->fill($data);

            if (isset($data['image'])) {
                /** @var UploadedFile $image */
                $image = $data['image'];
                $imagePath = $this->uploadImage($creditRequest, $image);
                $this->uploadImage($creditRequest, $image);
                $creditRequest->image = $imagePath;
                $this->deleteImage($creditRequest);
            }
            $creditRequest->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this credit request. Please try again.'));
        }

        // event(new CreditRequestUpdated($creditRequest));
        DB::commit();

        return $creditRequest;
    }

    public function delete(CreditRequest $creditRequest): CreditRequest
    {
        if ($this->deleteById($creditRequest->id)) {
            // event(new CreditRequestDeleted($creditRequest));

            return $creditRequest;
        }

        throw new GeneralException('There was a problem deleting this credit request. Please try again.');
    }

    public function restore(CreditRequest $creditRequest): CreditRequest
    {
        if ($creditRequest->restore()) {
            // event(new CreditRequestRestored($creditRequest));

            return $creditRequest;
        }

        throw new GeneralException(__('There was a problem restoring this credit request. Please try again.'));
    }

    public function destroy(CreditRequest $creditRequest): bool
    {
        if ($creditRequest->forceDelete()) {

            $this->deleteImage($creditRequest);
            // event(new CreditRequestDestroyed($creditRequest));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this credit request. Please try again.'));
    }

    public function simulation(array $data = [])
    {
        $creditRequestType = CreditRequestType::findByHashId($data['creditRequestType']);

        $loanDuration = Termin::findByHashId($data['loanDuration']);

        $lenghtOfLoan = $loanDuration->value;
        $loanAmount = $data['amount'];
        $loanInterest = $creditRequestType->interest ?? 6 / 100;

        $instalment = round(($loanAmount * ($loanInterest / 12)) / (1 - 1 / pow((1 + $loanInterest / 12), $lenghtOfLoan)));
        $remainingLoan = $loanAmount;

        $data = [];
        $data[] = [
            'month' => 0,
            'principalInstalment' => '',
            'loanInterest' => '',
            'instalment' => '',
            'remainingLoan' => formatCurrency($loanAmount),
        ];
        for ($i = 0; $i < $lenghtOfLoan; $i++) {
            $principalInterest = round($remainingLoan * $loanInterest / 12);
            $principalInstalment = round($instalment - $principalInterest);
            $remainingLoan -= $principalInstalment;

            $data[] = [
                'month' => $i + 1,
                'principalInstalment' => formatCurrency($principalInstalment),
                'loanInterest' => formatCurrency($principalInterest),
                'instalment' => formatCurrency($instalment),
                'remainingLoan' => formatCurrency($remainingLoan),
            ];
        }

        return $data;
    }

    public function confirm(CreditRequest $creditRequest): CreditRequest
    {
        if ($creditRequest->status !== CreditRequestStatusEnum::DRAFT->value) {
            throw new GeneralException(__('This credit request has already been confirmed.'));
        }

        DB::beginTransaction();

        try {
            $creditRequest->update([
                'status' => CreditRequestStatusEnum::CONFIRMED->value,
            ]);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();
            throw new GeneralException(__('There was a problem confirming this credit request. Please try again.'));
        }

        DB::commit();

        event(new CreditRequestConfirmed($creditRequest));

        return $creditRequest;
    }

    public function pending(CreditRequest $creditRequest, array $data = []): CreditRequest
    {
        if ($creditRequest->status === CreditRequestStatusEnum::PENDING->value) {
            throw new GeneralException(__('This credit request has already been pending.'));
        }

        if ($creditRequest->status === CreditRequestStatusEnum::DRAFT->value) {
            throw new GeneralException(__('This credit request has not been confirmed yet.'));
        }

        DB::beginTransaction();

        try {
            $creditRequest->update([
                'status' => CreditRequestStatusEnum::PENDING->value,
                'remark' => $data['message'],
            ]);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();
            throw new GeneralException(__('There was a problem pending this credit request. Please try again.'));
        }

        DB::commit();

        event(new CreditRequestPending($creditRequest));

        return $creditRequest;
    }

    public function reject(CreditRequest $creditRequest, array $data = []): CreditRequest
    {
        if ($creditRequest->status === CreditRequestStatusEnum::REJECTED->value) {
            throw new GeneralException(__('This credit request has already been rejected.'));
        }

        if ($creditRequest->status === CreditRequestStatusEnum::APPROVED->value) {
            throw new GeneralException(__('This credit request has already been approved.'));
        }

        if ($creditRequest->status === CreditRequestStatusEnum::DRAFT->value) {
            throw new GeneralException(__('This credit request has not been confirmed yet.'));
        }

        DB::beginTransaction();

        try {
            $creditRequest->update([
                'status' => CreditRequestStatusEnum::REJECTED->value,
                'remark' => $data['message'],
            ]);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();
            throw new GeneralException(__('There was a problem rejecting this credit request. Please try again.'));
        }

        DB::commit();

        event(new CreditRequestRejected($creditRequest));

        return $creditRequest;
    }

    public function approved(CreditRequest $creditRequest, array $data = []): CreditRequest
    {
        if ($creditRequest->status === CreditRequestStatusEnum::APPROVED->value) {
            throw new GeneralException(__('This credit request has already been approved.'));
        }

        if ($creditRequest->status === CreditRequestStatusEnum::REJECTED->value) {
            throw new GeneralException(__('This credit request has already been rejected.'));
        }

        if ($creditRequest->status === CreditRequestStatusEnum::DRAFT->value) {
            throw new GeneralException(__('This credit request has not been confirmed yet.'));
        }

        DB::beginTransaction();

        try {
            $creditRequest->update([
                'status' => CreditRequestStatusEnum::APPROVED->value,
                'remark' => $data['message'],
            ]);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();
            throw new GeneralException(__('There was a problem approving this credit request. Please try again.'));
        }

        DB::commit();

        event(new CreditRequestApproved($creditRequest));

        return $creditRequest;
    }

    public function redirected(CreditRequest $creditRequest, array $data = []): CreditRequest
    {
        if ($creditRequest->status === CreditRequestStatusEnum::PROCESSED->value) {
            throw new GeneralException(__('This credit request has already been processed.'));
        }

        if ($creditRequest->status !== CreditRequestStatusEnum::CONFIRMED->value) {
            throw new GeneralException(__('This credit request has not been confirmed yet.'));
        }

        DB::beginTransaction();

        try {
            $creditRequest->update([
                'status' => CreditRequestStatusEnum::PROCESSED->value,
                'remark' => $data['message'],
            ]);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();
            throw new GeneralException(__('There was a problem approving this credit request. Please try again.'));
        }

        DB::commit();

        event(new CreditRequestRedirected($creditRequest));

        return $creditRequest;
    }

    protected function uploadImage(CreditRequest $creditRequest, UploadedFile $file): string
    {
        $filename = sha1($creditRequest->registration_number.$creditRequest->user_id)
            .'.'.$file->getClientOriginalExtension();
        $file->storeAs('credit-requests', $filename, [
            'disk' => 's3',
        ]);

        return $filename;
    }

    protected function deleteImage(CreditRequest $creditRequest): void
    {
        if ($creditRequest->image) {
            Storage::disk('s3')->delete('credit-requests/'.$creditRequest->image);
        }
    }

    protected function getRegistrationNumber(): string
    {
        $latestCreditRequest = $this
            ->select([])
            ->whereRaw('DATE(created_at) = ?', [now()])
            ->get()
            ->count();
        $sequenceNumber = $latestCreditRequest ? $latestCreditRequest + 1 : 1;

        return 'PJ'.date('y').date('m').(str_pad(strval($sequenceNumber), 4, '0', STR_PAD_LEFT));
    }

    protected function createCreditRequest(array $data = []): CreditRequest
    {
        return $this->model::create([
            'user_id' => auth()->user()->id,
            'registration_number' => trim($this->getRegistrationNumber()),
            'business_type_id' => BusinessType::keyFromHashId($data['business_type_id']),
            'business_permit_id' => BusinessPermit::keyFromHashId($data['business_permit_id']),
            'business_tin' => $data['business_tin'] ?? null,
            'business_address' => $data['business_address'] ?? '',
            'business_regency_id' => Regency::keyFromHashId($data['business_regency_id']),
            'business_district_id' => District::keyFromHashId($data['business_district_id']),
            'village' => $data['village'] ?? null,
            'postal_code' => $data['postal_code'] ?? null,
            'credit_request_type_id' => CreditRequestType::keyFromHashId($data['credit_request_type_id']) ?? null,
            'amount' => $data['amount'] ?? 0,
            'termin_id' => Termin::keyFromHashId($data['termin_id']),
            'bank_id' => Bank::keyFromHashId($data['bank_id']),
        ]);
    }
}
