<?php

namespace App\Units\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:191',
            'email' => 'required|email|unique:users,email',
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
            'name.required' => 'Você precisa informar um nome',
            'name.min' => 'O nome precisa ter no mínimo 3 caracteres',
            'name.max' => 'O nome precisa ter no máximo 191 caracteres',
            'email.required' => 'Você precisa informar um e-mail',
            'email.email' => 'O e-mail informado é inválido',
            'email.unique' => 'Este e-mail já está sendo utilizado',
            'password.required' => 'Você precisa informar uma senha',
            'password.confirmed' => 'Você precisa confirmar a senha',
            'password.string' => 'A senha precisa ser um texto',
            'password.min' => 'A senha precisa ter no mínimo 8 caracteres',
        ];
    }
}
