<template lang="pug">
.dropdown
  button.dropbtn
    i.fa.fa-bell
    span.badge.badge-danger {{ notifications.length }}
    i.fa.fa-caret-down
  .dropdown-content
    .media.p-2(v-for="(n, i) in notifications", :key="i")
      img.mr-2(
        style="    height: 60px;width: 60px;",
        :src="'/user/' + n.data.comment_owner.profile_img",
        alt="commenter image"
      )
      .media-body
        .mt-0
          strong {{ n.data.comment_owner.name }}
          |
          | added a comment on your post
        router-link.p-0(:to="`/post/${n.data.post.slug}`", target="_blank") {{ n.data.post.title }}
        p.m-0
          i.fa.fa-clock-o.mr-1
          |
          | {{ formatTime(n.data.commented_at) }}
    div
      router-link.see-all(:to="'/notifications'")
        i.fa.fa-bell-o.mr-2
        |   See All
</template>

<script>
export default {
    data() {
        return {};
    },
    mounted() {
        this.getUnreadNotifications();
    },

    computed: {
        notifications() {
            return this.$store.state.notifications;
        }
    },
    methods: {
        formatTime(date) {
            let d = new Date(date);
            return `${d.getFullYear()}/${d.getMonth()}/${d.getDate()}`;
        },
        getUnreadNotifications() {
            axios
                .get("/api/getUnreadNotifications")
                .then(res => {
                    this.$store.state.notifications = res.data;
                    //mutation
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style scoped>

.dropdown .dropbtn {
    font-size: 16px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}
.navbar a:hover,
.dropdown:hover .dropbtn {
    background-color: #686e73;
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    min-width: 287px;
    max-height: 400px;
    overflow: auto;
}
.dropdown-content .media-body > div {
    font-size: 15px;
    line-height: 1.3;
}
.dropdown-content .media-body a {
    float: none;
    color: #1580dc;
    background: none;
    text-decoration: none;
    display: block;
    text-align: left;
}
.see-all {
    color: #000;
    background: #e4dede;
    text-decoration: none;
    text-align: center !important;
    display: block;
    padding: 4px;
}
.dropdown-content p {
    font-size: 14px;
}
.dropdown-content a:hover {
    background-color: #ddd;
}
.dropdown:hover .dropdown-content {
    display: block;
}
</style>
