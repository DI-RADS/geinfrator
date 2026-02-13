@extends('layouts.pdf')

@section('content')
<table style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr style="background-color: #e6e8f3">
            <th style="border: 1px solid #ccc;">Nº</th>
            <th>Nº do Processo</th>
            <th>Entidade Judicial</th>
            <th>Situação do Processo</th>
            <th>Data de Entrada</th>
            <th>Ano de Instrução</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($processos as $processo)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $processo->numero_processo }}</td>
            <td>{{ $processo->relation_entidade->designacao_entidade ?? 'S/N' }}</td>
            <td>{{ $processo->relation_situacaoAtual->designacao_situacao ?? 'S/N' }}</td>
            <td>{{ $processo->data_entrada ?? 'S/N' }}</td>
            <td>{{ $processo->ano_instrucao ?? 'S/N' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4">
                <div class="alert-warning">
                    Nenhum registro encontrado!
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection