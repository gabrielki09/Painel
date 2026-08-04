<?php

namespace App\Http\Controller\Auth;

use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController
{
    public function __construct(
        protected AuthService $authService
    ){}

    public function login(AuthLoginRequest $req)
    {
        $data = $req->validated();

        return apiSuccess(
            'Login realizado com sucesso!',
            $this->authService->login($data)
        );
    }

    public function register(AuthRequest $req)
    {
        $data = $req->validated();

        return apiSuccess(
            'Usuário cadastrado com sucesso!',
            $this->authService->register($data)
        );
    }

    public function logout(Request $req)
    {
        $this->authService->logout($req->user());

        return apiSuccess(
            'Logout bem sucedido!'
        );
    }
}
