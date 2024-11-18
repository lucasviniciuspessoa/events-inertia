<template>
    <div class="max-w-7xl mx-auto mt-10 px-6">
        <!-- Container de Busca -->
        <div id="search-container" class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Busque um evento</h1>
            <form @submit.prevent="searchEvents" class="mt-4">
                <input
                    type="text"
                    v-model="localSearch"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Procurar..."
                />
            </form>
        </div>

        <!-- Container de Eventos -->
        <div id="events-container">
            <h2 class="text-xl font-semibold text-gray-800" v-if="localSearch">Buscando por: {{ localSearch }}</h2>
            <h2 class="text-xl font-semibold text-gray-800" v-else>Próximos Eventos</h2>
            <p class="text-gray-600 mt-2">Veja os eventos dos próximos dias</p>
            <p v-if="eventsCount" class="text-gray-600 mt-2">Total de eventos: {{ eventsCount }}</p>

            <!-- Cards de Eventos -->
            <div id="cards-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
                <div class="card bg-white border border-gray-200 rounded-lg shadow-md" v-for="event in events" :key="event.id">
                    <img
                        :src="event.capa ? '/img/events/' + event.capa : '/img/logo.jpg'"
                        :alt="event.nome"
                        class="w-full h-48 object-cover rounded-t-lg"
                    />
                    <div class="card-body p-4">
                        <p class="text-gray-500 text-sm">{{ formatDate(event.data) }}</p>
                        <h5 class="text-lg font-semibold text-gray-800 mt-2">{{ event.nome }}</h5>
                        <p class="text-green-600 font-bold mt-2">
                            {{ event.usersCount }} Participantes
                        </p>
                        <a
                            :href="'/events/' + event.id"
                            class="inline-block mt-4 bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300"
                        >
                            Saber mais
                        </a>
                    </div>
                </div>

                <!-- Mensagens de Nenhum Evento Encontrado -->
                <p v-if="events.length === 0 && localSearch" class="col-span-3 text-center text-gray-500">
                    Não foi possível encontrar nenhum evento com "{{ localSearch }}"! <a href="/" class="text-blue-500">Ver
                        todos</a>
                </p>
                <p v-if="events.length === 0 && !localSearch" class="col-span-3 text-center text-gray-500">
                    Não há eventos disponíveis
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        events: Array,
        search: String,
        eventsCount: Number,
        usersCount: Number,
    },
    data() {
        return {
            localSearch: this.search || "",
        };
    },
    watch: {
        search(newVal) {
            this.localSearch = newVal;
        },
    },
    methods: {
        searchEvents() {
            if (this.localSearch.trim() === '') {
                this.$inertia.visit(route('events.index'));
            } else {
                this.$inertia.visit(route('events.index'), {
                    method: 'get',
                    data: { search: this.localSearch },
                    preserveState: true,
                    preserveScroll: true,
                });
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString('pt-BR');
        },
    },
};
</script>
