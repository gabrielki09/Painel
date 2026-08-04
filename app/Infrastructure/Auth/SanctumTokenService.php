<?php

namespace App\Infrastructure\Auth;

use App\Models\User;

class SanctumTokenService
{
    public function generateToken(User $user): string
    {
        return $user->createToken('api')->plainTextToken;
    }
}
