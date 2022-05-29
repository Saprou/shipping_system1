<template>
  <form @submit.prevent="submit()" class="table">
      <div class="form-card">
        <header class="sub-title">
            <h4>{{__('OrderDetails')}}</h4>
        </header>
        <Row>
            <div class="form-group">
                <label for="total_cash">{{__('Cash')+'+'+__('Shipping')}}</label>
                <input type="text" name="total_cash" v-model="order.total_cash">
            </div>
            <div class="form-group">
                <label for="package_type">{{__('Package type')}}</label>
                <select type="text" name="package_type" v-model="order.package_type">
                    <option value=1>{{__('Parcel')}}</option>
                    <option value=2>{{__('Document')}}</option>
                    <option value=3>{{__('Bulky')}}</option>
                </select>
            </div>
        </Row>
        <Row>
            <div class="form-group">
                <label for="number_of_items">{{__('Number of items')}}</label>
                <input type="text" name="number_of_items" v-model="order.number_of_items">
            </div>
            <div class="form-group">
                <label for="desc">{{__('Description')}}</label>
                <input type="text" name="desc" v-model="order.desc">
            </div>
        </Row>
      </div>
      <!--Customer Info -->
      <div class="form-card">
        <header class="sub-title">
            <h4>{{__('CustomerDetails')}}</h4>
        </header>
        <Row>
            <div class="form-group">
                <label for="name">{{__('Customer name')}}</label>
                <input type="text" name="name" v-model="order.name">
            </div>
            <div class="form-group">
                <label for="mobile">{{__('Mobile')}}</label>
                <input type="text" name="mobile" v-model="order.mobile">
            </div>
        </Row>
        <Row>
            <div class="form-group">
                <label for="notes">{{__('Notes')}}</label>
                <input type="text" name="notes" v-model="order.notes">
            </div>
            <div class="form-group">
                <label for="sec_mobile">{{__('Second mobile')}}</label>
                <input type="text" name="sec_mobile" v-model="order.sec_mobile">
            </div>
        </Row>
        <Row>
            <div class="form-group">
                <label for="sec_mobile">{{__('City')}}</label>
                <select name="city" v-model="order.city" id="">
                    <option v-for="(city,index) in $genStore.state.cities" :key="index" :value="city.name_en">{{$genStore.getters.getLocale == 'en'?city.name_en:city.name_ar}}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sec_mobile">{{__('Area')}}</label>
                <select name="area" v-model="order.area" id="">
                  <option v-for="(area,index) in Areas" :key="index" :value="area.name_en">{{$genStore.getters.getLocale == 'en'?area.name_en:area.name_ar}}</option>
                </select>
            </div>
        </Row>
        <Row>
            <div class="form-group">
                <label for="street">{{__('Street')}}</label>
                <input type="text" name="street" v-model="order.street">
            </div>
            <div class="form-group">
                <label for="landmarks">{{__('Landmarks')}}</label>
                <input type="text" name="landmarks" v-model="order.landmarks">
            </div>
        </Row>
        <Row>
            <div class="form-group">
                <label for="floor">{{__('Floor')}}</label>
                <input type="text" name="floor" v-model="order.floor">
            </div>
            <div class="form-group">
                <label for="building">{{__('Building')}}</label>
                <input type="text" name="building" v-model="order.building">
            </div>
        </Row>
        <Row>
            <div class="form-group">
                <label for="apartment">{{__('Apartment')}}</label>
                <input type="text" name="apartment" v-model="order.apartment">
            </div>
        </Row>
        <Row>
            <button class="btn primary-btn mb-6-em">Submit</button>
        </Row>
      </div>
  </form>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return this.initialState();
    },
    computed:{
        Areas:function(){
            let c=  this.$genStore.state.cities.find(city => {
                return city.name_en == this.order.city
            });
            return c?c.areas:[];
        },
    },
    methods:{
    initialState() {
           return {
            order:{
                total_cash:null,
                package_type:null,
                number_of_items:null,
                desc:null,
                name:null,
                mobile:null,
                sec_mobile:null,
                notes:null,
                city:null,
                area:null,
                city:null,
                area:null,
                landmarks:null,
                street:null,
                building:null,
                floor:null,
                apartment:null,
            },
          }
        },
        submit(){
            axios({
                method:'post',
                url:'/dashboard/seller/create-deliver',
                data:this.order
            }).then(res => {
                this.$router.push('/dashboard/orders')
            })
        },
    },
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