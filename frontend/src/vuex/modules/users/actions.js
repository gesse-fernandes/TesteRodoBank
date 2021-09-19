import axios from 'axios'
import { URL_BASE } from '../../../configs/config'

const RESOURCE = 'user'

const CONFIG = {
    headers: {
        'Accept': 'application/json'
    }
}

export default {
    loadUsers(context, params) {
        context.commit('LOADING', true)
        axios.get(`${URL_BASE}${RESOURCE}`, { params })
            .then(response => {
                console.log(response.data)
                context.commit("USERS_LOAD",response.data)
            })
            .catch(error => {
            console.log(error)
            })
            .finally(() => {
            context.commit('LOADING',false)
        })
    }
}