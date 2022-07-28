//import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Vue from 'vue'


Vue.config.productionTip = false

new Vue({
    router,
    render: h => h(App),
});
//createApp(App).mount('#app').user(router)
