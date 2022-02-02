<template>
  <div>
    <section class="vectir-container">
        <img :src="'/photos/complain.jpg'" alt="LOGO">
    </section>
      <Row>
        <MyInput :label="__('AWB')" v-model:object="ticket.awb"></MyInput>
      </Row>
      <Row>
        <MyInput :label="__('Description')" v-model:object="ticket.desc"></MyInput>
      </Row>
      <Row>
        <MyButton @click="submit()" :label="__('Submit')"></MyButton>
      </Row>
  </div>
</template>

<script>
export default {
  data(){
    return {
      ticket:{
        awb:{value:null,err:null,name:'awb'},
        desc:{value:null,err:null,name:'desc'},
      }
    }
  },
  methods:{
    submit(){
      this.$genStore.commit('loading',true);
      this.$axios({
        method:'post',
        url:'/dashboard/seller/create-ticket',
        data:{
          ticket:this.Ticket()
        }
      }).then(res => {
          Object.assign(this.$data, this.$options.data())
          this.$genStore.commit('greenMessage',this.__('Ticket created'));
      }).catch(err => {
          this.$genStore.commit('redMessage','An error happend');
      }).then(()=>{
          this.$genStore.commit('loading',false);
      })
    },
    Ticket(){
      let newTicket = {};
      for (const key in this.ticket) {
          newTicket[key] = this.ticket[key].value;
      }
      return newTicket;
    },
  }
}
</script>

<style lang='scss' scoped>
.vectir-container{
  text-align:center;
  max-width:80%;
  height:40vh;
  img{
    max-width:80%;
    height:90%;
  }
}
</style>