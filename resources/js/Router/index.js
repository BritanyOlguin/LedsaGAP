import { createRouter, createWebHashHistory } from 'vue-router';
import Login from '@/Pages/Auth/Login.vue';

const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/',
            children: [
                {
                    path: '/',
                    name: 'login',
                    component: Login,
                },
            ],
        },
    ],
});

export default router;