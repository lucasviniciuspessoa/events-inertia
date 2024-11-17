<template>
    <div class="container mx-auto p-4">
        <!-- Meus Eventos -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold">Meus Eventos</h1>
            <template v-if="events.length > 0">
                <table class="min-w-full table-auto bg-white shadow-md rounded-lg overflow-hidden mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">#</th>
                            <th class="px-4 py-2 text-left">Nome</th>
                            <th class="px-4 py-2 text-left">Participantes</th>
                            <th class="px-4 py-2 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(event, index) in events" :key="event.id">
                            <td class="px-4 py-2">{{ index + 1 }}</td>
                            <td class="px-4 py-2">
                                <router-link :to="`/events/${event.id}`" class="text-blue-500 hover:underline">
                                    {{ event.nome }}
                                </router-link>
                            </td>
                            <td class="px-4 py-2">{{ event.users_count }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    <router-link :to="`/events/edit/${event.id}`"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                        Editar
                                    </router-link>
                                    <button @click="deleteEvent(event.id)"
                                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                        Deletar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template v-else>
                <p class="text-gray-700">Você ainda não tem eventos, <router-link to="/events/create"
                        class="text-blue-500">criar evento</router-link></p>
            </template>
        </div>

        <!-- Eventos que estou participando -->
        <div class="mb-6">
            <h1 class="text-3xl font-semibold">Eventos que estou participando</h1>
            <template v-if="eventsAsParticipant.length > 0">
                <table class="min-w-full table-auto bg-white shadow-md rounded-lg overflow-hidden mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">#</th>
                            <th class="px-4 py-2 text-left">Nome</th>
                            <th class="px-4 py-2 text-left">Participantes</th>
                            <th class="px-4 py-2 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(event, index) in eventsAsParticipant" :key="event.id">
                            <td class="px-4 py-2">{{ index + 1 }}</td>
                            <td class="px-4 py-2">
                                <router-link :to="`/events/${event.id}`" class="text-blue-500 hover:underline">
                                    {{ event.nome }}
                                </router-link>
                            </td>
                            <td class="px-4 py-2">{{ event.users_count }}</td>
                            <td class="px-4 py-2">
                                <button @click="leaveEvent(event.id)"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Sair do Evento
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template v-else>
                <p class="text-gray-700">Você ainda não está participando de nenhum evento, <router-link to="/"
                        class="text-blue-500">veja todos os eventos</router-link></p>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        events: Array,
        eventsAsParticipant: Array
    },
    methods: {
        deleteEvent(eventId) {
            console.log('Deletar evento', eventId);
        },
        leaveEvent(eventId) {
            console.log('Sair do evento', eventId);
        }
    }
};
</script>


