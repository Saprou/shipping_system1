<template>
  <div id="couriersSidebar" class="couriers-sidebar-container">
        <svg @click="closeCouriersSidebar()" version="1.1" id="sidebar-toggler" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            width="532.439px" height="532.439px" viewBox="0 0 532.439 532.439" style="enable-background:new 0 0 532.439 532.439;"
            xml:space="preserve">
        <g>
            <g>
                <polygon points="532.439,44.56 241.74,266.22 532.439,487.88 532.439,377.05 386.484,266.22 532.439,155.39 		"/>
                <polygon points="290.699,487.88 290.699,377.05 144.744,266.22 290.699,155.39 290.699,44.56 0,266.22 		"/>
            </g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g>
        </g>
        <g>
        </g>
        <g>
        </g>
        </svg>
      <div class="couriers-sidebar">
          <h3>Available couriers</h3>
          <section class="courier-box" v-for="courier in $store.getters.availCouriers" :key="courier.id">
              <section @click="toggleCourier(courier)">
                 <svg v-if="courier.selected" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>
                 <svg v-if="!courier.selected" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"/></svg>
                  <p>{{courier.name}}</p>
                  <i class="fas fa-user"></i>
              </section>
              <div v-if="courier.selected" class="items-box">
                    <p v-if="courier.items.length <= 0">No Items</p>
                <section v-for="item in courier.items" :key="item.awb">
                    <p class="situation" v-if="item.kind == 'o' && item.type == 1">({{__('Deliver')}})</p>
                    <p class="situation" v-if="item.kind == 'o' && item.type == 3">({{__('Exchange')}})</p>
                    <p class="situation" v-if="item.kind == 'o' && item.type == 2">({{__('Return')}})</p>
                    <p >{{item.awb}}</p>
                    <svg class="minus" v-if="item.status" @click="$store.commit('unPickItem',item)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7 14h-14v-4h14v4z"/></svg>
                </section>
              </div>
              <div v-if="courier.selected" class="courier-box-footer">
                  <svg @click="this.$store.commit('printItems')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 5h-4v-5h-16v5h-4v13h4v6h9.519c2.947 0 6.029-3.577 6.434-6h4.047v-13zm-18-3h12v3h-12v-3zm8.691 16.648s1.469 3.352-2 3.352h-6.691v-8h12v2.648c0 3.594-3.309 2-3.309 2zm6.809-10.648c-.276 0-.5-.224-.5-.5s.224-.5.5-.5.5.224.5.5-.224.5-.5.5zm-5.5 9h-8v-1h8v1zm-3 1h-5v1h5v-1z"/></svg>

                  <svg @click="$store.dispatch('sendCourier');" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.012 15.876v4.124l1.735-2.578-1.735-1.546zm-4.026 5.871c-.645.405-1.311.765-1.986 1.069l.492 1.184c.675-.303 1.343-.658 1.992-1.056l-.498-1.197zm3.014-2.407c-.59.581-1.253 1.171-1.932 1.67l.505 1.214c.487-.346.977-.758 1.427-1.146v-1.738zm9-13.34l-3.195 12.716-4.329-3.855 4.154-4.385-5.568 3.849-3.843-.934 12.781-7.391zm-2 .001l-.944.546c-.034-.178-.056-.359-.056-.547 0-1.654 1.346-3 3-3s3 1.346 3 3c0 1.557-1.196 2.826-2.716 2.971l.266-1.058c.835-.24 1.45-1.001 1.45-1.913 0-1.104-.896-2-2-2s-2 .896-2 2.001zm8-.001c0 3.313-2.687 6-6 6l-.471-.024.497-1.979c2.194-.015 3.974-1.801 3.974-3.997 0-2.206-1.794-4-4-4s-4 1.794-4 4c0 .371.067.723.162 1.064l-1.779 1.029c-.243-.653-.383-1.356-.383-2.093 0-3.313 2.687-6 6-6s6 2.687 6 6z"/></svg>
              </div>
          </section>
      </div>
      <div class="couriers-sidebar">
          <h3>Out couriers</h3>
          <section class="courier-box" v-for="courier in $store.getters.outCouriers" :key="courier.id">
              <section @click="toggleCourier(courier)">
                 <svg v-if="courier.selected" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>
                 <svg v-if="!courier.selected" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"/></svg>
                  <p>{{courier.name}}</p>
                  <i class="fas fa-user"></i>
              </section>
              <div v-if="courier.selected" class="items-box">
                    <p v-if="courier.items.length <= 0">No Items</p>
                <section v-for="item in courier.items" :key="item.awb">
                    <section v-if="item.kind=='o' && item.old_status == 6">
                        <span @click="item.status = 7" :class="item.status == 7 ? 'selected':null">D</span>
                        <span @click="item.status = 8" :class="item.status == 8 ? 'selected':null">C</span>
                        <span @click="item.status = 9" :class="item.status == 9 ? 'selected':null">R</span>
                    </section>
                    <section v-if="item.kind=='o' && item.old_status == 10">
                        <span @click="item.status = 11" :class="item.status == 11 ? 'selected':null">{{__('Returned')}}</span>
                    </section>
                    <section v-if="item.kind=='o' && item.old_status == 21">
                        <span @click="item.status = 22" :class="item.status == 22 ? 'selected':null">{{__('InStock')}}</span>
                    </section>
                    <section v-if="item.kind=='o' && item.old_status == 23">
                        <span @click="item.status = 24" :class="item.status == 24 ? 'selected':null">{{__('Returned')}}</span>
                    </section>
                    <section v-if="item.kind=='p' && item.old_status == 2">
                        <span @click="item.status = 3" :class="[item.status == 3 ? {'selected':true}:{}]">picked</span>
                        <span @click="item.status = 4" :class="[item.status == 4 ? {'selected':true}:{}]">faild</span>
                    </section>
                    <p >{{item.awb}}</p>
                </section>
              </div>
              <div v-if="courier.selected" class="courier-box-footer">
                  <svg @click="this.$store.commit('printItems')" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 5h-4v-5h-16v5h-4v13h4v6h9.519c2.947 0 6.029-3.577 6.434-6h4.047v-13zm-18-3h12v3h-12v-3zm8.691 16.648s1.469 3.352-2 3.352h-6.691v-8h12v2.648c0 3.594-3.309 2-3.309 2zm6.809-10.648c-.276 0-.5-.224-.5-.5s.224-.5.5-.5.5.224.5.5-.224.5-.5.5zm-5.5 9h-8v-1h8v1zm-3 1h-5v1h5v-1z"/></svg>
                  <button class="def-button" @click="$store.dispatch('arrCourier')">Submit</button>
              </div>
          </section>
      </div>
  </div>
</template>

<script>
export default {
  mounted(){

 },
 methods:{
    toggleCourier(courier){
         courier.selected ? this.unSelectCourier(courier) 
                          : this.selectCourier(courier);
    },
    selectCourier(courier){
        this.unSelectCourier();
        courier.selected = true;
    },/* used */
    unSelectCourier(courier){
        this.$store.state.couriers.map(c => {c.selected = false;});
    },
    closeCouriersSidebar(){
        let couriersSidebar = document.querySelector('#couriersSidebar');
        if(couriersSidebar.style.right == '0px'){
            couriersSidebar.style.right = 'unset';
            couriersSidebar.style.left = '100%';
        }else{
            couriersSidebar.style.left = 'unset';
            couriersSidebar.style.right = '0px';
        }
    }
 },
}
</script>

<style lang="scss" scoped>
.couriers-sidebar-container{
    position:fixed;
    z-index:30;
    right:0px     ;top:0;
    height:100vh;
    display:flex;
    #sidebar-toggler{
        position:absolute;
        left:-1.4em;
        top:50%;    cursor:pointer;
        width:1.2em;    height:1.2em;
    }
    .couriers-sidebar{
        background-color: #db291d;
        height: 100%;
        flex: 1;
        color: #fff;
        padding: 0.2em;
        box-shadow: -2px 0 7px 0px #666;
        overflow:auto;
        user-select: none;
        min-width:max-content;
        &>h3{
            margin:0.4em;
            text-align: center;
            border-radius:0.4em;
        }
    }
    .courier-box{
        text-align: center;
        margin-block:0.3em;
        padding:0.2em;
        background-color: #641f1a52;
        border-radius:0.4em;
        flex:1;
        &>section{
            cursor:pointer;
            display:flex;
            fill:#db291d;
            align-items: center;
            justify-content:flex-end;
            &>p{
                flex:1;
            }
            svg{
                height:0.5em;
            }
        }
        .items-box{
            background-color:#db291d;
            border-radius:0.4em;
            margin-top:0.2em;
            &>section{
                display:flex;
                align-items: center;
                justify-content:flex-end;
                i{
                    margin-inline:0.3em;
                    color:rgb(99, 15, 15);
                    cursor:pointer;
                }
                &>section{
                    flex:1;
                    text-align:start;
                    padding-left:0.2em;
                    span{
                        padding:0.2em;
                        font-size:0.6em;
                        color:#000;
                        background-color:#fff;
                        border-radius:50%;
                        cursor:pointer;
                        display:inline-flex;   align-items:center;     justify-content:center;
                        height:1.3em;           width:1.3em;
                    }
                    .selected{
                        color:#fff !important;
                        background-color:#000 !important;
                    }
                }
            }
        }
        .courier-box-footer{
            display:flex;
            justify-content: space-around;
            padding-top:0.2em;
            svg{
                fill:#fff;
                cursor:pointer;
            }
        }
    }
    .situation{
        font-size:0.7em;    color:#eee;
        margin: 0 0.3em;
    }
}
</style>