@extends('layouts.main')
@section('title', 'Editando Evento')
@section('content')

<div id="event-edit-container" class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Editando: {{$event->nome}}</h1>

    <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label for="nome" class="block text-sm font-medium text-gray-700">Evento:</label>
            <input
                type="text"
                id="title"
                name="nome"
                class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
                placeholder="Nome do evento"
                value="{{$event->nome}}"
            >
        </div>

        <div class="form-group">
            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição:</label>
            <input
                type="text"
                id="descricao"
                name="descricao"
                class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
                placeholder="Descrição do evento"
                value="{{$event->descricao}}"
            >
        </div>

        <div class="form-group">
            <label for="date" class="block text-sm font-medium text-gray-700">Data do evento:</label>
            <input
                type="date"
                id="date"
                name="data"
                class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
                value="{{date('Y-m-d', strtotime($event->data))}}"
            >
        </div>

        <div class="form-group">
            <label for="capa" class="block text-sm font-medium text-gray-700">Capa:</label>
            <input
                type="file"
                id="capa"
                name="capa"
                class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
            >
            @if($event->capa)
                <img src="/img/events/{{$event->capa}}" alt="Imagem da capa" class="mt-3 w-full h-40 object-cover rounded-lg">
            @endif
        </div>

        <div class="form-group">
            <label for="banner" class="block text-sm font-medium text-gray-700">Banner:</label>
            <input
                type="file"
                id="banner"
                name="banner"
                class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
            >
            @if($event->banner)
                <img src="/img/events/{{$event->banner}}" alt="Imagem do banner" class="mt-3 w-full h-40 object-cover rounded-lg">
            @endif
        </div>

        <div class="form-group">
            <label for="mapa" class="block text-sm font-medium text-gray-700">Mapa:</label>
            <input
                type="text"
                id="mapa"
                name="mapa"
                class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500"
                placeholder="Mapa do evento"
                value="{{$event->mapa}}"
            >
        </div>

        <div class="flex justify-center">
            <button
                type="submit"
                class="w-full py-3 px-6 bg-blue-800 text-white text-lg font-semibold rounded-md hover:bg-blue-900 transition duration-300 ease-in-out focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50"
            >
                Editar Evento
            </button>
        </div>
    </form>
</div>

@endsection
