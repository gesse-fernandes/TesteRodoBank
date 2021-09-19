import Page404 from '../components/frontend/pages/404/Page404'
import SiteComponent from '../components/frontend/SiteComponent'
import HomePageComponent from '../components/frontend/pages/home/HomePageComponent'
import LoginComponent from '../components/admin/pages/auth/LoginComponent'
import createUser from '../components/frontend/pages/createUser/UserCreateComponent'
import clientComponent from '../components/client/ClientComponent'
import adminComponent from '../components/admin/AdminComponent'
import freightComponent from '../components/admin/pages/freights_modal/Freights'
export default [
    {
        path: '/',
        component: SiteComponent,
        meta: {
            auth: false
        },
        children: [{
            path: '',
            component: HomePageComponent,
            name:'home'
        },]
    },
    {
        path: '/login',
        component: LoginComponent,
        name:'auth'
    },
    

    {
        path: '*',
        component:Page404,
    },
    {
        path: '/criar',
        component: createUser,
        name:'create'
    },
    {
        path: '/client',
        component: clientComponent,
        name:'client'
    },
     {
         path: '/admin',
         component: adminComponent,
         name: 'admin',
           children: [{
                   path: '',
                   component: freightComponent,
                   name: 'freight'
               },
           ]
     }
   
]