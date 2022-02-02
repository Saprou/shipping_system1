import Vuex from 'Vuex';
import axios from 'axios';
function errorFound(name){
    let input = document.getElementById(name);
    input.scrollIntoView(false);
    input.focus();
}
const genStore = new Vuex.Store({
    state:{
        areas:[],
        orderStatuses:[],
        loaderSwitch:false,
        redMessageSwitch:false,
        greenMessageSwitch:false,
        redMessage:'Message',
        greenMessage:'Message'
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
            localStorage.setItem('Locale', locale);
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
        errorFound:(state,name)=>{
            errorFound(name);
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
    },
});
const setAreas = () => {
   let areas = require("./areas.json")
    genStore.commit('setAreas', areas);
}
const setOrderStatuses = () => {
   let statuses = require("./orderStatuses.json")
    genStore.commit('setOrderStatuses', statuses);
}
setAreas();
setOrderStatuses();
document.querySelector('html').setAttribute('dir',localStorage.getItem('Locale') == 'ar' ? 'rtl':'ltr');
export default genStore;