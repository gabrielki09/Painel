<?php

namespace App\Application\Auth\Contracts;

interface PasswordHasherInterface
{
    public function check(string $plainPassword, string $hashPassword): bool;
}
