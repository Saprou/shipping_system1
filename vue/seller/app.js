import { createApp } from 'vue'
import Dashboard from './Dashboard.vue';
import store from './store/index';
import router from './router';
import { Lang } from 'laravel-vue-lang';
import genStore from '../store/index';
import axios from 'axios';

/* Components */
import CopyText from '../components/CopyText.vue';
import PagesToggler from '../components/PagesToggler.vue';
import Barcode from '../components/Barcode.vue';
import PageHeader from '../components/PageHeader.vue';
import FiltersContainer from '../components/FiltersContainer.vue';
import ReloadData from '../components/ReloadData.vue';
import GreenMessage from '../components/GreenMessage.vue';
import RedMessage from '../components/RedMessage.vue';
import Loading from '../components/Loading.vue';
import Filter from '../components/Filter.vue';
import MyInput from '../components/MyInput.vue';
import MySelect from '../components/MySelect.vue';
import MySearch from '../components/MySearch.vue';
import MyButton from '../components/MyButton.vue';
import SecButton from '../components/SecButton.vue';
import ErrButton from '../components/ErrButton.vue';
import PopUp from '../components/basic-popup.vue';
import Header from '../components/Header.vue';
import Sidebar from '../components/Sidebar.vue';
import Row from '../components/Row.vue';
import Status from '../components/Status.vue';

let locale = localStorage.getItem('Locale');

const app = createApp(Dashboard)
            .use(store)
            .use(router)
            .use(Lang,{locale:locale});
app.config.globalProperties.$genStore = genStore;
app.config.globalProperties.$axios = axios;


app.component('SecButton',SecButton);
app.component('CopyText',CopyText);
app.component('PagesToggler',PagesToggler);
app.component('Barcode',Barcode);
app.component('PageHeader',PageHeader);
app.component('FiltersContainer',FiltersContainer);
app.component('RedMessage',RedMessage);
app.component('GreenMessage',GreenMessage);
app.component('Loading',Loading);
app.component('ReloadData',ReloadData);
app.component('Filter',Filter);
app.component('MyInput',MyInput);
app.component('MySearch',MySearch);
app.component('MySelect',MySelect);
app.component('MyButton',MyButton);
app.component('ErrButton',ErrButton);
app.component('PopUp',PopUp);
app.component('Header',Header);
app.component('Sidebar',Sidebar);
app.component('Row',Row);
app.component('Status',Status);

app.mount('#dashboard');