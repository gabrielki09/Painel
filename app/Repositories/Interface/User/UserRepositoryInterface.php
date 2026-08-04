<?php

namespace App\Repositories\Interface\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function findById(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function update(int $id, User $user): User;
    public function delete(int $id): void;
    public function active(int $id): void;
}
