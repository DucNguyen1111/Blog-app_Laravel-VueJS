<template>
  <div class="comment-item">
    <img class="item-img" :src="comment.avt" alt="" />
    <div class="item-content">
      <h4 class="item-user">
        {{ comment.username }}
      </h4>

      <p class="item-graph">
        {{ comment.commentContent }}
        <span
          v-if="this.$store.state.user.userId == comment.userid"
          class="item-task"
          ><i @click="handleEditComment" class="fas fa-pencil-alt green"></i
          ><i @click="handleDeleteComment" class="fas fa-times red"></i
        ></span>
      </p>
    </div>
  </div>
</template>
<script>
import CommentItem from "./CommentItem";
export default {
  props: {
    comment: Object,
    editingComment: String,
  },
  component: {
    "comment-item": CommentItem,
  },
  data() {
    return {
      text: this.editingComment,
    };
  },
  methods: {
    handleDeleteComment(e) {
      e.preventDefault();
      e.stopPropagation();
      this.$store.dispatch("comment/deleteComment", this.comment.commentid);
    },
    handleEditComment(e) {
      e.preventDefault();
      e.stopPropagation();
      this.$store.commit("comment/setEditingComment", this.comment.commentid);
    },
  },
};
</script>
<style scoped>
.comment-item {
  margin: 10px 0px;
  display: flex;
  align-items: flex-start;
}
.item-img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
.item-content {
  margin-left: 10px;
  background-color: #e8e8e8;
  padding: 5px 10px;
  border-radius: 10px;

  max-width: 80%;
  position: relative;
}
.item-task {
  position: absolute;
  right: -80px;
  top: 40%;
  border-radius: 50%;
  display: flex;
  padding: 0px 10px;
  width: 60px;
  justify-content: space-around;
}
.green {
  color: #5cb85c;
}
i:hover {
  transform: rotate(360deg);
  transition: 0.6s;
}
i {
  transition: 0.6s;
}
.red {
  color: #d9534f;
}
</style>