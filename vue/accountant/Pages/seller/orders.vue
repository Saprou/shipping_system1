<template>
 <div>
    <header>
      <Filter v-model="filter.status">
          <option v-for="status in statuses" :key="status.label" :value="status.value">{{__(status.label)}}</option>
      </Filter>
    </header>
    <table class="data-table">
        <thead>
            <tr>
                <td>{{__('Name')}}</td>
                <td>{{__('Ref')}}</td>
                <td>{{__('Mobiles')}}</td>
                <td>{{__('Forhim')}}/{{__('Onhim')}}</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{seller.f_name}} {{seller.l_name}}</td>
                <td>{{seller.ref}}</td>
                <td>{{seller.mobile}} / {{seller.sec_mobile}}</td>
                <td>{{cash}}</td>
            </tr>
        </tbody>
    </table>
    <div class="data-table-container">
    <table class="data-table">
      <thead>
          <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><TimeFilter v-model:from="filter.received_at_from" v-model:to="filter.received_at_to" /></td>
              <td><TimeFilter v-model:from="filter.deliverd_at_from" v-model:to="filter.deliverd_at_to" /></td>
              <td><TimeFilter v-model:from="filter.collected_at_from" v-model:to="filter.collected_at_to" /></td>
              <td><TimeFilter v-model:from="filter.paid_at_from" v-model:to="filter.paid_at_to" /></td>
          </tr>
          <tr>
            <td>
                <button @click="$store.dispatch('collectOrders',selectedOrders)" v-if="collectable">collect</button>
                <button @click="$store.dispatch('payOrders',selectedOrders)" v-if="payable">Pay</button>
            </td>
            <td class="actions">{{__('Actions')}}</td>
            <td>{{__('awb')}}</td>
            <td>{{__('Total cash')}}</td>
            <td>{{__('Status')}}</td>
            <td>{{__('Type')}}</td>
            <td>{{__('Attempts')}}</td>
            <td>{{__('Received at')}}</td>
            <td>{{__('Deliverd at')}}</td>
            <td>{{__('Collected at')}}</td>
            <td>{{__('Paid at')}}</td>
          </tr>
      </thead>
        <tbody>
            <tr v-for="order in filterdOrders" :key="order.awb">
                <td>
                    <svg class="select-box" v-if="order.selected"  @click="order.selected =! order.selected" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 5c0-2.761-2.238-5-5-5h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14z"/></svg>
                    <svg class="select-box" v-if="!order.selected" @click="order.selected =! order.selected" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 2c1.654 0 3 1.346 3 3v14c0 1.654-1.346 3-3 3h-14c-1.654 0-3-1.346-3-3v-14c0-1.654 1.346-3 3-3h14zm0-2h-14c-2.762 0-5 2.239-5 5v14c0 2.761 2.238 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5z"/></svg>
                </td>
                <td class="actions">
                </td>
                <td><CopyText :value="order.awb" /></td>
                <td>{{order.total_cash}}</td>
                <td><Status :background_color="Status(order.status).color">{{__(Status(order.status).label)}}</Status></td>
                <td>{{Type(order.type)}}</td>
                <td>{{order.attempts}}</td>
                <td>{{order.received_at}}</td>
                <td>{{order.deliverd_at}}</td>
                <td>{{order.collected_at}}</td>
                <td>{{order.paid_at}}</td>
            </tr>
        </tbody>
    </table>
    </div>
 </div>
</template>

<script>
export default {
    props:{
        orders:{default:[]},
        seller:{default:[]},
        cash:{default:'/'},
    },
    data(){
        return{
            filter:{
                deliverd_at_from:'2021-01-01',
                received_at_from:'2021-01-01',
                collected_at_from:'2021-01-01',
                paid_at_from:'2021-01-01',
                deliverd_at_to:'2050-01-01',
                received_at_to:'2050-01-01',
                collected_at_to:'2050-01-01',
                paid_at_to:'2050-01-01',
                status:0
            },
            statuses:this.$genStore.getters.orderStatuses,
            types:[
                {value:0,label:'All'},
                {value:1,label:'Deliver'},
                {value:2,label:'Return'},
                {value:3,label:'Exchange'}
            ],
        }
    },
    methods:{
        collectOrders(orders){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/accountant/collect-orders',
                data:{orders:orders}
            }).then(res =>{
                this.orders.forEach(order => {
                    res.data.forEach(o => {
                        o.selected = false;
                        if(order.id == o.id){Object.assign(order,o)}
                    })
                })
                this.$store.commit('insertOrders',res.data);
            }).then(()=>{
                this.$genStore.commit('loading',false);
            })
        },
        payOrders(orders){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/accountant/pay-orders',
                data:{orders:orders}
            }).then(res =>{
                this.orders.forEach(order => {
                    res.data.forEach(o => {
                        o.selected = false;
                        if(order.id == o.id){Object.assign(order,o)}
                    })
                })
                this.$store.commit('insertOrders',res.data);
            }).then(()=>{
                this.$genStore.commit('loading',false);
            })
        },
        Type(type){
            if(type == 1){return 'Deliver'}
            if(type == 2){return 'Return'}
            if(type == 3){return 'Exchange'}
        },
        Status(status){
            for (let i = 0; i < this.statuses.length; i++) {
            if(this.statuses[i].value == status){return this.statuses[i];}
            }
            return {label:"No status",color:"#000"};
        } 
    },
    computed:{
        filterdOrders:function(){
            return this.orders.filter(order => {
                return (this.filter.status==0 || order.status == this.filter.status)
                       &&((this.filter.deliverd_at_from <= order.deliverd_at&&this.filter.deliverd_at_to >= order.deliverd_at)||order.deliverd_at == null)
                       &&((this.filter.received_at_from <= order.received_at&&this.filter.received_at_to >= order.received_at)||order.received_at==null)
                       &&((this.filter.collected_at_from <= order.collected_at&&this.filter.collected_at_to >= order.collected_at)||order.collected_at == null)
                       &&((this.filter.paid_at_from <= order.paid_at&&this.filter.paid_at_to >= order.paid_at)||order.paid_at == null)
                       ;
            });
        },
        selectedOrders:function(){
            return this.filterdOrders.filter(order => {
                return order.selected;
            })
        },
        collectable:function(){
          let re = false;
          if(this.selectedOrders.length == 0){return false;}
          re = true;
          this.selectedOrders.forEach(order => {
            re = order.status != 7 ? false : re ;
          });
          return re;
        },
        payable:function(){
          let re = false;
          if(this.selectedOrders.length == 0){return false;}
          re = true;
          this.selectedOrders.forEach(order => {
            re = order.status != 12 ? false : re ;
          });
          return re;
        }

    }
}
</script>

<style>

</style>