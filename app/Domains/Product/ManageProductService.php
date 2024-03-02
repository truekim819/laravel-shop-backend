<?php

namespace App\Domains\Product;

/**
 * Product 관리하는 서비스 인터페이스
 */
interface ManageProductService
{
    /**
     * @param array $validatedRequestParam
     * @return bool
     */
    function manage(array $validatedRequestParam): bool;
}
