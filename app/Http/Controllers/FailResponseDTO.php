<?php

namespace App\Http\Controllers;

class FailResponseDTO
{
    private array $data;

    public function __construct(?string $message = null, string $errorCode = '9999')
    {
        $this->data['data']['message'] = $message;
        $this->data['data']['errorCode'] = $errorCode;
    }

    public function data(): array
    {
        return $this->data;
    }

}
