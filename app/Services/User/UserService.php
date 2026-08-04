<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\Interface\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ){}

    public function create(array $data)
    {
        return $this->userRepository->create($data);
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
