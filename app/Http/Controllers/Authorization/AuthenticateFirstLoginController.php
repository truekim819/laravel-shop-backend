<?php

namespace App\Http\Controllers\Authorization;

use App\Domains\Authorization\CreateAuthTokenService;
use App\Http\Controllers\Authorization\Responses\FirstLoginResponseDTO;
use App\Http\Controllers\FailResponseDTO;
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
        try {
            /** @var  $validatedRequestParam */
            $validatedRequestParam = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $token = $createAuthTokenService->getToken($validatedRequestParam);
        } catch (ValidationException $exception) {
            $errorResponseData = new FailResponseDTO($exception->getMessage(), '0001');
            return Response(
                $errorResponseData->data(),
                422,
            );
        }

        $responseData = new FirstLoginResponseDTO($token);

        return Response(
            $responseData->data(),
            200,
        );
    }

}
