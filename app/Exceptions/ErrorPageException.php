<?php

namespace App\Exceptions;

use Exception;

class ErrorPageException extends Exception
{
    protected $code = 403;

    protected $message = 'Unsupported route action!';

    public function __construct($message = null, $code = null)
    {
        $message === null ?: $this->message = $message;
        $code === null ?: $this->code = $code;
    }
}
