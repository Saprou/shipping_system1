import { createApp } from 'vue'
import Login from './Login.vue';
import { Lang } from 'laravel-vue-lang';
import genStore from '../store/index';
/* Components */
import MyInput from '../components/MyInput.vue';
import Password from '../components/Password.vue';
import MySelect from '../components/MySelect.vue';
import Loading from '../components/Loading.vue';
import MyButton from '../components/MyButton.vue';
import PopUp from '../components/basic-popup.vue';
import Header from '../components/Header.vue';
import Sidebar from '../components/Sidebar.vue';
import Row from '../components/Row.vue';
import GreenMessage from '../components/GreenMessage.vue';
import RedMessage from '../components/RedMessage.vue';
let locale = localStorage.getItem('Locale');
const app = createApp(Login)
            .use(Lang,{locale:locale});
app.config.globalProperties.$genStore = genStore;


app.component('Password',Password);
app.component('MyInput',MyInput);
app.component('Loading',Loading);
app.component('MySelect',MySelect);
app.component('MyButton',MyButton);
app.component('PopUp',PopUp);
app.component('Header',Header);
app.component('Sidebar',Sidebar);
app.component('Row',Row);
app.component('RedMessage',RedMessage);
app.component('GreenMessage',GreenMessage);
app.mount('#login');