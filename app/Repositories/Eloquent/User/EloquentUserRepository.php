<?php

namespace App\Repositories\Eloquent\User;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Repositories\Interface\User\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return User::query()->create($data);
    }

    public function findById(int $id): ?User
    {
        return User::query()->find($id);
    }

    public function findByEmail(string $email): ?User
    {
        $model = User::query()
            ->where('email', $email)
            ->first();

        return $model ? $model : null;
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);

        $user->fresh();

        return $user;
    }

    public function delete(int $id): void
    {
        User::query()->find($id)->delete();
    }

    public function active(int $id): void
    {
        User::query()->find($id)->restore();
    }
}
