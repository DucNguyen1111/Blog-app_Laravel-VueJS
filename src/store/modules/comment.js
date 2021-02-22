import axios from 'axios';
const comment = {
    namespaced: true,
    state: {
        comments: [],
        editingComment: "",
        editingCommentId: ""
    },
    getters: {

    },
    mutations: {
        setComments(state, payload) {
            state.comments = [...payload];
        },
        addComment(state, payload) {
            const comments = [...state.comments];
            payload.commentid = payload.commentId;
            comments.push(payload);
            state.comments = [...comments];
        },
        deleteComment(state, id) {
            const comments = [...state.comments];
            for (let index = 0; index < comments.length; index++) {
                if (comments[index].commentid == id) {
                    comments.splice(index, 1);
                    break;
                }
            }
            state.comments = [...comments];
        },
        setEditingComment(state, id) {
            for (let index = 0; index < state.comments.length; index++) {
                if (state.comments[index].commentid == id) {
                    state.editingComment = state.comments[index].commentContent;
                    state.editingCommentId = id;
                }
            }
        },
        updateComment(state, payload) {

            const comments = [...state.comments];
            for (let index = 0; index < comments.length; index++) {
                if (comments[index].commentid == payload.commentId) {
                    comments[index].commentContent = payload.commentContent;
                    break;
                }
            }
            state.editingComment = "";
            state.editingCommentId = "";
            state.comments = [...comments];
        },
        resetEditingComment(state) {

            state.editingComment = "";
            state.editingCommentId = "";
        }
    },
    actions: {
        async comment({ commit }, payload) {
            try {
                const res = await axios.post("http://127.0.0.1:8000/comment", payload, {
                    headers: {
                        'user_token': localStorage.getItem('_token')
                    }
                });
                commit("addComment", payload);
                console.log(res);
            } catch (error) {
                console.log(error);
            }
        },
        async deleteComment({ commit }, id) {
            try {
                const res = await axios.delete(`http://127.0.0.1:8000/comment/${id}`, {
                    headers: {
                        'user_token': localStorage.getItem('_token')
                    },
                });
                console.log(res);
                commit("deleteComment", id);
            } catch (error) {
                console.log(error);
            }
        },
        async updateComment({ commit }, payload) {
            try {
                const res = await axios.patch(`http://127.0.0.1:8000/comment/${payload.commentId}`, payload, {
                    headers: {
                        'user_token': localStorage.getItem('_token')
                    },
                });
                console.log(res);
                commit("updateComment", payload);


            } catch (error) {
                console.log(error);
            }
        }
    }
}
export default comment;