<template>
  <div class="table">
      <div class="form-card">
        <header class="sub-title">
            <h4>{{__('Old order')}}</h4>
        </header>
        <Row>
            <MyInput  :label="__('Old order AWB')"  v-model:object="order.rtn_order_awb" />
            <MySelect :label="__('Return location')" v-model:object="order.location_id" >
                <option value=0>{{__('Select')}}</option>
                <option v-for="location in $store.state.user.locations" :value="location.id" :key="location.id">{{location.city +'/'+location.area}}</option>
            </MySelect>
        </Row>
        <Row>
            <MySelect :label="__('Contact')"  v-model:object="order.contact_id" >
                <option value=0>{{__('Select')}}</option>
                <option v-for="contact in $store.state.user.contacts" :value="contact.id" :key="contact.id">{{contact.name}}</option>
            </MySelect>
        </Row>
        <Row>
            <MyButton @click="submit()" :label="__('Submit')" />
        </Row>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            order:{
                rtn_order_awb:{value:null,err:null,name:"rtn_order_awb"},
                location_id:{value:0,err:null,name:"location_id"},
                contact_id:{value:0,err:null,name:"contact_id"},
            },
        }
    },
    methods:{
        submit(){
            if(!this.check()){return null;}
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/seller/create-return',
                data:{
                    order:this.Order()
                }
            }).then(res => {
                if(!res.data.status){
                    this.$genStore.commit('loading',false);
                    this.$genStore.commit('redMessage',this.__(res.data.message));
                }else{
                    this.$store.commit('updateOrder',res.data.data.old_order);
                    this.$router.push('/dashboard/orders');
                }
            }).catch(err => {

            }).then(() => {
                this.$genStore.commit('loading',false);
            })
        },
        check(){
            let Order = this.order;
            if(!Order.rtn_order_awb.value){
                this.errorFound(this.__('Required'),Order.rtn_order_awb);
                return false;
            }else{Order.rtn_order_awb.err = null;}

            if(!Order.location_id.value || Order.location_id.value == 0){
                this.errorFound(this.__('Required'),Order.location_id );
                return false;
            }else{Order.location_id.err = null;}

            if(!Order.contact_id.value || Order.contact_id.value == 0){
                this.errorFound(this.__('Required'),Order.contact_id);
                return false;
            }else{Order.contact_id.err = null;}

            return true;
        },
        errorFound(message,object){
            object.err = message;
            let input = document.getElementById(object.name);
            input.scrollIntoView(false);
            input.focus();
        },
        Order(){
            let order = {};
            Object.entries(this.order).forEach(([key, value]) => {
                order[`${key}`] = value.value
            });
            return order;
        },
    }
}
</script>

<style>
.sub-title{
    border-top: 1px solid rgb(136, 136, 136);
    border-bottom: 1px solid rgb(136, 136, 136);
    padding: 0.3em;
    background-color: #d0d1d5;
    margin: 0.6em 0.2em;
}
</style>