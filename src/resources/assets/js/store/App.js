import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        events: []
    },

    mutations: {
        addEvent( {events}, event ) {
            events.push(event);
        },

        setEvents( state, events ) {
            events.forEach( event => state.events.push(event) );
        },
    },

    getters: {
        notificationEvents(state) {
            return state.events.filter(event => event.type == 'NOTIFICATION');
        },
    },

    actions: {
        addEvent( context, event ) {
            return new Promise( (resolve, reject) => {
                axios.post(
                    '/event', event
                ).then( ({data}) => {
                    context.commit('addEvent', data );
                    resolve();
                });
            });
        },

        loadEvents( context ) {
            return new Promise( (resolve, reject) => {
                axios.get(
                    '/event'
                ).then( ({data}) => {
                    context.commit('setEvents', data );
                    resolve();
                });
            });
        },
    }
});