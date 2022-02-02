<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
          <div class="window">
            <header>
                <h3>{{order.awb}}</h3>
            </header>
            <table class="data-table">
                <tr>
                    <td>{{__('AWB')}}</td>
                    <td>{{__('Cash')+'+'+__('Shipping')}}</td>
                    <td>{{__('Type')}}</td>
                    <td>{{__('Status')}}</td>
                </tr>
                <tr>
                    <td>{{order.awb}}</td>
                    <td>{{order.total_cash}}</td>
                    <td><p :style="'color:'+Type(order.type).color">{{__(Type(order.type).type)}}</p></td>
                    <td> <Status :background_color="Status(order.status).color">{{__(Status(order.status).status)}}</Status></td>
                </tr>
                <tr>
                    <td>{{__('Description')}}</td>
                    <td>{{__('Customer name')}}</td>
                    <td>{{__('mobile')}}</td>
                    <td>{{__('Second mobile')}}</td>
                </tr>
                <tr>
                    <td>{{order.desc}}</td>
                    <td>{{order.name}}</td>
                    <td>{{order.mobile}}</td>
                    <td>{{order.sec_mobile}}</td>
                </tr>
            </table>
          </div>
      </div>
      <section class="X" @click="close()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg>
      </section>
  </div>
</template>

<script>
export default {
    props:['order'],
    data(){
        return {
      statuses:[
            {value:0,label:'All'},
            {value:1,label:'New'},
            {value:2,label:'InPickup'},
            {value:3,label:'CourierOnWayToPick'},
            {value:4,label:'FaildToPick'},
            {value:5,label:'InStockToDeliver'},
            {value:25,label:'ReadyToDeliver'},
            {value:6,label:'CourierOnWayToDeliver'},
            {value:7,label:'Delivered'},
            {value:8,label:'Canceld'},
            {value:9,label:'ReturnedToStock'},
            {value:10,label:'OnWayToReturn'},
            {value:11,label:'ReturnedToSeller'},
            {value:20,label:'SetToReturn'},
            {value:21,label:'CourierOnWayToCustomer'},
            {value:22,label:'InStockToReturn'},
            {value:23,label:'OnWayToSeller'},
            {value:24,label:'ReturnedToSeller'},
            {value:26,label:'ReadyToReturn'},
        ],
        types:[
            {value:0,label:'All'},
            {value:1,label:'Deliver'},
            {value:2,label:'Return'},
            {value:3,label:'Exchange'}
        ],
        }
    },
    mounted(){
        this.fadeIn();
    },
    methods:{
        close(){
            this.$emit('close',false);
        },
        fadeIn(){
            setTimeout(function(){
                let popups = document.getElementsByClassName('popup-container');
                popups[0].style.opacity = '1';
            },1);
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
        switch(status) {
            case 1:return {status:'New',color:'#00b894'};
            case 2:return {status:'InPickup',color:'#6c5ce7'};
            case 3:return {status:'CourierOnWayToPick',color:'#fdcb6e'};
            case 4:return {status:'FaildToPick',color:'#d63031'};
            case 5:return {status:'InStockToDeliver',color:'#00cec9'};
            case 25:return {status:'ReadyToDeliver',color:'#74b9ff'};
            case 6:return {status:'CourierOnWayToDeliver',color:'#e1b12c'};
            case 7:return {status:'Delivered',color:'#44bd32'};
            case 8:return {status:'Canceld',color:'#f00'};
            case 9:return {status:'ReturnedToStock',color:'#f30'};
            case 10:return {status:'OnWayToReturn',color:'#f30'};
            case 11:return {status:'ReturnedToSeller',color:'#f30'};
            case 20:return {status:'SetToReturn',color:'#e84118'};
            case 26:return {status:'ReadyToReturn',color:'#487eb0'};
            case 21:return {status:'CourierOnWayToCustomer',color:'#f00'};
            case 22:return {status:'InStockToReturn',color:'#f00'};
            case 23:return {status:'OnWayToSeller',color:'#f00'};
            case 24:return {status:'ReturnedToSeller',color:'#353b48'};
            default:return {status:'NoStatus',color:'#000'};
        } 
        },
    },
}
</script>

<style lang='scss' scoped>
    .popup-container{
        transition:opacity 0.3s ease-in;
        position:fixed;
        inset:0;
        display:flex;
        opacity:0;
        align-items: center;    justify-content: center;
        z-index:20;
        .popup-background{
            position: absolute;
            inset: 0;
            background-color:rgba($color: #504b4b, $alpha: .7);
            z-index:-1;
        }
        .popup-content{
            max-height:100%;
            max-width:100%;
            overflow:auto;
            padding:0.6em 0.4em;
        }
        .X{
            position:absolute;
            top:1em;        right:1em;
            fill:tomato;
            cursor:pointer;
        }
    }
</style>