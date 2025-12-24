@extends('layouts.admin')

@section('content')
<!-- Título e Trilha de Navegação -->
<div class="content-wrapper">
    <div class="content-header">
        <h2 class="content-title">Curso</h2>
        <nav class="breadcrumb">
            <a href="{{ route('dashboard.index') }}" class="breadcrumb-link">Dashboard</a>
            <span>/</span>
            <a href="{{ route('processos.index') }}" class="breadcrumb-link">Processos</a>
            <span>/</span>
            <span>Curso</span>
        </nav>
    </div>
</div>

<div class="content-box">
    <div class="content-box-header">
        <h3 class="content-box-title">Detalhes</h3>
        <div class="content-box-btn">

            <a href="{{ route('processos.index') }}" class="btn-info align-icon-btn">
                <!-- Ícone queue-list (Heroicons) -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
                <span>Listar</span>
            </a>
        </div>
    </div>
    <x-alert />
    <!-- Content -->
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <tbody class="divide-y divide-gray-200">

                    <tr class="hover:bg-gray-50">
                        <th class="w-1/3 px-4 py-3 text-left text-sm font-medium text-gray-600">
                            ID
                        </th>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            {{ $processo->id ?? 'S/N' }}
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                            Nº do Processo
                        </th>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            {{ $processo->numero_processo ?? 'S/N' }}
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                            Descrição do Processo
                        </th>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            {{ $processo->descricao_processo ?? 'S/N' }}
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                            Ano de Instrução
                        </th>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            {{ $processo->ano_instrucao ?? 'S/N' }}
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                            Data de Entrada
                        </th>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            {{ $processo->data_entrada ?? 'S/N' }}
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                            Situação do Processo
                        </th>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            {{ $processo->ralation_situacao_processo->designacao_situacao ?? 'S/N' }}
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                            Entidade
                        </th>
                        <td class="px-4 py-3 text-sm text-gray-800">
                            {{ $processo->relation_entidade->designacao_entidade ?? 'S/N' }}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection