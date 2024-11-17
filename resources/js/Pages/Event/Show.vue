<template>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white border rounded-lg shadow-md">
        <div class="flex flex-wrap">
            <!-- Imagem do evento -->
            <div id="image-container" class="w-full sm:w-1/3 text-center">
                <img :src="`/img/events/${event.capa}`" class="w-full h-48 object-cover rounded-lg mb-4"
                    :alt="event.nome" />
            </div>

            <div id="info-container" class="w-full sm:w-2/3 sm:pl-6">
                <h1 class="text-3xl font-semibold text-blue-600">{{ event.nome }}</h1>


                <p class="text-gray-600 mt-2">
                    {{ formattedDate }}
                </p>
                <p class="text-green-600 font-bold mt-2">
                    {{ usersCount }} Participantes
                </p>
                <p class="text-gray-500 mt-1">
                    <i class="bi bi-person-circle"></i> Criado por: {{ eventOwner.name }}
                </p>

                <form v-if="!hasUserJoined" @submit.prevent="confirmPresence" class="mt-4">
                    <button type="submit"
                        class="bg-blue-500 text-white px-8 py-3 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 w-full">
                        Confirmar Presença
                    </button>

                </form>
                <p v-else class="mt-4 p-4 bg-blue-100 text-blue-700 border border-blue-300 rounded-lg">
                    <i class="bi bi-check-circle"></i> Você já está participando deste evento!
                </p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-700">Sobre o evento</h3>
            <p class="mt-2 text-gray-600 p-4 bg-gray-50 rounded-lg border border-gray-200">
                {{ event.descricao }}
            </p>
        </div>
    </div>
</template>

<script setup>

import { computed } from 'vue';
import dayjs from 'dayjs';

const props = defineProps({
    event: Object,
    eventOwner: Object,
    hasUserJoined: Boolean,
    usersCount: Number,
});

console.log(props.usersCount);

const formattedDate = computed(() => dayjs(props.event.date).format('DD/MM/YYYY'));

const confirmPresence = () => {
    Inertia.post(`/events/join/${props.event.id}`);
};
</script>
