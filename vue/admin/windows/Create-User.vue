<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
          <div class="window">
            <header>
                <h3>{{__('Create new user')}}</h3>
            </header>
            <Row>
                <MyInput :label="__('First name')" v-model:object="user.f_name"/>
                <MyInput :label="__('Last name')" v-model:object="user.l_name"/>
            </Row>
            <Row>
                <MyInput :label="__('Mobile')" v-model:object="user.mobile"/>
                <MyInput :label="__('Second mobile')" :required="false" v-model:object="user.sec_mobile"/>
            </Row>
            <Row>
                <MyInput :label="__('Email')" v-model:object="user.email"/>
            </Row>
            <Row>
                <MySelect :label="__('Role')" v-model:object="user.role">
                    <option value="empty">{{__('Select')}}</option>
                    <option value="accountant">{{__('Accountant')}}</option>
                    <option value="service">{{__('Service')}}</option>
                    <option value="operation">{{__('Operation')}}</option>
                </MySelect>
                <MyInput :label="__('Password')" v-model:object="user.password"/>
            </Row>
            <Row>
                <MyButton @click="submit()" :label="__('Submit')" :width="'100%'" ></MyButton>
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
            user:{
                f_name:{value:null,err:null,name:"user_fname"},
                l_name:{value:null,err:null,name:"user_lname"},
                email:{value:null,err:null,name:"user_email"},
                mobile:{value:null,err:null,name:"user_mobile"},
                sec_mobile:{value:null,err:null,name:"user_sec_mobile"},
                role:{value:'empty',err:null,name:"role"},
                password:{value:null,err:null,name:"password"},
            }
        }
    },
    mounted(){
        this.fadeIn();
    },
    methods:{
        submit(){
            if(!this.check()){return null;}
            this.$axios({
                method:'post',
                url:'/dashboard/admin/create-user',
                data:{user:this.User()}
            }).then(res => {
                if(res.data == 66){ this.user.email.err = this.__('E-mail is already taken');
                                    this.$genStore.commit('errorFound',this.user.mobile.name);
                                    return null;
                                }
                if(res.data == 77){ this.user.mobile.err = this.__('Mobile is already taken');
                                    this.$genStore.commit('errorFound',this.user.mobile.name);
                                    return null;
                                }
                if(res.data == 88){ this.user.sec_mobile.err = this.__('Mobile is already taken');
                                    this.$genStore.commit('errorFound',this.user.sec_mobile.name);
                                    return null;
                                }
                this.$store.commit('unshiftUser',res.data);
                this.close();

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
        },
        User(){
            let user = {};
            Object.entries(this.user).forEach(([key, value]) => {
                user[`${key}`] = value.value
            });
            return user;
        },
        check(){
            const User = this.user;
            /* first name */
            if(!User.f_name.value||User.f_name.value.length < 3){
                User.f_name.err = this.__('Min length = '+3);
                this.$genStore.commit('errorFound',User.f_name.name);
                return false;
            }else{User.f_name.err = null;}
            /* last name */
            if(!User.l_name.value||User.l_name.value.length < 3){
                User.l_name.err = this.__('Min length = '+3);
                this.$genStore.commit('errorFound',User.l_name.name);
                return false;
            }else{User.l_name.err = null;}
            /* email */
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!re.test(User.email.value)){
                User.email.err = this.__('name@example.com');
                this.$genStore.commit('errorFound',User.email.name);
                return false;
            }else{User.email.err = null;}
            /* mobile */
            if(!User.mobile.value || User.mobile.value.length != 11){
                User.mobile.err = this.__('Mobile length = ' +11);
                this.$genStore.commit('errorFound',User.mobile.name);
                return false;
            }else{User.mobile.err = null;}
            /* password */
            if(!User.password.value || User.password.value.length < 8){
                User.password.err = this.__('Password can\'t be less than 8');
                this.$genStore.commit('errorFound',User.password.name);
                return false;
            }else{User.password.err = null;}
            /* role */
            if(User.role.value == 'empty'){
                User.role.err = this.__('Select one !');
                this.$genStore.commit('errorFound',User.role.name);
                return false;
            }else{User.role.err = null;}
            return true;
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