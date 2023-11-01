<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class VerifyEmailNotificationController extends BaseController
{
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            throw new GeneralException('Your email address is already verified.');
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'verification-link-sent']);
    }
}
