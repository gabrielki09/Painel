<?php

namespace App\Application\User\UseCases;

use App\Application\User\DTOs\CreateUserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Services\UserService;

class CreateUserUseCase
{
    public function __construct(
        protected UserService $userService
    ){}

    public function execute(CreateUserDTO $dto): User
    {
        $user = $this->userService->create(
            $dto->firstName,
            $dto->lastName,
            $dto->email,
            $dto->document,
            $dto->passwordHash,
        );

        return $user;
    }
}
