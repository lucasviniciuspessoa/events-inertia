@extends('layouts.main')

@section('title', 'Informações')

@section('content')
<div class="max-w-7xl mx-auto p-6 mt-8 border rounded-lg shadow-xl bg-white">
    <div class="flex flex-col md:flex-row space-y-6 md:space-y-0">
        <!-- Imagem -->
        <div id="image-container" class="md:w-1/3 text-center mb-6 md:mb-0">
            <img src="/img/events/{{$event->capa}}" class="w-full h-auto rounded-lg shadow-md mb-3" alt="{{$event->nome}}">
        </div>

        <!-- Informações do Evento -->
        <div id="info-container" class="md:w-2/3 md:pl-8">
            <h1 class="text-4xl font-semibold text-blue-700">{{$event->nome}}</h1>
            <p class="text-lg text-gray-600 mt-3">
                <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
            </p>
            <p class="text-xl font-bold text-green-600 mt-4">
                <i class="bi bi-people-fill"></i> {{ count($event->users) }} Participantes
            </p>
            <p class="text-md text-gray-700 mt-2">
                <i class="bi bi-person-circle"></i> Criado por: {{$eventOwner['name']}}
            </p>

            <!-- Confirmar Presença -->
            @if(!$hasUserJoined)
            <form action="/events/join/{{$event->id}}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="px-8 py-4 bg-blue-600 text-white rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 w-full md:w-auto">
                    <i class="bi bi-check-circle-fill"></i> Confirmar Presença
                </button>
            </form>
            @else
            <p class="alert alert-info mt-6 text-center text-blue-600 p-4 bg-blue-100 rounded-lg">
                <i class="bi bi-check-circle"></i> Você já está participando deste evento!
            </p>
            @endif
        </div>
    </div>

    <!-- Descrição do Evento -->
    <div class="mt-8">
        <h3 class="text-2xl font-semibold text-gray-800">Sobre o evento</h3>
        <p class="text-lg text-gray-700 bg-white p-6 rounded-lg shadow-md mt-4">
            {{$event->descricao}}
        </p>
    </div>
</div>
@endsection
