<?php

namespace Modules\Faq\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\Faq\Entities\Faq;

final class FaqService extends BaseService
{
    public function __construct(Faq $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->select()
            ->allowedSorts(['question'])
            ->toQueryBuilder();

        return $query;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createFaq($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this faq. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    public function update(Faq $faq, array $data = []): Faq
    {
        DB::beginTransaction();

        try {
            $faq->fill($data);

            $faq->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this faq. Please try again.'));
        }

        DB::commit();

        return $faq;
    }

    public function delete(Faq $faq): Faq
    {
        if ($this->deleteById($faq->id)) {

            return $faq;
        }

        throw new GeneralException('There was a problem deleting this faq. Please try again.');
    }

    public function restore(Faq $faq): Faq
    {
        if ($faq->restore()) {

            return $faq;
        }

        throw new GeneralException(__('There was a problem restoring this faq. Please try again.'));
    }

    public function destroy(Faq $faq): bool
    {
        if ($faq->forceDelete()) {

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this faq. Please try again.'));
    }

    protected function createFaq(array $data = []): Faq
    {
        return $this->model::create([
            'question' => $data['question'] ?? null,
            'answer' => $data['question'] ?? null,
        ]);
    }
}
