<template>
  <div class="container-fluid">
    <form-modal v-bind:formElements="formElements" v-bind:formType="formType" />
  </div>
</template>

<script>
import FormModal from "../components/FormModal.vue";
export default {
  data() {
    return {
      formElements: [
        {
          label: "username",
          model: "",
        },
        {
          label: "password",
          model: "",
        },
      ],
      formType: "login",
    };
  },
  components: {
    "form-modal": FormModal,
  },
  beforeCreate() {
    // this.$store.dispatch("fetchSomething");
  },
};
</script>
<style scoped>
.container-fluid {
  height: 100%;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
}
</style>