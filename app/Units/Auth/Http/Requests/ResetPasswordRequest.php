<?php

namespace App\Units\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    /**
     * Get the error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'token.required' => 'Você precisa informar o token de redefinição de senha',
            'email.required' => 'Você precisa informar seu e-mail',
            'email.email' => 'O e-mail informado é inválido',
            'password.required' => 'Você precisa informar uma senha',
            'password.confirmed' => 'Você precisa confirmar a senha',
            'password.string' => 'A senha precisa ser um texto',
            'password.min' => 'A senha precisa ter no mínimo 8 caracteres',
        ];
    }
}
