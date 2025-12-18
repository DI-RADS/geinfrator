@extends('layouts.admin')

@section('content')
    <!-- Título e Trilha de Navegação -->
    <div class="content-wrapper">
        <div class="content-header">
            <h2 class="content-title">Curso</h2>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard.index') }}" class="breadcrumb-link">Dashboard</a>
                <span>/</span>
                <a href="{{ route('produtos.index') }}" class="breadcrumb-link">Cursos</a>
                <span>/</span>
                <span>Curso</span>
            </nav>
        </div>
    </div>

    <div class="content-box">
        <div class="content-box-header">
            <h3 class="content-box-title">Detalhes</h3>
            <div class="content-box-btn">
           
                    <a href="{{ route('produtos.index') }}" class="btn-info align-icon-btn">
                        <!-- Ícone queue-list (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                        </svg>
                        <span>Listar</span>
                    </a>
           
               
                    <a href="{{ route('produto.edit', ['produto' => $produto->id]) }}" class="btn-warning align-icon-btn">
                        <!-- Ícone pencil-square (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        <span>Editar</span>
                    </a>
            

            </div>
        </div>

        <x-alert />
        <div class="detail-box">

            <div class="mb-1">
                <span class="title-detail-content">ID: </span>
                <span class="detail-content">{{ $produto->id ?? 'S/N'}}</span>
            </div>

            <div class="mb-1">
                <span class="title-detail-content">Nome: </span>
                <span class="detail-content">{{ $produto->designacao_produto ?? 'S/N'}}</span>
            </div>


            <div class="mb-1">
                <span class="title-detail-content">Cadastrado: </span>
                <span class="detail-content">{{ \Carbon\Carbon::parse($produto->created_at)->format('d/m/Y H:i:s') }}</span>
            </div>

            <div class="mb-1">
                <span class="title-detail-content">Editado: </span>
                <span class="detail-content">{{ \Carbon\Carbon::parse($produto->updated_at)->format('d/m/Y H:i:s') }}</span>
            </div>

        </div>

    </div>
@endsection
