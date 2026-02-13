@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <h2 class="content-title">Processo</h2>
        <nav class="breadcrumb">
            <a href="{{ route('dashboard.index') }}" class="breadcrumb-link">Dashboard</a>
            <span>/</span>
            <a href="{{ route('processos.index') }}" class="breadcrumb-link">Processos</a>
            <span>/</span>
            <span>Processo</span>
        </nav>
    </div>
</div>

<div class="content-box">
    <div class="content-box-header">
        <h3 class="content-box-title">Detalhes</h3>
        <div class="content-box-btn">
            @can('index-processo')
            <a href="{{ route('processos.index') }}" class="btn-info align-icon-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
                <span>Listar</span>
            </a>
            @endcan
        </div>
    </div>

    <x-alert />

    <!-- Conteúdo -->
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <tbody class="divide-y divide-gray-200">

                    <tr class="hover:bg-gray-50">
                        <th class="w-1/3 px-4 py-3 text-left text-sm font-medium text-gray-600">ID</th>
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $processo->id ?? 'S/N' }}</td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Nº do Processo</th>
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $processo->numero_processo ?? 'S/N' }}</td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Ano de Instrução</th>
                        <td class="px-4 py-3 text-sm text-gray-800"> {{ $processo->ano_instrucao ?? 'S/N' }} </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Data de Entrada</th>
                        <td class="px-4 py-3 text-sm text-gray-800"> {{ $processo->data_entrada ?? 'S/N' }} </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Entidade Judicial</th>
                        <td class="px-4 py-3 text-sm text-gray-800"> {{ $processo->relation_entidade->designacao_entidade ?? 'S/N' }} </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Situação actual</th>
                        <td class="px-4 py-3 text-sm text-gray-800 flex items-center gap-3">
                            {{ $processo->relation_situacaoAtual->designacao_situacao ?? 'S/N' }}
                            <button onclick="openModal()"
                                class="rounded-md bg-yellow-500 px-3 py-1 text-sm font-semibold text-white hover:bg-yellow-600 transition">
                                Alterar
                            </button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Situação anterior</th>
                        <td class="px-4 py-3 text-sm text-gray-800 flex items-center gap-3">
                            {{ optional( $processo->relation_historico_situacoes->sortBy('created_at')->slice(0,-1)->last() ?->relation_situacao)->designacao_situacao ?? 'S/N'}}
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Descrição</th>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            <div class="max-h-24 overflow-y-auto p-1 border border-gray-100 rounded">
                                {{ $processo->descricao_processo ?? 'S/N' }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br class="border-gray-200">
        <div x-data="{ tab: 'resumo' }" class="mt-8">

            <!-- Cabeçalho das abas -->
            <div class="flex border-b border-gray-200">
                <button
                    @click="tab = 'resumo'"
                    :class="tab === 'resumo'
                ? 'border-b-2 border-blue-600 text-blue-600'
                : 'text-gray-500'"
                    class="px-4 py-2 font-medium text-sm">
                    Fluxo da Situação
                </button>

                <button
                    @click="tab = 'infratores'"
                    :class="tab === 'infratores'
                ? 'border-b-2 border-blue-600 text-blue-600'
                : 'text-gray-500'"
                    class="px-4 py-2 font-medium text-sm">
                    Infratores
                </button>

                <button
                    @click="tab = 'historico'"
                    :class="tab === 'historico'
                ? 'border-b-2 border-blue-600 text-blue-600'
                : 'text-gray-500'"
                    class="px-4 py-2 font-medium text-sm">
                    Histórico Completo
                </button>
            </div>

            <!-- CONTEÚDO DAS ABAS -->
            <div class="mt-4">

                <!-- RESUMO -->
                <div x-show="tab === 'resumo'" x-cloak>
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                        <tbody class="divide-y divide-gray-200">

                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                    Situação inicial
                                </th>
                                <td class="px-4 py-3 text-sm text-gray-800">
                                    {{
                                optional(
                                    $processo->relation_historico_situacoes
                                        ->sortBy('created_at')
                                        ->first()
                                        ?->relation_situacao
                                )->designacao_situacao ?? 'S/N'
                            }}
                                </td>
                            </tr>

                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                    Situação anterior
                                </th>
                                <td class="px-4 py-3 text-sm text-gray-800">
                                    {{
                                optional(
                                    $processo->relation_historico_situacoes
                                        ->sortBy('created_at')
                                        ->slice(0, -1)
                                        ->last()
                                        ?->relation_situacao
                                )->designacao_situacao ?? 'S/N'
                            }}
                                </td>
                            </tr>

                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                    Situação atual
                                </th>
                                <td class="px-4 py-3 text-sm font-semibold text-green-700">
                                    {{ $processo->relation_situacaoAtual->designacao_situacao ?? 'S/N' }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- INFRATORES -->
                <div x-show="tab === 'infratores'" x-cloak>
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    Aqui vai a lista de infratores vinculados ao processo.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- HISTÓRICO -->
                <div x-show="tab === 'historico'" x-cloak>
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Data</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Situação</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Motivo</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($processo->relation_historico_situacoes->sortBy('created_at') as $historico)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-700">
                                    {{ $historico->data_alt_situacao ?? $historico->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    {{ $historico->relation_situacao->designacao_situacao ?? 'S/N' }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700">
                                    {{ $historico->motivo_alteracao ?? '—' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-center text-sm text-gray-500">
                                    Nenhuma alteração registrada.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        <!-- MODAL -->
        <div id="crud-modal" class="hidden fixed inset-0 z-50 flex items-start justify-center bg-black/50 overflow-y-auto">
            <div class="relative w-full max-w-2xl mt-20 bg-white rounded-xl shadow-lg">
                <!-- HEADER -->
                <div class="flex items-center justify-between px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Alterar Situação</h3>
                    <button onclick="closeModal()"
                        class="text-gray-500 hover:text-gray-700 rounded-full p-1 transition">✕</button>
                </div>

                <!-- BODY -->
                <div class="px-6 py-4">
                    <form method="POST" action="{{ route('processos.altsituacaoprocesso', $processo->id) }}">
                        @csrf
                        @method('PUT')
                        <!-- GRID PRINCIPAL -->
                        <div class="grid grid-cols-6 gap-5">
                            <div class="col-span-6 md:col-span-3">
                                <label class="label-personalized">Situação do Processo</label>
                                <select name="situacao_processo_id" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2">
                                    <option selected disabled>Selecione uma opção</option>
                                    @foreach($list_situacao_processos as $situacao)
                                    <option value="{{ $situacao->id }}" {{ $processo->situacao_processo_id == $situacao->id ? 'selected' : '' }}>
                                        {{ $situacao->designacao_situacao }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-6 md:col-span-3">
                                <label class="label-personalized">Data de Alteração</label>
                                <input type="date" name="data_alt_situacao" id="data_alt_situacao" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2">
                            </div>

                            <div class="col-span-6">
                                <label for="motivo_alteracao" class="label-personalized">Descrição o Motivo</label>
                                <textarea name="motivo_alteracao" id="motivo_alteracao" cols="3" rows="3" class="form-personalized" placeholder="Descreva o processo">
                        Descreve o motivo da alteração da situação do processo.         
                        </textarea>
                            </div>
                        </div>

                        <!-- FOOTER -->
                        <div class="flex justify-end gap-2 mt-4 border-t pt-4">
                            <button type="button" onclick="closeModal()"
                                class="px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition">Cancelar</button>
                            <button type="submit"
                                class="px-4 py-2 rounded-md bg-yellow-500 text-white hover:bg-yellow-600 transition">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('crud-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('crud-modal').classList.add('hidden');
    }
</script>
@endsection