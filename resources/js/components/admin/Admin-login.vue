<template lang="pug">
div
    section.col-md-4.mx-auto
      b-form
        h2.text-center Log in
        b-alert(show, variant="success", v-if="success") login is Done
        b-form-group.my-3
          b-form-input.form-control(
            type="text",
            name="email",
            v-model="fields.email",
            required
          )
          b-alert.mt-2(show, variant="success", v-if="errors && errors.email") {{ errors.email[0] }}
        b-form-group.my-3
          b-form-input.form-control(
            type="password",
            name="password",
            v-model="fields.password"
          )
          b-alert.mt-2(
            show,
            variant="success",
            v-if="errors && errors.password"
          ) {{ errors.password[0] }}
        b-button(
          type="submit",
          variant="danger",
          block="",
          :disabled="!isvalid",
          @click.prevent="submit",
        ) Log in
        b-button(type="submit", variant="info", block="", :disabled="!isvalid") create account
        //- .clearfix
        //-   p.my-2.text-center: a Forget Password
</template>
<script>
export default {
    data() {
        return {
            fields: {},
            success: false,
            errors: {}
        };
    },
    methods: {
        submit() {
            axios
                .post("/api/loginAdmin", this.fields)
                .then(response => {
                    console.log('loginAdmin',response);
                    this.$store.commit("setUserToken", response.data.token);
                     this.fields = {};
                     this.errors = {};
                     this.success = true;
                    console.log(response.data.token);
                //     //start check if user is admin
                    axios
                        .get("/api/user")
                        .then(res => {
                            this.$store.commit("setUser", res.data.user);
                            console.log('user',res.data.user);
                        }).then(this.$router.push('/admin-panel'));

                //         // end check if user is admin
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        // error in console
                        this.errors = error.response.data.errors;
                        this.success = false;
                        console.log(this.errors);
                    }
                });
        },
        isvalid() {
            let { email, password } = this.fields;
            return { email }.length >= 0 && { password }.length >= 0;
        }
    }
};
</script>
