<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <span v-if="isLoadingEvents">
                    Carregando dados...
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card card-default">
                    <div class="card-header flex justify-content-between" style="background-color: #506578; color: white;">
                        Eventos
                        <span>
                            {{ filteredEvents.length }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card card-default">
                    <div class="card-body flex justify-content-between">
                        <div>
                            <button class="btn" :class="{ 'btn-primary': ( eventType == null )}" @click="eventType=null">Todos</button>
                            <button class="btn" :class="{ 'btn-primary': eventType == 'Evento'}" @click="eventType='Evento'">Eventos</button>
                            <button class="btn" :class="{ 'btn-primary': eventType == 'Notificação'}" @click="eventType='Notificação'">Notificações</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-for="(event, idx) in filteredEvents" :key="idx">
            <div class="col">
                <div class="card card-default">
                    <div class="card-header">
                        {{ event.title }}
                        <span class="pull-right">
                            {{ event.type }}
                        </span>
                    </div>

                    <div class="card-body">
                        <p>{{ event.body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import store from '../store/App';

    import {
        mapState,
        mapMutations,
        mapGetters
    } from 'vuex';

    export default {
        props: {
        },

        data() {
            return {
                isLoadingEvents: false,
                eventType: null,
                novoEvento: {
                    title: '',
                    body: ''
                }
            };
        },

        components: {
            event
        },

        store,

        computed: {
            ...mapState(['events']),
            ...mapGetters(['notificationEvents']),

            filteredEvents() {
                if ( this.eventType ) {
                    return this.events.filter(event => event.type == this.eventType );
                }
                return this.events;
            },
        },

        methods: {
            ...mapMutations(['addEvent']),

            addEvent() {
                this.$store.dispatch('addEvent', { ...this.novoEvento } ).then( () => {
                    this.novoEvento.title = '';
                    this.novoEvento.body = '';
                    this.$refs.novoEventoTitle.focus();
                });
            },
        },

        mounted() {
            this.$store.dispatch( 'loadEvents' ).then(() => {
                this.isLoadingEvents = false;
            });

            window.Echo.channel('events').listen( '.event', ({event}) => {
                this.$store.commit( 'addEvent', event );
            });

            window.Echo.channel('events').listen( 'event', ({event}) => {
                this.$store.commit( 'addEvent', event );
            });

            console.log( 'Devidamente configurado' );
        },
    }
</script>
