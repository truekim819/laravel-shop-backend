<?php

namespace App\Http\Controllers\Authorization\Responses;

class FirstLoginResponseDTO
{
    private array $data;

    public function __construct(?string $token = null)
    {
        $this->data['data']['token'] = $token;
    }

    public function data(): array
    {
        return $this->data;
    }

}
