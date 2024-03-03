<?php

namespace App\Domains\Authorization;


use App\Exceptions\BusinessException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ConfirmFirstLoginService
{
    /**
     * @param array $validatedRequestParam
     * @return User
     * @throws BusinessException
     */
    public function getUser(array $validatedRequestParam): User
    {
        $user = User::where('email', $validatedRequestParam['email'])
            ->firstOrFail();

        $isValidate = Hash::check($validatedRequestParam['password'], $user->getAuthPassword());

        $this->isValidatePassword($isValidate);

        return $user;
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
