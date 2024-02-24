<?php

namespace App\Domains\Authorization;

use App\Exceptions\BusinessException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CreateAuthTokenService
{
    /**
     * @param array $validatedRequestParam
     * @return string
     * @throws BusinessException
     */
    function getToken(array $validatedRequestParam): string
    {
        $user = $this->getUser($validatedRequestParam);
        /** @var null|string $token */
        $token = $user->getRememberToken();

        if ($token === "") {
            $token = $this->createToken($user);
        }

        return  $token;
    }

    /**
     * @param array $validatedRequestParam
     * @return User
     * @throws BusinessException
     */
    private function getUser(array $validatedRequestParam): User
    {
        $user = User::where('email', $validatedRequestParam['email'])
            ->firstOrFail();

        $isValidate = Hash::check($validatedRequestParam['password'], $user->getAuthPassword());

        $this->isValidatePassword($isValidate);

        return $user;
    }

    private function createToken(User $user): string
    {
        $tokenString = $user->createToken('auth-token')->plainTextToken;
        $parseToken = explode("|", $tokenString)[1];

        $user->setRememberToken($parseToken);
        $user->save();

        return $parseToken;
    }

    /**
     * @param bool $isValidate
     * @throws BusinessException
     */
    private function isValidatePassword(bool $isValidate): void
    {
        if (!$isValidate) {
            throw new BusinessException("로그인 검증 실패 오류", 1002);
        }
    }
}
