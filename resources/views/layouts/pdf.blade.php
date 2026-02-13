<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de gestão de infratores</title>
</head>
<style>
    /* Cabeçalho */
    /* Cabeçalho */
    body.pdf-body {
        text-align: center;
        /* centraliza cabeçalho e logo */
    }

    .pdf-logo {
        max-width: 120px;
        display: block;
        margin: 0 auto 10px auto;
    }

    .pdf-header-text {
        font-weight: bold;
        line-height: 1.3;
        margin-bottom: 1px;
    }

    .pdf-hr {
        border: 1px solid #000;
        margin: 10px 0 15px 0;
    }



    /* Tabelas */
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
        text-align: left;
        font-size: 11px;
    }

    th,
    td {
        border: 1px solid #444;
        padding: 5px;
    }

    th {
        background-color: #adb5db;
        font-weight: bold;
        text-align: center;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

</style>

<body class="pdf-body">

    <!-- Logo centralizado -->
    <div>
        <a href="{{ route('login') }}">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo-define-500x500_v3.png'))) }}" alt="Logo" class="pdf-logo">
        </a>

    </div>

    <div  class="pdf-header-text">
        <!-- Texto do cabeçalho -->
        <div>Forças Armadas Angolanas</div>
        <div>Estado-Maior General</div>

        <div>Sistema de Gestão de Infratores</div>

    </div>

    <!-- Conteúdo principal -->
    @yield('content')
    <footer>
        <hr>
        <div class="footer-text">Desenvolvido por: <a href=" ">DI/EMGFAA</a>
    </footer>
</body>

</html>