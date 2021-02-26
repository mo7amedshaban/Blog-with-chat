<template lang="pug">
b-container
  b-tabs(
    content-class="mt-5",
    align='center',
    active-nav-item-class="font-weight-bold text-uppercase text-danger"
  )
    b-tab(title="Profile", title-item-class="w-20", active)
      b-card-group.d-block(deck)
        .d-flex.justify-content-center
          b-card-img.rounded-50(:src="'user/' + image", alt="Image")
        .blockFile.d-flex.justify-content-center.clearfix
          b-form-file.mt-3(accept="image/*", @change="onImageChanged") ok
          .overlay Edit
            b-icon.ml-2(icon="pen", aria-hidden="true")
        b-card.my-5(
          header="username",
          text-variant="white",
          border-variant="dark",
          header-bg-variant="dark"
        )
          b-form-input.m-auto(v-model="username", name="username")
        b-card.my-5(
          header="Email",
          text-variant="white",
          header-bg-variant="dark",
          border-variant="dark"
        )
          b-form-input.m-auto(v-model="email")
        b-card.my-5(
          header="Phone",
          text-variant="white",
          border-variant="dark",
          header-bg-variant="dark"
        )
          b-form-input.m-auto(v-model="phone")

      .d-flex.justify-content-center
        b-button(
          variant="outline-danger",
          size="lg",
          @click="update_user_profile"
        ) Save
</template>
<script>
export default {
  data() {
    return {
      id: null,
      username: null,
      image: "",
      email: null,
      phone: null,
    };
  },
  mounted() {
    this.userInfo();
  },
  created() {
    this.updateToken();
  },
  methods: {
    updateToken() {
      let token = JSON.parse(localStorage.getItem("userToken"));
      this.$store.commit("setUserToken", token);
    },
    onImageChanged(event) {
      this.image = event.target.files[0]; // in vue.js   inspect    appear file  not changed
      console.log("image", this.image);
    },
    userInfo() {
      axios.get("/api/user").then((response) => {
        console.log(response.data.user);
        this.id = response.data.user.id;
        this.username = response.data.user.username;
        this.email = response.data.user.email;
        this.phone = response.data.user.phone;
        this.image = response.data.user.profile_img;
      });
    },
    update_user_profile() {
      let data = new FormData();
      // data.set("username", this.username);
      data.set("image", this.image);
      data.set("email", this.email);
      data.set("phone", this.phone);
      data.set("username", this.username);
      axios
        .post(`/api/update_user_profile/${this.id}`, data)
        .then((response) => {
          console.log("update_user_profile", response.data);
          console.log("username", this.username);
          this.$router.push('/setting');
        });
    },
  },
};
</script>

 <style lang="scss"  scoped>
* {
  box-sizing: border-box;
}

::v-deep .card-img {
  width: 250px;
  height: 200px;
  border: 2px solid yellow;
  border-radius: 50%;
  box-shadow: 2px 2px 0px 0.5px rgba(232, 7, 105, 0.84),
    -2px -2px 0px 0.5px rgba(232, 7, 105, 0.84);
}
.blockFile {
  position: relative;
  ::v-deep .custom-file {
    width: 80px;
    white-space: nowrap;
    overflow: hidden;
    .custom-file-label {
      opacity: 0;
      z-index: 999;
    }
  }
  .overlay {
    position: absolute;
    background: green;
    border: 1px solid yellow;
    cursor: pointer;
    padding: 5px;
    text-align: center;
    border-radius: 13%;
    top: 17%;
    color: white;
  }
}

/******************/
</style>
