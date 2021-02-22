<template>
  <div class="form-task">
    <div class="form-modal" v-click-outside>
      <i class="fas fa-times form-closing" v-on:click="handleCloseForm()"></i>
      <h2 class="form-type"><i class="fas fa-edit"></i>{{ heading }}</h2>
      <div class="form-title">
        <label class="form-label">Post Title</label>
        <input type="text" class="form-input-title" v-model="postTitle" />
      </div>
      <div class="form-content">
        <label class="form-label">Post content</label>
        <textarea
          class="form-area-content"
          v-model="postContent"
          cols="30"
          rows="10"
        ></textarea>
      </div>
      <div class="form-submit">
        <button @click="handleUpdatePost" class="form-btn" type="submit">
          Submit
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import shordid from "shortid";
export default {
  props: {
    editingPost: Object,
  },
  data() {
    return {
      postTitle: this.editingPost.post_title,
      postContent: this.editingPost.post_content,
    };
  },
  methods: {
    handleCloseForm() {
      this.$store.commit("closeFormTask");
    },
    handleUpdatePost(event) {
      event.preventDefault();
      if (this.editingPost.index != -1) {
        const payload = {
          postId: this.editingPost.postid,
          postTitle: this.postTitle,
          postContent: this.postContent,
          index: this.editingPost.index,
        };
        this.$store.dispatch("updatePost", payload);
      } else {
        const postId = shordid.generate();
        const payload = {
          postId,
          postTitle: this.postTitle,
          postContent: this.postContent,
        };
        this.$store.dispatch("createPost", payload);
      }
    },
  },
  computed: {
    heading() {
      if (this.editingPost.index == -1) {
        return "Create Post";
      } else {
        return "Edit Post";
      }
    },
  },
};
</script>
<style scoped>
.form-task {
  position: absolute;
  height: 100%;
  width: 100%;
  z-index: 9999;
  display: flex;
  box-sizing: border-box;
  justify-content: center;
  align-items: flex-start;
}
.form-modal {
  width: 30%;
  position: relative;
  margin-top: 100px;
  background: linear-gradient(to left, #f46b45, #eea849);
  padding: 20px 25px;
  box-sizing: border-box;
  border-radius: 5px;
}
.fa-edit {
  margin-right: 10px;
  background-color: transparent;
}
.form-type {
  color: white;
  text-align: center;
  margin: 30px 0px;
}
.form-label {
  display: block;
  color: white;
  font-size: 16px;
  font-weight: bold;
}
.form-input-title {
  width: 100%;
  line-height: 30px;
  margin: 10px 0px;
  border-radius: 5px;
  outline: none;
  border: none;
  padding: 0px 8px;
  box-sizing: border-box;
  font-weight: bold;
  text-transform: uppercase;
}
.form-area-content {
  margin: 10px 0px;
  width: 100%;
  outline: none;
  border: none;
  border-radius: 5px;
  padding: 8px;
  box-sizing: border-box;
}
.form-submit {
  display: flex;
  justify-content: center;
}
.form-btn {
  width: 60%;
  padding: 6px;
  outline: none;
  border: none;
  font-size: 16px;
  font-weight: bold;
  border-radius: 5px;
  cursor: pointer;
  color: white;
  background: linear-gradient(
    45deg,
    #f09433 0%,
    #e6683c 25%,
    #dc2743 50%,
    #cc2366 75%,
    #bc1888 100%
  );
}
.form-closing {
  position: absolute;
  cursor: pointer;
  right: 25px;
  font-size: 20px;
  color: red;
}
.form-closing:hover {
  transform: scale(1.5);
}
</style>