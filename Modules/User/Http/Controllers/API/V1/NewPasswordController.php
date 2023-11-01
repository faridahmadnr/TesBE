<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Modules\User\Http\Requests\NewPasswordRequest;
use Modules\User\Services\UserService;

class NewPasswordController extends BaseController
{
    public function __invoke(NewPasswordRequest $request, UserService $userService)
    {
        $userService->resetPassword($request->validated());

        return $this->noContentResponse();
    }
}
