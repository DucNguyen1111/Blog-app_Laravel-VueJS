<template>
  <div class="nav-bar">
    <div class="user-info">
      <img :src="user.avt" alt="" class="user-avatar" />
      <div class="user-name">
        <h3>{{ user.userName }}</h3>
      </div>
    </div>
    <div @click="handleLogout" class="log-out">Log out</div>
  </div>
</template>
<script>
import { router } from "../main";
export default {
  data() {
    return {
      user: this.$store.state.user,
    };
  },
  methods: {
    handleLogout() {
      localStorage.clear();
      router.push("/login");
    },
  },
};
</script>
<style scoped>
.nav-bar {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.user-name h3 {
  margin-left: 10px;
}
.user-info {
  display: flex;
  justify-content: flex-start;
}
.user-avatar {
  width: 70px;
  height: 70px;
  border-radius: 50%;
}
.user-name {
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}
.user-name:hover {
  background: linear-gradient(to left, #f46b45, #eea849);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.log-out {
  font-weight: bold;
  cursor: pointer;
}
.log-out:hover {
  background: linear-gradient(to left, #f46b45, #eea849);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
</style>