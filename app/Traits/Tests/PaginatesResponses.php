<?php

namespace App\Traits\Tests;

use Illuminate\Pagination\LengthAwarePaginator;

trait PaginatesResponses
{
    protected function createPaginatedResponse($modelClass, $count = 10, $perPage = 10, $currentPage = 1)
    {
        // Generate a collection of model instances using the factory
        $items = $modelClass::factory()->count($count)->make();

        // Create a new LengthAwarePaginator instance
        return new LengthAwarePaginator(
            $items,
            $items->count(),
            $perPage,
            $currentPage,
            [
            ]
        );
    }
}
