<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de gestão de infratores</title>

    @vite(['resources/css/app.css', 'resources/js/app_auth.js'])
</head>

<body class="bg-login">

    <div class="card-login">
        <!-- Lado esquerdo -->
        <div class="logo-wrapper-login">
            <a href="{{ route('login') }}">
                <img src="{{ asset('images/logo-define-500x500_v3.png') }}" alt="Logo" class="logo-login">
            </a>
        </div>

        <!-- Lado direito -->
        <div class="form-container-login">
            @yield('content')
        </div>


    </div>
    <footer class="w-full py-4 text-center text-white">
        <p class="uppercase text-sm">
            &copy; {{ now()->year }} – Direcção de Informática / E.M.G
        </p>
    </footer>

</body>

</html>