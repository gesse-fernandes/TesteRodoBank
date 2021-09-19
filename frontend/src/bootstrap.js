import { NAME_TOKEN } from "./configs/config";

try {
    require('bootstrap');
} catch (error) {
    
}

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

const tokenAcess = localStorage.getItem(NAME_TOKEN)
window.axios.defaults.headers.common['Authorization'] = `Bearer ${tokenAcess}`;