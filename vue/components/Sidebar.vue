<template>
  <div id="sidebar" class="sidebar labtop">
      <section class="logo-container">
        <h3>{{role}}</h3>
        <img @click="goHome()" class="labtop" :src="'/photos/logo2.jpeg'" alt="LOGO">
        <svg @click="closeSidebar()" class="mobile" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 3.752l-4.423-3.752-7.771 9.039-7.647-9.008-4.159 4.278c2.285 2.885 5.284 5.903 8.362 8.708l-8.165 9.447 1.343 1.487c1.978-1.335 5.981-4.373 10.205-7.958 4.304 3.67 8.306 6.663 10.229 8.006l1.449-1.278-8.254-9.724c3.287-2.973 6.584-6.354 8.831-9.245z"/></svg>
      </section>
      <section class="user-info" @click="closeSidebar()">
        <router-link :to="'/dashboard/profile'">
          <p>{{$store.state.user.f_name}}</p>
          <p class="small">{{$store.state.user.ref}}</p>
        </router-link>
      </section>
      <section>
        <section v-for="link in links" :key="link.url">
          <!-- single link -->
          <router-link :class="this.$route.path == link.url ? 'selected-link':null"  class="sidebar-link" v-if="!link.sublinks" :to="link.url">
            <section class="icon-container"><p v-html="link.svg"></p></section>
            <section @click="closeSidebar()">{{link.title}}</section>
            <section></section>
          </router-link>
          <!-- multi links -->
          <a v-if="link.sublinks" @click.stop="openSubLinks($event.currentTarget)">
            <section class="sidebar-link">
              <section class="icon-container"><p v-html="link.svg"></p></section>
              <section>
                {{link.title}}
              </section>
              <section class="down-arrow">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"/></svg>
              </section>
            </section>
            <section class="sub-links">
              <router-link :class="this.$route.path.match(sublink.url) ? 'selected-link':null" @click="closeSidebar()" class="sub-link" v-for="sublink in link.sublinks" :key="sublink.url" :to="sublink.url">
                  {{sublink.title}}
              </router-link>
            </section>
          </a>
        </section>
      </section>
      <div class="logout-container">
        <MyButton @click="$genStore.commit('logout')" :label="__('Logout')" :svg="svg" />
      </div>
  </div>
</template>

<script>
export default {
  props:{
    links:{default:[]},
    role:{default:null}
  },
  data(){
    return{
      svg:'<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M14 19v-.083c-1.178.685-2.542 1.083-4 1.083-4.411 0-8-3.589-8-8s3.589-8 8-8c1.458 0 2.822.398 4 1.083v-2.245c-1.226-.536-2.576-.838-4-.838-5.522 0-10 4.477-10 10s4.478 10 10 10c1.424 0 2.774-.302 4-.838v-2.162zm4-9.592l2.963 2.592-2.963 2.592v-1.592h-8v-2h8v-1.592zm-2-4.408v4h-8v6h8v4l8-7-8-7z"/></svg>'
    }
  },
  methods:{
    goHome(){
      window.location.href ='/';
    },
    openSubLinks(a){
      a.children[1].classList.add("open-sub-links");
    },
    closeSidebar(){
      if (window.innerWidth > 800) {
          return null;
      }
      let sidebar = document.getElementById('sidebar');
      sidebar.style.display ="none";
    }
  }
}
</script>

<style lang='scss' scoped>
.sidebar{
    grid-column: 1/11;
    grid-row: 7/101;
    background-color:#4d4d4d;
    color:#f0f0f0f0;
    fill:#f0f0f0f0;
    font-size:0.9em;
    position:relative;
    overflow: hidden;
    .logo-container{
      display:flex;   align-items:center;   justify-content:center; flex-direction: column;
      fill:#ff6600;
        img{
          max-width:100%;
          margin:0 0 1em 0;
        }
        svg{
          fill:#2c3e50;
          margin:0.2em 0.2em 1em 0.2em;
        }
    }
    .user-info{
      max-width: 100%;
      a{
        display:flex;   justify-content:center; align-items:center; flex-direction:column;
        margin:0.3em 0.3em 1em 0.3em;
        background: rgba( 255, 255, 255, 0.35 );
        box-shadow: 0 4px 8px 0 rgba(127, 127, 129, 0.37);
        backdrop-filter: blur( 8.5px );
        -webkit-backdrop-filter: blur( 8.5px );
        border-radius: 10px;
        border: 1px solid rgba( 255, 255, 255, 0.18 );
      p{
      overflow:hidden;
      max-width:100%;
      }
        .small{
          font-size:0.7em;
          color:rgb(182, 184, 199);
      overflow:hidden;
      max-width:100%;
        }
      }
    }
    .logout-container{
      position:absolute;
      bottom:2em; left:0;
      width: 100%;
      text-align: center;
    }
}
.sidebar-link{
  margin:0.3em 0.1em;
  display:flex;
  justify-content:space-between;
  border-right:2px solid transparent;
  border-left:2px solid transparent;
  .icon-container{
    margin:0 0.2em;
    img{
      cursor:pointer;
    }
  }
  &:hover{
    fill:#ff6600 !important;
    color:#ff6600 !important;
  }
  &>*{
    flex:1;
    min-width:max-content;
  }
}
.selected-link{
  color:#ff6600;
  fill:#ff6600 !important;
}
.open-sub-links{
    display:block !important;
    animation: listDown 0.5s ease ;
}
.sub-links{
    text-align: center;
    margin:0.6em;
    padding:0.4em 0;
    display:none;
    font-size:0.8em;
    box-shadow:inset 0 0 5px 0 rgba(0,0,0,0.4);
    border-radius:0.3em;

    /* animation: listUp 0.5s ease forwards;
    /* background-color:rgba(52, 31, 151,.5); */
  .sub-link{
      cursor:pointer;
      display:block;
      &:hover{
          color:#2c3e50;
      }
  }
}
.down-arrow{
  text-align:center;
}
  /* Animation */
@keyframes listDown {
    0%{
        display:none;
        transform:scale(0);
    }
    100%{
        display:block;
        transform:scale(1);
    }
} 
@keyframes listUp {
    0%{
        display:block;
        transform:scale(1);
    }
    99%{
    transform:scale(0);
    }
    100%{
        transform:scale(0);
        display:none;
    }
} 
@media screen and (max-width:800px){
  .sidebar{
    position:absolute;
    z-index:100;
    height:100vh;
    width:100vw;
  }
}
</style>