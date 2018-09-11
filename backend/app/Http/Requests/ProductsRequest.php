<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ProductsRequest extends FormRequest
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
        $today = Carbon::now()->format('d/m/Y');
        return [
            'name' => 'required',
            'price' => "required|regex:/^\d*(\.\d{2})?$/",
            'categories' => 'required',
            'expiration_date' => 'required|date_format:d/m/Y|after:'. $today,
            'description' => 'required',
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
            'name.required' => 'O campo nome do produto é obrigatorio',
            
            'price.required' => 'O campo preço do produto é obrigatorio',
            'price.regex' => 'Atenção esse valor digitado não é valido',
            
            'categories.required' => 'O campo categorias do produto é obrigatorio',
            
            'expiration_date.required' => 'O campo data de expiração é obrigatorio',
            'expiration_date.date_format' => 'O formato não é compativel com DD/MM/AAAA',
            'expiration_date.date_format' => 'O campo data de expiração deve ser uma data posterior a :date.',

            'description.required' => 'O campo descrição do produto é obrigatorio',
        ];
    }
}
