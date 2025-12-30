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
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Entidade</th>
                        <td class="px-4 py-3 text-sm text-gray-800"> {{ $processo->relation_entidade->designacao_entidade ?? 'S/N' }} </td>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Situação do Processo</th>
                        <td class="px-4 py-3 text-sm text-gray-800 flex items-center gap-3">
                            {{ $processo->ralation_situacao_processo->designacao_situacao ?? 'S/N' }}
                            <button onclick="openModal()"
                                class="rounded-md bg-yellow-500 px-3 py-1 text-sm font-semibold text-white hover:bg-yellow-600 transition">
                                Alterar
                            </button>
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
    </div>
</div>

<!-- MODAL -->
<div id="crud-modal" class="hidden fixed inset-0 z-50 flex items-start justify-center bg-black/50 overflow-y-auto">
    <div class="relative w-full max-w-md mt-20 bg-white rounded-xl shadow-lg">
        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Alterar Situação do Processo</h3>
            <button onclick="closeModal()"
                class="text-gray-500 hover:text-gray-700 rounded-full p-1 transition">✕</button>
        </div>

        <!-- BODY -->
        <div class="px-6 py-4">
            <form method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Situação do Processo</label>
                    <select class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm focus:border-yellow-500 focus:ring-yellow-500">
                        <option selected disabled>Selecione</option>
                        <option>Ativo</option>
                        <option>Suspenso</option>
                        <option>Encerrado</option>
                    </select>
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

<script>
    function openModal() {
        document.getElementById('crud-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('crud-modal').classList.add('hidden');
    }
</script>
@endsection