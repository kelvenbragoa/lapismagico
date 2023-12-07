

//IMPORT COMPONENT FOR ADMIN ROUTES
import Login from './pages/auth/Login.vue';
import DashboardAdmin from './components/DashboardAdmin.vue';

import IndexUsers from './pages/admin/users/IndexUsers.vue';
import CreateUsers from './pages/admin/users/CreateUsers.vue';
import ShowUsers from './pages/admin/users/ShowUsers.vue';
import EditUsers from './pages/admin/users/EditUsers.vue';


import IndexSchoolYear from './pages/admin/schoolyear/IndexSchoolYear.vue';
import CreateSchoolYear from './pages/admin/schoolyear/CreateSchoolYear.vue';
import ShowSchoolYear from './pages/admin/schoolyear/ShowSchoolYear.vue';
import EditSchoolYear from './pages/admin/schoolyear/EditSchoolYear.vue';


import IndexRegistration from './pages/admin/registration/IndexRegistration.vue';
import CreateRegistration from './pages/admin/registration/CreateRegistration.vue';
import ShowRegistration from './pages/admin/registration/ShowRegistration.vue';
import EditRegistration from './pages/admin/registration/EditRegistration.vue';

import IndexTaxes from './pages/admin/taxes/IndexTaxes.vue';
import CreateTaxes from './pages/admin/taxes/CreateTaxes.vue';
import ShowTaxes from './pages/admin/taxes/ShowTaxes.vue';
import EditTaxes from './pages/admin/taxes/EditTaxes.vue';



export default [


  
    //auth
    {
        path: '/login',
        name: 'users.login',
        component: Login,
    },

    // ADMIN ROUTES

    //admins
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: DashboardAdmin,
    },

    //users
    {
        path: '/admin/users',
        name: 'admin.users.index',
        component: IndexUsers,
    },
    {
        path: '/admin/users/create',
        name: 'admin.users.create',
        component: CreateUsers,
    },
    {
        path: '/admin/users/:id',
        name: 'admin.users.show',
        component: ShowUsers,
    },
    {
        path: '/admin/users/:id/edit',
        name: 'admin.users.edit',
        component: EditUsers,
    },

    //schoolyear
    {
        path: '/admin/schoolyear',
        name: 'admin.schoolyear.index',
        component: IndexSchoolYear,
    },
    {
        path: '/admin/schoolyear/create',
        name: 'admin.schoolyear.create',
        component: CreateSchoolYear,
    },
    {
        path: '/admin/schoolyear/:id',
        name: 'admin.schoolyear.show',
        component: ShowSchoolYear,
    },
    {
        path: '/admin/schoolyear/:id/edit',
        name: 'admin.schoolyear.edit',
        component: EditSchoolYear,
    },

      //taxes
      {
        path: '/admin/taxes',
        name: 'admin.taxes.index',
        component: IndexTaxes,
    },
    {
        path: '/admin/taxes/create',
        name: 'admin.taxes.create',
        component: CreateTaxes,
    },
    {
        path: '/admin/taxes/:id',
        name: 'admin.taxes.show',
        component: ShowTaxes,
    },
    {
        path: '/admin/taxes/:id/edit',
        name: 'admin.taxes.edit',
        component: EditTaxes,
    },


    //registration
    {
        path: '/admin/registration',
        name: 'admin.registration.index',
        component: IndexRegistration,
    },
    {
        path: '/admin/registration/create',
        name: 'admin.registration.create',
        component: CreateRegistration,
    },
    {
        path: '/admin/registration/:id',
        name: 'admin.registration.show',
        component: ShowRegistration,
    },
    {
        path: '/admin/registration/:id/edit',
        name: 'admin.registration.edit',
        component: EditRegistration,
    },

]

