import TopPage from "@/components/pages/TopPage.vue";
import Ckeditor from "@/components/pages/Ckeditor.vue";
import VeeVal01 from "@/components/pages/VeeVal01.vue";
// import NextPage from "@/pages/NextPage.vue";

import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "TopPage",
        component: TopPage,
    },
    {
        path: "/ckeditor",
        name: "ckEditor",
        component: Ckeditor,
    },
    {
        path: "/veeVal",
        name: "veeVal01",
        component: VeeVal01,
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});
export default router;
