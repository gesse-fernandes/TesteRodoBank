<template>
    <div class="container">
        <h1>Fretes</h1>
        <div class="row-options">
            <div class="col">
                <router-link :to="{name:'freight.add'}" class="btn btn-success">
                    Adicionar
                </router-link>
            </div>
            <div class="col">
                <search @search="searchFreight"></search>
                <div v-if="search">
                    Resultados para a pesquisa: {{search}}
                </div>
            </div>
        </div>

            <table class="table table-dark">
                <tr>
                    <th>Placa do veiculo</th>
                    <th>Dono do veiculo</th>
                    <th>Valor do frete</th>
                    <th>Data de Inicio</th>
                    <th>Data fim</th>
                    <th>Status</th>
                    <th width="200">Ações</th>
                </tr>
                <tr v-for="(freight,key) in freight.data" :key="key">
                    <td v-text="freight.board"></td>
                    <td v-text="freight.vehicle_owner"></td>
                    <td v-text="freight.price_freight"></td>
                    <td v-text="freight.date_start"></td>
                    <td v-text="freight.date_end"></td>
                    <td v-text="freight.status"></td>
                    <td>
                        <router-link :to="{name:'freight.edit',params:{id:freight.id}}" class="btn btn-success">
                            Editar
                        </router-link>
                        <button class="btn btn-danger" v-on:click="deletar(freight.id)">Deletar</button>
                    </td>
                </tr>
            </table>
    
        <paginate
            :pagination="freights"
            :offset="3"
            @paginate="loadFreights">
            </paginate>
    </div>
</template>
<script>
import searchFreightComponent from './partials/SearchFreightComponent'
import PaginationComponent from '../../../layouts/PaginationComponent.vue'
export default {
    name:'freight-component',
    create(){
        this.loadFreights()
    },
    data (){
        return{
            search: null,
            freightId:null,
        }
    },
    computed: {
        freights(){
            return this.$store.state.freights.items
        },
        params (){
            return {
                page: this.freights.current_page,
                filter: this.search,
            }
        },
    },
    methods: {
        loadFreights(page){
            this.$store.dispatch('loadFreights',{... this.params,page})
        },
        searchFreight(search){
            this.search = search,
            this.loadFreights(1)
        },
        deletar(id){
            if(confirm('Confirma a exclusão?')){
                this.destroy(id)
            }
        },
        destroy(id){
            this.$store.dispatch('destroyFreight',id)
            .then(()=>{
                id = null,
                this.loadFreights()
            })
        }
    },
    components:{
        search: searchFreightComponent,
        paginate: PaginationComponent,
    }
}
</script>
<style scoped>
.options{margin: 20px 0;}
.vodal-dialog{height: auto; max-width: 90%;}
</style>