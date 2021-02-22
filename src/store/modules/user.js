import { router } from '../../main.js';
import axios from 'axios';
const user = {
    state: () => ({
        userId: null,
        userName: null,
        avt: null,
        age: null,
        address: null,

    }),
    getters: {
        isLogin: state => {
            if (state.userId) return true;
            return false;
        }
    },
    mutations: {
        setOwner(state, payload) {
            state.userId = payload.userid;
            state.userName = payload.username;
            state.avt = payload.avt;
            state.age = payload.age;
            state.address = payload.address;
        }
    },
    actions: {
        async login(state, payload) {
            const response = await axios.post("http://127.0.0.1:8000/login", payload, {
                header: { "Content-Type": "multipart/form-data" },
            });
            localStorage.setItem("_token", response.data.user_token);
            if (response.status == 200) {
                router.push({ path: 'newsfeed' });
            }
            else {
                alert("Not allow to access!");
            }
        },
        async auth({ commit }) {
            const response = await axios.get(`http://127.0.0.1:8000/owner`, {
                headers: {
                    'user_token': localStorage.getItem('_token')
                }
            });
            console.log(response);
            if (response.data.status == 200) {
                console.log(response);
                commit('setOwner', response.data.user);
            }
            else {
                commit('setOwner', {
                    userId: null,
                    userName: null,
                    avt: null,
                    age: null,
                    address: null,
                });
            }
        },
        async register(state, payload) {
            try {
                const res = await axios.post("http://127.0.0.1:8000/register", payload);
                console.log(res);
                if (res.status == 201) {
                    router.push("/login");
                }
            } catch (error) {
                console.log(error);
            }
        },
    }
}
export default user