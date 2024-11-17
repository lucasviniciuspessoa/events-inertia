<script setup>
import { ref, watch } from 'vue';
import { usePage, Inertia } from '@inertiajs/inertia-vue3';
const { events, eventsCount } = usePage().props;

let page = usePage();
let search = ref('');


</script>

<template>
    <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Eventos
        </h2>

        <!-- Exibir a quantidade de eventos -->
        <div v-if="eventsCount > 0">
            <p>{{ eventsCount }} evento(s) encontrado(s).</p>
        </div>

        <!-- Campo de busca -->
         {{ search }}
        <input
            type="text"
            v-model="search"
            class="border p-2 rounded"
            placeholder="Buscar eventos..."
            :value="search"
        />

        <!-- Exibir a lista de eventos -->
        <div v-if="eventsCount > 0">
            <ul>
                <li v-for="event in events" :key="event.id">
                    {{ event.nome }}
                </li>
            </ul>
        </div>

        <div v-else>
            <p>Nenhum evento encontrado.</p>
        </div>
    </div>
</template>
