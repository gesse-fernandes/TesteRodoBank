<template>
    <h1>Aqui é do admin</h1>
</template>
<script>
export default {
    computed:{
        freights(){
            return this.$store.state.freights.items
        },
        params (){
            return {
                page: this.freights.current_page,
                filter: this.search
            }
        }
    },
    methods:{
        loadFreights(page=1){
            this.$store.dispatch('loadFreights',{... this.params,page})
        },
        searchFreight(search){
            this.search = search,
            this.loadFreights()
        }
    }
}
</script>