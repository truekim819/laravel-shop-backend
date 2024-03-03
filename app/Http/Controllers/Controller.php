<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @throws BusinessException
     */
    protected function getValidateParams(Request $request, array $rules): array
    {
        try {
            $validatedRequestParam = $request->validate($rules);
        } catch (ValidationException $exception) {
            throw new BusinessException($exception->getMessage(), 1001);
        }

        return $validatedRequestParam;
    }
}
