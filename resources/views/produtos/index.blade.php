@extends('layouts.admin')

@section('content')
    <!-- Título e Trilha de Navegação -->
    <div class="content-wrapper">
        <div class="content-header">
            <h2 class="content-title">Status Curso</h2>
            <nav class="breadcrumb">
                <a href="{{ route('dashboard.index') }}" class="breadcrumb-link">Dashboard</a>
                <span>/</span>
                <span>Listar Produtos</span>
            </nav>
        </div>
    </div>


    <div class="content-box">
        <div class="content-box-header">
            <h3 class="content-box-title">Listar</h3>
            <div class="content-box-btn">
            </div>    
        </div>
    </div>
@endsection
