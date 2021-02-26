<template lang="pug">
b-container
    .col-md-9.m-auto
      .media.simple-post(v-for='post in posts', :key='post.id')
        img.mr-3(:src="'/photos/'+post.image", alt='Generic placeholder image')
        .media-body.row
          div.float-right
            h4.mt-0
                router-link(:to="'/post/'+post.slug") {{ post.title}}
            |              {{post.body.substr(0,150)}}
          ul.list-inline.list-unstyled.post-info.ml-0.pl-0
            li
              span
                i.fa.fa-user
                |  posted by :
                strong.text-primary {{ post.user.username}}
            li |
            li
              span
                i.fa.fa-calendar
                 | {{ post.added_at}}
            li |
            span
              i.fa.fa-comment
              |  {{post.comments_count}} comments

</template>
<script>
export default {
    data() {
        return {
            posts: []
        };
    },
    mounted() {
        console.log("Component mounted.");
        this.getPosts();
    },
    methods: {
        getPosts() {
            axios
                .get("/api/category/" + this.$route.params.slug + "/posts")
                .then(res => {
                    // console.log(res)
                    this.posts = res.data;
                })
                .catch(err => console.log(err));
        }
    }
};
</script>
