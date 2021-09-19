import axios from 'axios'
import {
    URL_BASE
} from '../../../configs/config'

const RESOURCE = 'freight'

const CONFIG = {
    headers: {
        'Accept': 'application/json',
    }
}

export default {
    loadFreights(context, params) {
        context.commit('LOADING', true)
        axios.get(`${URL_BASE}${RESOURCE}`, { params })
            .then(response => {
                context.commit('FREIGHTS_LOAD', response.data)
                console.log(response)
            })
            .catch(error => console.log(error))
        .finally(()=> context.commit('LOADING',false))
    }
}