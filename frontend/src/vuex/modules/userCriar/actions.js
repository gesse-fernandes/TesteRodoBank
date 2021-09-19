import axios from 'axios'
import {
    URL_BASE,
    NAME_TOKEN,
    USER_TYPE
} from '../../../configs/config'
const RESOURCE = 'user/criar'

const CONFIG = {
    headers: {
        'Accept': 'application/json'
    }
}

export default {
    createUser(context, formData) {
        context.commit('LOADING', true)
        return new Promise((resolve, reject) => {
            axios.post(`${URL_BASE}${RESOURCE}`, formData, CONFIG)
                .then(response => {
                    
                     localStorage.setItem(NAME_TOKEN, response.data.access_token)
                    localStorage.setItem('type', response.data.type)
                    console.log(response.data.type)
                     axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.access_token}`;
                    resolve()
                })
                .catch(error => {
                    console.log(error.response.data.errors);
                    reject(error.response.data.errors)
                })
            .finally(() => context.commit('LOADING',false))
        })
    }
}