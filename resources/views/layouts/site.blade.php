<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gráfica Miop</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CustomShop - Produtos Personalizados</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
    </head>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">CustomShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Produtos
                        </a>
                        <div class="dropdown-menu mega-menu p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Vestuário</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="dropdown-item" href="/products/camisetas">Camisetas</a></li>
                                        <li><a class="dropdown-item" href="/products/moletons">Moletons</a></li>
                                        <li><a class="dropdown-item" href="/products/calcas">Calças</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Acessórios</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="dropdown-item" href="/products/bones">Bonés</a></li>
                                        <li><a class="dropdown-item" href="/products/canecas">Canecas</a></li>
                                        <li><a class="dropdown-item" href="/products/mouse-pads">Mouse Pads</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Personalizar
                        </a>
                        <div class="dropdown-menu mega-menu p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Por Categoria</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="dropdown-item" href="/customize/camiseta">Criar Camiseta</a></li>
                                        <li><a class="dropdown-item" href="/customize/caneca">Criar Caneca</a></li>
                                        <li><a class="dropdown-item" href="/customize/bone">Criar Boné</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Ferramentas</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="dropdown-item" href="/customize/upload">Upload de Arte</a></li>
                                        <li><a class="dropdown-item" href="/customize/text">Editor de Texto</a></li>
                                        <li><a class="dropdown-item" href="/customize/gallery">Galeria de Designs</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contato</a>
                    </li>
                    <li class="nav-item ms-2">
                        <button class="btn btn-link">
                            <i class="bi bi-cart"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" target="_blank" rel="noopener noreferrer">
                        <button class="btn btn-link">
                            <i class="bi bi-person"></i>
                        </button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

</body>

</html>