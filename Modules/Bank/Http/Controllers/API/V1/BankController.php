<?php

namespace Modules\Bank\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Bank\Entities\Bank;
use Modules\Bank\Http\Requests\StoreBankRequest;
use Modules\Bank\Http\Requests\UpdateBankRequest;
use Modules\Bank\Services\BankService;
use Modules\Bank\Transformers\BankCollection;
use Modules\Bank\Transformers\BankResource;

class BankController extends BaseController
{
    public function __construct(
        private BankService $bankService
    ) {
        $this->authorizeResource(Bank::class, 'bank');
    }

    /**
     * Retrieves all banks and returns a response with a collection of banks.
     */
    public function index(): JsonResponse
    {
        $banks = $this->bankService->getAllBank();

        return $this->okResponse(new BankCollection($banks));
    }

    public function store(StoreBankRequest $request): JsonResponse
    {
        $bank = $this->bankService->store($request->validated());

        return $this->okResponse(new BankResource($bank));
    }

    public function show(Bank $bank): JsonResponse
    {
        return $this->okResponse(new BankResource($bank));
    }

    public function update(UpdateBankRequest $request, Bank $bank): JsonResponse
    {
        $bank = $this->bankService->update($bank, $request->validated());

        return $this->okResponse(new BankResource($bank));
    }

    public function destroy(Bank $bank): JsonResponse
    {
        $this->bankService->delete($bank);

        return $this->okResponse(new BankResource($bank));
    }

    public function restore(Bank $bank): JsonResponse
    {
        $this->bankService->restore($bank);

        return $this->okResponse(new BankResource($bank));
    }

    public function forceDelete(Bank $bank): JsonResponse
    {
        $this->bankService->destroy($bank);

        return $this->okResponse(new BankResource($bank));
    }
}
