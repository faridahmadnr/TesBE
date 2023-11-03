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
use Modules\Location\Entities\District;
use Modules\Location\Entities\Regency;
use Modules\Termin\Entities\Termin;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class CreditRequestService extends BaseService
{
    public function __construct(CreditRequest $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select([
            '*',
        ])->with([
            'district',
            'user',
            'user.member',
            'creditRequestType',
            'businessType',
        ]);
        $results = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['name'])
            ->allowedFilters([
                'name',
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'name',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(10)
            ->appends(request()->query());

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
        if (! $creditRequest->trashed()) {
            throw new GeneralException(__('This creditRequest can not be deleted because it is not in a deleted state.'));
        }

        if ($creditRequest->forceDelete()) {

            $this->deleteImage($creditRequest);
            // event(new CreditRequestDestroyed($creditRequest));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this credit request. Please try again.'));
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
            'registration_number' => $this->getRegistrationNumber(),
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
