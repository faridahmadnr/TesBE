<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends BaseController
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            throw new GeneralException('Your email address is already verified.');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->okResponse(['message' => 'Your e-mail has been verified.']);
    }
}
