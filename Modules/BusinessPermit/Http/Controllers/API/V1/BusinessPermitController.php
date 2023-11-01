<?php

namespace Modules\BusinessPermit\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Modules\BusinessPermit\Services\BusinessPermitService;
use Modules\BusinessPermit\Transformers\BusinessPermitCollection;

class BusinessPermitController extends BaseController
{
    public function __construct(
        private BusinessPermitService $businessPermitService
    ) {
    }

    public function index()
    {
        $businessPermits = $this->businessPermitService->getAll();

        return $this->successResponse(new BusinessPermitCollection($businessPermits));
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
