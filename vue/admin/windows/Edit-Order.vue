<template>
  <div class="popup-container">
      <div class="popup-background" @click="close()"></div>
      <div class="popup-content">
          <div class="window">
            <header>
                <h3>{{__('Edit Order')}}</h3>
            </header>
            <table class="data-table">
                <tbody>
                    <tr>
                        <td>
                        <label for="total_cash">total cash</label>
                        <input name="total_cash" placeholder="total_cash" v-model="order.total_cash">
                        </td>
                        <td>
                        <label for="number_of_items">number of items</label>
                        <input name="number_of_items" placeholder="number of items" v-model="order.number_of_items">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
            </div>
            <h2>Address</h2>
            <table class="data-table">
                <tbody>
                    <tr>
                        <td>
                            <label for="city">city</label>
                            <input name="city" placeholder="city" v-model="order.city">
                        </td>
                        <td>
                            <label for="area">area</label>
                            <input name="area" placeholder="area" v-model="order.area">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="street">street</label>
                            <input name="street" placeholder="street" v-model="order.street">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="landmarks">landmarks</label>
                            <input name="landmarks" placeholder="landmarks" v-model="order.landmarks">
                        </td>
                        <td>
                            <label for="building">building</label>
                            <input name="building" placeholder="building" v-model="order.building">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="floor">floor</label>
                            <input name="floor" placeholder="floor" v-model="order.floor">
                        </td>
                        <td>
                            <label for="apartment">apartment</label>
                            <input name="apartment" placeholder="apartment" v-model="order.apartment">
                        </td>
                    </tr>
                </tbody>
            </table>
            <Row>
                <MyButton @click="updateOrder()" :label="__('Submit')" :width="'100%'" ></MyButton>
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
    props:['order'],
    data(){
        return{

        }
    },
    mounted(){
        this.fadeIn();
    },
    methods:{
        updateOrder(){
            this.$genStore.commit('loading',true);
            this.$axios({
                method:'post',
                url:'/dashboard/admin/update-order',
                data:{order:this.order}
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
            .data-table{
                input{
                    display:block;
                }
            }

        }
        .X{
            position:absolute;
            top:1em;        right:1em;
            fill:tomato;
            cursor:pointer;
        }
    }
</style>