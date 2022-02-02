<template>
  <div class="login-page" :style="'direction:' + $genStore.getters.getDir">
      <RedMessage v-if="$genStore.state.redMessageSwitch" @close="$genStore.state.redMessageSwitch = false" :message="$genStore.state.redMessage"></RedMessage>
      <GreenMessage v-if="$genStore.state.greenMessageSwitch" @close="$genStore.state.greenMessageSwitch = false" :message="$genStore.state.greenMessage"></GreenMessage>
      <Loading v-if="$genStore.state.loaderSwitch"></Loading>
      <header>
          <img :src="'/photos/logo.jpeg'" alt="Logo">
      </header>
      <div class="login-form">
          <header>
              <h2>{{__('Login')}}</h2>
              <p v-if="$genStore.getters.getLocale == 'ar'" @click="$genStore.commit('setLocale','en')" style="margin:0 0.8em;cursor:pointer;">En</p> 
              <p v-if="$genStore.getters.getLocale == 'en'" @click="$genStore.commit('setLocale','ar')" style="margin:0 0.8em;cursor:pointer;">ألعربية</p>
          </header>
          <div class="login-page-body" @keypress.enter="submit()">
            <Row>
                <MyInput  :label="__('Email')" v-model:object="user.email" />
                <Password  :label="__('Password')" v-model:object="user.password" />
            </Row>
            <div class="forgot-password">
                <p>
                    {{__('Forgot password ?')}}
                    <span class="link">
                        <a href="/password/reset">
                            {{__('no problem.')}}
                        </a>
                    </span>
                </p>
            </div>
            <Row>
                <MyButton @click="submit()" :label="__('Submit')"></MyButton>
            </Row>
          </div>
      </div>
      <footer>
          <p>{{__('1223')}} <span><a class="link" href="/register">{{__('Register')}}</a></span></p>
      </footer>
  </div>
</template>

<script>
import axios from 'axios'
export default {
    data(){
        return{
            user:{
                email:{value:null,err:null,name:'email'},
                password:{value:null,err:null,name:'password'},
            }
        }
    },
    methods:{
        submit(){

            this.$genStore.commit('loading',true);
            axios({
                method:'post',
                url:'/login',
                data:{
                    email:this.user.email.value,
                    password:this.user.password.value,
                }
            }).then(res => {
                window.location.href = '/dashboard'
            }).catch(error => {
                if(error.response.status == 422){
                    this.$genStore.commit('redMessage',this.__('Incorrect Email or Password'));
                }else{
                    this.$genStore.commit('redMessage','Error! try refreshing the page');
                }
            }).then(()=>{
                this.$genStore.commit('loading',false);
            })
        }
    },
}
</script>

<style lang='scss' scoped> 
.login-page{
    padding:1em 0.3em 3em;
    height:100vh;
    width:100vw;
    background-color:#2c3e50;
    display:flex; align-items:center; flex-direction:column;
    overflow:auto;
    &>header{
        img{
            margin-top:1em;
            height:6em;
        }
    }
    .login-form{
        display:flex; flex-direction:column;
        header{
            padding:0.4em 1em;
            box-shadow:0 1px 1px 0 #eee;
            p{
                float: inline-end;
            }
        }
        box-shadow:0 0 6px 0 #aaa ;
        background-color:rgba($color: #ddd, $alpha: 0.9);
        max-height:80vh;
        .login-page-body{
            padding:1em 1em;
            flex:1;
            overflow:auto;
        }
    }
    &>footer{
        margin: 0.4em 0.2em 0.6em;
        color:#fff;
    }
    .forgot-password{
        font-size:0.7em;
        margin : 0.3em 0.9em;
    }
}
</style>