@extends('layouts.site')

@section('content')
    

<body>
    <!-- Carousel -->
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" class="d-block w-100" alt="Moda">
                <div class="carousel-caption text-start">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2 class="display-4 fw-bold">Crie Sua Própria Moda</h2>
                                <p class="lead">Personalize camisetas, moletons e muito mais com seu estilo único</p>
                                <a href="#" class="btn btn-light btn-lg">Começar a Criar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" class="d-block w-100" alt="Coleção Premium">
                <div class="carousel-caption text-start">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2 class="display-4 fw-bold">Coleção Premium</h2>
                                <p class="lead">Descubra nossa linha de produtos de alta qualidade</p>
                                <a href="#" class="btn btn-light btn-lg">Ver Coleção</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" class="d-block w-100" alt="Ofertas Especiais">
                <div class="carousel-caption text-start">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2 class="display-4 fw-bold">Ofertas Especiais</h2>
                                <p class="lead">Aproveite descontos exclusivos em produtos selecionados</p>
                                <a href="#" class="btn btn-light btn-lg">Ver Ofertas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
        </div>
    </div>

    <!-- Categories -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Categorias</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <a href="/category/vestuario" class="text-decoration-none">
                        <div class="card category-card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-palette fs-1 mb-3 text-primary"></i>
                                <h3 class="h5 mb-2">Vestuário</h3>
                                <p class="text-muted">Camisetas, moletons e mais</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="/category/canecas" class="text-decoration-none">
                        <div class="card category-card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-cup-hot fs-1 mb-3 text-primary"></i>
                                <h3 class="h5 mb-2">Canecas</h3>
                                <p class="text-muted">Canecas personalizadas</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="/category/bones" class="text-decoration-none">
                        <div class="card category-card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-cap fs-1 mb-3 text-primary"></i>
                                <h3 class="h5 mb-2">Bonés</h3>
                                <p class="text-muted">Bonés e chapéus</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="/category/acessorios" class="text-decoration-none">
                        <div class="card category-card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-mouse fs-1 mb-3 text-primary"></i>
                                <h3 class="h5 mb-2">Acessórios</h3>
                                <p class="text-muted">Mouse pads e mais</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Produtos em Destaque</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80" class="card-img-top" alt="Camiseta Personalizada">
                        <div class="card-body">
                            <h3 class="h5 mb-2">Camiseta Personalizada</h3>
                            <p class="text-primary mb-3">R$ 79,90</p>
                            <a href="#" class="btn btn-primary w-100">Personalizar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80" class="card-img-top" alt="Caneca Personalizada">
                        <div class="card-body">
                            <h3 class="h5 mb-2">Caneca Personalizada</h3>
                            <p class="text-primary mb-3">R$ 39,90</p>
                            <a href="#" class="btn btn-primary w-100">Personalizar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1588850561407-ed78c282e89b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80" class="card-img-top" alt="Boné Personalizado">
                        <div class="card-body">
                            <h3 class="h5 mb-2">Boné Personalizado</h3>
                            <p class="text-primary mb-3">R$ 59,90</p>
                            <a href="#" class="btn btn-primary w-100">Personalizar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card product-card h-100">
                        <img src="https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80" class="card-img-top" alt="Mouse Pad Personalizado">
                        <div class="card-body">
                            <h3 class="h5 mb-2">Mouse Pad Personalizado</h3>
                            <p class="text-primary mb-3">R$ 29,90</p>
                            <a href="#" class="btn btn-primary w-100">Personalizar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-3">Sobre Nós</h5>
                    <p class="text-muted">Somos especialistas em produtos personalizados, oferecendo soluções únicas para nossos clientes desde 2023.</p>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-3">Links Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="/products" class="text-decoration-none text-muted">Produtos</a></li>
                        <li><a href="/customize" class="text-decoration-none text-muted">Personalizar</a></li>
                        <li><a href="/about" class="text-decoration-none text-muted">Sobre</a></li>
                        <li><a href="/contact" class="text-decoration-none text-muted">Contato</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-3">Atendimento</h5>
                    <ul class="list-unstyled text-muted">
                        <li>Segunda a Sexta: 9h - 18h</li>
                        <li>Sábado: 9h - 13h</li>
                        <li>contato@customshop.com</li>
                        <li>(11) 99999-9999</li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold mb-3">Redes Sociais</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-muted fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-muted fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-muted fs-5"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-top mt-4 pt-4 text-center text-muted">
                <p>© 2024 CustomShop. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
@endsection
