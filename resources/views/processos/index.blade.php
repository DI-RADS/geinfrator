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
                <div class="dt-filters flex flex-col md:flex-row gap-3 mb-4 items-end">
                    <div class="flex gap-2 items-center">
                        <select id="filtro-entidade" class="form-personalized">
                            <option value="" selected disabled>Selecione uma opção</option>
                            <option value="Geral">Geral</option>
                            <option value="Tribunal Militar">Tribunal Militar</option>
                            <option value="Procuradoria da República">Procuradoria da República</option>
                            <option value="filtro-por-data">Por Data</option>
                        </select>
                        <button id="btn-filtrar" class="text-white bg-blue-600 border border-blue-600 hover:bg-blue-700 hover:text-white 
                        focus:ring-4 focus:ring-blue-300 font-medium leading-5 rounded-md text-sm px-4 py-2 
                        focus:outline-none transition-colors">
                            Filtrar
                        </button>
                    </div>
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
                            <td>{{ $processo->ralation_situacao_processo->designacao_situacao ?? 'S/N' }}</td>
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
                                <button type="button" onclick="confirmDelete({{ $processo->id }})" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    <!-- Ícone Trash -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9M9.394 18l.346-9m9.968-3.21c.342.052.682.107 1.022.166M18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397" />
                                    </svg>
                                    Apagar
                                </button>
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