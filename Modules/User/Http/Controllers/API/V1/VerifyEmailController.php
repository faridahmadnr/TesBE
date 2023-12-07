<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Modules\User\Services\UserService;

class VerifyEmailController extends BaseController
{
    public function __invoke(Request $request, UserService $userService)
    {
        $user = $userService->getByHashId($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            throw new GeneralException('Your email address is already verified.');
        }

        if ($user->markEmailAsVerified()) {
            $user->update([
                'status' => true,
            ]);
            event(new Verified($user));
        }

        return $this->noContentResponse();
    }
}
