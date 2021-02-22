<template>
  <div class="post-list">
    <span class="post-creation"
      ><i
        class="fas fa-plus-circle post-creation-icon"
        @click="handleCreatePost"
      ></i
    ></span>
    <post-item
      v-for="post in posts"
      :key="post.postid"
      :post="post"
      :showComment="false"
    />
  </div>
</template>
<script>
import PostItem from "./PostItem.vue";
export default {
  components: {
    "post-item": PostItem,
  },
  data() {
    return {};
  },
  computed: {
    posts() {
      return this.$store.state.post.posts;
    },
  },
  methods: {
    handleCreatePost(e) {
      e.preventDefault();
      this.$store.commit("openShowingFomrTask", -1);
    },
  },
};
</script>
<style scoped>
.post-list {
  margin-top: 100px;
}
.post-creation {
  display: block;
  display: flex;
  justify-content: center;
}
.post-creation-icon {
  color: green;
  font-size: 40px;
  cursor: pointer;
  transition: 0.6s;
}
.post-creation-icon:hover {
  transform: rotate(180deg);
  transition: 0.6s;
}
</style>