<?php

namespace App\Domains\Product;

use App\Exceptions\BusinessException;
use App\Models\Product\Products;
use Illuminate\Database\QueryException;
use function PHPUnit\Framework\throwException;
use function Symfony\Component\Translation\t;

class DeleteProductService implements ManageProductService
{
    const ERROR_MESSAGE = '상품삭제에 실패했습니다.';
    const ERROR_CODE = 2003;

    /**
     * @throws BusinessException
     */
    function manage(array $validatedRequestParam): bool
    {
        try {
            Products::destroy($validatedRequestParam['id']);
        } catch (QueryException $exception) {
            throw new BusinessException(self::ERROR_MESSAGE, self::ERROR_CODE);
        }

        return true;
    }
}
