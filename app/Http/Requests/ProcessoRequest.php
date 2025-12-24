<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessoRequest extends FormRequest
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
            'situacao_processo'    => 'nullable|exists:tb_situacao_processos,id',
            'entidade_judicial'    => 'nullable|exists:tb_entidades,id'
           // 'infracao'    => 'nullable|exists:tb_infracoes,id'
        ];
    }
}
