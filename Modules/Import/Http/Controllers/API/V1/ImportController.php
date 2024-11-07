<?php

namespace Modules\Import\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Modules\Import\Http\Requests\StoreImportRequest;
use Modules\Import\Services\ImportService;

class ImportController extends BaseController
{
    public function __invoke(StoreImportRequest $request, ImportService $importService)
    {
        $importService->import($request->validated());

        return $this->noContentResponse();
    }
}
