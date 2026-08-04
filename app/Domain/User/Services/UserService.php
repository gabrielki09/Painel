<?php

namespace App\Domain\User\Services;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ){}

    public function create(
        string $firstName,
        string $lastName,
        string $email,
        string $document,
        string $passwordHash,
    ) {

        return $this->userRepository->create(new User(
            $firstName,
            $lastName,
            $email,
            $document,
            Hash::make($passwordHash),
        ));
    }

    public function findById(int $id): ?User
    {
        $user = $this->userRepository->findById($id);

        if (! $user ) throw new ModelNotFoundException('As credenciais informadas são inválidas.');

        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        $user = $this->userRepository->findByEmail($email);

        if (! $user ) throw new ModelNotFoundException('Usuário não locaizado.');

        return $user;
    }

    public function update(int $id, User $data): User
    {
        $user = $this->userRepository->update($id, $data);

        return $user;
    }

    public function delete(int $id): void
    {
        $this->userRepository->delete($id);
        return;
    }

    public function active(int $id): void
    {
        $this->userRepository->active($id);
        return;
    }
}
