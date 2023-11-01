<?php

namespace Modules\Bank\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Modules\Bank\Services\BankService;
use Modules\Bank\Transformers\BankCollection;

class BankController extends BaseController
{
    public function __construct(
        private BankService $bankService
    ) {
    }

    public function index()
    {
        $banks = $this->bankService->getAllBank();

        return $this->okResponse(new BankCollection($banks));
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
