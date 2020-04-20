<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageUpdateProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // = criado assim para passar pela autorização
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:10000',
            'price' => 'required',
            'photo' => 'image|nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é obrigatório!',
            'name.min' => 'O nome precisa ter ao menos 3 letras',
            'price' => 'O preço é obrigatório',
        ];
    }
}
