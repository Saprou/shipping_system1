<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
          <div class="window">
            <header>
                <h3>{{__('Create new address')}}</h3>
            </header>
            <Row>
                <MyInput :label="__('City')" v-model:object="location.city"/>
                <MyInput :label="__('Area')" v-model:object="location.area"/>
            </Row>
            <Row>
                <MyInput :label="__('Street')" v-model:object="location.street"/>
                <MyInput :label="__('Landmarks')" v-model:object="location.landmarks"/>
            </Row>
            <Row>
                <MyInput :required="false" :label="__('Building')" v-model:object="location.building"/>
                <MyInput :required="false" :label="__('Apartment')" v-model:object="location.apartment"/>
            </Row>
            <Row>
                <MyInput :required="false" :label="__('Floor')" v-model:object="location.floor"/>
            </Row>
            <Row>
                <MyButton @click="submit()" :label="__('Submit')"></MyButton>
            </Row>
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
            location:{
                city:{value:null,err:null,name:"city"},
                area:{value:null,err:null,name:"area"},
                street:{value:null,err:null,name:"street"},
                landmarks:{value:null,err:null,name:"landmarks"},
                apartment:{value:null,err:null,name:"apartment"},
                building:{value:null,err:null,name:"building"},
                floor:{value:null,err:null,name:"floor"},
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
                url:'/dashboard/seller/create-location',
                data:{location:this.Location()}
            }).then(res => {
                this.$store.commit('unshiftLocation',res.data);
                this.close();
            }).catch(err=>{

            }).then(()=>{
                this.$genStore.commit('loading',false);
            })
        },
        check(){
            let Location = this.location;
                /* city */
            if(!Location.city.value || Location.city.value.length < 3){
                this.errorFound(this.__('Required'),Location.city);
                return false;
            }else{Location.city.err = null;}
                /* area */
            if(!Location.area.value || Location.area.value.length < 3){
                this.errorFound(this.__('Required'),Location.area);
                return false;
            }else{Location.area.err = null;}
                /* street */
            if(!Location.street.value || Location.street.value.length < 3){
                this.errorFound(this.__('Required'),Location.street);
                return false;
            }else{Location.street.err = null;}
                /* landmarks */
            if(!Location.landmarks.value || Location.landmarks.value.length  < 4){
                this.errorFound(this.__('Required'),Location.landmarks);
                return false;
            }else{Location.landmarks.err = null;}
            /* ALL good */
            return true;
        },
        close(){
            this.$emit('close',false);
        },
        fadeIn(){
            setTimeout(function(){
                let popups = document.getElementsByClassName('popup-container');
                popups[0].style.opacity = '1';
            },1);
        },
        Location(){
            let location = {};
            Object.entries(this.location).forEach(([key, value]) => {
                location[`${key}`] = value.value
            });
            return location;
        },
        errorFound(message,object){
            object.err = message;
            let input = document.getElementById(object.name);
            input.scrollIntoView(false);
            input.focus();
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
            max-height:80%;
            max-width:90%;
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