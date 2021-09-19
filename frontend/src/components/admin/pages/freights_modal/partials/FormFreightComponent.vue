<template>
    <div>
        <form @submit.prevent="onSubmit">
            <div :class="['form-group',{'has-error':errors.board}]">
                <input type="text" class="form-control" placeholder="Placa do veiculo" v-model="freight.board">
                <div v-if="errors.board" class="help-block">
                    <p>{{errors.board}}</p>
                </div>
                </div>
                 <div :class="['form-group',{'has-error':errors.vehicle_owner}]">
                <input type="text" class="form-control" placeholder="Dono do veiculo" v-model="freight.vehicle_owner">
                <div v-if="errors.vehicle_owner" class="help-block">
                    <p>{{errors.vehicle_owner}}</p>
                </div>
            </div>
            <div :class="['form-group',{'has-error':errors.price_freight}]">
                <input type="number" class="form-control" placeholder="Valor do Frete" v-model="freight.price_freight">
                <div v-if="errors.price_freight" class="help-block">
                    <p>{{errors.price_freight}}</p>
                </div>
            </div>
            <div :class="['form-group',{'has-error':errors.date_start}]">
                <input type="date" class="form-control" placeholder="Inicio da data" v-model="freight.date_start">
                <div v-if="errors.date_start" class="help-block">
                    <p>{{errors.date_start}}</p>
                </div>
            </div>
             <div :class="['form-group',{'has-error':errors.date_end}]">
                <input type="date" class="form-control" placeholder="Fim de data" v-model="freight.date_end">
                <div v-if="errors.date_end" class="help-block">
                    <p>{{errors.date_end}}</p>
                </div>
            </div>
             <div :class="['form-group',{'has-error':errors.status}]">
                <select v-model="freight.status" class="form-control">
                    <option disabled  value="">Escolha o status</option>
                    <option>{{freight.status.iniciado}}</option>
                     <option>{{freight.status.transito}}</option>
                      <option>{{freight.status.concluido}}</option>
                </select>
                <div v-if="errors.status" class="help-block">
                    <p>{{errors.status}}</p>
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
                    board:'',
                    vehicle_owner:'',
                    price_freight:'',
                    date_start:'',
                    date_end:'',
                    status:{
                        iniciado:'Iniciado',
                        transito:'em trânsito',
                        concluido:'concluido',
                        
                    },

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
             const action = this.update? 'editFreight':'addFreight'
             const formData = new FormData()
             formData.append('id',this.freight.id)
             formData.append('board',this.freight.board)
             formData.append('vehicle_owner',this.freight.vehicle_owner)
             formData.append('price_freight',this.freight.price_freight)
             formData.append('date_start',this.freight.date_start)
             formData.append('date_end',this.freight.date_end)
             formData.append('status',this.freight.status)

              return this.$store.dispatch(action, formData) .then(()=>{
                  this.$snotify.success('Sucesso ao salvar o registro')
                  this.$router.push({name: 'freights'})
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