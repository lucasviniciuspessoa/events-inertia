@extends('layouts.main')
@section('title', 'Criar Evento')
@section('content')

    <div id="event-create-container" class="max-w-4xl mx-auto mt-10 px-6 py-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Crie o seu evento</h1>

        <form action="/events/create" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="form-group">
                <label for="nome" class="block text-lg font-medium text-gray-700">Evento</label>
                <input type="text"
                    class="form-control w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="nome" name="nome" placeholder="Nome do evento" required>
            </div>

            <div class="form-group">
                <label for="descricao" class="block text-lg font-medium text-gray-700">Descrição</label>
                <input type="text"
                    class="form-control w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="descricao" name="descricao" placeholder="Descrição do evento" required>
            </div>

            <div class="form-group">
                <label for="data" class="block text-lg font-medium text-gray-700">Data do evento</label>
                <input type="date"
                    class="form-control w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="data" name="data" required>
            </div>

            <div class="form-group">
                <label for="capa" class="block text-lg font-medium text-gray-700">Capa</label>
                <input type="file"
                    class="form-control-file w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="capa" name="capa" required>
            </div>

            <div class="form-group">
                <label for="banner" class="block text-lg font-medium text-gray-700">Banner</label>
                <input type="file"
                    class="form-control-file w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="banner" name="banner" required>
            </div>

            <div class="form-group">
                <label for="mapa" class="block text-lg font-medium text-gray-700">Mapa</label>
                <input type="text"
                    class="form-control w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="mapa" name="mapa" placeholder="Mapa do evento" required>
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="w-full py-3 px-6 bg-blue-600 text-white text-lg font-bold rounded-md shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Criar Evento
                </button>
            </div>
        </form>
    </div>

@endsection
