<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisteredRequest extends FormRequest
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
        $name = !$this->registered ? '' : ',name,' . $this->registered->id;
        $email = !$this->registered ? '' : ',email,' . $this->registered->id;
        return [
            'name' => 'required|unique:registereds' . $name,
            'email' => 'required|email|unique:registereds' . $email,
            'address' => 'required',
            'password' => 'required|min:3|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Esse campo de Nome do usuário e obrigatorio',
            'name.unique' => 'Esse Nome já existe na tabela',

            'email.required' => 'Esse campo Email é obrigatorio',
            'email.unique' => 'Esse Email já existe na tabela',
            'email.email' => 'Esse Email é invalido, por favor utilize outro',

            'address.required' => 'Esse campo de Endereço do Usuário e obrigatorio',

            'password.required' => 'O campo Senha é obrigatorio.',
            'password.min' => 'O campo senha necessita ter pelo menos três digitos.',
            'password.confirmed' => 'A senha não está identica a senha confirmada.',
        ];
    }

}
