<?php

namespace App\Infrastructure\Http\Auth;

use App\Application\User\DTOs\CreateUserDTO;
use App\Application\User\DTOs\LoginDTO;
use App\Application\User\UseCases\CreateUserUseCase;
use App\Application\User\UseCases\LoginUserUseCase;
use App\Infrastructure\Http\Requests\Auth\AuthRequest;

class AuthController
{
    public function __construct(
        private CreateUserUseCase $createUserUseCase,
        private LoginUserUseCase $loginUserUseCase
    ){}

    public function login()
    {
        $data = $req->validate([
            'email' => ['required'],
            'password' => ['required']
        ], [
            'email.required' => 'O e-mail é obrigatório',
            'password.required' => 'A senha é obrigatória',
        ]);

        $dto = new LoginDTO(
            email: $data['email'],
            password: $data['password']
        );

        $user = $this->loginUserUseCase->login($dto);


        return apiSuccess(
            'Login realizado com sucesso!',
            [
                'user' =
            ]
        );
    }

    public function register(AuthRequest $req)
    {
        $data = $req->validated();

        $dto = new CreateUserDTO(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['document'],
            $data['password'],
        );

        $user = $this->createUserUseCase->execute($dto);

        return apiSuccess(
            'Usuário cadastrado com sucesso!',
            [
                'user' => [
                    'id' => $user->getId(),
                    'first_name' => $user->getFirstName(),
                    'last_name' => $user->getLastName(),
                    'email' => $user->getEmail(),
                    'document' => $user->getDocument(),
                ]
            ],
        201);
    }

    public function logout()
    {

    }
}
