<?php

namespace App\Infrastructure\Database\User;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Models\User as EloquentUser;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(User $data)
    {
        $user = EloquentUser::query()->create([
            'first_name' => $data->getFirstName(),
            'last_name' => $data->getLastName(),
            'email' => $data->getEmail(),
            'document' => $data->getDocument(),
            'password' => $data->getPasswordHash()
        ]);

        return $this->toDomain($user);
    }

    public function findById(int $id): ?User
    {
        $model = EloquentUser::query()
            ->find($id)
            ->first();


        return $model ? $this->toDomain($model) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $model = EloquentUser::query()
            ->where('email', $email)
            ->whereNull('deleted_at');

        return $model ? $this->toDomain($model) : null;
    }

    public function update(int $id, User $user): User
    {
        $model = EloquentUser::query()->find($id);
        $model->update([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'document' => $user->getDocument(),
            'password' => $user->getPasswordHash(),
        ]);
        $model->fresh();

        return $this->toDomain($model);
    }

    public function delete(int $id): void
    {
        EloquentUser::query()->find($id)->delete();
    }

    public function active(int $id): void
    {
        EloquentUser::query()->find($id)->restore();
    }

    private function toDomain(EloquentUser $user): User
    {
        return new User(
            firstName: $user->first_name,
            lastName: $user->last_name,
            email: $user->email,
            document: $user->document,
            passwordHash: $user->password,
            id: $user->id,
        );
    }
}
