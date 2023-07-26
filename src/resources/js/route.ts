import TopPage from "@/components/pages/TopPage.vue";
// import NextPage from "@/pages/NextPage.vue";

import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "TopPage",
        component: TopPage,
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});
export default router;
