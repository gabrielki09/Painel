<?php

namespace App\Application\User\UseCases;

use App\Application\Auth\Contracts\PasswordHasherInterface;
use App\Application\User\DTOs\LoginDTO;
use App\Domain\User\Services\UserService;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class LoginUserUseCase
{
    public function __construct(
        private UserService $userService,
        private PasswordHasherInterface $passwordHasher
    ){}

    public function login(LoginDTO $dto) {
        $user = $this->userService->findByEmail($dto->email);

        if(! $this->passwordHasher->check($dto->password, $user->getPasswordHash())) throw new InvalidArgumentException('As credenciais informadas são inválidas.');

        return $user;
    }
}
