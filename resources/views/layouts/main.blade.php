<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS da aplicação -->
    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/scripts.js"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-900">

    <!-- Header -->
    <header class=" text-black shadow-md">
        <nav class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center">
                    <img src="/img/logo.jpg" alt="Logo" class="w-14 h-10">
                </a>

                <!-- Navigation links -->
                <ul class="flex space-x-6">
                    <li><a href="/" class="hover:underline">Eventos</a></li>
                    <li><a href="/events/create" class="hover:underline">Criar Evento</a></li>
                    @auth
                        <li><a href="/dashboard" class="hover:underline">Meus Eventos</a></li>
                        <li>
                            <form action="/logout" method="POST" class="inline">
                                @csrf
                                <a href="/logout" class="hover:underline"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    Sair
                                </a>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li><a href="/login" class="hover:underline">Entrar</a></li>
                        <li><a href="/register" class="hover:underline">Cadastrar</a></li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col">
                <!-- Display session message -->
                @if(session('msg'))
                    <p class="bg-green-500 text-white py-2 px-4 rounded-lg mb-4">{{ session('msg') }}</p>
                @endif

                <!-- Content of the page -->
                @yield('content')
            </div>
        </div>
    </main>

</body>
</html>
