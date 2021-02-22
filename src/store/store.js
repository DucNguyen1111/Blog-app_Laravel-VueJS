import axios from 'axios';
import Vue from 'vue';
import Vuex from 'vuex';
import user from './modules/user';
import post from './modules/post';
import comment from './modules/comment';
Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        isShowingFormTask: false,
        editingPost: {
            post_title: "",
            post_content: ""
        },
    },
    getters: {
    },
    mutations: {
        openShowingFomrTask(state, index) {
            if (index != -1) {
                state.editingPost = { ...state.post.posts[index], index: index };
            }
            else {
                state.editingPost = {
                    post_title: "",
                    post_content: "",
                    index: index
                };
            }
            state.isShowingFormTask = true;
        },
        closeFormTask(state) {
            state.isShowingFormTask = false;
        }
    },
    modules: {
        user: user,
        post: post,
        comment: comment
    },
    actions: {
        async getAllPosts() {
            const res = await axios.get(`http://127.0.0.1:8000/posts`, {
                headers: {
                    'user_token': localStorage.getItem('_token')
                }
            });
            console.log(res);
        },
    }
});