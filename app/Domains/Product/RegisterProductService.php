<?php

namespace App\Domains\Product;

use App\Exceptions\BusinessException;
use App\Models\Product\Products;
use Illuminate\Database\QueryException;
use function PHPUnit\Framework\throwException;

class RegisterProductService implements ManageProductService
{
    const ERROR_MESSAGE = '상품등록에 실패했습니다.';
    const ERROR_CODE = 2001;

    /**
     * @throws BusinessException
     */
    function manage(array $validatedRequestParam): bool
    {
        try {
            $product = Products::createOrFail($validatedRequestParam);
        } catch (QueryException $exception) {
            throw new BusinessException(self::ERROR_MESSAGE, self::ERROR_CODE);
        }

        return $product instanceof Products;
    }
}
