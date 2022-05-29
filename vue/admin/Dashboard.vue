<template>
  <div class="dashboard" :style="'direction:' + $genStore.getters.getDir">
      <div id="errors-container"></div>
      <Header></Header>
      <RedMessage v-if="$genStore.state.redMessageSwitch" @close="$genStore.state.redMessageSwitch = false" :message="$genStore.state.redMessage"></RedMessage>
      <GreenMessage v-if="$genStore.state.greenMessageSwitch" @close="$genStore.state.greenMessageSwitch = false" :message="$genStore.state.greenMessage"></GreenMessage>
      <Sidebar :links="links" :role="'Admin'"></Sidebar>
      <Loading v-if="$genStore.state.loaderSwitch"></Loading>
      <div class="dashboard-content">
            <router-view/>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            links:[
                    {url:'/dashboard/users',title:this.__('Users')},
                    {url:'/dashboard/couriers',title:this.__('Couriers')},
                    {url:'/dashboard/orders',title:this.__('Orders')},
                    {url:'/dashboard/pickups',title:this.__('Pickups')},
                    {url:'/dashboard/sellers',title:this.__('Sellers')},
                    {url:'/dashboard/trips',title:this.__('Trips')},
                    {url:'/dashboard/actions',title:this.__('Actions')},
                    {url:'/dashboard/settings',title:this.__('Settings')},
                ]
        }
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
        overflow: auto;
        &>div{
            max-width: 100vw;
            display:flex;
            flex-direction:column;
            .data-table{
                width:100%;
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