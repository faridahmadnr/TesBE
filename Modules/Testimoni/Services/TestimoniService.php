<?php

namespace Modules\Testimoni\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Testimoni\Entities\Testimoni;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class TestimoniService extends BaseService
{
    public function __construct(Testimoni $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select(['id', 'name', 'message', 'email', 'is_anonymous', 'created_at']);
        $results = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['id', 'name', 'email', 'is_anonymous'])
            ->allowedFilters(['name', 'email', 'is_anonymous', AllowedFilter::trashed()])
            ->allowedSorts([
                'name',
                'email',
                'is_anonymous',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $results;
    }

    public function store(array $data = []): Testimoni
    {
        DB::beginTransaction();

        try {
            $testimoni = $this->createTestimoni($data);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this testimoni. Please try again.'));
        }

        // event(new TestimoniCreated($testimoni));
        DB::commit();

        return $testimoni;
    }

    public function update(Testimoni $testimoni, array $data = []): Testimoni
    {
        DB::beginTransaction();

        try {
            $testimoni->fill($data);

            if (isset($data['image'])) {
                /** @var UploadedFile $image */
                $image = $data['image'];
                $imagePath = $this->uploadImage($image);
                $testimoni->image = $imagePath;
                $this->deleteImage($testimoni);
            }

            $testimoni->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this testimoni. Please try again.'));
        }

        // event(new TestimoniUpdated($testimoni));
        DB::commit();

        return $testimoni;
    }

    public function delete(Testimoni $testimoni): Testimoni
    {
        if ($this->deleteById($testimoni->id)) {
            // event(new TestimoniDeleted($testimoni));

            return $testimoni;
        }

        throw new GeneralException('There was a problem deleting this testimoni. Please try again.');
    }

    public function restore(Testimoni $testimoni): Testimoni
    {
        if ($testimoni->restore()) {
            // event(new TestimoniRestored($testimoni));

            return $testimoni;
        }

        throw new GeneralException(__('There was a problem restoring this testimoni. Please try again.'));
    }

    public function destroy(Testimoni $testimoni): bool
    {
        if ($testimoni->forceDelete()) {

            if ($testimoni->image) {
                $this->deleteImage($testimoni);
            }
            // event(new TestimoniDestroyed($testimoni));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this testimoni. Please try again.'));
    }

    protected function uploadImage(UploadedFile $file): string
    {
        // skipcq: PHP-A1004
        $filename = sha1(now()).'.'.$file->getClientOriginalExtension();
        $file->storeAs('testimonials', $filename);

        return $filename;
    }

    protected function deleteImage(Testimoni $testimoni): void
    {
        if ($testimoni->image) {
            Storage::delete($testimoni->imagePath.$testimoni->image);
        }
    }

    protected function createTestimoni(array $data = []): Testimoni
    {
        $imagePath = '';
        if (isset($data['image'])) {
            /** @var UploadedFile $image */
            $image = $data['image'];
            $imagePath = $this->uploadImage($image);
        }

        return $this->model::create([
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'is_anonymous' => $data['is_anonymous'] ?? false,
            'message' => $data['message'] ?? null,
            'image' => $imagePath,
        ]);
    }
}
