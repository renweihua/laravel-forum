<?php

namespace App\Exceptions\HttpStatus;

use App\Constants\HttpStatus;
use App\Exceptions\Exception;
use Throwable;

class SuccessRequestException extends Exception
{
    public function __construct(string $message = null, int $http_code = HttpStatus::SUCCESS, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = '';
        }

        parent::__construct($message, $http_code, $previous);
    }
}
