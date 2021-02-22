
import axios from 'axios';
import { store } from '../store';
const post = {
    state: () => ({
        posts: []
    }),
    getters: {
        article: (state) => (id) => {

            return state.posts.find(post => post.postid == id);
        }
    },
    mutations: {
        setPosts: (state, payload) => {
            state.posts = [...payload];
        },
        updatePosts: (state, payload) => {
            const posts = [...state.posts];
            const index = payload.index;
            posts[index].post_title = payload.postTitle.toUpperCase();
            posts[index].post_content = payload.postContent;
            state.posts = [...posts];
        },
        createPost: (state, payload) => {
            payload.postid = payload.postId;
            const posts = [...state.posts];
            posts.unshift(payload);
            state.posts = [...posts];
        },
        deletePost: (state, payload) => {

            const posts = [...state.posts];
            posts.splice(payload.postition, 1);
            state.posts = [...posts];
        }
    },
    actions: {
        async createPost({ commit }, payload) {
            try {
                const res = await axios.post("http://127.0.0.1:8000/create", payload, {
                    headers: {
                        'user_token': localStorage.getItem('_token')
                    }
                });
                payload.username = store.state.user.userName;
                payload.avt = store.state.user.avt;
                payload.post_title = payload.postTitle;
                payload.post_content = payload.postContent;
                payload.userid = store.state.user.userId;

                commit("createPost", payload);
                console.log(res);
            } catch (error) {
                console.log(error);
            }

        },
        async getAllPosts({ commit }) {
            try {
                const res = await axios.get(`http://127.0.0.1:8000/posts`, {
                    headers: {
                        'user_token': localStorage.getItem('_token')
                    }
                });
                commit("setPosts", res.data.posts);
            } catch (error) {
                console.log('getPost have an error');
            }

        },
        async updatePost({ commit }, payload) {
            try {
                const res = await axios.patch(`http://127.0.0.1:8000/post/${payload.postId}`, payload, {
                    headers: {
                        'user_token': localStorage.getItem('_token')
                    }
                });
                if (res.status == 200) {
                    commit("updatePosts", payload);
                }
                console.log(res);
            } catch (error) {
                console.log(error)
            }
        },
        async deletePost({ commit }, payload) {
            try {
                const res = await axios.delete(`http://127.0.0.1:8000/post/${payload.postId}`, {
                    headers: {
                        'user_token': localStorage.getItem('_token')
                    },
                    payload
                });
                console.log(res);
                commit("deletePost", payload);
            } catch (error) {
                console.log(error)
            }

        },
        async getPost({ commit, state }, postId) {

            const res = await axios.get(`http://127.0.0.1:8000/post/${postId}`, {
                headers: {
                    'user_token': localStorage.getItem('_token')
                }
            });
            console.log(res);
            if (state.posts.length == 0) {
                commit('setPosts', [res.data.post]);
            }
            store.commit('comment/setComments', res.data.comments);
        }
    }
}
export default post