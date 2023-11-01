<?php

namespace Modules\BusinessType\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Modules\BusinessType\Services\BusinessTypeService;
use Modules\BusinessType\Transformers\BusinessTypeCollection;

class BusinessTypeController extends BaseController
{
    public function __construct(
        private BusinessTypeService $businessTypeService
    ) {
    }

    public function index()
    {
        $businessTypes = $this->businessTypeService->getAll();

        return $this->successResponse(new BusinessTypeCollection($businessTypes));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
