<?php

namespace App\Http\Controllers\Product;

use App\Domains\Product\RegisterProductService;
use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * 상품 등록, 수정, 삭제 컨트롤러
 */
class ManageProductController extends Controller
{

    /**
     * 상품 신규 등록
     * @param Request $request
     * @return Response
     * @throws BusinessException
     */
    public function create(
        Request                $request,
        RegisterProductService $createProductService,
    ): Response
    {
        // price, stock이 null로 들어오는 경우 디폴트를 설정한다.
        $request->merge([
            'price' => $request->input('price', 0),
            'stock' => $request->input('stock', 999),
        ]);

        /** @var array $validatedRequestParam */
        $validatedRequestParam = $this->getValidateParams($request, [
            'product_name' => 'required',
            'description' => 'nullable|string',
            'price' => 'nullable|integer',
            'stock' => 'nullable|integer',
        ]);

        $createProductService->manage($validatedRequestParam);


        return Response(
            null,
            204,
        );
    }

    /**
     * 상품 수정
     * @param Request $request
     * @return Response
     */
    public function update(
        Request $request,
    ): Response
    {
        return Response(
            null,
            204,
        );
    }

    /**
     * 상품 삭제
     * @param Request $request
     * @return Response
     */
    public function delete(
        Request $request,
    ): Response
    {
        return Response(
            null,
            204,
        );
    }
}
