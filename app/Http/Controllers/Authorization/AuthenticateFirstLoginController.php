<?php

namespace App\Http\Controllers\Authorization;

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
        CreateAuthTokenService $createAuthTokenService
    ): Response {
        $validatedRequestParam = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4|max:12',
        ]);

        $token = $createAuthTokenService->getToken($validatedRequestParam);
        $responseData = new FirstLoginResponseDTO($token);

        return Response(
            $responseData->data(),
            200,
        );
    }

}
