<?php

namespace Modules\User\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class Captcha.
 */
class Captcha implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function passes($attribute, $value)
    {
        if (empty($value)) {
            return false;
        }

        $response = json_decode((new Client([
            'timeout' => 60,
        ]))->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => '6LcJZcIpAAAAAOVq01jQjFGtK442YZZnCkSk_YpC',
                'remoteip' => request()->getClientIp(),
                'response' => $value,
            ],
        ])->getBody(), true);

        return isset($response['success']) && $response['success'] === true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The captcha was invalid.');
    }
}
