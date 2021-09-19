<template>
    <div>
        <form @submit.prevent="onSubmit">
            <div :class="['form-group',{'has-error':errors.name}]">
                <input type="text" class="form-control" placeholder="Nome.." v-model="user.name">
                <div v-if="errors.name" class="help-block">
                    <p>{{errors.name}}</p>
                </div>
                </div>
                 <div :class="['form-group',{'has-error':errors.surname}]">
                <input type="text" class="form-control" placeholder="Sobrenme.." v-model="user.surname">
                <div v-if="errors.surname" class="help-block">
                    <p>{{errors.surname}}</p>
                </div>
            </div>
            <div :class="['form-group',{'has-error':errors.email}]">
                <input type="email" class="form-control" placeholder="E-mail" v-model="user.email">
                <div v-if="errors.email" class="help-block">
                    <p>{{errors.email}}</p>
                </div>
            </div>
            <div :class="['form-group',{'has-error':errors.password}]">
                <input type="password" class="form-control" placeholder="Senha.." v-model="user.password">
                <div v-if="errors.password" class="help-block">
                    <p>{{errors.password}}</p>
                </div>
            </div>
            
           
            
        </form>
    </div>

</template>
<script>
export default {
     mounted () {
        this.reset()
    },
    props: {
        update:{
            require:false,
            type:Boolean,
            default:false,
        },
        freight: {
            require:false,
            type:Array|Object,
            default: () =>{
                return {
                    id: '',
                    name:'',
                    surname:'',
                    email:'',
                    password:'',

                }
            }
        }
    },
    data () {
        return {
           errors: {}, 
        }
    },
     methods: {
         onsubmit(){
             const action = this.update? 'editUser':'addUser'
             const formData = new FormData()
             formData.append('id',this.user.id)
             formData.append('name',this.user.name)
             formData.append('surname',this.user.surname)
             formData.append('email',this.user.email)
             formData.append('password',this.user.password)
              return this.$store.dispatch(action, formData) .then(()=>{
                  this.$snotify.success('Sucesso ao salvar o registro')
                  this.$router.push({name: 'users'})
              })
              .catch(errors => {
                            this.$snotify.error('Algo errado...', 'Erro')

                            this.errors = errors.hasOwnProperty('errors') ? errors.errors : errors
                        })
             
         },
         reset () {
            console.log('Form reset')
            this.errors = {}
        }
     }
}
</script>
<style>
form{
    margin: 10px 0;
}
.img-responsive{max-width: 60px;}
</style>