<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SalasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permitir que qualquer usuário faça a requisição
    }

    /**
     * Custom response for validation failure.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('id') ?? 'null'; 

        return [
            'nome_sala' => [
                'required',
                'string',
                'max:255',
                'unique:salas,nome_sala,' . $id, 
            ],
        ];
    }

    /**
     * Custom messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'nome_sala.required' => 'O campo nome da sala é obrigatório.',
            'nome_sala.string' => 'O nome da sala deve ser uma string.',
            'nome_sala.max' => 'O nome da sala não pode exceder 255 caracteres.',
            'nome_sala.unique' => 'Esse nome de sala já está em uso.', 
        ];
    }
}
