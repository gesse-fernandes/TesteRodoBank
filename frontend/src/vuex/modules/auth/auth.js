import axios from 'axios'
import {
    URL_BASE,
    NAME_TOKEN,
    USER_TYPE
} from '../../../configs/config'

const RESOURCE = 'auth/login'

const state = {
    me: {},
    authenticated:false
}
const mutations = {
    AUTH_USER_OK(state, user) {
        state.me = user,
        state.authenticated =true
    },
    AUTH_USER_LOGOUT(state) {
        state.me = {},
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
                localStorage.setItem('type', response.data.type_role)
                  axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.access_token}`;
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
        localStorage.removeItem('type')
         context.commit('AUTH_USER_LOGOUT')
    },
    checkLogin(context) {
        const accessToken = localStorage.getItem(NAME_TOKEN)
        const user_type = localStorage.getItem('type')
        return new Promise((resolve, reject) => {
            if (!accessToken) {
                
                context.commit('AUTH_USER_LOGOUT')
                return reject()
            }
            return axios.get(`${URL_BASE}me`)
                .then(response => {
                    const user = response.data.user
                    context.commit('AUTH_USER_OK', user)
                   
                    return resolve()

                })
                .catch(error => {
                    localStorage.removeItem(NAME_TOKEN)
                    localStorage.removeItem('type')
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