<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
          <div class="window">
            <header>
                <h3>{{__('Create new courier')}}</h3>
            </header>
            <Row>
                <MyInput :label="__('Name')" v-model:object="courier.name"/>
                <MyInput :label="__('Mobile')" v-model:object="courier.mobile"/>
            </Row>
            <Row>
                <MyInput :label="__('Second mobile')" :required="false" v-model:object="courier.sec_mobile"/>
                <MyInput :label="__('Personal ID')" v-model:object="courier.personal_id"/>
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
            courier:{
                name:{value:null,err:null,name:"name"},
                mobile:{value:null,err:null,name:"courier_mobile"},
                sec_mobile:{value:null,err:null,name:"courier_sec_mobile"},
                personal_id:{value:null,err:null,name:"personal_id"},
            }
        }
    },
    mounted(){
        this.fadeIn();
    },
    methods:{
        submit(){
            this.$axios({
                method:'post',
                url:'/dashboard/admin/create-courier',
                data:{courier:this.Courier()}
            }).then(res => {
                this.$store.commit('unshiftCourier',res.data);
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
        Courier(){
            let courier = {};
            Object.entries(this.courier).forEach(([key, value]) => {
                courier[`${key}`] = value.value
            });
            return courier;
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