<template>
<div>
  <CreatePickup :orders="selectedOrders" v-if="createPickupSwitch" @close="createPickupSwitch =false" />
  <ViewOrder :order="viewOrder" v-if="viewOrderSwitch" @close="viewOrderSwitch =false" />
  <PrintPage :order="printOrder"  v-if="printOrder" style="display:none"></PrintPage>
  <PrintMulti :orders="selectedOrders"  v-if="selectedOrders" style="display:none"></PrintMulti>
  <PageHeader>
    <MySearch @searchClicked="Search()" @searchTyped="searchTyped()" v-model:modelValue="searchInput" />
    <MyButton :notAllowed="selectedOrders.length <= 0 ?true:false" @click="createPickup()" :label="__('CreatePickup')"></MyButton>
    <SecButton>
      <router-link :to="'/dashboard/create-order'">
      {{__('Create order')}}
      </router-link>
    </SecButton>
  </PageHeader>
  <div class="data-table-container">
  <div>
      <Filter v-model="filter.status">
          <option v-for="status in statuses" :key="status.label" :value="status.value">{{__(status.label)}}</option>
      </Filter>
      <Filter v-model="filter.type">
          <option v-for="type in types" :key="type.label" :value="type.value">{{__(type.label)}}</option>
      </Filter>
      <Filter v-model="filter.city">
          <option value="All">{{__('City')}}</option>
          <option v-for="city in cities" :key="city" :value="city">{{__(city)}}</option>
      </Filter>
      <Filter v-model="filter.area">
          <option value="All">{{__('Area')}}</option>
          <option v-for="area in Areas" :key="area.value" :value="area.value">{{__(area.value)}}</option>
      </Filter>
      <ReloadData/>
  </div>
  <table class="data-table">
    <thead>
      <tr>
        <td>{{selectedOrders.length}}</td>
        <td class="actions">{{__('Actions')}}</td>
        <td>{{__('AWB')}}</td>
        <td>{{__('Cash')+'+'+__('Shipping')}}</td>
        <td>{{__('Type')}}</td>
        <td>{{__('Location')}}</td>
        <td>{{__('Attempts')}}</td>
        <td>{{__('Status')}}</td>
      </tr>
    </thead>
    <tbody>
      <tr v-for="order in filterdOrders.slice(from,from+10)" :key="order.awb">
        <td>
            <svg class="select-box" v-if="order.status == 1 && order.selected"  @click="order.selected =! order.selected" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 5c0-2.761-2.238-5-5-5h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14z"/></svg>
            <svg class="select-box" v-if="order.status == 1 && !order.selected" @click="order.selected =! order.selected" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 2c1.654 0 3 1.346 3 3v14c0 1.654-1.346 3-3 3h-14c-1.654 0-3-1.346-3-3v-14c0-1.654 1.346-3 3-3h14zm0-2h-14c-2.762 0-5 2.239-5 5v14c0 2.761 2.238 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5z"/></svg>
        </td>
        <td class="actions">
          <div>
            <svg class="action-icon" @click="Print(order)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#4cd137"><path d="M24 5h-4v-5h-16v5h-4v13h4v6h9.519c2.947 0 6.029-3.577 6.434-6h4.047v-13zm-18-3h12v3h-12v-3zm8.691 16.648s1.469 3.352-2 3.352h-6.691v-8h12v2.648c0 3.594-3.309 2-3.309 2zm6.809-10.648c-.276 0-.5-.224-.5-.5s.224-.5.5-.5.5.224.5.5-.224.5-.5.5zm-5.5 9h-8v-1h8v1zm-3 1h-5v1h5v-1z"/></svg>
            <svg class="action-icon" @click="View(order)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#00a8ff"><path d="M12.015 7c4.751 0 8.063 3.012 9.504 4.636-1.401 1.837-4.713 5.364-9.504 5.364-4.42 0-7.93-3.536-9.478-5.407 1.493-1.647 4.817-4.593 9.478-4.593zm0-2c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 7l-3.36-2.171c-.405.625-.64 1.371-.64 2.171 0 2.209 1.791 4 4 4s4-1.791 4-4-1.791-4-4-4c-.742 0-1.438.202-2.033.554l2.033 3.446z"/></svg>
          </div>
        </td>
        <td><CopyText :value="order.awb" /></td>
        <td>{{order.total_cash}}</td>
        <td><p :style="'color:'+Type(order.type).color">{{__(Type(order.type).type)}}</p></td>
        <td>{{order.city + '/' +order.area}}</td>
        <td>{{order.attempts}}</td>
        <td> <Status :background_color="Status(order.status).color">{{__(Status(order.status).label)}}</Status></td>
      </tr>
    </tbody>
  </table>
    <div class="no-order" v-if="filterdOrders.length == 0">
      <svg version="1.1" id="Warstwa_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          viewBox="0 0 430 430" style="enable-background:new 0 0 430 430;" xml:space="preserve">
          <g>
            <path class="st1" d="M354.03,354.43H75.97c-6.88,0-13.04-3.56-16.48-9.52c-3.44-5.96-3.44-13.07,0-19.03l139.03-240.8
              c3.44-5.96,9.6-9.52,16.48-9.52s13.04,3.56,16.48,9.52l0,0l139.03,240.8c3.44,5.96,3.44,13.08,0,19.03
              C367.07,350.88,360.91,354.43,354.03,354.43z M215,87.57c-1.22,0-4.26,0.34-6.09,3.52L69.88,331.88c-1.83,3.17-0.61,5.98,0,7.03
              c0.61,1.06,2.43,3.52,6.09,3.52h278.05c3.67,0,5.48-2.46,6.09-3.52c0.61-1.06,1.83-3.86,0-7.03L221.09,91.08
              C219.26,87.91,216.22,87.57,215,87.57z"/>
            <g>
              <path class="st3" d="M217.7,264.59h-5.41c-10.6,0-19.3-8.29-19.82-18.88l-2.83-57.89c-0.3-6.18,1.88-12.06,6.15-16.54
                c4.27-4.48,10.03-6.95,16.22-6.95h5.96c6.19,0,11.95,2.47,16.22,6.95c4.27,4.48,6.45,10.36,6.15,16.54l-2.83,57.89
                C237.01,256.3,228.3,264.59,217.7,264.59z M212.02,176.33c-2.87,0-5.55,1.15-7.53,3.23c-1.98,2.08-3,4.81-2.86,7.68l2.83,57.89
                c0.2,4.18,3.65,7.46,7.83,7.46h5.41c4.19,0,7.63-3.28,7.83-7.46l2.83-57.89c0.14-2.87-0.87-5.6-2.86-7.68
                c-1.98-2.08-4.65-3.23-7.53-3.23H212.02z"/>
              <path class="st3" d="M215,322.33c-12.05,0-21.85-9.8-21.85-21.85s9.8-21.85,21.85-21.85s21.85,9.8,21.85,21.85
                S227.05,322.33,215,322.33z M215,290.63c-5.43,0-9.85,4.42-9.85,9.85s4.42,9.85,9.85,9.85s9.85-4.42,9.85-9.85
                S220.43,290.63,215,290.63z"/>
            </g>
          </g>
        </svg>
      <p>{{ __('No Orders') }} <router-link :to="'/dashboard/create-order/deliver'">{{__('Create one')}}</router-link></p>
    </div>
  </div>
  <PagesToggler v-model:from="from" :arrayLength="filterdOrders.length"/>
</div>
</template>

<script>
import CreatePickup from '../windows/Create-Pickup.vue'
import ViewOrder from '../windows/View-Order.vue'
import PrintPage from '../../components/Print-page.vue'
import PrintMulti from '../../components/Print-Multi.vue'
export default {
  data(){
    return{
      from:0,
      createPickupSwitch:false,
      viewOrderSwitch:false,
      searchInput:'',
      viewOrder:{},
      printOrder:null,
      printOrders:null,
      statuses:this.$genStore.getters.orderStatuses,
      types:[
        {value:0,label:'Type'},
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
          'Cairo',
          'Giza',
          'Qalubeya',
          'Alexandria',
      ],
      areas:this.$genStore.getters.Areas
    }
  },
  components:{
    CreatePickup,ViewOrder,PrintPage,PrintMulti
  },
  methods:{
    createPickup(){
      if(this.selectedOrders.length <= 0){return null;}
      this.createPickupSwitch = true;
    },
    Search(){
      this.$genStore.commit('loading',true);
      this.$axios({
        method:'post',
        url:'/dashboard/seller/find-order',
        data:{awb:this.searchInput}
      }).then(res => {
        if(res.data == 500){this.$genStore.commit('redMessage',this.__('Not found'));return null;}
        let order = res.data;
        order.selected = false;
        this.$store.state.orders = [];
        this.$store.state.orders.push(res.data);
      }).then(()=>{
        this.$genStore.commit('loading',false);
      })
    },
    searchTyped(){
      if(this.searchInput.length == 0){
        this.$store.state.orders = this.$store.state.FOrders;
      }
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
    },
    View(order){
      this.viewOrder = order;
      this.viewOrderSwitch = true;
    },
    Print(order){
        this.printOrder = order;
        let w=window.open();
        w.document.write(document.getElementById('print-page').innerHTML);
        w.print();
        this.printOrder = null;
        w.close();
    },
    PrintMulti(order){
        let w=window.open();
        w.document.write(document.getElementById('print-multi').innerHTML);
        w.print();
        w.close();
    },
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
    selectedOrders:function(){
      return this.filterdOrders.filter(order => {
        return order.selected;
      })
    },
    Areas:function(){
        return this.areas.filter(area => {
            return area.city == this.filter.city
        })
    },
  }
}
</script>

<style lang='scss' scoped>
.no-order{
height: 100%;
display: flex;
align-items: center;
justify-content: center;
flex-direction: column;
background-color: transparent;
font-size:0.8em;
  svg{
    width:75px;
    fill:#ff6600;
  }
  p{
    margin:0.3em
  }
  a{
    text-decoration:underline;
    &:hover{
      color:#ff6600;
    }
  }
}
.next-pre{
  text-align:center;
}
</style>