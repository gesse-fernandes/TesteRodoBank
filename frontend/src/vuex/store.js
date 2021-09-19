import Vue from "vue";
import Vuex from 'vuex'
import preloader from './modules/preloader/preloader'
import auth from "./modules/auth/auth";
import userCreate from './modules/userCriar/userCreate'
import Freight from './modules/freights/freights'
import User from './modules/users/users'
Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        preloader,
        userCreate,
        Freight,
        User

    }
})