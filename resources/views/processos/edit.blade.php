@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <h2 class="content-title">Editar Processo</h2>
        <nav class="breadcrumb">
            <a href="{{ route('dashboard.index') }}" class="breadcrumb-link">Dashboard</a>
            <span>/</span>
            <a href="#" class="breadcrumb-link">processos</a>
            <span>/</span>
            <span>Processo</span>
        </nav>
    </div>
</div>

<div class="content-box">
    <div class="content-box-header">
        <h3 class="content-box-title">Cadastrar</h3>
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

    <div class="w-full">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <form method="POST" action="{{ route('processo.update', $processo->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="p-5 bg-white rounded-md shadow-sm space-y-8">
                        <div class="col-12 mb-3 alert alert-warning text-center">
                            <strong><span class="text-danger">*</span> Campo obrigatório</strong>
                        </div>

                        <!-- GRID PRINCIPAL -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

                            <div>
                                <label class="label-personalized">Nº do Processo <span class="text-danger">*</span></label>
                                <input type="text" name="numero_processo" class="form-personalized" value="{{ old('numero_processo', $processo->numero_processo) }}">
                            </div>


                            <div>
                                <label for="situacao_processo" class="label-personalized">Estado do Processo</label>
                                <select id="situacaoSelect" name="situacao_processo" class="form-personalized">
                                    <option value="" disabled>Selecione uma opção</option>
                                    @foreach($list_situacao_processos as $situacao)
                                    <option value="{{ $situacao->id }}"
                                        @selected(old('situacao_processo', $processo->situacao_id) == $situacao->id)>
                                        {{ $situacao->designacao_situacao }}
                                    </option>
                                    @endforeach
                                </select>
                                {{-- Descrição da situação --}}
                                <p id="descricaoSituacao"
                                    class="mt-1 text-sm text-gray-800 italic hidden">
                                </p>
                            </div>




                            <div>
                                <label for="ano_de_instrucao" class="label-personalized">Ano de Instrução</label>
                                <select id="anoInscricao" name="ano_de_instrucao" class="form-personalized">
                                    <!-- Opção padrão -->
                                    <option value="" disabled
                                        {{ old('ano_de_instrucao', $processo->ano_instrucao) ? '' : 'selected' }}>
                                        Selecione o ano
                                    </option>

                                    <!-- Gera todos os anos -->
                                    @for ($ano = now()->year; $ano >= 1975; $ano--)
                                    <option value="{{ $ano }}"
                                        {{ old('ano_de_instrucao', $processo->ano_instrucao) == $ano ? 'selected' : '' }}>
                                        {{ $ano }}
                                    </option>
                                    @endfor
                                </select>
                            </div>

                            <div>
                                <label for="data_de_entrada" class="label-personalized"> Data de Entrada</label>
                                <input type="datetime-local" name="data_de_entrada" id="data_de_entrada" class="form-personalized"
                                    value="{{ old('data_de_entrada', $processo->data_entrada) }}">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                            <div>
                                <label class="label-personalized">Entidade Judicial</label>
                                <select name="entidade_judicial" id="entidade_judicial" class="form-personalized">
                                    <option value="" disabled {{ old('entidade_id', $processo->entidade_id) ? '' : 'selected' }}>Selecione uma Entidade</option>
                                    @foreach ($list_entidades as $entidade)
                                    <option value="{{ $entidade->id }}"
                                        {{ old('entidade_id', $processo->entidade_id) == $entidade->id ? 'selected' : '' }}>
                                        {{ $entidade->designacao_entidade }}
                                    </option>
                                    @endforeach
                                </select>
                                {{-- Descrição da situação --}}
                                <p id="descricaoentidade"
                                    class="mt-0 m-1 text-sm text-gray-800 italic hidden">
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                            <div>
                                <label for="descricao_processo" class="label-personalized">Descrição</label>
                                <textarea name="descricao_processo" id="descricao_processo" cols="3" rows="5" class="form-personalized"
                                    value="{{ old('descricao_processo', $processo->descricao_processo) }}">Descreve o processo
                                    
                                </textarea>
                                <!-- BOTÃO FINAL -->
                                <div class="flex justify-end">
                                    <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded">
                                        Salvar
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
</div>
<script>

</script>
</div>
@endsection