@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="mb-6 flex flex-col gap-2">
    <h2 class="text-2xl font-semibold text-gray-800">Processos</h2>

    <nav class="flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('dashboard.index') }}" class="hover:text-blue-600 transition">
            Dashboard
        </a>
        <span>/</span>
        <span class="text-gray-700 font-medium">Processos</span>
    </nav>
</div>

<!-- Card -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200">

    <!-- Card Header -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">
            Listagem
        </h3>
        @can('create-processo')
        <a href="{{ route('processo.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Cadastrar
        </a>
        @endcan
    </div>

    <x-alert />

    <!-- Table -->
    <div class="p-6">
        <div class="overflow-x-auto">
            <div class="mt-4 bg-white shadow rounded p-4">
                <div class="dt-filters p-4 bg-white rounded shadow">
                    <form method="GET" action="{{ route('processos.index') }}" class="flex flex-wrap gap-4 items-end" x-data="{ tipoFiltro: '{{ request('tipo_filtro') }}' }">

                        <!-- Select Principal -->
                        <div class="flex flex-col">
                            <label class="mb-1 text-sm font-medium text-gray-700 flex items-center gap-1">
                                <i class="fa fa-filter text-blue-500"></i> Tipo de Filtro
                            </label>
                            <select name="tipo_filtro" x-model="tipoFiltro" class="form-personalized pl-3 pr-8">
                                <option value="" selected disabled>Selecione uma opção</option>
                                <option value="Geral">Geral</option>
                                <option value="filtro_entidade">Entidade Judicial</option>
                                <option value="filtro_situacao">Situação do Processo</option>
                                <option value="filtro_por_data">Por Data</option>
                            </select>
                        </div>

                        <!-- Campos extras: Entidade Judicial -->
                        <div class="flex flex-col" x-show="tipoFiltro == 'filtro_entidade'">
                            <label class="mb-1 text-sm font-medium text-gray-700 flex items-center gap-1">
                                <i class="fa fa-building text-green-500"></i> Escolha a Entidade
                            </label>
                            <select name="entidade" class="form-personalized pl-3 pr-8">
                                <option value="" disabled selected>Selecione uma opção</option>
                                @foreach($list_entidades as $entidade)
                                <option value="{{ $entidade->id }}" {{ request('entidade') == $entidade->id ? 'selected' : '' }}>
                                    {{ $entidade->designacao_entidade }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campos extras: Situação do Processo -->
                        <div class="flex flex-col" x-show="tipoFiltro == 'filtro_situacao'">
                            <label class="mb-1 text-sm font-medium text-gray-700 flex items-center gap-1">
                                <i class="fa fa-building text-green-500"></i> Escolha a Situação
                            </label>
                            <select name="situacao" class="form-personalized pl-3 pr-8">
                                <option value="" disabled selected>Selecione uma opção</option>
                                @foreach($list_situacao_processos as $situacao)
                                <option value="{{ $situacao->id }}" {{ request('situacao') == $situacao->id ? 'selected' : '' }}>
                                    {{ $situacao->designacao_situacao }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campos extras: Data -->
                        <div class="flex flex-col" x-show="tipoFiltro == 'filtro_por_data'">
                            <label class="mb-1 text-sm font-medium text-gray-700 flex items-center gap-1">
                                <i class="fa fa-calendar-alt text-yellow-500"></i> Data Inicial
                            </label>
                            <input type="date" name="data_inicio" class="form-personalized" value="{{ request('data_inicio') }}">
                        </div>
                        <div class="flex flex-col" x-show="tipoFiltro == 'filtro_por_data'">
                            <label class="mb-1 text-sm font-medium text-gray-700 flex items-center gap-1">
                                <i class="fa fa-calendar-check text-red-500"></i> Data Final
                            </label>
                            <input type="date" name="data_fim" class="form-personalized" value="{{ request('data_fim') }}">
                        </div>

                        <!-- Botão Filtrar -->
                        <div class="flex flex-col justify-end">
                            <button type="submit" class="flex items-center gap-2 text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-md px-4 py-2 transition-colors">
                                <i class="fa fa-search"></i> Filtrar
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Campos para filtrar relatório em PDF -->
                <div class="flex flex-wrap justify-between items-center gap-4 mb-4 bg-white shadow rounded p-4">

                    <!-- Checkboxes das colunas -->
                    <div class="flex flex-wrap gap-3 items-center">
                        <span class="font-medium text-gray-700">Colunas a imprimir:</span>
                        <label class="flex items-center gap-1"><input type="checkbox" class="toggle-col" data-col="numero_processo" checked> Nº do Processo</label>
                        <label class="flex items-center gap-1"> <input type="checkbox" class="toggle-col" data-col="entidade" checked> Entidade</label>
                        <label class="flex items-center gap-1"><input type="checkbox" class="toggle-col" data-col="situacao" checked> Situação</label>
                        <label class="flex items-center gap-1"><input type="checkbox" class="toggle-col" data-col="data_entrada" checked> Data de Entrada</label>
                        <label class="flex items-center gap-1"><input type="checkbox" class="toggle-col" data-col="ano_instrucao" checked> Ano de Instrução</label>
                    </div>

                    @can('generate-pdf-processos')
                    <!--a href="{{ route('processos.generate-pdf') . (request()->getQueryString() ? '?' . request()->getQueryString() : '') }}"
                        class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625A3.375 3.375 0 0 0 16.125 8.25H13.5
              A1.125 1.125 0 0 1 12.375 7.125V5.625
              A3.375 3.375 0 0 0 9 2.25H5.625
              A1.125 1.125 0 0 0 4.5 3.375v17.25
              A1.125 1.125 0 0 0 5.625 21.75h12.75
              A1.125 1.125 0 0 0 19.5 20.625Z" />
                        </svg>
                        <span>PDF</span>
                    </!--a-->
                    @endcan
                    @can('pdf-index-processos')
                    <!--div class="flex-shrink-0">
                        <a href="{{ url('processos/generate-pdf') . (request()->getQueryString() ? '?' . request()->getQueryString() : '') }}"
                            target="_blank"
                            class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-md transition-colors">
                            < Ícone PDF em SVG
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zM6 20V4h9v5h5v11H6z" />
                                <path d="M13 10h-2v6h2v-6zm4 0h-2v6h2v-6z" />
                            </svg>
                            <span>PDF</span>
                        </a>
                    <-div-->
                    @endcan


                    <!-- Botão PDF no canto direito -->
                    @can('create-processo')
                    <div class="flex-shrink-0">

                        <a href="{{ route('processos.generate-pdf', request()->query()) }}" target="_blank"
                            class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-md transition-colors">
                            <!-- Ícone PDF em SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zM6 20V4h9v5h5v11H6z" />
                                <path d="M13 10h-2v6h2v-6zm4 0h-2v6h2v-6z" />
                            </svg>
                            <span>PDF</span>
                        </a>
                    </div>
                    @endcan


                </div>

                <table class="datatable min-w-full">
                    <thead class="text-lg text-body bg-neutral-secondary-soft border-b rounded-base border-gray-200">
                        <tr>
                            <th>#</th>
                            <th>Nº do Processo</th>
                            <th>Entidade Judicial</th>
                            <th>Situação do Processo</th>
                            <th>Data de Entrada</th>
                            <th>Ano de Instrução</th>
                            <th class="text-center">Ações</th>
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
                            <td class="text-center relative">
                                <!-- botão -->
                                <!-- Botão -->
                                <button type="button"
                                    data-id="{{ $processo->id }}"
                                    class="dropdown-btn inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-3 py-1 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Ações
                                    <svg id="arrow-{{ $processo->id }}" class="-mr-1 ml-2 h-5 w-5 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </td>

                            <!-- Dropdown movido para o body -->
                            <div id="dropdown-{{ $processo->id }}" class="drop-content absolute w-44 rounded-md shadow-lg bg-white overflow-hidden max-h-0 transition-all duration-300 ease-in-out z-50">
                                @can('show-processo')
                                <a href="{{ route('processo.show', $processo->id) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <!-- Ícone Eye -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    Ver
                                </a>
                                @endcan

                                @can('edit-processo')
                                <a href="{{ route('processo.edit', $processo->id) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <!-- Ícone Pencil -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                                    </svg>
                                    Editar
                                </a>
                                @endcan

                                @can('destroy-processo')
                                <form id="delete-form-{{ $processo->id }}"
                                    action="{{ route('processo.destroy', ['processo' => $processo->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="button" onclick="confirmDelete({{ $processo->id }})" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        <!-- Ícone Trash -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9M9.394 18l.346-9m9.968-3.21c.342.052.682.107 1.022.166M18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397" />
                                        </svg>
                                        Apagar
                                    </button>
                                </form>
                                @endcan
                            </div>


                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">Nenhum processo encontrado!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let activeDropdown = null;

        document.querySelectorAll('.dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation(); // evita disparar o evento do document
                const id = this.dataset.id;
                const dropdown = document.getElementById(`dropdown-${id}`);
                const arrow = document.getElementById(`arrow-${id}`);

                // Fecha dropdown ativo se for diferente
                if (activeDropdown && activeDropdown.dropdown !== dropdown) {
                    activeDropdown.dropdown.classList.remove('max-h-52');
                    activeDropdown.arrow.classList.remove('rotate-180');
                }

                // Alterna dropdown clicado
                const isOpen = dropdown.classList.contains('max-h-52');
                if (isOpen) {
                    dropdown.classList.remove('max-h-52');
                    arrow.classList.remove('rotate-180');
                    activeDropdown = null;
                } else {
                    const rect = this.getBoundingClientRect();
                    dropdown.style.top = rect.bottom + window.scrollY + "px";
                    dropdown.style.left = rect.left + window.scrollX + "px";
                    dropdown.classList.add('max-h-52');
                    arrow.classList.add('rotate-180');
                    activeDropdown = {
                        dropdown,
                        arrow
                    };
                }
            });
        });

        // Fecha dropdown ao clicar fora
        document.addEventListener('click', function() {
            if (activeDropdown) {
                activeDropdown.dropdown.classList.remove('max-h-52');
                activeDropdown.arrow.classList.remove('rotate-180');
                activeDropdown = null;
            }
        });
    </script>


</div>
@endsection