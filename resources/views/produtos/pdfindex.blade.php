@extends('layouts.admin')

@section('content')
<!-- Título e Trilha de Navegação -->
<div class="content-wrapper">
    <div class="content-header">
        <h2 class="content-title"> + Novo Produto</h2>
        <nav class="breadcrumb">
            <a href="{{ route('dashboard.index') }}" class="breadcrumb-link">Dashboard</a>
            <span>/</span>
            <a href="" class="breadcrumb-link">Produtos</a>
            <span>/</span>
            <span>Produto</span>
        </nav>
    </div>
</div>

<div class="content-box">
    <div class="content-box-header">
        <h3 class="content-box-title">Novo Produto</h3>
        <div class="content-box-btn">
            @can('index-produto')
            <a href="" class="btn-info align-icon-btn">
                <!-- Ícone queue-list (Heroicons) -->
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
    <section class="section">
        <form>
            <div class="space-y-12">
                <div class="border-b border-gray-800/10 pb-14">
                    <h2 class="text-base/7 font-semibold text-gray-800">Personal Information</h2>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2 sm:col-start-1">
                            <label for="city" class="block text-sm/6 font-medium text-gray-800">City</label>
                            <div class="mt-2">
                                <input id="city" type="text" name="city" autocomplete="address-level2" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="region" class="block text-sm/6 font-medium text-gray-800">State / Province</label>
                            <div class="mt-2">
                                <input id="region" type="text" name="region" autocomplete="address-level1" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="postal-code" class="block text-sm/6 font-medium text-gray-800">ZIP / Postal code</label>
                            <div class="mt-2">
                                <input id="postal-code" type="text" name="postal-code" autocomplete="postal-code" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm/6 font-semibold text-gray-800">Cancel</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>





    </section>
</div>

<style>
    /* ====== CARTÃO PRINCIPAL ====== */
    /* CARD DO FORMULÁRIO — borda superior vermelha apenas */
    .section .card {
        border-top: 4px solid #440000ff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(187, 0, 0, 0.15);
    }

    /* Abas (sem vermelho nos textos) */
    .nav-tabs .nav-link {
        border: 1px solid #ccc !important;
        color: #555;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 6px 6px 0 0;
    }

    .nav-tabs .nav-link.active {
        background: #5e0e0eff !important;
        color: #fff !important;
        border-bottom-color: transparent !important;
    }

    .nav-tabs .nav-link:hover {
        background: #f7f7f7;
        color: #333;
    }

    /* Conteúdo das abas */
    #tab1,
    #tab2 {
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 0 0 8px 8px;
        background: #fff;
        margin-top: -1px;
    }

    /* Labels, inputs e selects normais */
    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control,
    .form-select {
        border: 1px solid #aaa !important;
        border-radius: 6px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #4e0101ff !important;
        box-shadow: 0 0 4px rgba(187, 0, 0, 0.3);
    }

    /* Botão */
    .btn-secondary {
        background: #4e0000ff;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        color: #fff;
        font-weight: 600;
    }

    .btn-secondary:hover {
        background: #360000ff;
    }

    /*--------------------------------------------------------------
# Estilo personalizado para formulários CRUD
--------------------------------------------------------------*/
    .pagetitle h1 {
        color: var(--default-color) !important;
    }

    .pagetitle {
        margin-bottom: 10px;
    }

    .pagetitle h1 {
        font-size: 24px;
        margin-bottom: 0;
        font-weight: 600;
        color: #012970;
    }

    .form label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: bold !important;
    }

    .form input:disabled,
    .form select:disabled,
    .form textarea:disabled {
        background-color: #ededed;
    }

    .form input,
    .form select,
    .form textarea,
    .datatable-input,
    .datatable-selector {
        background-color: #fafafa;
        border: thin solid #c4c4c4;
        border-radius: 10px;
        width: 100%;
        padding: 10px 1rem;
    }

    .form textarea {
        resize: none;
    }

    .form-check-input:focus {
        border-color: #b41911;
        outline: 0;
        box-shadow: 0 0 0 0.25rem #b419111f;
    }

    .form-check-input:checked {
        background-color: var(--secundary-color);
        border-color: var(--secundary-color);
    }

    .datatable-selector {
        width: auto !important;
    }

    .form input:focus,
    .form textarea:focus,
    .datatable-input:focus,
    .datatable-selector:focus {
        background-color: #e6e9ec;
        outline: 0;
    }

    .form input::placeholder,
    .form textarea::placeholder {
        font-size: 14px !important;
        font-weight: normal;
    }

    /* Estilo do botão togue para alterar registo Online e Ofline */
    .toggle-button {
        display: flex;
        align-items: center;
        width: 80px;
        background: #ddd;
        border-radius: 25px;
        padding: 5px;
        Produtor: pointer;
        transition: background 0.3s;
        position: relative;
    }

    .toggle-button.active {
        background: #4caf50;
        /* Verde quando ativado */
    }

    .label-on,
    .label-off {
        flex: 1;
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        color: black;
    }

    .switch {
        width: 30px;
        height: 20px;
        background: white;
        border-radius: 50%;
        position: absolute;
        transition: transform 0.3s;
        left: 5px;
    }

    .toggle-button.active .switch {
        transform: translateX(35px);
    }

    /**  Estilo do dashboard IniciL */
    .dashboard .cima .card {
        border-top: thick solid #303c16 !important;
    }

    .dashboard .cima .card .card-title {
        padding-bottom: 0 !important;
        color: #303c16;
        font-weight: bold !important;
    }

    .dashboard .cima .card strong {
        font-size: 1.5rem;
    }

    .dashboard .cima .card .icone {
        background-color: #303c16 !important;
        color: #fff;
        border-radius: 50%;
        margin: auto;
        padding: 1rem;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        margin-bottom: 0.5rem;
    }

    .dashboard .cima .card .icone i {
        font-size: 20px !important;
    }

    .breadcrumb {
        margin-top: 10px !important;
        background-color: #fff !important;
        padding: 0;
    }

    .btn-default {
        background-color: #303c16 !important;
        color: #fff;
        font-weight: bold;
    }

    .btn-default:hover {
        background-color: #212617;
    }

    /* Estilo da imagem nos */

    .image-preview-container {
        width: 150px;
        height: 150px;
        border: 2px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 10px;
        margin-top: 10px;
    }

    .image-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* estilo imagem na modal listar reclusos*/


    .modal-de-listagem {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-de-listagem img.foto-da-modal-index {
        max-width: 100%;
        /* nunca ultrapassa a largura da modal */
        max-height: 70vh;
        /* nunca ultrapassa 70% da altura da tela */
        object-fit: contain;
        /* mantém proporção sem cortar */
        border-radius: 8px;
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.3);
    }
</style>
@endsection