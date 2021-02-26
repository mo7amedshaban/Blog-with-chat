<template lang="pug">
nav.navbar.navbar-expand-lg.navbar-dark.bg-dark.fixed-top
  .container
    a.navbar-brand(href='/setting') Hi
      p.d-inline.pl-2.text-info(v-if="user") {{ user.username}}
    notificationBar
    button.navbar-toggler(type='button', data-toggle='collapse', data-target='#navbarResponsive', aria-controls='navbarResponsive', aria-expanded='false', aria-label='Toggle navigation')
      span.navbar-toggler-icon
    #navbarResponsive.collapse.navbar-collapse
      ul.navbar-nav.ml-auto
        li.nav-item
          router-link.nav-link(to='/') Home
        li.nav-item
          router-link.nav-link(to='/chat-app' v-if="isLogged") Chat
        li.nav-item(v-if="isLogged")
          router-link(to="/setting",variant="danger") Setting
        li.nav-item(v-if="isLogged", @click.stop='logout')
          router-link.text-danger(to="/",variant="danger") Log Out
        li.nav-item(v-if="!isLogged")
          register
        li.nav-item(v-if="!isLogged")
          login
</template>

<script>
import notificationBar from './NotificationBar.vue';
import { mapGetters, mapState, mapActions,mapMutations } from "vuex";
export default {
    data(){
        return{

        }
    },
    computed: {
        ...mapGetters(["isLogged", "isAdmin"]),
        ...mapState(["user"])
    },
    components:{notificationBar},
    created() {
        this.updateToken();
        this.update_setUser();
    },
    methods: {
        ...mapMutations(['logout']),
        updateToken() {
            let token = JSON.parse(localStorage.getItem("userToken"));
            this.$store.commit("setUserToken", token);
        },
         update_setUser() {
            if (this.isLogged) {
                axios.get("/api/user").then(res => {
                    this.$store.commit("setUser", res.data.user);
                    console.log('user-data',res.data.user);
                });
            }
        },

    }
};
</script>
<style lang="scss" scoped>

a{
    color:#22f146;
    text-decoration: none;
    font-size: 21px;
}
a:hover{color:white;}

.navbar-dark .navbar-nav .nav-link[data-v-582473d9]{
    color: #22f146;
    font-size: 21px;
}
.navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link:focus {color:white;}
</style>
