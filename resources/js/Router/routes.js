const routes = [{
        path: '/home',
        component: () =>
            import ('../Pages/Home.vue'),
        name: 'home'
    },
    {
        path: '/admission',
        component: () =>
            import ('../Pages/Admission.vue'),
        name: 'admission',
        beforeEnter: admin
    },
    {
        path: '/tests',
        component: () =>
            import ('../Pages/Tests.vue'),
        name: 'tests',
        beforeEnter: admin
    },
    {
        path: '/user',
        component: () =>
            import ('../Pages/User.vue'),
        name: 'user',
        beforeEnter: admin
    },
    {
        path: '/logs',
        component: () =>
            import ('../Pages/Log.vue'),
        name: 'logs',
        beforeEnter: admin
    },
    {
        path: '/dropdowns',
        component: () =>
            import ('../Pages/Dropdown.vue'),
        name: 'dropdowns',
        beforeEnter: admin
    },

    // Main Iso

    {
        path: '/facilities',
        component: () =>
            import ('../Pages/Facility.vue'),
        name: 'facilities',
        beforeEnter: admin
    },
    {
        path: '/facility/:id',
        component: () =>
            import ('../Pages/Room.vue'),
        name: 'facility/profile',
        beforeEnter: admin
    },
    {
        path: '/patients',
        component: () =>
            import ('../Pages/Patient.vue'),
        name: 'patients',
        beforeEnter: admin
    },
    {
        path: '/patient/:id',
        component: () =>
            import ('../Pages/Profile.vue'),
        name: 'patient/profile',
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