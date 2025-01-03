<?php

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Class GeneralException.
 */
class GeneralException extends Exception
{
    /**
     * @var string
     */
    public $message;

    /**
     * GeneralException constructor.
     *
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct($message = '', $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        if ($request->is('api/*')) {
            return response()->json([
                'apiVersion' => '1.0',
                'error' => [
                    'code' => $this->code,
                    'message' => $this->message,
                ],
                'message' => $this->message,
            ], 400);
        }
    }
}
