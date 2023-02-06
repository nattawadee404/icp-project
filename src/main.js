import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import vuex from "./store";

// ให้ลง chart.js ก่อนลง vue-charttick
import VueChartkick from "vue-chartkick";
import "chartkick/chart.js";
import VueApexCharts from "vue3-apexcharts";

// npm install --save-dev @fortawesome/fontawesome-free
import "@fortawesome/fontawesome-free/css/all.css";
import "@fortawesome/fontawesome-free/js/all.js";

createApp(App)
  .use(VueApexCharts)
  .use(VueChartkick)
  .use(store)
  .use(router)
  .mount("#app")
  .use(vuex);
