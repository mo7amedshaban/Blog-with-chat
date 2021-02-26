<template lang="pug">
b-container
 div.row
  div.col-md-9.d-flex.align-items-center(v-if="isSearching")
   div.m-auto
    b-spinner( style="width: 4rem; height: 4rem;" label="Large Spinner" variant="danger")
  div.col-md-9.d-flex.align-items-center.justify-content-center(v-else-if="no_posts")
    div.d-block
      b-iconstack(font-scale="5" animation="cylon")
        b-icon(icon="search" stacked
            animation="throb"
            variant="info"
            scale="0.75")
        b-icon(stacked='' icon='slash-circle' animation='spin-reverse' variant='danger')
    div.clearfix.d-block
     b-card-text.d-block No Result Found

  div.col-md-9(v-else )
   div.media.simple-post(v-for='post in posts.data', :key='post.id')
      .media-body.row
        img.mr-3(:src="'photos/'+post.image", alt='Generic placeholder image')
        div.float-right
            h4.mt-0
                 router-link(:to="'/post/'+post.slug" ) {{ post.title}}
            |              {{post.body.substr(0,150)}}
        ul.list-inline.list-unstyled.post-info
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
   pagination.justify-content-center(:data="posts" @pagination-change-page="getPosts")
    span(slot='prev-nav') Previous
    span(slot='next-nav') Next

  // Search Widget
  div.col-md-3
   div.card.my-4
     h5.card-header Search
      .card-body
        .input-group
          input.form-control(type='text', placeholder='Search for...' , v-model="searchPost" class="border border-success")
   categories
</template>

<script>
import categories from "./Categories.vue";
export default {
    data() {
        return {
            posts: {}, //must {} for pagination
            searchPost: "",
            isSearching: false,
            no_posts: false
        };
    },
    components: { categories },
    watch: {
        searchPost(v_modelInput, page = 1) {
            if (v_modelInput.length > 0) {
                this.isSearching = true;
                axios
                    .get("/api/searchposts/" + v_modelInput + "/?page=" + page) //page for pagination
                    .then(res => {
                        this.posts = res.data;
                        // if word not found
                        if (Object.keys(res.data.data).length == 0) {
                            this.no_posts = true;
                        }

                        console.log("search", res.data);
                    })
                    .catch(err => console.log(err));
            } else {
                let old_posts = JSON.parse(localStorage.getItem("posts"));
                this.posts = old_posts;
            }
            //this.isSearching = false;
            new Promise((resolve, reject) => {
                resolve();
                setInterval(() => {
                    this.isSearching = false;
                }, 1000);
            });
            this.no_posts = false;

            // new Promise((resolve, reject) => {
            //     resolve();
            //     setInterval(() => {
            //         this.no_posts = false;
            //     }, 5000);
            // });
        }
    },
    mounted() {
        //perform after DOM is created
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            //page for pagination
            axios
                .get("/api/posts/?page=" + page)
                .then(res => {
                    this.posts = res.data;
                    localStorage.setItem("posts", JSON.stringify(this.posts));
                })
                .catch(err => console.log(err));
        }
    }
};
</script>

<style lang="scss" scoped>
// div.col-md-4{margin-top:-500px}
</style>
