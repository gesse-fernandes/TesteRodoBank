<template>
    <div class="container">
        <h1>Criar Usuario</h1>
        <hr>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card card-default">
                    <div class="card-header">
                        Criar
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning" v-if="error" v-text="error"></div>

                        <form @submit.prevent="create" class="form">
                            <div class="form-group" :class="{'has-error':errors.name}">
                                <input type="text" v-model="formData.name" class="form-control" placeholder="Nome..">
                                <div class="help-block" v-if="errors.name">
                                    <div v-for="(error, index) in errors.name" :key="index">
                                        <strong>{{ error }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error':errors.surname}">
                                <input type="text" v-model="formData.surname" class="form-control" placeholder="Sobrenome..">
                                <div class="help-block" v-if="errors.surname">
                                    <div v-for="(error, index) in errors.surname" :key="index">
                                        <strong>{{ error }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.email }">
                                <input type="email" v-model="formData.email" class="form-control" placeholder="E-mail">
                                <div class="help-block" v-if="errors.email">
                                    <div v-for="(error, index) in errors.email" :key="index">
                                        <strong>{{ error }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.email }">
                                <input type="password" v-model="formData.password" class="form-control" placeholder="Senha">
                                <div v-for="(error, index) in errors.password" :key="index">
                                    <strong>{{ error }}</strong>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                            </div>
                        </form><!--Form-->
                    </div><!--panel-body-->
                </div><!--panel-->
            </div><!--col-->
        </div><!--row-->
    </div>
</template>


<script>

export default {
  data () {
      return {
          formData: {
              name:'',
              surname: '',
              email: '',
              password: '',
          },
          errors: {},
          error: ''
      }
  },
  methods: {
      create () {
          this.$store.dispatch('createUser', this.formData)
                    .then(() => {
                        this.$snotify.success('Sucesso ao logar', 'OK')
                        const type = localStorage.getItem('type');
                        console.log(type);
                        if(type == 'client')
                        { this.$store.dispatch('checkLogin')
                            this.$router.push({name: 'client'})
                        }
                    })
                    .catch((response) => {
                        console.log(response)
                        this.errors = response
                        //this.error = response.error
                        this.$snotify.error('Falha...', 'Erro')
                    })
      }
  }
}
</script>
