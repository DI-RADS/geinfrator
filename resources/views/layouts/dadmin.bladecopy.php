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
    <hr>
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
                    <!-- Menu principal: Relatórios -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#menurelatorio" aria-expanded="false" aria-controls="menurelatorio">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Relatórios
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>

                    <!-- Submenus dentro de Relatórios -->
                    <div class="collapse" id="menurelatorio" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <!-- Submenu: Relatórios de Vendas -->

                            <a>
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Relatórios de Vendas
                            </a>


                            <!-- Submenu: Relatórios de Compras -->

                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Relatórios de Compras
                            </a>


                            <!-- Submenu: Produtos mais Vendidos -->

                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Produtos mais Vendidos
                            </a>

                        </nav>
                    </div>


                    <!-- Menu principal: Relatórios -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#menuRelatorio" aria-expanded="false" aria-controls="menuRelatorio">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Relatórios
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>

                    <!-- Submenus dentro do menu Relatórios -->
                    <div class="collapse" id="menuRelatorio" data-bs-parent="#sidebar">
                        <nav class="sb-sidenav-menu-nested nav">

                            <!-- Relatório de Produção -->
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-print"></i></div>
                                Produção
                            </a>

                            <!-- Relatório de Vendas -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#submenuVendas" aria-expanded="false" aria-controls="submenuVendas">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                                Vendas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="submenuVendas" data-bs-parent="#menuRelatorio">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="">
                                        <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check"></i></div>
                                        Diário
                                    </a>
                                    <a class="nav-link" href="">
                                        <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-days"></i></div>
                                        Mensal
                                    </a>
                                    <a class="nav-link" href="}">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line"></i></div>
                                        Anual
                                    </a>
                                </nav>
                            </div>

                            <!-- Relatório de Clientes -->
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Clientes
                            </a>

                            <!-- Relatório Financeiro -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#submenuFinanceiro" aria-expanded="false" aria-controls="submenuFinanceiro">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill"></i></div>
                                Financeiro
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="submenuFinanceiro" data-bs-parent="#menuRelatorio">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-trend-up"></i></div>
                                        Receitas
                                    </a>
                                    <a class="nav-link" href="">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-trend-down"></i></div>
                                        Despesas
                                    </a>
                                    <a class="nav-link" href="">
                                        <div class="sb-nav-link-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                                        Balanço
                                    </a>
                                </nav>
                            </div>

                        </nav>
                    </div>





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



                    @can('index-user')
                    <a @class(['sidebar-link', 'active'=> isset($menu) && $menu == 'users']) href="{{ route('users.index') }}">
                        <!-- Ícone user-group (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        <span>Usuários</span>
                    </a>
                    @endcan

                    @can('index-user-status')
                    <a @class([ 'sidebar-link' , 'active'=> isset($menu) && $menu == 'user_statuses',
                        ]) href="{{ route('user_statuses.index') }}">
                        <!-- Ícone check (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>

                        <span>Status Usuários</span>
                    </a>
                    @endcan

                    @can('index-permission')
                    <a @class([ 'sidebar-link' , 'active'=> isset($menu) && $menu == 'permissions',
                        ]) href="{{ route('permissions.index') }}">
                        <!-- Ícone bookmark (Heroicons) -->
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
                        <!-- Ícone rectangle-group (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                        </svg>
                        <span>Papéis</span>
                    </a>
                    @endcan

                    @can('index-course')
                    <a @class([ 'sidebar-link' , 'active'=> isset($menu) && $menu == 'courses',
                        ]) href="{{ route('courses.index') }}">
                        <!-- Ícone academic-cap (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                        <span>Cursos</span>
                    </a>
                    @endcan

                    @can('index-course-status')
                    <a @class([ 'sidebar-link' , 'active'=> isset($menu) && $menu == 'course_statuses',
                        ]) href="{{ route('course_statuses.index') }}">
                        <!-- Ícone clipboard-document-check (Heroicons) -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                        </svg>
                        <span>Status Cursos</span>
                    </a>
                    @endcan

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

<style>
    .menu-parent {
        width: 100%;
        padding: 10px 14px;
        display: flex;
        justify-content: space-between;
        background: transparent;
        color: #fff;
        cursor: pointer;
        transition: 0.2s;
    }

    .menu-parent:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .submenu {
        background: rgba(255, 255, 255, 0.05);
    }

    .submenu-item {
        display: block;
        padding: 8px 20px;
        color: #ddd;
        transition: 0.2s;
    }

    .submenu-item:hover {
        background: rgba(255, 255, 255, 0.1);
    }
</style>
<script>
    function toggleMenu(id) {
        const menu = document.getElementById(id);
        const arrow = document.getElementById('arrow-' + id);

        menu.classList.toggle('hidden');

        // anima a seta
        if (menu.classList.contains('hidden')) {
            arrow.classList.remove('rotate-180');
        } else {
            arrow.classList.add('rotate-180');
        }
    }


    document.addEventListener('DOMContentLoaded', () => {
        // Seleciona todos os botões com data-dropdown-toggle
        const dropdownToggles = document.querySelectorAll('[data-dropdown-toggle]');

        dropdownToggles.forEach(btn => {
            const dropdownId = btn.getAttribute('data-dropdown-toggle');
            const dropdown = document.getElementById(dropdownId);
            const icon = btn.querySelector('svg');

            btn.addEventListener('click', (e) => {
                e.preventDefault();
                dropdown.classList.toggle('hidden'); // alterna visibilidade
                icon.classList.toggle('rotate-180'); // gira ícone
            });

            // Fechar se clicar fora
            document.addEventListener('click', (e) => {
                if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            });
        });
    });
</script>

</html>