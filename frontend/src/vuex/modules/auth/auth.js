import axios from 'axios'
import {
    URL_BASE,
    NAME_TOKEN,
    USER_TYPE
} from '../../../configs/config'

const RESOURCE = 'auth/login'

const state = {
    getUser: {},
    authenticated:false
}
const mutations = {
    AUTH_USER_OK(state, user) {
        state.getUser = user,
        state.authenticated =true
    },
    AUTH_USER_LOGOUT(state) {
        state.getUser = {},
        state.authenticated = false
    }
}
const actions = {
    login(conext, formData) {
        conext.commit('LOADING', true)
        return new Promise((resolve, reject) => {
            axios.post(`${URL_BASE}${RESOURCE}`, formData).then(response => {
                conext.commit('AUTH_USER_OK', response.data)
                localStorage.setItem(NAME_TOKEN, response.data.access_token)
                localStorage.setItem(USER_TYPE, response.data.type_role)
                resolve()
                
            })
                .catch(error => {
                    //console.log(error.response.data)
                    reject(error.response.data)
                })
            .finally(() => conext.commit('LOADING',false))
        })
    },
    logout(context) {
        localStorage.removeItem(NAME_TOKEN)
        localStorage.removeItem(USER_TYPE)
         context.commit('AUTH_USER_LOGOUT')
    },
    checkLogin(context) {
        const accessToken = localStorage.getItem(NAME_TOKEN)
        const user_type = localStorage.getItem(USER_TYPE)
        return new Promise((resolve, reject) => {
            if (!accessToken && !user_type) {
                context.commit('AUTH_USER_LOGOUT')
                return reject()
            }
            return axios.get(`${URL_BASE}getUser`)
                .then(response => {
                    const user = response.data.user
                    context.commit('AUTH_USER_OK', user)

                    return resolve()

                })
                .catch(error => {
                    localStorage.removeItem(NAME_TOKEN)
                    localStorage.removeItem(USER_TYPE)
                    context.commit('AUTH_USER_LOGOUT')
                    return reject(error.response.data)
            })
        })
    }
}
export default {
    state,
    mutations,
    actions
}