<template>
  <div class="comment-list">
    <div class="new-comment">
      <img class="comment-avt" :src="user.avt" alt="" />
      <input
        @click="handleFocusInput"
        type="text"
        class="commenting"
        placeholder="Viết bình luận ..."
        v-model="text"
        v-on:keyup.enter="handleCreateComment"
      />
    </div>
    <comment-item
      v-for="comment in comments"
      :key="comment.commentid"
      :comment="comment"
      :editingComment="editingComment"
    />
  </div>
</template>
<script>
import CommentItem from "./CommentItem";
import { router } from "../main.js";
import shortid from "shortid";
export default {
  components: { CommentItem },
  component: {
    "comment-item": CommentItem,
  },
  data() {
    return {
      text: this.editingComment,
      user: this.$store.state.user,
      CommentId: this.editingCommentId,
    };
  },
  computed: {
    comments() {
      return this.$store.state.comment.comments;
    },
    editingComment() {
      return this.$store.state.comment.editingComment;
    },
    editingCommentId() {
      return this.$store.state.comment.editingCommentId;
    },
  },
  watch: {
    editingComment(newEditingComment) {
      this.text = newEditingComment;
    },
    editingCommentId(newEditingCommentId) {
      this.commentId = newEditingCommentId;
    },
  },
  methods: {
    handleFocusInput(e) {
      e.stopPropagation();
    },
    handleCreateComment(e) {
      e.preventDefault();
      if (this.$store.state.comment.editingCommentId.length) {
        const payload = {
          postId: router.history.current.params.id,
          commentId: this.commentId,
          commentContent: this.text,
          userid: this.user.userId,
          username: this.user.userName,
          avt: this.user.avt,
        };
        this.$store.dispatch("comment/updateComment", payload);
      } else {
        const payload = {
          postId: router.history.current.params.id,
          commentId: shortid(),
          commentContent: this.text,
          userid: this.user.userId,
          username: this.user.userName,
          avt: this.user.avt,
        };
        this.$store.dispatch("comment/comment", payload);
      }
      this.text = "";
    },
  },
};
</script>
<style scoped>
.comment-list {
  margin: 20px 0px;
  padding-right: 25px;
}
.commenting {
  margin-left: 10px;
  line-height: 30px;
  width: 100%;
  padding: 0px 10px;
  position: relative;
  background-color: #e8e8e8;
  border: none;
  outline: none;
  border-radius: 100px;
}
.new-comment {
  margin: 10px 0px;
  margin-top: 20px;
  display: flex;
  align-items: center;
}
.comment-avt {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
</style>