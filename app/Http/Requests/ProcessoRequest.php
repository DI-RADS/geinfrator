<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProcessoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero_processo' => ['required', Rule::unique('tb_processos', 'numero_processo')->ignore($this->route('processo')), ], // ignora o processo atual       
            'descricao_processo' => 'nullable|string',
            'situacao_processo' => 'nullable|exists:tb_situacao_processos,id',
            'entidade_judicial' => 'nullable|exists:tb_entidades,id',

            // 'infracao' => 'nullable|exists:tb_infracoes,id',
        ];
    }
}

