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
        beforeEnter: main
    },
    {
        path: '/tests',
        component: () =>
            import ('../Pages/Tests.vue'),
        name: 'tests',
        beforeEnter: main
    },
    {
        path: '/user',
        component: () =>
            import ('../Pages/User.vue'),
        name: 'user',
        beforeEnter: both
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
        beforeEnter: superadmin
    },
    {
        path: '/municipalities',
        component: () =>
            import ('../Pages/Municipality.vue'),
        name: 'municipalities',
        beforeEnter: superadmin
    },
    {
        path: '/municipality/:id',
        component: () =>
            import ('../Pages/MuniProfile.vue'),
        name: 'municipality/profile',
        beforeEnter: superadmin
    },

    // Main Iso

    {
        path: '/facilities',
        component: () =>
            import ('../Pages/Facility.vue'),
        name: 'facilities',
        beforeEnter: adminiso
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
        beforeEnter: main
    },
    {
        path: '/patient/:id',
        component: () =>
            import ('../Pages/Profile.vue'),
        name: 'patient/profile',
        beforeEnter: main
    },


];

function superadmin(to, from, next) {
    (window.User.type == "Super Administrator") ? next(true): next({
        path: '/home',
        compone
    });
}

function admin(to, from, next) {
    (window.User.type == "Administrator") ? next(true): next({
        path: '/home',
        compone
    });
}

function adminiso(to, from, next) {
    (window.User.type == "Administrator" || window.User.type == "Isolation Manager") ? next(true): next({
        path: '/home',
        compone
    });
}

function both(to, from, next) {
    (window.User.type == "Administrator" || window.User.type == "Super Administrator") ? next(true): next({
        path: '/home',
        compone
    });
}


function main(to, from, next) {
    (window.User.type == "Isolation Manager" || window.User.type == "Contact Tracer") ? next(true): next({
        path: '/home',
        compone
    });
}

export default routes;