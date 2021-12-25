const routes = [{
        path: '/home',
        component: () => import('../Pages/Home.vue'),
        name: 'home'
    },
    {
        path: '/user',
        component: () => import('../Pages/User.vue'),
        name: 'user',
        beforeEnter: admin
    },
    {
        path: '/logs',
        component: () => import('../Pages/Log.vue'),
        name: 'logs',
        beforeEnter: admin
    },

    // Main Iso

    {
        path: '/facilities',
        component: () => import('../Pages/Facility.vue'),
        name: 'facilities',
        beforeEnter: admin
    },

];

function admin(to, from, next) {
    (window.User.type == "Administrator") ? next(true): next({
        path: '/home',
        compone
    });
}

function main(to, from, next) {
    (window.User.type == "Isolation Manager") ? next(true): next({
        path: '/home',
        compone
    });
}

export default routes;
