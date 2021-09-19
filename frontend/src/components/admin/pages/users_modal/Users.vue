<template>
   <div class="container">
        <h1>Usuarios</h1>
        

        <div class="row options">
            <div class="col">
                <a ref="modal" @click.prevent="testandoApi()" class="btn btn-success">
                    Adicionar
                </a>
            </div>

            
        </div>
 <table class="table table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>E-mail</th>
                    <th width="200">Ações</th>
                </tr>
                <tr v-for="(user,key) in user" :key="key">
                    <td v-text="user.name"></td>
                    <td v-text="user.surname"></td>
                    <td v-text="user.email"></td>
                   <td>
                        <router-link :to="{name:'user.edit',params:{id:user.id}}" class="btn btn-success">
                            Editar
                        </router-link>
                        <button class="btn btn-danger" v-on:click="deletar(user.id)">Deletar</button>
                    </td>
                </tr>
            </table>
   </div>
</template>
<script>
import Vodal from 'vodal'
import PaginationComponent from '../../../layouts/PaginationComponent.vue'
import  formUserComponent from './partials/FormUserComponent'
import axios from 'axios'
export default {
    name: 'user-component',
    create (){
        this.loadUsers()
    },
    data (){
        return {
            search:null,
            userId:null,
            showModal:false,
            user:{
                id:'',
                name:'',
                surname:'',
                email:'',
            },
            update:false
        }
    },
    computed: {
        users(){
            return this.$store.state.users.items
        },
        params (){
            return {
                page: this.users.current_page,
                filter: this.search,
            }
        },
    },
        methods:{
            loadUsers(page=1){
                this.$store.dispatch('loadUsers',{... this.params,page})
             
            },
            searchUser(search){
                this.search = search,
                this.loadUsers()
            },
            create(){
                this.reset()
                this.update = false
                this.showModal = true
            },
            hide(){
                this.showModal = false
            },
            success (){
                this.reset()
                this.loadUsers()
                this.hide()
            },
            reset(){
                this.user ={
                    id:'',
                    name:'',
                    surname:'',
                    email: '',
                }
            },
            testandoApi(){
                axios.get("http://127.0.0.1:8000/api/user").then(response => {
                    console.log(response.data);
                });
            }
        },
        components: {
           paginate:PaginationComponent,
           formUser: formUserComponent,
           Vodal 
        }
    
}
</script>