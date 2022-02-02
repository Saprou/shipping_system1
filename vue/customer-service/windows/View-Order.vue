<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
          <div class="window">
            <header>
                <h3>{{order.awb}}</h3>
            </header>
            <div class="data-table-container">
            <table class="data-table">
                <tbody>
                <tr>
                    <td>{{__('AWB')}}</td>
                    <td>{{__('Cash')+'+'+__('Shipping')}}</td>
                </tr>
                <tr>
                   <td>{{order.awb}}</td>
                   <td>{{order.total_cash}}</td>
                </tr>
                <tr>
                    <td>{{__('Package type')}}</td>
                    <td>{{__('Number of items')}}</td>
                </tr>
                <tr>
                   <td>{{order.package_type}}</td>
                   <td>{{order.number_of_items}}</td>
                </tr>
                <tr>
                  <td>{{__('Type')}}</td>
                  <td>{{__('Status')}}</td>
                </tr>
                <tr>
                    <td><p :style="'color:'+Type(order.type).color">{{__(Type(order.type).type)}}</p></td>
                    <td> <Status :background_color="Status(order.status).color">{{__(Status(order.status).label)}}</Status></td>
                </tr>
                <tr>
                    <td>{{__('Description')}}</td>
                    <td>{{__('Customer name')}}</td>
                </tr>
                <tr>
                    <td>{{order.desc}}</td>
                    <td>{{order.name}}</td>
                </tr>
                <tr>
                   <td>{{__('Mobile')}}</td>
                   <td>{{__('Second mobile')}}</td>
                </tr>
                <tr>
                    <td>{{order.mobile}}</td>
                    <td>{{order.sec_mobile}}</td>
                </tr>
                <tr>
                   <td>{{__('City')}}</td>
                   <td>{{__('Email')}}</td>
                </tr>
                <tr>
                    <td>{{order.city}}</td>
                    <td>{{order.email}}</td>
                </tr>
                <tr>
                   <td>{{__('Street')}}</td>
                   <td>{{__('Area')}}</td>
                </tr>
                <tr>
                    <td>{{order.street}}</td>
                    <td>{{order.area}}</td>
                </tr>
                <tr>
                   <td>{{__('Building')}}</td>
                   <td>{{__('Landmarks')}}</td>
                </tr>
                <tr>
                    <td>{{order.building}}</td>
                    <td>{{order.landmarks}}</td>
                </tr>
                <tr>
                   <td>{{__('Apartment')}}</td>
                   <td>{{__('Floor')}}</td>
                </tr>
                <tr>
                    <td>{{order.apartment}}</td>
                    <td>{{order.floor}}</td>
                </tr>
                <tr>
                   <td>{{__('Notes')}}</td>
                </tr>
                <tr>
                    <td>{{order.notes}}</td>
                </tr>
                </tbody>
            </table>
            <h2>{{__('Seller')}}</h2>
            <table class="data-table">
                <tbody>
                <tr>
                    <td>{{__('Seller Ref')}}</td>
                    <td>{{__('Seller Name')}}</td>
                    <td>{{__('Mobiles')}}</td>
                </tr>
                <tr>
                   <td>{{order.seller.ref}}</td>
                   <td>{{order.seller.name}}</td>
                   <td>{{order.seller.mobiles}}</td>
                </tr>
                </tbody>
            </table>
            </div>
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
        statuses:this.$genStore.getters.orderStatuses,
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
            for (let i = 0; i < this.statuses.length; i++) {
            if(this.statuses[i].value == status){return this.statuses[i];}
            }
            return {label:"No status",color:"#000"};
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
            max-width:100vw;
            padding:0.6em 0.4em;
            overflow:hidden;
            .data-table-container{
                    min-width:300px;
                    max-width:99vw;
                    overflow:auto;

                    max-height:80vh;
            }
            tbody{
                tr{
                    border-bottom:none;
                }
                tr:nth-of-type(odd){
                    font-weight:900;
                    margin-top:5px;
                    background-color:#8ab5b8;
                    color:#fff;
                }
                tr:nth-of-type(even){
                    border-bottom: 1px solid #8ab5b8;
                    td{
                        border:1px solid #aaa;
                    }
                }
            }
        }
        .X{
            position:absolute;
            top:1em;        right:1em;
            fill:tomato;
            cursor:pointer;
        }
    }
</style>