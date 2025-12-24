@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="mb-6 flex flex-col gap-2">
    <h2 class="text-2xl font-semibold text-gray-800">Usuários</h2>

    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('dashboard.index') }}" class="hover:text-blue-600 transition">
            Dashboard
        </a>
        <span>/</span>
        <span class="text-gray-700 font-medium">Usuários</span>
    </nav>
</div>

<!-- Card -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200">

    <!-- Card Header -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">
            Listagem
        </h3>

        <a href=""
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Cadastrar
        </a>
    </div>

    <x-alert />

    <!-- Table -->
    <div class="p-6">
        <div class="overflow-x-auto">
            <div class="table-container mt-4 bg-white shadow rounded p-4">
                <table  class="table datatable min-w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Número do Processo</th>
                            <th>Data</th>
                            <th>Entidade</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($processos as $processo)
                        <tr>
                            <td>{{ $processo->id }}</td>
                            <td>{{ $processo->numero_processo }}</td>
                            <td>{{ $processo->data_processo ?? 'S/N' }}</td>
                            <td>{{ $processo->relation_entidade->designacao_entidade ?? 'S/N' }}</td>
                            <td class="text-center">
                                <div class="inline-flex space-x-1">
                                    <a href="{{ route('processo.show', $processo->id) }}"
                                        class="text-blue-500 hover:underline">Ver</a>
                                    <a href="{{ route('processo.edit', $processo->id) }}"
                                        class="text-green-500 hover:underline">Editar</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">Nenhum processo encontrado!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection