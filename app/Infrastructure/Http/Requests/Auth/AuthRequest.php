<?php

namespace App\Infrastructure\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Override;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'max:120', 'min:6'],
            'last_name' => ['required', 'max:120', 'min:6'],
            'email' => ['required', 'email'],
            'document' => ['required', 'cpf'],
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'O primeiro nome é obrigatório',
            'first_name.max' => 'O primeiro nome precisa conter no máximo :max caracteres',
            'first_name.min' => 'O primeiro nome precisa conter pelo menos :min caracteres',

            'last_name.required' => 'O sobrenome é obrigatório',
            'last_name.max' => 'O sobrenome precisa conter no máximo :max caracteres',
            'last_name.min' => 'O sobrenome precisa conter no pelo menos :min caracteres',

            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'O e-mail precisa estar em um formatao válido.',

            'document.required' => 'O documento é obrigatório.',
            'document.cpf' => 'O documento precisa estar em um formato válido.',

            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha precisa conter ao menos :min caracteres.',
            'password.mixedCase' => 'A senha precisa de letras maiúsculas e minúsculas.',
            'password.numbers' => 'A senha precisa conter números.',
            'password.symbols' => 'A senha precisa conter ao menos um caracter especial.',

                //->mixedCase()
                //->numbers()
                //->symbols()
                //->uncompromised(),
        ];
    }
}
