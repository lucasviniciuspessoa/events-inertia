<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-800">
        <header class="bg-white shadow">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <a href="/" class="text-lg font-bold text-gray-800 hover:text-gray-600">
                    <img src="/img/logo.jpg" alt="Logo" width="70" height="50">

                </a>
                <nav>
                    <ul class="flex space-x-4">
                        <li>
                            <a href="/" class="text-gray-700 hover:text-gray-500">Eventos</a>
                        </li>
                        <li>
                            <a href="/events/create" class="text-gray-700 hover:text-gray-500">Criar Eventos</a>
                        </li>
                        @auth
                        <li>
                            <a href="/dashboard" class="text-gray-700 hover:text-gray-500">Meus Eventos</a>
                        </li>
                        <li>
                            <form action="/logout" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-gray-500">Sair</button>
                            </form>
                        </li>
                        @endauth
                        @guest
                        <li>
                            <a href="/login" class="text-gray-700 hover:text-gray-500">Entrar</a>
                        </li>
                        <li>
                            <a href="/register" class="text-gray-700 hover:text-gray-500">Cadastrar</a>
                        </li>
                        @endguest
                    </ul>
                </nav>
            </div>
        </header>

        <main class="container mx-auto px-4 py-6">
            @inertia
        </main>
    </body>
</html>
