<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
          <div class="window">
            <header>
                <h3>{{__('Create new contact')}}</h3>
            </header>
            <Row>
                <MyInput :label="__('Name')" v-model:object="contact.name"/>
                <MyInput :label="__('Email')" v-model:object="contact.email"/>
            </Row>
            <Row>
                <MyInput :label="__('Mobile')" :type="'number'" v-model:object="contact.mobile"/>
                <MyInput :label="__('Second mobile')" :required="false" :type="'number'" v-model:object="contact.sec_mobile"/>
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
            contact:{
                name:{value:null,err:null,name:"contact_name"},
                email:{value:null,err:null,name:"contact_email"},
                mobile:{value:null,err:null,name:"contact_mobile"},
                sec_mobile:{value:null,err:null,name:"contact_sec_mobile"},
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
                url:'/dashboard/seller/create-contact',
                data:{contact:this.Contact()}
            }).then(res => {
                this.$store.commit('unshiftContact',res.data);
                this.close();
            }).catch(err =>{

            }).then(() => {
                this.$genStore.commit('loading',false);
            })
        },
        check(){
            let contact = this.contact;
                /* name */
            if(!contact.name.value || contact.name.value.length < 3){
                this.errorFound(this.__('Required'),contact.name);
                return false;
            }else{contact.name.err = null;}
                /* email */
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!re.test(contact.email.value)){
                this.errorFound(this.__('Required'),contact.email);
                return false;
            }else{contact.email.err = null;}
                /* mobile */
            if(!contact.mobile.value || contact.mobile.value.length < 11){
                this.errorFound(this.__('Mobile length is '+11),contact.mobile);
                return false;
            }else{contact.mobile.err = null;}
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
        Contact(){
            let contact = {};
            Object.entries(this.contact).forEach(([key, value]) => {
                contact[`${key}`] = value.value
            });
            return contact;
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