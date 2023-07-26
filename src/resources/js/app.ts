import "./bootstrap";
import { createApp } from "vue";
import App from "./components/App.vue";

// Route設定は次に行います
import router from "./route";
const app = createApp(App);
app.use(router);
app.mount("#app");
