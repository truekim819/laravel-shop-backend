<?php

namespace App\Http\Controllers\Authorization\Responses;

class FirstLoginResponseDTO
{
    private array $data;

    public function __construct(?string $message = null)
    {
        $this->data['data']['message'] = $message;
    }

    public function data(): array
    {
        return $this->data;
    }

}
