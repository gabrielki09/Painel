<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\Interface\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ){}

    private function generateToken(User $user): string
    {
        return $user->createToken('api')->plainTextToken;
    }

    private function checkHash(string $plainPassword, string $hashPassword): bool
    {
        return Hash::check($plainPassword, $hashPassword);
    }

    public function login(array $data): array
    {
        $user = $this->userRepository->findByEmail($data['email']);

        if(! $user )
        {
            throw new InvalidArgumentException('Credencias incorretas.');
        }

        if(! $this->checkHash($data['password'], $user->password) )
        {
            throw new InvalidArgumentException('Credencias incorretas.');
        }

        return [
            'user' => $user,
            'token' => $this->generateToken($user)
        ];
    }

    public function register(array $data): array
    {
        $user = $this->userRepository->create($data);

        return [
            'user' => $user
        ];
    }

    public function logout(User $user): void
    {
        $token = $user->currentAccessToken();

        if ( $token instanceof PersonalAccessToken )
        {
            $token->delete();
        }
    }
}
