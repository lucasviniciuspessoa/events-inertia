@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="max-w-7xl mx-auto p-6">
        <!-- Meus Eventos -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Meus Eventos</h1>
        </div>
        <div class="bg-white shadow-sm rounded-lg p-4">
            @if (count($events) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">#</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nome</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Participantes</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr class="border-t border-gray-200">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->index + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-blue-600"><a
                                            href="/events/{{ $event->id }}">{{ $event->nome }}</a></td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ count($event->users) }}</td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="/events/edit/{{ $event->id }}"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <ion-icon name="create-outline"></ion-icon> Editar
                                            </a>
                                            <form action="/events/{{ $event->id }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                    <ion-icon name="trash-outline"></ion-icon> Deletar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-700">Você ainda não tem eventos, <a href="/events/create"
                        class="text-blue-600 hover:underline">criar evento</a></p>
            @endif
        </div>

        <div class="mt-12 mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Eventos que estou participando</h1>
        </div>
        <div class="bg-white shadow-sm rounded-lg p-4">
            @if (count($eventsasparticipant) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">#</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nome</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Participantes</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eventsasparticipant as $event)
                                <tr class="border-t border-gray-200">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->index + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-blue-600"><a
                                            href="/events/{{ $event->id }}">{{ $event->nome }}</a></td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ count($event->users) }}</td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        <form action="/events/leave/{{ $event->id }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                Sair do Evento
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-700">Você ainda não está participando de nenhum evento, <a href="/"
                        class="text-blue-600 hover:underline">veja todos os eventos</a></p>
            @endif
        </div>
    </div>

@endsection
