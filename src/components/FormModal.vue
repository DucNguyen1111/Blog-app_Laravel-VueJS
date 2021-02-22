<template>
  <form action="" class="form">
    <h1 class="form--title">{{ upper }}</h1>
    <div
      v-for="(element, index) in formElements"
      v-bind:key="index"
      class="form-group"
    >
      <label class="form--label">{{ capitalize(element.label) }}</label
      ><br />
      <input
        v-if="element.label != 'avatar'"
        class="form--control"
        v-bind:type="type(element.label)"
        name="account"
        autocomplete="off"
        v-bind:placeholder="placeHolder(element.label)"
        v-model="element.model"
      />
      <input
        v-else
        class="form--control form--file"
        v-bind:type="type(element.label)"
        name="account"
        autocomplete="off"
        v-bind:placeholder="placeHolder(element.label)"
        v-on:change="onFileChange"
      />
    </div>
    <p v-if="formType == 'login'" class="form--redirect">
      If you don't have an account,
      <span
        ><router-link class="span--redirect" to="/register"
          >Go to register</router-link
        ></span
      >
    </p>
    <button class="form--register" type="submit" v-on:click="submit">
      {{ formTypeName }}
    </button>
  </form>
</template>
<script>
import shortid from "shortid";
export default {
  props: {
    formElements: Array,
    formType: String,
  },
  data() {
    return {};
  },
  computed: {
    upper: function () {
      return this.formType.toUpperCase();
    },
    formTypeName: function () {
      const type = this.formType == "login" ? "login" : "register";
      return type.toUpperCase();
    },
  },
  methods: {
    capitalize: function (string) {
      string[0].toUpperCase();
      return string.charAt(0).toUpperCase() + string.slice(1);
    },
    placeHolder: function (string) {
      return `Type your ${string} !`;
    },
    type: function (string) {
      if (string == "password") return string;
      else if (string == "avatar") return "file";
      else return "text";
    },
    onFileChange: function (e) {
      e.preventDefault();
      let last = this.formElements.length - 1;
      this.formElements[last].model = e.target.files[0];
    },
    submit: async function (e) {
      e.preventDefault();
      const formData = new FormData();

      if (this.formType == "login") {
        formData.append("account", this.formElements[0].model);
        formData.append("password", this.formElements[1].model);
        this.$store.dispatch("login", formData);
      } else {
        formData.append("userId", shortid());
        formData.append("account", this.formElements[0].model);
        formData.append("password", this.formElements[1].model);
        formData.append("userName", this.formElements[2].model);
        formData.append("age", this.formElements[3].model);
        formData.append("address", this.formElements[4].model);
        formData.append("avatar", this.formElements[5].model);
        this.$store.dispatch("register", formData);
      }
    },
  },
};
</script>
<style  scoped>
.form {
  background-color: white;
  width: 30%;
  padding: 20px 20px;
  border-radius: 8px;
}
.form--title {
  text-align: center;
  font-weight: bold;
}
.form--label {
  font-weight: bold;
  font-size: 16px;
}
.form--control {
  width: 100%;
  height: 30px;
  border: none;
  font-size: 18px;
  border-bottom: 1px solid #d3d3d3;
  outline: none;
  display: block;
  margin-top: 7px;
  margin-bottom: 10px;
}
.form--file {
  border: none;
}
.form--register {
  width: 100%;
  display: block;
  padding: 8px;
  margin-top: 25px;
  font-size: 20px;
  border-radius: 54px;
  border: none;
  outline: none;
  color: white;
  background: #f46b45; /* fallback for old browsers */
  background: -webkit-linear-gradient(
    to left,
    #f46b45,
    #eea849
  ); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(
    to left,
    #f46b45,
    #eea849
  ); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.form--register:hover {
  cursor: pointer;
}
.form--redirect {
  font-size: 13px;
  font-weight: bold;
}
.span--redirect {
  color: #eea849 !important;
  text-decoration: none;
}
.span--redirect:hover {
  text-decoration: underline;
}
</style>>

