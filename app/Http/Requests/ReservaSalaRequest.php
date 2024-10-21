<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReservaSalaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
        $rules = [
            'nome_sala' => 'required|string|max:255',
            'dt_hr_inicio' => 'required|date|after_or_equal:today',
            'dt_hr_termino' => 'required|date|after:dt_hr_inicio',
            'nome_responsavel' => 'required|string|max:255',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['status'] = 'required|string';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nome_sala.required' => 'O campo nome da sala é obrigatório.',
            'nome_responsavel.required' => 'O campo nome do responsável é obrigatório.',
            'dt_hr_inicio.required' => 'O campo data e hora de início é obrigatório.',
            'dt_hr_inicio.after_or_equal' => 'A data e hora de início deve ser a partir de hoje.',
            'dt_hr_termino.required' => 'O campo data e hora de término é obrigatório.',
            'dt_hr_termino.after' => 'A data e hora de término deve ser após a data e hora de início.',
            'status.required' => 'O campo status é obrigatório.',  
        ];
    }
}
