<?php

namespace App\Domains\Authorization;

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class CreateAuthTokenService
{
    const AUTH_TOKEN_NAME = 'auth-token';
    /**
     * @param User $user
     * @return string
     */
    function getToken(User $user): string
    {
        $token = $this->refreshToken($user);

        return  "Bearer $token";
    }

    private function refreshToken(User $user): string
    {
        if (!$this->isNeedRefresh($user)) {
            return $user->getRememberToken();
        }

        $user->tokens()->delete();
        $token = $this->publishNewToken($user);

        return $token;
    }

    private function publishNewToken(User $user): string
    {
        $tokenString = $user->createToken(self::AUTH_TOKEN_NAME, ['*'], now()->addDay())->plainTextToken;
        $parseToken = explode("|", $tokenString)[1];

        $user->setRememberToken($parseToken);
        $user->save();

        return $parseToken;
    }

    private function isNeedRefresh(User $user): bool
    {
        if (is_null($user->getRememberToken()))  {
            return true;
        }

        /** @var PersonalAccessToken $latestAccessToken */
        $latestAccessToken = $user->tokens()
            ->get()
            ->filter(function (PersonalAccessToken $personalAccessToken) {
                return $personalAccessToken->name === self::AUTH_TOKEN_NAME;
            })
            ->last();

        return is_null($latestAccessToken->expires_at)
        || $latestAccessToken->expires_at->isPast();
    }
}
