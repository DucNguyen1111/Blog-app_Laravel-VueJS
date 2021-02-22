<template>
  <div class="container-fluid">
    <div class="wall">
      <user-info />
      <post-article />
    </div>
    <form-task v-if="isShowingFormTask" :editingPost="editingPost" />
  </div>
</template>
<script>
import Article from "../components/Article.vue";
import UserInfo from "../components/UserInfo";
import FormTask from "../components/FormTask.vue";
export default {
  components: {
    "user-info": UserInfo,
    "post-article": Article,
    "form-task": FormTask,
  },
  data() {
    return {};
  },
  computed: {
    isShowingFormTask: function () {
      return this.$store.state.isShowingFormTask;
    },
    editingPost: function () {
      return { ...this.$store.state.editingPost };
    },
  },
};
</script>
<style scoped>
.container-fluid {
  min-height: 100vh;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  position: relative;
}
.wall {
  min-height: 100vh;
  width: 70%;
  background-color: white;
  padding: 20px 25px;
  padding-top: 20;
  box-sizing: border-box;
}
.logo {
  font-size: 72px;
  background: linear-gradient(to left, #f46b45, #eea849);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-family: "Courier New";
}
</style>