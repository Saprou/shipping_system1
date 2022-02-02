<template>
  <header class='app-header'>
      <section class="labtop">
         <h4 v-if="this.$route.name">{{__(this.$route.name)}}</h4>
      </section>
      <!-- mobile -->
      <section class="mobile">
          <svg @click="openSidebar()" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z"/></svg>
      </section>
      <section>
       <section class="lang-toggler">
          <select :value="this.$genStore.getters.getLocale" @input="setLocale($event.target.value)">
              <option value="en">
                <p style="margin:0 0.8em;cursor:pointer;">En</p>
              </option>
              <option value="ar">
                <p style="margin:0 0.8em;cursor:pointer;">ألعربية</p>
              </option>
          </select>
          </section>
          <section style="position:relative;">
          <svg @click.stop="openUserMenu()" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z"/></svg>
          <section id="user-menu" class="list user-menu" :class="$genStore.getters.getLocale == 'ar'?'go-right':null">
              <router-link :to="'/dashboard/profile'">{{__('Profile')}}</router-link>
              <a @click.prevent="$genStore.commit('logout')">{{__('Logout')}}</a>
          </section>
          </section>
          
      </section>

  </header>
</template>

<script>
export default {
    data(){
        return{
        }
    },
    computed:{
        routeName:function(){
            return this.$route.name;
        },
    },
    methods:{
        openUserMenu(){
           let m = document.getElementById('user-menu');
           m.classList.toggle('open-list')
        },
        openSidebar(){
            let sidebar = document.getElementById('sidebar');
            sidebar.style.display ="block";
            sidebar.classList.remove('labtop');
        },
        setLocale(v){
            this.$genStore.commit('setLocale',v);
        }
    }

}
</script>

<style lang='scss' scoped>
.app-header{
    display: flex;
    grid-row:1/7 ;
    grid-column: 1/101;
    justify-content: center;    align-items: center;
    background-color:#ff6600;
    box-shadow: #4d347e 0px 1px 2px 0px ;
    padding:0.6em 1.2em;
    z-index:10;
    color:#f0f0f0f0;        fill:#f0f0f0f0;
    &>section{
        flex:1;
        display:flex;     align-items:center;
    }
    &>section:first-of-type{
        justify-content: flex-start; 
    }
    &>section:nth-of-type(3){
        justify-content: flex-end; 
        position:relative;
        svg{cursor:pointer;}
        .user-menu{
            display:none;   justify-content: center;    align-items:center;
            position:absolute;
            top:100%;
            padding:0.3em;
            right:1.2em;
            background-color:#f0f0f0;
            box-shadow: #f0f0f01e 0 0 2px 2px;
            color:#5f27cd;
            flex-direction: column;
            border-radius:0.5em;
            transition:all 0.3s ease-in-out;
            a{
                width:100%;
                padding:0.3em 0.7em ;
                background-color:#fff;
                &:hover{
                    background-color:#f0f0f0f0;
                }
            }
            a:first-of-type{
                border-top-left-radius: 0.5em;
            }
            a:last-of-type{
                border-bottom-left-radius: 0.5em;
                border-bottom-right-radius: 0.5em;
            }
        }
    }
    &>section:last-of-type{
        justify-content: flex-end; 
        position:relative;
        svg{cursor:pointer;}  
    }
    .lang-toggler{
        position:relative;
        display:inline-flex;
        justify-content: center;    align-items: center;
        select{
        margin:0 0.3em;
        border:none;    outline:none;
        background-color:transparent;
        appearance: none;
        color:inherit;
        text-align:center;
        font-size:0.7em;    font-weight:700;
        cursor:pointer;
        }
        option{
            background-color:#fff;
            color:#111;
        }
    }

}
.go-right{
    left:1.2em !important;
    right:unset !important;
}
</style>