<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
        <div class="widow">
        <h2>{{__('CreatePickup')}}</h2>
        <p>{{__('please fill this inputs')}}</p>
        <section>
            <Row>
                <MyInput :label="__('Location')" v-model:object="pickup.location_id" />
                <MyInput :label="__('Contact')" v-model:object="pickup.contact_id" />
            </Row>
            <Row>
                <MyInput :label="__('Hub')" v-model:object="pickup.hub" />
                <MyInput :label="__('Notes')" v-model:object="pickup.notes" />
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
    data(){
        return{
            pickup:{
                location_id:{value:null,error:null,name:'location_id'},
                contact_id:{value:null,error:null,name:'contact_id'},
                hub:{value:null,error:null,name:'hub'},
                notes:{value:null,error:null,name:'notes'},
            }
        }
    },
    mounted(){
        this.fadeIn();
    },
    methods:{
        submit(){
            console.log('gg')
            this.$axios({
                method:'post',
                url:"/dashboard/create-pickup",
                data:{
                    pickup:this.Pickup
                }
            }).then(res => {
                console.log(res.data)
            })
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
        }
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