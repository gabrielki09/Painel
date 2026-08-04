<?php

namespace App\Infrastructure\Auth;

use App\Application\Auth\Contracts\PasswordHasherInterface;
use Illuminate\Support\Facades\Hash;

class LaravelPasswordHasher implements PasswordHasherInterface
{
    public function check(string $plainPassword, string $hashPassword): bool
    {
        return Hash::check($plainPassword, $hashPassword);
    }
}
