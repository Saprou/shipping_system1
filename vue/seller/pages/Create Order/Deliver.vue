<template>
  <div class="table">
      <div class="form-card">
        <header class="sub-title">
            <h4>{{__('OrderDetails')}}</h4>
        </header>
        <Row>
            <MyInput :label="__('Cash')+'+'+__('Shipping')" :type="'number'" v-model:object="order.total_cash" />
            <MySelect :label="__('Package type')" v-model:object="order.package_type" >
                <option value=0>{{__('Select')}}</option>
                <option value=1>{{__('Parcel')}}</option>
                <option value=2>{{__('Document')}}</option>
                <option value=3>{{__('Bulky')}}</option>
            </MySelect>
        </Row>
        <Row>
            <MyInput :label="__('Number of items')" v-model:object="order.number_of_items" :type="'number'" />
            <MyInput :label="__('Description')" :required="false" v-model:object="order.desc" />
        </Row>
      </div>
      <div class="form-card">
        <header class="sub-title">
            <h4>{{__('CustomerDetails')}}</h4>
        </header>
        <Row>
            <MyInput :label="__('Customer name')" v-model:object="order.name" />
            <MyInput :label="__('Mobile')" v-model:object="order.mobile" />
        </Row>
        <Row>
            <MyInput :required="false" :label="__('Second mobile')" v-model:object="order.sec_mobile" />
            <MyInput :required="false" :label="__('Notes')" v-model:object="order.notes"/>
        </Row>
        <Row>
            <MySelect   :label="__('City')" v-model:object="location.city" >
              <option value=0>{{__('Select')}}</option>
              <option v-for="city in cities" :key="city" :value="city">{{__(city)}}</option>
            </MySelect>
            <MySelect :label="__('Area')" v-model:object="location.area" >
              <option value=0>{{__('Select')}}</option>
              <option v-for="area in Areas" :key="area.value" :value="area.value">{{__(area.value)}}</option>
            </MySelect>
        </Row>
        <Row>
            <MyInput    :label="__('Street')"   v-model:object="location.street" />
            <MyInput    :label="__('Landmarks')"   v-model:object="location.landmarks" />
        </Row>
        <Row>
            <MyInput :required="false" :label="__('Building')" v-model:object="location.building" />
            <MyInput :required="false" :label="__('Floor')" v-model:object="location.floor" />
        </Row>
        <Row>
            <MyInput :required="false" :label="__('Apartment')" v-model:object="location.apartment" />
        </Row>
        <Row>
            <MyButton @click="submit()" :label="__('Submit')" />
        </Row>
      </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return this.initialState();
    },
    computed:{
        Areas:function(){
            this.location.area.value = 0;
            return this.areas.filter(area => {
                return area.city == this.location.city.value
            })
        },
    },
    methods:{
    initialState() {
           return {
            order:{
                total_cash:{value:null,err:null,name:"total_cash"},
                package_type:{value:0,err:null,name:"package_type"},
                number_of_items:{value:null,err:null,name:"number_of_items"},
                desc:{value:null,err:null,name:"desc"},
                name:{value:null,err:null,name:"name"},
                mobile:{value:null,err:null,name:"mobile"},
                sec_mobile:{value:null,err:null,name:"sec_mobile"},
                notes:{value:null,err:null,name:"notes"},
            },
            location:{
                city:{value:0,err:null,name:"city"},
                area:{value:0,err:null,name:"area"},
                landmarks:{value:null,err:null,name:"landmarks"},
                street:{value:null,err:null,name:"street"},
                building:{value:null,err:null,name:"building"},
                floor:{value:null,err:null,name:"floor"},
                apartment:{value:null,err:null,name:"apartment"},
            },
            areas:this.$genStore.getters.Areas,
            cities:[
                'Cairo',
                'Giza',
                'Qalubeya',
                'Alexandria',
            ]
          }
        },
        submit(){
            if(!this.check()){return null;}
            this.$genStore.commit('loading',true);
            axios({
                method:'post',
                url:'/dashboard/seller/create-deliver',
                data:{
                    location:this.Location(),
                    order:this.Order()
                }
            }).then(res => {
                this.$store.commit('unshiftOrder',res.data)
                this.$router.push('/dashboard/orders')
                this.$genStore.commit('greenMessage',this.__('Order created'));
            }).catch(err => {
                this.$genStore.commit('redMessage','An error happend');
            }).then(()=>{
                this.$genStore.commit('loading',false);
            })
        },
        check(){
            let Order = this.order;
            let Location = this.location;
            /* total cash */
            if(!Order.total_cash.value || Order.total_cash.value.length == 0){
                this.errorFound(this.__('Required'),Order.total_cash);
                return false;
            }else{Order.total_cash.err = null;}
                /* package type */
            if(!Order.package_type.value || Order.package_type.value == 0){
                this.errorFound(this.__('Required'),Order.package_type);
                return false;
            }else{Order.package_type.err = null;}
                /* number of items */
            if(!Order.number_of_items.value || Order.number_of_items.value == 0){
                this.errorFound(this.__('Required'),Order.number_of_items);
                return false;
            }else{Order.number_of_items.err = null;}
                /* Customer name */
            if(Order.name.value < 3){
                this.errorFound(this.__('Min length is 3'),Order.name);
                return false;
            }else{Order.name.err = null;}
                /* Customer mobile */
            if(Order.mobile.value < 3){
                this.errorFound(this.__('Min length is 3'),Order.mobile);
                return false;
            }else{Order.mobile.err = null;}
                /* city */
            if(!Location.city.value || Location.city.value == 0){
                this.errorFound(this.__('Required'),Location.city);
                return false;
            }else{Location.city.err = null;}
                /* area */
            if(!Location.area.value || Location.area.value.length < 1|| Location.area.value == ''){
                this.errorFound(this.__('Required'),Location.area);
                return false;
            }else{Location.area.err = null;}
                /* street */
            if(!Location.street.value || Location.street.value.length == 0){
                this.errorFound(this.__('Required'),Location.street);
                return false;
            }else{Location.street.err = null;}
                /* landmarks */
            if(!Location.landmarks.value || Location.landmarks.value.length == 0){
                this.errorFound(this.__('Required'),Location.landmarks);
                return false;
            }else{Location.landmarks.err = null;}
            /* ALL good */
            return true;
        },
        errorFound(message,object){
            object.err = message;
            let input = document.getElementById(object.name);
            input.scrollIntoView(false);
            input.focus();
        },
        Location(){
            let location = {};
            Object.entries(this.location).forEach(([key, value]) => {
                location[`${key}`] = value.value
            });
            return location;
        },
        Order(){
            let order = {};
            Object.entries(this.order).forEach(([key, value]) => {
                order[`${key}`] = value.value
            });
            return order;
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