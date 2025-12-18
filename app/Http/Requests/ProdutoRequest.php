<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // permite que qualquer usuário autorizado use este request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'descricao_produto' => 'required|string|max:255|unique:tb_produtos,designacao_produto',
            'marca_id'          => 'required|exists:tb_marcas,id',
            'preco_kwanza'      => 'required|string',
            'quantidade_prod'   => 'nullable|integer|min:1',
            'estado_produto'    => 'nullable|exists:tb_estados,id',
            'has_series'        => 'nullable|boolean',
            'series_json'       => 'nullable|string',
        ];
    }
}
