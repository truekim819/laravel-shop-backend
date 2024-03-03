<?php

namespace App\Domains\Product;

use App\Exceptions\BusinessException;
use App\Models\Product\Products;
use Illuminate\Database\QueryException;
use function PHPUnit\Framework\throwException;

class UpdateProductService implements ManageProductService
{
    const ERROR_MESSAGE = '상품수정에 실패했습니다.';
    const ERROR_CODE = 2002;

    /**
     * @throws BusinessException
     */
    function manage(array $validatedRequestParam): bool
    {
        try {
            $product = Products::findOrFail($validatedRequestParam['id']);

            //파라미터 필터 하기
            $updateParameter = $this->getParams($validatedRequestParam);

            //상품을 업데이트합니다.
            $product->updateOrFail($updateParameter);
        } catch (QueryException $exception) {
            throw new BusinessException(self::ERROR_MESSAGE, self::ERROR_CODE);
        }

        return $product instanceof Products;
    }

    private function getParams(array $validatedRequestParam): array
    {
        return collect($validatedRequestParam)
            ->only(['name', 'description', 'price', 'stock'])
            ->filter()
            ->all();
    }
}
