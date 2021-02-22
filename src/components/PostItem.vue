<template>
  <div @click="handlePostInfo" class="post-item">
    <div class="post-header">
      <img class="post-avt" v-bind:src="post.avt" alt="" />
      <div class="post-owner">
        <h3>{{ post.username }}</h3>
      </div>
    </div>
    <div class="post-title">
      <h3>{{ post.post_title }}</h3>
    </div>
    <div class="post-content">
      <p>{{ post.post_content }}</p>
    </div>
    <div class="post-control" v-if="post.userid == user.userId">
      <span class="post-edit edit" v-on:click="handleEditPost"
        ><i class="fas fa-edit"></i>Edit</span
      >
      <span class="post-delete delete" v-on:click="handelDeletePost"
        ><i class="fas fa-trash-alt"></i>Delete</span
      >
    </div>
    <div v-if="showComment == true">
      <comment-list />
    </div>
  </div>
</template>
<script>
import { router } from "../main";
import CommentList from "./CommentList.vue";
export default {
  components: {
    "comment-list": CommentList,
  },
  props: {
    post: Object,
    showComment: Boolean,
  },
  data() {
    return {
      user: this.$store.state.user,
    };
  },
  methods: {
    handleEditPost(e) {
      e.preventDefault();
      e.stopPropagation();
      let postition = -1;
      for (
        let index = 0;
        index < this.$store.state.post.posts.length;
        index++
      ) {
        if (this.$store.state.post.posts[index].postid == this.post.postid) {
          postition = index;
          break;
        }
      }
      this.$store.commit("openShowingFomrTask", postition);
    },
    handelDeletePost(e) {
      e.preventDefault();
      e.stopPropagation();
      let postition = -1;
      for (
        let index = 0;
        index < this.$store.state.post.posts.length;
        index++
      ) {
        if (this.$store.state.post.posts[index].postid == this.post.postid) {
          postition = index;
          break;
        }
      }
      const payload = {
        postition,
        postId: this.post.postid,
      };
      this.$store.dispatch("deletePost", payload);
    },
    handlePostInfo(e) {
      e.preventDefault();
      const postId = this.post.postid;
      router.push(`/post/${postId}`);
    },
  },
};
</script>
<style scoped>
.post-item {
  padding: 50px 15px;
  padding-bottom: 20px;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px,
    rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
  min-height: 180px;
  cursor: pointer;
  transition: 0.5s;
  margin: 25px 0px;
  border-radius: 5px;
}
.post-item:hover {
  box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px,
    rgba(0, 0, 0, 0.22) 0px 15px 12px;
  transition: 0.5s;
}
.post-header {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  margin-bottom: 15px;
}
.post-avt {
  width: 70px;
  height: 70px;
  border-radius: 50%;
}
.post-owner {
  background: linear-gradient(to left, #f46b45, #eea849);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.post-owner h3 {
  margin-left: 10px;
}
.post-title {
  font-weight: bold;
  margin-bottom: 20px;
}
.post-content p {
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  font-size: 14px;
}
.post-control {
  margin-top: 10px;
  display: flex;
  justify-content: flex-end;
}
.post-edit,
.post-delete {
  display: inline-block;
  margin-right: 15px;
  padding: 10px 12px;
  border-radius: 5px;
  color: white;
}
.delete {
  background-color: #ff4500;
}
.edit {
  background-color: #0275d8;
}
</style>