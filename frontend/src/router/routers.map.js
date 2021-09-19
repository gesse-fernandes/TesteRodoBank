import Page404 from '../components/frontend/pages/404/Page404'
import SiteComponent from '../components/frontend/SiteComponent'
import HomePageComponent from '../components/frontend/pages/home/HomePageComponent'
import LoginComponent from '../components/admin/pages/auth/LoginComponent'
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
    }
]