import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
    },

    state: {
        user: null
    },
    getters: {},

    mutations: {
        SET_USER_DATA (state, user) {
            state.user = user
        }
    },

    actions: {
        setUserData(context, user){
            context.commit('SET_USER_DATA', user)
        }
    },
});
