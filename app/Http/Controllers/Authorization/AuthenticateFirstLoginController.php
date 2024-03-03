<?php

namespace App\Http\Controllers\Authorization;

use App\Domains\Authorization\ConfirmFirstLoginService;
use App\Domains\Authorization\CreateAuthTokenService;
use App\Exceptions\BusinessException;
use App\Http\Controllers\Authorization\Responses\FirstLoginResponseDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticateFirstLoginController extends Controller
{
    /**
     * @throws BusinessException
     */
    public function login(
        Request $request,
        ConfirmFirstLoginService $confirmFirstLoginService,
        CreateAuthTokenService $createAuthTokenService
    ): Response
    {
        $validatedRequestParam = $this->getValidateParams($request, [
            'email' => 'required|email',
            'password' => 'required|min:4|max:12',
        ]);

        $user = $confirmFirstLoginService->getUser($validatedRequestParam);
        $token = $createAuthTokenService->getToken($user);
        $responseData = new FirstLoginResponseDTO('로그인이 완료됐습니다.');

        return Response(
            $responseData->data(),
            200,
            ['Authorization' => $token]
        );
    }
}
