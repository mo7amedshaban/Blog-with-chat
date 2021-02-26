<template lang="pug">
div.container
  div.col-12
    // Title
    h1.mt-4 {{post.title}}
     //- Author
    p.alert.alert-info(
      style='width: fit-content;\
    padding: 5px;\
    color: #142d31;',
      v-if="post.category"
    )
      | {{ post.category.name }}
    hr
    // Date/Time
    p
      | Posted on
      strong.badge.badge-primary.p-1.time {{ post.added_at }}
      span.float-right
        strong.badge.badge-info.p-1  {{comments.length}}
        |
        | comments
    hr
    // Preview Image
    img.img-fluid.rounded(
      :src="'/photos/'+post.image",
      style="width:900px;max-height:300px",
      alt=""
    )
    hr
    // Post Content
    |
    | {{ post.body }}
    hr
    // Comments Form
    .card.my-4
      h5.card-header Leave a Comment:
      .card-body
        form
          input(type="hidden", name="", v-model="post_id")
          .form-group
            textarea.form-control(rows="3", v-model="body")
          button.btn.btn-primary.float-right(type="submit", @click.prevent="addComment") Submit
    // Single Comment
    .media.mb-4.comment(v-for="(comment,index) in post.comments", :key="index")
      img.d-flex.mr-3.rounded-circle(
        :src="'/user/' + comment.user.profile_img",
        style="height:50px;width:50px",
        alt=""
      )
      .media-body
        h5.mt-0
            strong(v-if="comment.user") {{comment.user.username}}
        |             {{comment.body}}
</template>

<script>
export default {
    data() {
        return {
            post: '',
            post_id: "",
            body: "",
            comments: [], // for get length of comments
        };
    },
    created() {
        this.getPosts();
        this.updateToken();
    },
    methods: {
        getPosts() {
            //  api/posts/{post}       | posts.show       | App\Http\Controllers\PostController@show
            axios
                .get("/api/posts/"+this.$route.params.slug)
                .then(response => {
                    this.post = response.data[0];
                    console.log('post',response.data[0]);
                    this.post_id = this.post.id;
                    this.comments = this.post.comments;
                    this.realTime();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        realTime() {
            Echo.private(`newComment.${this.post_id}`).listen(
                "NewComment",
                e => {
                    this.comments.unshift(e.comment);
                    // add class="comment"   in single comment
                    document.querySelectorAll(".comment").forEach(item => {
                        item.classList.remove("new");
                    });
                    document
                        .querySelectorAll(".comment")[0]
                        .classList.add("new");
                    console.log("realTime -> e", e);
                    console.log("listen ok");
                }
            );
        },
        addComment() {
            //auth:sancatum  must insert token when refresh page or logn in
            //instead of login  must use token
            let { body, post_id } = this;
            axios
                .post("/api/comment/create", { body, post_id })
                .then(res => {
                    this.comments.unshift(res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        },
        updateToken() {
            let token = JSON.parse(localStorage.getItem("userToken"));
            this.$store.commit("setUserToken", token);
        },

    }
};
</script>

<style scoped>
.time{margin-left:2%;}
.comment {
    padding: 0.5rem;
    background: #fff;
}
/* The element to apply the animation to */
.comment.new {
    background-color: #fff;
    animation-name: newComment;
    -webkit-animation-name: newComment;
    animation-duration: 6s;
    -webkit-animation-duration: 6s;
    animation-iteration-count: 1;
    -webkit-animation-iteration-count: 1;
}
@keyframes newComment {
    from {
        background-color: rgb(241, 245, 24);
    }
    to {
        background-color: inherit;
    }
}

/*
 */

</style>
