<template>
  <div>
      <EditOrder @close="EditOrder = null" :order="EditOrder" v-if="EditOrder"/>
    <header>
        <section class="filters-container">
        <MySearch @searchClicked="Search()" @searchTyped="searchTyped()" v-model:modelValue="searchInput" />
        <section class="filter">
            <label for="">{{__('Status')}}</label>
            <select v-model="filter.status">
            <option v-for="status in statuses" :key="status.label" :value="status.value">{{__(status.label)}}</option>
            </select>
        </section>
        <section class="filter">
            <label for="">{{__('Type')}}</label>
            <select v-model="filter.type">
            <option v-for="type in types" :key="type.label" :value="type.value">{{__(type.label)}}</option>
            </select>
        </section>
        <section class="filter">
            <label for="">{{__('City')}}</label>
            <select v-model="filter.city">
            <option v-for="city in cities" :key="city" :value="city">{{__(city)}}</option>
            </select>
        </section>
        <section class="filter">
            <label for="">{{__('Area')}}</label>
            <select v-model="filter.area">
            <option value="All">{{__('All')}}</option>
            <option v-for="area in Areas" :key="area.value" :value="area.value">{{__(area.value)}}</option>
            </select>
        </section>
        </section>
        <svg class="reload-icon" @click="$store.commit('getItems')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z"/></svg>
    </header>
      <div class="data-table-container">
          <table class="data-table">
              <thead>
                  <tr>
                      <td>{{__('Length')}}</td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>{{filterdOrders.length}}</td>
                  </tr>
              </tbody>
          </table>
          

          <table class="data-table">
              <thead>
                  <tr>
                      <td class="actions">{{__('Actions')}}</td>
                      <td>{{__('AWB')}}</td>
                      <td>{{__('Seller')}}</td>
                      <td>{{__('Location')}}</td>
                      <td>{{__('Status')}}</td>
                      <td>{{__('Type')}}</td>
                      <td>{{__('Attempts')}}</td>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="order in filterdOrders" :key="order.id">
                      <td class="actions">
                          <button @click="EditOrder = order">edit</button>
                          <select @input="changeStatus(order.id,$event.target.value)">
                              <option value=0>{{__('Change status')}}</option>
                              <option value=1>{{__('New')}}</option>
                              <option value=2>{{__('In pickup')}}</option>
                              <option value=3>{{__('Courier on way to pick')}}</option>
                              <option value=4>{{__('Faild to pick')}}</option>
                              <option value=25>{{__('Ready')}}</option>
                              <option value=5>{{__('In stock')}}</option>
                              <option value=6>{{__('Courier on way to deliver')}}</option>
                              <option value=7>{{__('Delivered')}}</option>
                              <option value=8>{{__('RTNed to stock')}}</option>
                              <option value=9>{{__('Canceld')}}</option>
                              <option value=10>{{__('On way to seller')}}</option>
                              <option value=23>{{__('On way to seller (return)')}}</option>
                              <option value=11>{{__('Returned')}}</option>
                              <option value=12>{{__('Collected')}}</option>
                              <option value=13>{{__('Paid')}}</option>
                              <option value=24>{{__('Returned (return)')}}</option>
                              <option value=20>{{__('Set to return(return)')}}</option>
                              <option value=21>{{__('Courier on way to customer(return)')}}</option>
                              <option value=22>{{__('In stock (return)')}}</option>
                              <option value=30>{{__('Faild to return (return)')}}</option>
                          </select>
                      </td>
                      <td><CopyText :value="order.awb" /></td>
                      <td>{{order.seller.ref}} /{{order.seller.f_name+ ' '+order.seller.l_name}}</td>
                      <td>{{order.city}}/{{order.area}}</td>
                      <td><Status :background_color="Status(order.status).color">{{__(Status(order.status).label)}}</Status></td>
                      <td><p :style="'color:'+Type(order.type).color">{{__(Type(order.type).type)}}</p></td>
                      <td>{{order.attempts}}</td>
                  </tr>
              </tbody>
          </table>
      </div>
  </div>
</template>

<script>
import EditOrder from '../windows/Edit-Order.vue';
export default {
    data(){
        return{
            EditOrder:null,
            searchInput:'',
            statuses:this.$genStore.getters.orderStatuses,
            types:[
                {value:0,label:'All'},
                {value:1,label:'Deliver'},
                {value:2,label:'Return'},
                {value:3,label:'Exchange'}
            ],
            filter:{
                status:0,
                type:0,
                city:'All',
                area:'All',
            },
            cities:[
                'All',
                'Cairo',
                'Giza',
                'Qalubeya',
                'Alexandria',
            ],
            areas:this.$genStore.getters.Areas,
        }
    },
    components:{
        EditOrder
    },
    methods:{
        Search(){
            this.$axios({
                method:'post',
                url:'/dashboard/find-order',
                data:{awb:this.searchInput}
            }).then(res => {
                if(res.data == 500){console.log('Not Found');return null;}
                let order = res.data;
                order.old_status = order.status;
                order.selected = false;
                order.kind = 'o';
                this.$store.state.orders = [];
                this.$store.state.orders.push(order);
            })
        },
        searchTyped(){
            if(this.searchInput.length == 0){
            this.$store.state.orders = this.$store.state.FOrders;
        }
        },
        changeStatus(id,status){
            if(status == 0){return null;}
            status = parseInt(status);
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/admin/update-order-status',
                data:{id:id , status:status}
            }).then(res => {
                this.$store.commit('insertOrder',res.data);
            }).then(() => {
                this.$genStore.commit('loading',false);
            })
        },
        Type(type){
            switch(type) {
                case 1:
                return {type:'Deliver',color:'green'};
                case 2:
                return {type:'Return',color:'orange'};
                case 3:
                return {type:'Exchange',color:'red'};
                default:
                return {type:'no type',color:'#000'};
            }
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
        return this.$store.state.orders.filter(order => {
            return (order.status == this.filter.status || this.filter.status==0 )
                && (order.type == this.filter.type || this.filter.type==0)
                && (order.city == this.filter.city || this.filter.city=='All')
                && (order.area.match(this.filter.area) || this.filter.area=='All');
        });
        },
        Areas:function(){
            return this.areas.filter(area => {
                return area.city == this.filter.city
            })
        },

    }
}
</script>

<style>

</style>