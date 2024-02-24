<?php

namespace App\Exceptions;

use Exception;

class BusinessException extends Exception
{
    protected int $errorCode;

    /**
     * @param string $message
     * @param int $errorCode | 비즈니스 에러코드
     * @param Exception $previous
     * @return void
     */
    public function __construct(string $message = "", int $errorCode = 0, Exception $previous = null)
    {
        $this->errorCode = $errorCode;
        parent::__construct($message, 422, $previous);
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }
}
