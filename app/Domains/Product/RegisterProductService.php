<?php

namespace App\Domains\Product;

use App\Exceptions\BusinessException;

class RegisterProductService implements ManageProductService
{
    const SUCCESS_MESSAGE = '상품등록에 성공했습니다.';
    const ERROR_MESSAGE = '상품등록에 실패했습니다.';
    const ERROR_CODE = 2001;

    function manage(array $validatedRequestParam): bool
    {
        $this->register($validatedRequestParam);

        return true;
    }

    private function register(array $validatedRequestParam): void
    {

    }
}
