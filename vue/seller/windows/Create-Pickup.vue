<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
        <div class="window">
            <header>
                <h3>{{__('CreatePickup')}}</h3>
            </header>
            <section>
                <Row>
                    <MySelect :label="__('Location')" v-model:object="pickup.location_id">
                        <option value='empty'>{{__('Select')}}</option>
                        <option v-for="location in $store.state.user.locations" :value="location.id" :key="location.id">{{location.city +'/'+location.area}}</option>
                    </MySelect>
                    <MySelect :label="__('Contact')" v-model:object="pickup.contact_id">
                        <option value='empty'>{{__('Select')}}</option>
                        <option v-for="contact in $store.state.user.contacts" :value="contact.id" :key="contact.id">{{contact.name}}</option>
                    </MySelect>
                </Row>
                <Row>
                    <MySelect :label="__('Hub')" v-model:object="pickup.hub" >
                        <option value='empty'>{{__('Select')}}</option>
                        <option value=1>{{__('Cairo')}}</option>
                        <option value=2>{{__('Giza')}}</option>
                        <option value=3>{{__('Qalyubia')}}</option>
                    </MySelect>
                    <MyInput :required="false" :label="__('Notes')" v-model:object="pickup.notes" />
                </Row>
                <Row>
                    <MyButton @click="submit()" :label="__('Submit')"></MyButton>
                </Row>
            </section>
        </div>
      </div>
      <section class="X" @click="close()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg>
      </section>
  </div>
</template>

<script>
export default {
    props:['orders'],
    data(){
        return{
            pickup:{
                location_id:{value:'empty',err:null,name:'location_id'},
                contact_id:{value:'empty',err:null,name:'contact_id'},
                hub:{value:'empty',err:null,name:'hub'},
                notes:{value:null,err:null,name:'notes'},
            }
        }
    },
    mounted(){
        this.fadeIn();
    },
    methods:{
        submit(){
            if(!this.check()){return null;}
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:"/dashboard/seller/create-pickup",
                data:{
                    pickup:this.Pickup,
                    orders:this.orders,
                }
            }).then(res => {
                this.$store.commit('updateOrders',res.data.orders);
                this.$store.commit('unshiftPickup',res.data.pickup);
                this.$genStore.commit('greenMessage',this.__('Pickup Created'));
                this.close();
            }).catch(err =>{
                this.$genStore.commit('redMessage',this.__('Error'));
            })
            .then(()=>{
                this.$genStore.commit('loading',false);
            })
        },
        check(){
            let Pickup = this.pickup;
            /* Location */
            if(Pickup.location_id.value == 'empty'){
                this.errorFound(this.__('Required'),Pickup.location_id);
                return false;
            }else{Pickup.location_id.err = null;}
            /* Contact */
            if(Pickup.contact_id.value == 'empty'){
                this.errorFound(this.__('Required'),Pickup.contact_id);
                return false;
            }else{Pickup.contact_id.err = null;}
            /* Hub */
            if(Pickup.hub.value == 'empty'){
                this.errorFound(this.__('Required'),Pickup.hub);
                return false;
            }else{Pickup.hub.err = null;}
            return true;
        },
        errorFound(message,object){
            object.err = message;
            let c = document.getElementById('error-founder');
            c.href = '#'+object.name;
            c.click();
        },
        close(){
            this.$emit('close',false);
        },
        fadeIn(){
            setTimeout(function(){
                let popups = document.getElementsByClassName('popup-container');
                popups[0].style.opacity = '1';
            },1);
        }
    },
    computed:{
        Pickup:function(){
            let pickup =this.pickup;
            for (const key in pickup) {
                pickup[key] = pickup[key].value;
            }
            return pickup;
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
            max-height:100%;
            max-width:100%;
            overflow:auto;
        }
        .X{
            position:absolute;
            top:1em;        right:1em;
            fill:tomato;
            cursor:pointer;
        }
    }
</style>