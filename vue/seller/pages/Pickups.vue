<template>
  <div>
    <PageHeader>
      <MySearch @searchClicked="Search()" @searchTyped="searchTyped()" v-model:modelValue="searchInput" />
    </PageHeader>
    <div>
      <Filter v-model="filter.status">
            <option v-for="status in statuses" :key="status.label" :value="status.value">{{__(status.label)}}</option>
      </Filter>
      <Filter v-model="filter.hub">
            <option v-for="hub in hubs" :key="hub.label" :value="hub.value">{{__(hub.label)}}</option>
      </Filter>
      <ReloadData/>
    </div>
    <div class="data-table-container">
      <table class="data-table">
        <thead>
          <tr>
            <td>{{__('AWB')}}</td>
            <td>{{__('Hub')}}</td>
            <td>{{__('Location')}}</td>
            <td>{{__('Contact')}}</td>
            <td>{{__('Status')}}</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pickup in filterdPickups.slice(from,from+10)" :key="pickup.awb">
            <td><CopyText :value="pickup.awb" /></td>
            <td>{{__(Hub(pickup.hub))}}</td>
            <td>{{pickup.location.city + '/' +pickup.location.area}}</td>
            <td>{{pickup.contact.name + '/' +pickup.contact.mobile}}</td>
            <td> <Status :background_color="Status(pickup.status).color">{{__(Status(pickup.status).value)}}</Status></td>
          </tr>
        </tbody>
      </table>
    <div class="no-order" v-if="filterdPickups.length == 0">
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
      <p>{{ __('No Pickups') }}</p>
    </div>
    </div>
  <PagesToggler v-model:from="from" :arrayLength="filterdPickups.length"/>
  </div>
</template>

<script>
export default {
  data(){
    return{
      from:0,
      searchInput:'',
      filter:{
        status:0,
        hub:0,
      },
      statuses:[
        {value:0,label:'All'},
        {value:1,label:'New'},
        {value:25,label:'Ready'},
        {value:2,label:'Courier on way to pick'},
        {value:4,label:'Failed'},
        {value:3,label:'In stock'}
      ],
      hubs:[
        {value:0,label:'All'},
        {value:1,label:'Cairo'},
        {value:2,label:'Giza'},
        {value:3,label:'Qalubeya'},
      ]
    }
  },
  methods:{
    Search(){
      this.$genStore.commit('loading',true);
      this.$axios({
        method:'post',
        url:'/dashboard/find-pickup',
        data:{awb:this.searchInput}
      }).then(res => {
        if(res.data == 500){this.$genStore.commit('redMessage',this.__('Not found'));return null;}
        let pickup = res.data;
        pickup.old_status = pickup.status;
        pickup.selected = false;
        pickup.kind = 'p';
        this.$store.state.pickups = [];
        this.$store.state.pickups.push(res.data);
      }).then(()=>{
        this.$genStore.commit('loading',false);
      })
    },
    searchTyped(){
      if(this.searchInput.length == 0){
        this.$store.state.pickups = this.$store.state.FPickups;
      }
    },
    Hub(hub){
      switch(hub){
        case 1 :return 'Cairo';
        case 2 :return 'Giza';
        case 3 :return 'Qalyubia';
        case '1' :return 'Cairo';
        case '2' :return 'Giza';
        case '3' :return 'Qalyubia';
        default : return 'No Hub';
      }
    },
    Status(status){
      switch(status) {
        case 1:return {value:'New',color:'#00b894'};
        case 2:return {value:'Courier on way to pick',color:'#e1b12c'};
        case 3:return {value:'In stock',color:'#487eb0'};
        case 4:return {value:'Faild',color:'#e00'};
        case 25:return {value:'Ready',color:'#353b48'};
        default:return {value:'No status',color:'#000'};
      } 
    },
  },
  computed:{
    filterdPickups:function(){
      return this.$store.state.pickups.filter(pickup=>{
        return (pickup.status == this.filter.status||this.filter.status==0)
            &&(pickup.hub == this.filter.hub||this.filter.hub==0)
      });
    }
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
</style>