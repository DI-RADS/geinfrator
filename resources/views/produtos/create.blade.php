@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <h2 class="content-title">Novo Produto</h2>
        <nav class="breadcrumb">
            <a href="{{ route('dashboard.index') }}" class="breadcrumb-link">Dashboard</a>
            <span>/</span>
            <a href="#" class="breadcrumb-link">Produtos</a>
            <span>/</span>
            <span>Produto</span>
        </nav>
    </div>
</div>

<div class="content-box">
    <div class="content-box-header">
        <h3 class="content-box-title">Cadastrar</h3>
        <div class="content-box-btn">
            @can('index-produto')
            <a href="{{ route('produtos.index') }}" class="btn-info align-icon-btn">
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
                <form method="POST" action="{{ route('produto.store') }}">
                    @csrf
                    @method('POST')
                    <div class="p-5 bg-white rounded-md shadow-sm space-y-8">
                        <div class="col-12 mb-3 alert alert-warning text-center">
                            <strong><span class="text-danger">*</span>Campo obrigatório</strong>
                        </div>

                        <!-- GRID PRINCIPAL -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

                            <div>
                                <label class="label-personalized">Número do Processo</label>
                                <input type="text" name="descricao_produto" class="form-personalized" placeholder="Digite o nome do produto">
                            </div>

                            <div>
                                <label class="label-personalized">Estado do Processo</label>
                                <select id="situacaoSelect" name="situacao_processo_id" class="form-personalized">
                                    <option value="" selected disabled>Selecione uma opção</option>
                                    @foreach($list_situacao_processos as $situacao)
                                    <option
                                        value="{{ $situacao->id }}"
                                        data-descricao="{{ $situacao->descricao_situacao }}">
                                        {{ $situacao->designacao_situacao }}
                                    </option>
                                    @endforeach
                                </select>
                                {{-- Descrição da situação --}}
                                <p id="descricaoSituacao"
                                    class="mt-0 m-1 text-sm text-gray-800 italic hidden">
                                </p>
                            </div>

                            <div>
                                <label class="label-personalized">Ano de Instrução</label>
                                <select id="anoInscricao" name="ano_inscricao" class="form-personalized">
                                    <option value="">Selecione o ano</option>
                                    @for ($ano = now()->year; $ano >= 1975; $ano--)
                                    <option value="{{ $ano }}">{{ $ano }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label class="label-personalized"> Data de Entrada</label>
                                <input type="datetime-local" name="" id="" class="form-personalized">
                            </div>


                            <div>
                                <label class="label-personalized">Entidade Judicial</label>
                                <select id="entidadejudidical" name="entidadejudidical_id" class="form-personalized">
                                    <option value="" selected disabled>Selecione uma opção</option>
                                    @foreach($list_entidades as $entidade)
                                    <option
                                        value="{{ $entidade->id }}"
                                        data-descricao="{{ $entidade->descricao_entidade }}">
                                        {{ $entidade->designacao_entidade }}
                                    </option>
                                    @endforeach
                                </select>
                                {{-- Descrição da situação --}}
                                <p id="descricaoentidade"
                                    class="mt-0 m-1 text-sm text-gray-800 italic hidden">
                                </p>
                            </div>

                            <div>
                                <label class="label-personalized" for="tipo_infracao">Tipo de Infração</label>
                                <select id="tipo_infracao" name="tipo_infracao_id" class="form-personalized">
                                    <option value="" selected disabled>Selecione uma opção</option>
                                    @foreach($list_tipo_infracoes as $tipo)
                                    <option value="{{ $tipo->id }}" data-descricao="{{ $tipo->descricao_tipo_infracao }}">
                                        {{ $tipo->designacao_tipo_infracao }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="label-personalized" for="selected_infracao">Infração específica</label>
                                <select id="selected_infracao" name="infracao_id" class="form-personalized">
                                    <option value="" selected disabled>Selecione uma opção</option>
                                    <!-- Opções serão carregadas via JS -->
                                </select>
                            </div>


                        </div>



                        <!-- BOTÃO FINAL -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded">
                                Salvar
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>

    </script>
</div>
@endsection