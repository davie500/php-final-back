<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CafeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:150',
            'origem' => 'required|string|max:100',
            'marca' => 'required|string|max:50',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O nome deve ser no formato texto',
            'origem.required' => 'O campo origem é obrigatório.',
            'marca.required' => 'O campo marca é obrigatório.',
            'preco.required' => 'O campo preço é obrigatório.',
            'preco.numeric' => 'O campo preço deve ser um número válido.',
            'preco.min' => 'O campo preço deve ser um valor positivo.',
        ];
    }
}
