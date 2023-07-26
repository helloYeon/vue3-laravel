import TopPage from "@/components/pages/TopPage.vue";
import Ckeditor from "@/components/pages/Ckeditor.vue";
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
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});
export default router;
