import Vuex from 'vuex';
import axios from 'axios';

axios.interceptors.response.use(
    response => {
        genStore.commit('loading',false);
        return response;
    },
    error => {
        console.log(error.response.data)
        if(error.response && error.response.data && error.response.data.errors){
            const errors = error.response.data.errors;
            for (const key in errors) {
                if (Object.hasOwnProperty.call(errors, key)) {
                    let input = document.querySelector('[name='+key+']');
                    if(input){
                        let errMessage = "<label class='error-message'>"+errors[key]+"</label>";
                        input.classList.add('error');
                        input.parentElement.insertAdjacentHTML("beforeend",errMessage);
                    }
                }
            }
            let firstInput = document.querySelector('[name='+Object.keys(errors)[0]+']');
            if(firstInput){firstInput.focus();}

        }
    genStore.commit('loading',false);
    throw error;
});

axios.interceptors.request.use(function (config) {
    genStore.commit('loading',true);
    document.querySelectorAll('.error-message').forEach(message => {
        message.remove();
    });
    document.querySelectorAll('input,select').forEach(input => {
        input.classList.remove('error');
    })
    return config;
  }, function (error) {
    // Do something with request error
    return Promise.reject(error);
  });
const genStore = new Vuex.Store({
    state:{
        areas:[],
        orderStatuses:[],
        loaderSwitch:false,
        redMessageSwitch:false,
        greenMessageSwitch:false,
        redMessage:'Message',
        greenMessage:'Message',
        cities:[]
    },
    getters:{
        getLocale:(state) =>{
            let locale = localStorage.getItem('Locale');
            return locale ? locale :'en';
        },
        getDir:(state,getters) =>{
            return getters.getLocale == 'ar'?'rtl':'ltr';
        },
        Areas:(state)=>{
            return state.areas;
        },
        orderStatuses:(state)=>{
            return state.orderStatuses;
        }
    },
    actions:{
        orderNote:({state,commit},{id,note})=>{
            axios({
                method:'post',
                url:'/dashboard/add-note-to-order',
                data:{order_id:id , note:note}
            }).then(res => {
                commit('greenMessage','added')
            })
        },
        pickupNote:({state,commit},{id,note})=>{
            axios({
                method:'post',
                url:'/dashboard/add-note-to-pickup',
                data:{id:id , note:note}
            }).then(res => {
                commit('greenMessage','added')
            })
        },
    },
    mutations:{
        setLocale:(state,locale) => {
            localStorage.setItem('Locale', 'en');
            window.location.reload();
        },
        logout:()=>{
            axios({
                method:'post',
                url:'/logout'
            }).then(()=>{
                window.location.href ='/';
            })
        },
        loading:(state,value)=>{
            state.loaderSwitch = value;
        },
        redMessage:(state,message)=>{
            state.redMessageSwitch = true;
            state.redMessage = message;
        },
        greenMessage:(state,message)=>{
            state.greenMessageSwitch = true;
            state.greenMessage = message;
        },
        setAreas:(state,areas)=>{
            state.areas = areas;
        },
        setOrderStatuses:(state,areas)=>{
            state.orderStatuses = areas;
        },
        getCities:(state)=>{
            axios('/admin/city/all').then(res => {
                state.cities = res.data;
            })
        }
    },
});
genStore.commit('getCities');
const setOrderStatuses = () => {
   let statuses = require("./orderStatuses.json")
    genStore.commit('setOrderStatuses', statuses);
}
setOrderStatuses();
document.querySelector('html').setAttribute('dir',localStorage.getItem('Locale') == 'ar' ? 'rtl':'ltr');
export default genStore;