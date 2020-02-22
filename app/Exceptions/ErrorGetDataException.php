<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ErrorGetDataException extends Exception
{
    /**
     * Error message
     *
     * @var string
     */
    public $message;

    /**
     * ErrorGetDataException constructor.
     * @param string $message
     */
    public function __construct(string $message = '')
    {
        parent::__construct();

        $this->message = $message;
    }

    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        Log::debug($this->message);
    }
}
