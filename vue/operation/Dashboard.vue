<template>
  <div class="dashboard" :style="'direction:' + $genStore.getters.getDir">
      <RedMessage v-if="$genStore.state.redMessageSwitch" @close="$genStore.state.redMessageSwitch = false" :message="$genStore.state.redMessage"></RedMessage>
      <GreenMessage v-if="$genStore.state.greenMessageSwitch" @close="$genStore.state.greenMessageSwitch = false" :message="$genStore.state.greenMessage"></GreenMessage>
      <Loading v-if="$genStore.state.loaderSwitch"></Loading>
      <Header></Header>
      <CouriersSidebar></CouriersSidebar>
      <PrintItems style="display:none;"></PrintItems>
      <Sidebar :links="links" :role="'Operation'"></Sidebar>
      <div class="dashboard-content">
            <router-view/>
      </div>
  </div>
</template>

<script>
import CouriersSidebar from './components/couriers-sidebar.vue'
import PrintItems from './components/print-items-page.vue'

export default {
    data(){
        return{
            links:[
                    {url:'/dashboard/orders',title:this.__('Orders')},
                    {url:'/dashboard/pickups',title:this.__('Pickups')},
                    {url:'/dashboard/tickets',title:this.__('Tickets')},
                    {url:'/dashboard/trips',title:this.__('Trips')},
                ]
        }
    },
    components:{
      CouriersSidebar,PrintItems
    },
    beforeCreate(){
        this.$store.dispatch('StartUp')
    },
    afterCreate(){
        /* make loader disapear */
    }
}
</script>

<style lang='scss' scoped>
.dashboard{
    display:grid;
    grid-template-columns: repeat(100, 1fr);
    grid-template-rows: repeat(100, 1fr);
    height:100vh;
    .dashboard-content{
        grid-column: 11/101;
        grid-row: 7/101;
        overflow:hidden;
        &>div{
            height:100%;
            max-width: 100%;
            overflow-x:hidden;
            overflow-y:auto;
            display:flex;
            flex-direction:column;
            .data-table{
                height:100%;    width:100%;
                overflow:auto;
            }
        }
    }
}
@media screen and (max-width:800px){
    .dashboard{
        .dashboard-content{
            grid-column: 1/101;
        }
    }
}
</style>