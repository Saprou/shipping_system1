<template>
  <div class="dashboard" :style="'direction:' + $genStore.getters.getDir">
      <RedMessage v-if="$genStore.state.redMessageSwitch" @close="$genStore.state.redMessageSwitch = false" :message="$genStore.state.redMessage"></RedMessage>
      <GreenMessage v-if="$genStore.state.greenMessageSwitch" @close="$genStore.state.greenMessageSwitch = false" :message="$genStore.state.greenMessage"></GreenMessage>
      <Loading v-if="$genStore.state.loaderSwitch"></Loading>
      <Header></Header>
      <Sidebar :links="links" :role="'Accountant'"></Sidebar>
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
                    {url:'/dashboard/sellers',title:this.__('Sellers')},
                    {url:'/dashboard/trips',title:this.__('Trips')},
                    {url:'/dashboard/orders',title:this.__('Orders')},
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
        overflow: hidden;
        grid-column: 11/101;
        grid-row: 7/101;
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