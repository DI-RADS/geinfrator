<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoricoSitProcessoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ou lógica de permissão
    }

    public function rules(): array
    {
        return [
            'situacao_processo_id' => 'required|exists:tb_situacao_processos,id',
            'motivo_alteracao'     => 'nullable|string',
            'data_alt_situacao'    => 'nullable|date'
        ];
    }

    public function messages(): array
    {
        return [
            'situacao_processo_id.required' => 'A situação do processo é obrigatória.',
            'situacao_processo_id.exists'   => 'Situação inválida.'
        ];
    }
}
