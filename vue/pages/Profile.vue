<template>
  <div class="page">
    <CreateLocation @close="CreateLocation = false" v-if="CreateLocation" />
    <CreateContact @close="CreateContact = false" v-if="CreateContact" />
    <section class="profile-section">
      <header>
        <h4>{{__('Info')}}</h4>
      </header>
      <div class="user-info">
            <section><h4>{{__('First name')}} : </h4> <input v-model="$store.state.user.f_name" :class="user.f_name.edit?null:'disabled'" /><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 18.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25c.691 0 1.25.56 1.25 1.25s-.559 1.25-1.25 1.25zm1.961-5.928c-.904.975-.947 1.514-.935 2.178h-2.005c-.007-1.475.02-2.125 1.431-3.468.573-.544 1.025-.975.962-1.821-.058-.805-.73-1.226-1.365-1.226-.709 0-1.538.527-1.538 2.013h-2.01c0-2.4 1.409-3.95 3.59-3.95 1.036 0 1.942.339 2.55.955.57.578.865 1.372.854 2.298-.016 1.383-.857 2.291-1.534 3.021z"/></svg> <!-- <svg xmlns="http://www.w3.org/2000/svg" v-if="!user.f_name.edit" @click="user.f_name.edit = true" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-5 17l1.006-4.036 3.106 3.105-4.112.931zm5.16-1.879l-3.202-3.202 5.841-5.919 3.201 3.2-5.84 5.921z"/></svg> <svg xmlns="http://www.w3.org/2000/svg" v-if="user.f_name.edit" @click="user.f_name.edit = false" fill="#f00" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z"/></svg> <svg xmlns="http://www.w3.org/2000/svg" v-if="user.f_name.edit" @click="update()" fill="#0f0" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z"/></svg> --></section>
            <section><h4>{{__('Last name')}} : </h4> <input v-model="$store.state.user.l_name" :class="user.l_name.edit?null:'disabled'" /><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 18.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25c.691 0 1.25.56 1.25 1.25s-.559 1.25-1.25 1.25zm1.961-5.928c-.904.975-.947 1.514-.935 2.178h-2.005c-.007-1.475.02-2.125 1.431-3.468.573-.544 1.025-.975.962-1.821-.058-.805-.73-1.226-1.365-1.226-.709 0-1.538.527-1.538 2.013h-2.01c0-2.4 1.409-3.95 3.59-3.95 1.036 0 1.942.339 2.55.955.57.578.865 1.372.854 2.298-.016 1.383-.857 2.291-1.534 3.021z"/></svg> <!-- <svg xmlns="http://www.w3.org/2000/svg" v-if="!user.l_name.edit" @click="user.l_name.edit = true" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-5 17l1.006-4.036 3.106 3.105-4.112.931zm5.16-1.879l-3.202-3.202 5.841-5.919 3.201 3.2-5.84 5.921z"/></svg> <svg xmlns="http://www.w3.org/2000/svg" v-if="user.l_name.edit" @click="user.l_name.edit = false" fill="#f00" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z"/></svg> <svg xmlns="http://www.w3.org/2000/svg" v-if="user.l_name.edit" @click="update()" fill="#0f0" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z"/></svg> --></section>
            <section><h4>{{__('Mobile')}} : </h4><p>{{$store.state.user.mobile}}</p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 18.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25c.691 0 1.25.56 1.25 1.25s-.559 1.25-1.25 1.25zm1.961-5.928c-.904.975-.947 1.514-.935 2.178h-2.005c-.007-1.475.02-2.125 1.431-3.468.573-.544 1.025-.975.962-1.821-.058-.805-.73-1.226-1.365-1.226-.709 0-1.538.527-1.538 2.013h-2.01c0-2.4 1.409-3.95 3.59-3.95 1.036 0 1.942.339 2.55.955.57.578.865 1.372.854 2.298-.016 1.383-.857 2.291-1.534 3.021z"/></svg></section>
            <section><h4>{{__('Second mobile')}} : </h4><p>{{$store.state.user.sec_mobile}}</p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 18.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25c.691 0 1.25.56 1.25 1.25s-.559 1.25-1.25 1.25zm1.961-5.928c-.904.975-.947 1.514-.935 2.178h-2.005c-.007-1.475.02-2.125 1.431-3.468.573-.544 1.025-.975.962-1.821-.058-.805-.73-1.226-1.365-1.226-.709 0-1.538.527-1.538 2.013h-2.01c0-2.4 1.409-3.95 3.59-3.95 1.036 0 1.942.339 2.55.955.57.578.865 1.372.854 2.298-.016 1.383-.857 2.291-1.534 3.021z"/></svg></section> 
            <section><h4>{{__('Email')}} : </h4><p>{{$store.state.user.email}}</p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 18.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25c.691 0 1.25.56 1.25 1.25s-.559 1.25-1.25 1.25zm1.961-5.928c-.904.975-.947 1.514-.935 2.178h-2.005c-.007-1.475.02-2.125 1.431-3.468.573-.544 1.025-.975.962-1.821-.058-.805-.73-1.226-1.365-1.226-.709 0-1.538.527-1.538 2.013h-2.01c0-2.4 1.409-3.95 3.59-3.95 1.036 0 1.942.339 2.55.955.57.578.865 1.372.854 2.298-.016 1.383-.857 2.291-1.534 3.021z"/></svg></section> 
      </div>
        <section v-if="!updatePasswordT">
          <p class="link" @click="updatePasswordT = true">{{__('Change password')}}</p>
        </section>
      <div v-if="updatePasswordT">
        <Row>
          <MyInput :label="__('New Password')" v-model:object="user.password"/>
          <MyInput :label="__('Confirm password')" v-model:object="user.conf_password"/>
        </Row>
        <Row>
          <MyButton @click="updatePassword()" :label="__('Update')"></MyButton>
          <MyButton @click="updatePasswordT = false" :label="__('Cancel')"></MyButton>
        </Row>
      </div>
      
    </section>
    <section class="profile-section" v-if="this.$store.state.user.role == 'seller'">
      <header>
        <h4>{{__('Addresses')}}</h4>
        <MyButton @click="CreateLocation = true" :label="'+'" :title="__('CreateNewAddress')"></MyButton>
      </header>
      <div class="data-table-container">
      <table class="data-table">
        <tbody >
          <tr v-for="location in Locations" :key="location">
            <td>{{__(location.city)}}</td>
            <td>{{__(location.area)}}</td>
            <td>{{__(location.street)}}</td>
            <td>{{__(location.landmarks)}}</td>
            <td>{{location.building}}</td>
            <td>{{location.floor}}</td>
          </tr>
        </tbody>
      </table>
      </div>
    </section>
    <section class="profile-section" v-if="this.$store.state.user.role == 'seller'">
      <header>
        <h4>{{__('Contacts')}}</h4>
        <MyButton @click="CreateContact = true" :label="'+'" :title="__('CreateNewContact')"></MyButton>
      </header>
      <div class="data-table-container">
      <table class="data-table">
        <tbody >
          <tr v-for="contact in Contacts" :key="contact">
            <td>{{contact.name}}</td>
            <td>{{contact.email}}</td>
            <td>{{contact.mobile}}</td>
            <td>{{contact.sec_mobile}}</td>
          </tr>
        </tbody>
      </table>
      </div>
    </section>
  </div>
</template>

<script>
import CreateLocation from '../seller/windows/Create-Location.vue'
import CreateContact from '../seller/windows/Create-Contact.vue'
export default {
  data(){
    return{
      updatePasswordT:false,
      CreateLocation:false,
      CreateContact:false,
      user:{
        f_name:{value:null,err:null,name:"user-f-name",edit:false},
        l_name:{value:null,err:null,name:"user-l-name",edit:false},
        password:{value:null,err:null,name:"password"},
        conf_password:{value:null,err:null,name:"conf_password"},
      }
    }
  },
  components:{
    CreateLocation,CreateContact
  },
  methods:{

    update(){
      console.log(this.$store.state.user);return null;
      this.$genStore.commit('loading',true);
      this.$axios({
        method:'post',
        url:'/dashboard/user/update-password',
        data:{user:this.$store.state.user}
      }).then(res => {
        console.log(res.data)
        if(res.data.status){
          this.$genStore.commit('greenMessage',this.__(res.data.message));
          Object.assign(this.$data, this.$options.data());
        }else{
          this.$genStore.commit('redMessage',this.__(res.data.message));
        }
      }).then(() => {
        this.$genStore.commit('loading',false);
      })
    },
    updatePassword(){
      if(!this.check()){return null;}
      this.$genStore.commit('loading',true);
      this.$axios({
        method:'post',
        url:'/dashboard/user/update-password',
        data:{password:this.user.password.value}
      }).then(res => {
        console.log(res.data)
        if(res.data.status){
          this.$genStore.commit('greenMessage',this.__(res.data.message));
          Object.assign(this.$data, this.$options.data());
        }else{
          this.$genStore.commit('redMessage',this.__(res.data.message));
        }
      }).then(() => {
        this.$genStore.commit('loading',false);
      })
    },
    User(){
        let user = {};
        Object.entries(this.user).forEach(([key, value]) => {
            user[`${key}`] = value.value
        });
        return user;
    },
    check(){
        let User = this.user;
        /* Password */
        if(!User.password.value || User.password.value.length < 8){
            this.errorFound(this.__('Min lenght is ') + 8,User.password);
            return false;
        }else{User.password.err = null;}
        if(User.password.value != User.conf_password.value){
            this.errorFound(this.__('Not the same'),User.conf_password);
            return false;
        }else{User.conf_password.err = null;}
        return true;
    },
    errorFound(message,object){
        object.err = message;
        let input = document.getElementById(object.name);
        input.scrollIntoView(false);
        input.focus();
    },
  },
  computed:{
    Locations:function(){
      return this.$store.state.user.locations;
    },
    Contacts:function(){
      return this.$store.state.user.contacts;
    }
  }
}
</script>

<style lang='scss' scoped>
.profile-section{
  &>header{
    display:flex;   align-items:center;
    padding:0.3em 0.4em 0.3em 0.4em;
    box-shadow: inset 0 0 200px 0 rgba($color: #ccc, $alpha: 1.0);
    .button-container{
      margin:0 0.3em;
    } 
  }
  margin:1em;
  box-shadow: 0 0 3px 0 #aaa;
  border-radius:6px;
  .user-info{
    width:100%;
    padding:0.6em 0.4em;
    border-collapse:separate;
    border-spacing:0 15px;
    section{
      display:inline-block;
      position:relative;
      background-color: #fff;
      border-radius: 0.4em;
      margin: 0.4em;
      padding: 0.4em;
      font-size:0.8em;
      h4,p{
        display:inline-block;
      }
      svg{
        margin:0 0.7em;
        cursor:pointer;
        &:hover{
          fill:#ff6600;
        }
      }
    }
  }
  .link{
    font-size:0.7em;  margin:0.4em;
  }
  .disabled{
      pointer-events: none;
      background-color:inherit;
      border:none;
      outline:none;
      font-size:inherit;
      color:inherit;
      cursor:pointer;
  }
}

</style>