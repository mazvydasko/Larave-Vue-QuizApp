import Home from "./components/Home";
import TopicView from "./components/topic/View"
import NewTopic from "./components/topic/NewTopic";
import NewQuestion from "./components/question/NewQuestion";
import AdminPanel from "./components/AdminPanel";
import Login from "./components/auth/Login";
import Register from "./components/auth/Register";



export const routes = [
    {
        path: '/',
        component: Home
    },

    {
        path: '/topics/:id',
        component: TopicView,
        meta: {
            requiresAuth: true
        },
    },
    {
        path: '/topic/new',
        component: NewTopic
    },
    {
        path: '/question/new',
        component: NewQuestion
    },
    {
        path: '/adminpanel',
        component: AdminPanel,
        meta: {
            requiresAuth: true,
            requiresAdmin: true
        },
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },

];