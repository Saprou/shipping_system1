<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
          <div class="window">
            <header>
                <h3>{{pickup.awb}}</h3>
            </header>
            <div class="data-table-container">
                <h2>Pickup details</h2>
            <table class="data-table">
                <tbody>
                <tr>
                   <td>{{__('Status')}}</td>
                   <td>{{__('Hub')}}</td>
                </tr>
                <tr>
                    <td><Status :background_color="Status(pickup.old_status).color">{{Status(pickup.status).value}}</Status></td>
                    <td>{{Hub(pickup.hub)}}</td>
                </tr>
                </tbody>
            </table>
                <h2>Seller details</h2>
            <table class="data-table">
                <tbody>
                <tr>
                   <td>{{__('Ref')}}</td>
                   <td>{{__('Name')}}</td>
                </tr>
                <tr>
                    <td>{{pickup.seller.ref}}</td>
                    <td>{{pickup.seller.f_name}} {{pickup.seller.l_name}}</td>
                </tr>
                <tr>
                   <td>{{__('Mobile')}}</td>
                   <td>{{__('Second mobile')}}</td>
                </tr>
                <tr>
                    <td>{{pickup.seller.mobile}}</td>
                    <td>{{pickup.seller.sec_mobile}}</td>
                </tr>
                </tbody>
            </table>
                <h2>Location</h2>
            <table class="data-table">
                <tbody>
                <tr>
                   <td>{{__('City')}}</td>
                   <td>{{__('Area')}}</td>
                </tr>
                <tr>
                    <td>{{pickup.location.city}}</td>
                    <td>{{pickup.location.area}}</td>
                </tr>
                <tr>
                   <td>{{__('Street')}}</td>
                   <td>{{__('Landmarks')}}</td>
                </tr>
                <tr>
                    <td>{{pickup.location.street}}</td>
                    <td>{{pickup.location.landmarks}}</td>
                </tr>
                <tr>
                   <td>{{__('Building')}}</td>
                   <td>{{__('Floor')}}</td>
                </tr>
                <tr>
                    <td>{{pickup.location.building}}</td>
                    <td>{{pickup.location.floor}}</td>
                </tr>
                <tr>
                   <td>{{__('Apartment')}}</td>
                </tr>
                <tr>
                    <td>{{pickup.location.apartment}}</td>
                </tr>
                </tbody>
            </table>
                <h2>Orders</h2>
            <table class="data-table no-colors">
                <tbody>
                    <tr v-for="order in pickup.orders" :key="order.id">
                    <td>{{order.city}}/{{order.area}}/{{order.street}}/{{order.landmarks}}/{{order.building}}/{{order.floor}}</td>
                    <td>{{order.name}}</td>
                    <td>{{order.number_of_items}}</td>
                    <td>{{order.awb}}</td>
                    </tr>
                </tbody>
            </table>
               <small>
                    {{pickup.notes}}
                </small>
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
    props:['pickup'],
    data(){
        return {
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
        Hub(hub){
        switch(hub){
            case 1 :return 'Cairo';
            case 2 :return 'Giza';
            case 3 :return 'Qalyubia';
            default : return 'No Hub';
        }
        },
        Status(status){
        switch(status) {
            case 1:return {value:'New',color:'#00b894'};
            case 2:return {value:'CourierOnWayToPick',color:'#e1b12c'};
            case 3:return {value:'InStock',color:'#487eb0'};
            case 4:return {value:'Faild',color:'#e00'};
            case 25:return {value:'Ready',color:'#353b48'};
            default:return {value:'NoStatus',color:'#000'};
        } 
        },
    }
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
            .no-colors{
                tr{
                    border-bottom:none;
                }
                tr:nth-of-type(odd){
                    font-weight:normal;
                    border-bottom: 1px solid #8ab5b8;
                    color:#000;
                    background-color:#fff;
                    td{
                        border:1px solid #aaa;
                    }
                }
                tr:nth-of-type(even){
                    border-bottom: 1px solid #8ab5b8;
                    color:#000;
                    background-color:#fff;
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