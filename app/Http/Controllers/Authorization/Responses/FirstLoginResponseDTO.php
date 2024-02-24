<?php

namespace App\Http\Controllers\Authorization\Responses;

class FirstLoginResponseDTO
{
    private array $data;

    public function __construct(?string $token = null)
    {
        $this->data['data']['token'] = $token;
    }

    public function data(?string $token = null): array
    {
        if (!is_null($token)) {
            $this->data['data']['token'] = $token;
        }

        return $this->data;
    }

}
