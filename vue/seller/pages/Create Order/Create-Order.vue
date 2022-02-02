<template>
  <div class="create-order-page page">
      <div class="page-body" style="display:block;">
          <div class="order-type">
            <router-link to="/dashboard/create-order/deliver" class="order-type-card" :class="type == 1?'type-selected':null">
              <h4>{{__('Deliver')}}</h4>
            </router-link>
            <router-link to="/dashboard/create-order/exchange"  class="order-type-card" :class="type == 2?'type-selected':null">
              <h4>{{__('Exchange')}}</h4>
            </router-link>
            <router-link to="/dashboard/create-order/return" class="order-type-card" :class="type == 3?'type-selected':null">
              <h4>{{__('Return')}}</h4>
            </router-link>
          </div>
          <div class="table" :class="[$genStore.getters.getLocale == 'en'? {'r-dr':true} :{}]">
              <router-view/>
          </div>
      </div>
  </div>
</template>

<script>
export default {
  computed:{
    type(){
      if(this.$route.name == 'Create Deliver'){
        return 1;
      }
      if(this.$route.name == 'Create Exchange'){
        return 2;
      }
      if(this.$route.name == 'Create Return'){
        return 3;
      }
    }
  }
}
</script>

<style lang="scss" scoped>
$Basic:#ff6600;
$Sec:#353b48;
.sub-title{
    border-top: 1px solid rgb(136, 136, 136);
    border-bottom: 1px solid rgb(136, 136, 136);
    padding: 0.3em;
    background-color: #d0d1d5;
    margin: 0.6em 0.2em;
}
.create-order-page{
        .order-type{
          display:flex;
          padding:0.4em 0.2em;
          justify-content: safe center;
          max-width:100%;
          overflow: auto;
          .order-type-card{
            text-align: center;
            display:inline-block;
            color:#fff;
            background-color:$Basic;
            padding:0.8em 0.5em;
            border-radius:0.4em;
            margin:0.1em 0.6em;
            cursor:pointer;
            border:2px solid transparent;

          }
          .type-selected{
                border:2px solid #2c3e50;
                color : #2c3e50;
          }
        }

}
@media screen and (max-width:800px) {
.create-order-page{
        .order-type{
          .order-type-card{
            font-size:0.6em;
          }
    }
}
}
</style>