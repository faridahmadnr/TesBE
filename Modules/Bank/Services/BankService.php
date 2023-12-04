<?php

namespace Modules\Bank\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Bank\Entities\Bank;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class BankService extends BaseService
{
    public function __construct(Bank $user)
    {
        $this->model = $user;
    }

    public function getAllBank()
    {
        $bankQuery = $this->model::select([
            'id',
            'name',
            'logo',
            'created_at',
            'link',
            'status',
            'code',
        ]);
        $banks = QueryBuilder::for($bankQuery)
            ->defaultSort('-created_at')
            ->allowedFields(['id', 'name', 'code'])
            ->allowedFilters([
                'name',
                'code',
                'status',
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'name',
                'code',
                'status',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $banks;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $bank = $this->createBank($data);

            if (isset($data['logo'])) {
                /** @var UploadedFile $logo */
                $logo = $data['logo'];
                $filename = $this->uploadLogo($bank, $logo);
                $bank->update([
                    'logo' => $filename,
                ]);
            }

        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this bank. Please try again.'));
        }

        // event(new BankCreated($bank));

        DB::commit();

        return $bank;
    }

    public function update(Bank $bank, array $data = []): Bank
    {
        DB::beginTransaction();

        try {
            $bank->fill([
                ...$data,
                'status' => $data['status'] === 'active',
            ]);

            if (isset($data['logo'])) {
                /** @var UploadedFile $logo */
                $logo = $data['logo'];
                $filename = $this->uploadLogo($bank, $logo);
                $bank->fill([
                    'logo' => $filename,
                ]);
            }

            $bank->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this bank. Please try again.'));
        }

        DB::commit();

        return $bank;
    }

    public function delete(Bank $bank): Bank
    {
        if ($this->deleteById($bank->id)) {
            // event(new UserDeleted($bank));

            return $bank;
        }

        throw new GeneralException('There was a problem deleting this bank. Please try again.');
    }

    public function restore(Bank $bank): Bank
    {
        if ($bank->restore()) {
            // event(new UserRestored($bank));

            return $bank;
        }

        throw new GeneralException(__('There was a problem restoring this bank. Please try again.'));
    }

    public function destroy(Bank $bank): bool
    {
        if ($bank->trashed()
            && $bank->forceDelete()) {

            $this->deleteLogo($bank);
            // event(new UserDestroyed($bank));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this bank. Please try again.'));
    }

    protected function uploadLogo(Bank $bank, UploadedFile $file): string
    {
        // @phpstan-ignore-next-line
        $filename = \Str::slug($bank->name).'.'.$file->getClientOriginalExtension();
        $file->storeAs('banks', $filename, [
            'disk' => 's3',
        ]);

        return $filename;
    }

    protected function deleteLogo(Bank $bank): void
    {
        if ($bank->logo) {
            Storage::disk('s3')->delete('banks/'.$bank->logo);
        }
    }

    protected function createRow(array $data = []): array
    {
        return [
            'name' => $data['name'] ?? null,
            'link' => $data['link'] ?? null,
            'code' => $data['code'] ?? null,
            'status' => $data['status'] === 'active',
            'reason_status' => $data['reason_status'] ?? null,
            'logo' => $data['logo'] ?? null,
        ];
    }

    protected function createBank(array $data = []): Bank
    {
        return $this->model::create($this->createRow($data));
    }
}
