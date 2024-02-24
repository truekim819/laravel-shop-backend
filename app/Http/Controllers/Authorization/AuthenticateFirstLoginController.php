<?php

namespace App\Http\Controllers;

use App\Domains\Authorization\CreateAuthTokenService;
use App\Http\Controllers\Authorization\Responses\FirstLoginResponseDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthenticateFirstLoginController
{

    /**
     * @throws ValidationException
     */
    public function login(
        Request $request,
        CreateAuthTokenService $createAuthTokenService
    ): Response {
        /** @var  $validatedRequestParam */
        $validatedRequestParam = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $token = $createAuthTokenService->create($validatedRequestParam);
        $responseData = new FirstLoginResponseDTO($token);

        return Response(
            $responseData->data(),
            200,
        );
    }

}
