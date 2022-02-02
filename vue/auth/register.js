import { createApp } from 'vue'
import Register from './Register.vue';
import { Lang } from 'laravel-vue-lang';
import genStore from '../store/index';
import axios from 'axios';
/* Components */
import Password from '../components/Password.vue';
import MyInput from '../components/MyInput.vue';
import Loading from '../components/Loading.vue';
import MySelect from '../components/MySelect.vue';
import MyButton from '../components/MyButton.vue';
import SecButton from '../components/SecButton.vue';
import PopUp from '../components/basic-popup.vue';
import Header from '../components/Header.vue';
import Sidebar from '../components/Sidebar.vue';
import Row from '../components/Row.vue';

let locale = localStorage.getItem('Locale');
const app = createApp(Register)
            .use(Lang,{locale:locale});
app.config.globalProperties.$genStore = genStore;
app.config.globalProperties.$axios = axios;


app.component('Password',Password);
app.component('MyInput',MyInput);
app.component('Loading',Loading);
app.component('MySelect',MySelect);
app.component('MyButton',MyButton);
app.component('SecButton',SecButton);
app.component('PopUp',PopUp);
app.component('Header',Header);
app.component('Sidebar',Sidebar);
app.component('Row',Row);

app.mount('#register');