<?php

namespace App\Repositories\Eloquent\User;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Repositories\Interface\User\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        $user = User::query()->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'document' => $data['document'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    public function findById(int $id): ?User
    {
        $model = User::query()
            ->find($id)
            ->first();

        return $model ? $model : null;
    }

    public function findByEmail(string $email): ?User
    {
        $model = User::query()
            ->where('email', $email)
            ->whereNull('deleted_at')
            ->first();

        return $model ? $model : null;
    }

    public function update(int $id, User $user): User
    {
        $model = User::query()->find($id);
        $model->update([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'document' => $user->getDocument(),
            'password' => $user->getPasswordHash(),
        ]);
        $model->fresh();

        return $model;
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
