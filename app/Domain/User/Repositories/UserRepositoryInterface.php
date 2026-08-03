<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;

interface UserRepositoryInterface
{
    public function create(User $user);
    public function findById(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function update(int $id, User $user): User;
    public function delete(int $id): void;
    public function active(int $id): void;
}
