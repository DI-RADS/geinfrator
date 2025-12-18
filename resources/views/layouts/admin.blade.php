<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gráfica Miop</title>

    <script>
        // Executar logo no início, antes de carregar o CSS e evitar o piscar na tela
        (function() {

            // Verificar se o usuário já definiu um tema na localStorage
            const theme = localStorage.getItem('theme');

            // Verificar se o sistema do usuário está configurado para o tema escuro
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            // Se o usuário escolheu o tema 'dark' ou se não há tema definido e o sistema prefere o modo escuro, aplica o tema escuro
            if (theme === 'dark' || (!theme && prefersDark)) {
                // Adicionar a classe 'dark' ao elemento raiz (html), ativando o modo escuro no site
                document.documentElement.classList.add('dark');
            } else {
                // Caso contrário, remove a classe 'dark' e aplica o tema claro
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-dashboard">

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <button id="toggleSidebar" class="menu-button">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="user-container">
                <div class="relative dropdown-button-border">
                    <!-- Ícone moon (Heroicons) -->
                    <button id="themeToggle" class="dropdown-button">
                        <svg id="iconMoon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>
                        <!-- Ícone sun (Heroicons) -->
                        <svg id="iconSun" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>
                    </button>
                </div>
                <div class="relative">
                    <!-- Dropdown -->
                    <button id="userDropdownButton" class="dropdown-button">
                        Usuário
                        <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <!-- Conteúdo do Dropdown -->
                    <div id="dropdownContent" class="dropdown-content hidden">
                        <a href="{{ route('profile.show') }}" class="dropdown-item">Perfil</a>
                        <a href="{{ route('logout') }}" class="dropdown-item">Sair</a>
                    </div>
                </div>
            </div>
        </div>


    </nav>

    <div class="flex">

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar">
            <div class="sidebar-container">
                <button id="closeSidebar" class="sidebar-close-button">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="sidebar-header">
                    <span class="sidebar-title">Gráfica MIOP</span>
                </div>
                <nav class="sidebar-nav">
                    @can('dashboard')
                    <!-- Ícone home (Heroicons) -->
                    <a @class([ 'sidebar-link' , 'active'=> isset($menu) && $menu == 'dashboard',
                        ]) href="{{ route('dashboard.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    @endcan

                    <!-- ===================== -->
                    <!--     DROPMENU FIXO     -->
                    <!-- ===================== -->
                    {{-- MENU PRINCIPAL: Produtos --}}
                    <div>
                        <a @class(['sidebar-link', 'drop-btn' ]) href="#" data-target="menu-produto">
                            <div class="flex items-center justify-between w-full">
                                <div class="flex items-center gap-2">
                                    <!-- Ícone Produtos -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                                    </svg>
                                    <span>Produtos</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-4 h-4 transition-transform duration-300 drop-arrow rotate-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </a>
                        <div id="menu-produto" class="drop-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <a @class(['sidebar-link' , 'active'=> isset($menu) && $menu == 'produtos',
                            ]) href="{{ route('produto.create') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Adicionar Produto</span>
                            </a>
                            <a @class(['sidebar-link' , 'active'=> isset($menu) && $menu == 'produtos',]) href="{{ route('produtos.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <span>Listar Produtos</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 6h16M4 10h16M4 14h16" />
                                </svg>
                                <span>Categorias de Produtos</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 3v4h14V3M5 21v-4h14v4" />
                                </svg>
                                <span>Marcas / Fornecedores</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 3h18v4H3V3zm0 7h18v4H3v-4zm0 7h18v4H3v-4z" />
                                </svg>
                                <span>Estoque (entrada/saída)</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 4h16v16H4V4z" />
                                </svg>
                                <span>Importar / Exportar Produtos</span>
                            </a>
                        </div>
                    </div>

                    {{-- MENU PRINCIPAL: Vendas --}}
                    <div>
                        <a @class(['sidebar-link', 'drop-btn' ]) href="#" data-target="menu-vendas">
                            <div class="flex items-center justify-between w-full">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 3h18v18H3V3z" />
                                    </svg>
                                    <span>Vendas</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-4 h-4 transition-transform duration-300 drop-arrow rotate-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </a>
                        <div id="menu-vendas" class="drop-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Nova Venda</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <span>Listar Vendas</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4V4z" />
                                </svg>
                                <span>Pedidos Pendentes</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18" />
                                </svg>
                                <span>Relatórios de Vendas</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 4l16 16M20 4L4 20" />
                                </svg>
                                <span>Devoluções / Trocas</span>
                            </a>
                        </div>
                    </div>

                    {{-- MENU PRINCIPAL: Clientes --}}
                    <div>
                        <a @class(['sidebar-link', 'drop-btn' ]) href="#" data-target="menu-clientes">
                            <div class="flex items-center justify-between w-full">
                                <div class="flex items-center gap-2">
                                    <!-- Ícone Clientes -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0zM3 21v-2a4 4 0 014-4h10a4 4 0 014 4v2" />
                                    </svg>
                                    <span>Clientes</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-4 h-4 transition-transform duration-300 drop-arrow rotate-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </a>
                        <div id="menu-clientes" class="drop-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Adicionar Cliente</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <span>Listar Clientes</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 17v-6a3 3 0 016 0v6" />
                                </svg>
                                <span>Histórico de Compras</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <span>Segmentação / Grupos</span>
                            </a>
                        </div>
                    </div>

                    {{-- MENU PRINCIPAL: Financeiro --}}
                    <div>
                        <a @class(['sidebar-link', 'drop-btn' ]) href="#" data-target="menu-financeiro">
                            <div class="flex items-center justify-between w-full">
                                <div class="flex items-center gap-2">
                                    <!-- Ícone Financeiro -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8c-3.866 0-7 1.343-7 3v2c0 1.657 3.134 3 7 3s7-1.343 7-3v-2c0-1.657-3.134-3-7-3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4v4m0 8v4" />
                                    </svg>
                                    <span>Financeiro</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-4 h-4 transition-transform duration-300 drop-arrow rotate-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </a>
                        <div id="menu-financeiro" class="drop-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Pagamentos Recebidos</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 6h18M3 12h18m-9 6h9" />
                                </svg>
                                <span>Contas a Pagar / Receber</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 17v-6a3 3 0 016 0v6" />
                                </svg>
                                <span>Faturamento</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 4h16v16H4V4z" />
                                </svg>
                                <span>Relatórios Financeiros</span>
                            </a>
                        </div>
                    </div>

                    {{-- MENU PRINCIPAL: Marketing --}}
                    <div>
                        <a @class(['sidebar-link', 'drop-btn' ]) href="#" data-target="menu-marketing">
                            <div class="flex items-center justify-between w-full">
                                <div class="flex items-center gap-2">
                                    <!-- Ícone Marketing -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 2v4M12 18v4M2 12h4M18 12h4" />
                                    </svg>
                                    <span>Marketing</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-4 h-4 transition-transform duration-300 drop-arrow rotate-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </a>
                        <div id="menu-marketing" class="drop-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Cupons / Descontos</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 6h18M3 12h18m-16.5 6h13.5" />
                                </svg>
                                <span>E-mails</span>
                            </a>
                            <a @class(['sidebar-link']) href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 4h16v16H4V4z" />
                                </svg>
                                <span>Campanhas de Promoção</span>
                            </a>
                        </div>
                    </div>
                    <hr class="border-t border-gray-200 my-2">

                    {{-- MENU CONFIGURAÇÕES ADMINISTRATIVO --}}
                    <div>
                        <!-- BOTÃO PRINCIPAL -->
                        <a @class(['sidebar-link', 'drop-btn' ]) href="#" data-target="configuracoes">
                            <div class="flex items-center justify-between w-full">
                                <div class="flex items-center gap-2">
                                    <!-- Ícone de engrenagem (Configurações) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4 w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.25 2.25a.75.75 0 0 1 .75.75v1.5a7.5 7.5 0 0 1 5.303 12.75l1.064 1.064a.75.75 0 0 1-1.06 1.06l-1.064-1.064a7.5 7.5 0 0 1-12.75-5.303H2.25a.75.75 0 0 1 0-1.5h1.5a7.5 7.5 0 0 1 5.303-5.303V3a.75.75 0 0 1 .75-.75z" />
                                    </svg>
                                    <span>Configurações</span>
                                </div>

                                <!-- Seta para baixo -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4 transition-transform duration-300 drop-arrow rotate-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </a>

                        <!-- CONTEÚDO DO DROP -->
                        <div id="configuracoes" class="drop-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">

                            @can('index-user')
                            <a @class(['sidebar-link', 'active'=> isset($menu) && $menu == 'users']) href="{{ route('users.index') }}">
                                <!-- Ícone user-group -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                                <span>Usuários</span>
                            </a>
                            @endcan

                            @can('index-user-status')
                            <a @class([ 'sidebar-link' , 'active'=> isset($menu) && $menu == 'user_statuses']) href="{{ route('user_statuses.index') }}">
                                <!-- Ícone check -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <span>Status Usuários</span>
                            </a>
                            @endcan

                            @can('index-permission')
                            <a @class([ 'sidebar-link' , 'active'=> isset($menu) && $menu == 'permissions']) href="{{ route('permissions.index') }}">
                                <!-- Ícone bookmark -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                                <span>Permissões</span>
                            </a>
                            @endcan

                            @can('index-role')
                            <a @class(['sidebar-link', 'active'=> isset($menu) && $menu == 'roles']) href="{{ route('roles.index') }}">
                                <!-- Ícone rectangle-group -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                                </svg>
                                <span>Papéis</span>
                            </a>
                            @endcan

                            @can('index-course')
                            <a @class([ 'sidebar-link' , 'active'=> isset($menu) && $menu == 'courses']) href="{{ route('courses.index') }}">
                                <!-- Ícone academic-cap -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                </svg>
                                <span>Cursos</span>
                            </a>
                            @endcan

                            @can('index-course-status')
                            <a @class([ 'sidebar-link' , 'active'=> isset($menu) && $menu == 'course_statuses']) href="{{ route('course_statuses.index') }}">
                                <!-- Ícone clipboard-document-check -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                </svg>
                                <span>Status Cursos</span>
                            </a>
                            @endcan

                        </div>
                    </div>

                    <a href="{{ route('logout') }}" class="sidebar-link">
                        <!-- Ícone arrow-right-circle (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>Sair</span>
                    </a>
                </nav>
            </div>
        </aside>
        <!-- Conteúdo Principal -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
<script>
    // animação do dropmenu do administrativo 
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".drop-btn").forEach(btn => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();

                const targetID = btn.getAttribute("data-target");
                const content = document.getElementById(targetID);
                const arrow = btn.querySelector(".drop-arrow");

                // Fechar se já estiver aberto
                const isOpen = content.style.maxHeight && content.style.maxHeight !== "0px";

                if (isOpen) {
                    content.style.maxHeight = "0px";
                    arrow.classList.remove("rotate-180");
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                    arrow.classList.add("rotate-180");
                }
            });
        });
    });
</script>

</html>