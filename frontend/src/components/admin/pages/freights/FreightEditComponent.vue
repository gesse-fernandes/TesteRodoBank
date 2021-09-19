<template>
    <div class="container">
        <h1>Editar Frete <b>{{freight.board}}</b></h1>

        <form-freight-component
            :freight="freight"
            :update="true">
        </form-freight-component>
    </div>
</template>
<script>
import FormFreightComponent from './partials/FormFreightComponent'
export default {
    props:{
        id:{
            require:true
        }
    },
    create(){
        this.$store.dispatch('loadFreight',$this.id)
        .then(response => this.id = response)
        .catch(error => {
             this.$snotify.error('Erro ao carregar Frete', 'Erro')
        })
    },
    data(){
        return {
            freight:{}
        }
    },
    components: {
        FormFreightComponent
    }
}
</script>