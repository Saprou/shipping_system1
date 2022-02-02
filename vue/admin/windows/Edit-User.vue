<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
          <div class="window">
            <header>
                <h3>{{__('Edit user')}}</h3>
            </header>
            <Row>
                <input placeholder="first name" v-model="user.f_name">
                <input placeholder="last name" v-model="user.l_name">
            </Row>
            <Row>
                <input placeholder="email" v-model="user.email">
                <input placeholder="mobile" v-model="user.mobile">
            </Row>
            <Row>
                <input placeholder="payment method" v-model="user.payment_method">
                <input placeholder="seconed mobile" v-model="user.sec_mobile">
            </Row>
            <Row>
                <input placeholder="new password" v-model="new_password">
            </Row>
            <Row>
                <MyButton @click="updateUser()" :label="__('Submit')" :width="'100%'" ></MyButton>
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
    props:['user'],
    data(){
        return{
            new_password:null
        }
    },
    mounted(){
        this.fadeIn();
    },
    methods:{
        updateUser(){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/admin/update-seller',
                data:{seller:this.user,password:this.new_password}
            }).then(res => {
                if(res.data == 66 ){console.log('email is already taken');return null;}
                if(res.data == 77 ){console.log('mobile is already taken');return null;}
                if(res.data == 88 ){console.log('second mobile is already taken');return null;}
                if(res.data == 98 ){console.log('passwrod has to be more than 8');return null;}
                this.$store.commit('insertSeller',res.data);
                this.close();
            }).then(()=>{
                this.$genStore.commit('loading',false);
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