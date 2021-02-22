import Register from '../views/Register.vue';
import Login from '../views/Login.vue';
import NewsFeed from '../views/NewsFeed.vue';
import PostPage from '../views/PostPage';
import { store } from '../store/store';
const routes = [
    {
        path: '/',
        redirect: '/login'
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/newsfeed',
        name: 'newsfeed',
        component: NewsFeed,
        beforeEnter: async (to, from, next) => {
            try {
                await Promise.all([store.dispatch("auth"), store.dispatch("getAllPosts")]);
                if (store.getters.isLogin) {
                    return next();
                }
                return next('/login');
            } catch (error) {
                return next('/login');
            }
        }
    },
    {
        path: '/post/:id',
        component: PostPage,
        beforeEnter: async (to, from, next) => {
            try {
                const postId = to.params.id;
                await Promise.all([store.dispatch("auth"), store.dispatch("getPost", postId)]);
                store.commit("comment/resetEditingComment");
                if (store.getters.isLogin) {
                    return next();
                }
                return next('/login');
            } catch (error) {
                return next('/login');
            }

        }
    }
];
export default routes;