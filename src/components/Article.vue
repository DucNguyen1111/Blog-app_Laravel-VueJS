<template>
  <div class="blog-article">
    <post-item v-if="post != null" :post="post" :showComment="true" />
  </div>
</template>
<script>
import PostItem from "./PostItem.vue";
import { router } from "../main.js";
export default {
  components: {
    "post-item": PostItem,
  },
  computed: {
    post() {
      const postArticle = this.$store.getters.article(
        router.history.current.params.id
      );
      if (postArticle) return postArticle;
      else {
        return null;
      }
    },
  },
};
</script>
<style scoped>
.blog-article {
  margin-top: 100px;
}
</style>