<template>
    <div class="page">
            <!--  Area Modal -->
        <Modal v-if="is_area_modal" @close="is_area_modal =false">
            <form action="" @submit.prevent="storeArea()">
                <h3>Creat Area</h3>
                <div class="form-group">
                    <label for="name_en">Name in English</label>
                    <input name="name_en" type="text" v-model="area.name_en">
                </div>
                <div class="form-group">
                    <label for="name_ar">Name in Arabic</label>
                    <input name="name_ar" type="text" v-model="area.name_ar">
                </div>
                <div class="form-group">
                    <label for="city_id">City</label>
                    <select v-model="area.city_id" name="city_id" id="">
                        <option v-for="(city,index) in cities.data" :key="index" :value="city.id">{{city.name_en}}</option>
                    </select>
                </div>
                <button class="btn primary-btn">Create</button>
            </form>
        </Modal>
        <!--  City Modal -->
        <Modal v-if="is_city_modal" @close="is_city_modal =false">
            <form action="" @submit.prevent="storeCity()">
                <h3>Creat City</h3>
                <div class="form-group">
                    <label for="name_en">Name in English</label>
                    <input name="name_en" type="text" v-model="city.name_en">
                </div>
                <div class="form-group">
                    <label for="name_ar">Name in Arabic</label>
                    <input name="name_ar" type="text" v-model="city.name_ar">
                </div>
                <button class="btn primary-btn">Create</button>
            </form>
        </Modal>

        <!-- Cities Table -->
      <div class="data-table-container">
          <header>
              <h3>{{__('Cities')}}</h3>
              <button class="btn primary-btn" @click="is_city_modal = true">Add New</button>
          </header>
          <table class="data-table">
            <thead>
                <tr>
                    <th class="Actions">{{__('Actions')}}</th>
                    <th>{{__('Name in English')}}</th>
                    <th>{{__('Name in Arabic')}}</th>
                 </tr>
              </thead>
              <tbody>
                  <tr v-for="city in cities.data" :key="city.id">
                    <td></td>
                    <td>{{city.name_en}}</td>
                    <td>{{city.name_ar}}</td>
                  </tr>
              </tbody>
          </table>
          <footer>
            <div class="pagination">
                <section @click="getCities(link.url)" class="pagination-link" :class="link.active?'active':''" v-for="(link,index) in cities.links" :key="index">
                    <p v-html="link.label"></p>
                </section>
            </div>
          </footer>
      </div>
        <!-- Areas Table -->
      <div class="data-table-container">
          <header>
              <h3>{{__('Areas')}}</h3>
              <button class="btn primary-btn" @click="is_area_modal = true">Add New</button>
          </header>
          <table class="data-table">
            <thead>
                <tr>
                    <th class="Actions">{{__('Actions')}}</th>
                    <th>{{__('Name in English')}}</th>
                    <th>{{__('Name in Arabic')}}</th>
                    <th>{{__('City Name')}}</th>
                 </tr>
              </thead>
              <tbody>
                  <tr v-for="area in areas.data" :key="area.id">
                    <td></td>
                    <td>{{area.name_en}}</td>
                    <td>{{area.name_ar}}</td>
                    <td>{{area.city.name_en}}/{{area.city.name_ar}}</td>
                  </tr>
              </tbody>
          </table>
          <footer>
            <div class="pagination">
                <section @click="getAreas(link.url)" class="pagination-link" :class="link.active?'active':''" v-for="(link,index) in areas.links" :key="index">
                    <p v-html="link.label"></p>
                </section>
            </div>
          </footer>
      </div>
    </div>
</template>

<script>
import axios from 'axios'
import Modal from '../../components/basic-popup.vue'
export default {
    data(){
        return{
            is_city_modal:false,
            is_area_modal:false,
            cities:[],
            areas:[],
            city:{
                name_ar:null,
                name_en:null
            },
            area:{
                name_ar:null,
                name_en:null,
                city_id:null
            }
        }
    },
    components:{Modal},
    mounted(){
        this.$genStore.commit('loading',true);
        Promise.all([this.getCities(),this.getAreas()]).then(res => {
            this.$genStore.commit('loading',false);
            console.log('loading off')
        })
    },
    methods:{
        getCities(url = '/admin/city'){
            axios({
                method:'get',
                url:url,
            }).then(res => {
                this.cities = res.data;
            })
        },
        getAreas(url = '/admin/area'){
            axios({
                method:'get',
                url:url,
            }).then(res => {
                this.areas = res.data;
            })
        },
        storeCity(){
            axios({
                method:'post',
                url:'/admin/city',
                data:this.city
            }).then(res => {
                this.getCities(this.cities.path + '?page=' +this.cities.current_page);
                this.is_city_modal = false;
            })
        },
        storeArea(){
            axios({
                method:'post',
                url:'/admin/area',
                data:this.area
            }).then(res => {
                this.getAreas(this.areas.path + '?page=' +this.areas.current_page);
                this.is_area_modal = false;
            })
        },
    }
}
</script>

<style lang="scss" scoped>
$min-width:9em;
$font-size:0.6em;;        /* height depends on font-size */
$border:2px solid #aaa;
$border-radius:4px;
$on-focus-color:dodgerBlue;
form{
    display: inline-block;
    margin:1em; padding:1em;
    border-radius:6px;
    background-color: #fff;
    box-shadow: 0 0 3px 0 #ccc;
    max-width: 500px;
    h3{
        margin-bottom: 0.6em;
    }
    .form-group{

    }
    button{
        font-size: 0.7em;
        margin-block: 0.8em;
        &:hover{
            background-color: var(--color-btn-hover);
        }
    }
}
</style>