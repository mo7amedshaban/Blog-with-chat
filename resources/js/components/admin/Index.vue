<template lang="pug">
#cont
  div
    .table-wrapper
      .table-title
        .row
          .col-sm-4
            h2
              | Manage
              b Posts
          .col-sm-8
            a.btn.btn-success(href='#addPostModal', data-toggle='modal')
              i.material-icons 
              span New Post
            a.btn.btn-danger(href='#deletePostModal', data-toggle='modal' v-if="selectedPosts.length")
              i.material-icons 
              span Delete
            a.btn.btn-danger(href='#deletePostModalnopost', data-toggle='modal' v-if="!selectedPosts.length")
              i.material-icons 
              span Delete
      .table-responsive-sm
       table.table.table-striped.table-hover
        thead
          tr.text-center
            th
              span.custom-checkbox
                input#selectAll(type='checkbox' @click="selectAll($event)")
                label(for='selectAll')
            th Title
            th Body
            th Category
            th Image
            th User
            th Action
        tbody(v-if="posts.data")
          tr.text-center(v-for="(post,index) in posts.data" :key="index")
            td
              span.custom-checkbox
                input(type='checkbox', name='options[]', value='1' :id="index" , :checked="allCheckBoxes",@click.stop="selectPost(post,$event)")
                label
            td  {{post.title}}
            td {{post.body.substr(0,150)}}
            td
              span.badge.badge-info.p-1.mb-1  {{post.category.name}}
            td
              img(:src="'photos/'+post.image", style='width:100px;height:60px;border:1px solid #e7e7e7', alt='')
            td  {{post.user.username}}
            td
              a.edit(href='#editPostModal'  data-toggle='modal'  @click="editPost(post,$event)")
                i.material-icons(data-toggle='tooltip', title='Edit') 
              a.delete(href='#deletePostModal', data-toggle='modal' )
                i.material-icons(data-toggle='tooltip', title='Delete') 
              router-link(:to="'/post/'+post.slug" )
                i.material-icons(data-toggle='tooltip', title='Delete') 👁

    pagination.justify-content-center(:data='posts', @pagination-change-page='getPosts')
            span(slot='prev-nav') Previous
            span(slot='next-nav') Next

  // Edit Modal HTML
  #addPostModal.modal.fade
    .modal-dialog
      .modal-content
        form(enctype='multipart/form-data')
          .modal-header
            h4.modal-title Add Post
            button.close(type='button', data-dismiss='modal', aria-hidden='true') ×
          .modal-body
            .form-group
              label Title
              input.form-control(type='text', required='' v-model="title")
            .form-group
              label Body
              textarea.form-control(name='', cols='30', rows='10' v-model="body")
            .form-group
              label Choose Category
              select.form-control(name='' v-model="category_id")
                option(value='0', disabled='', selected='') choose category
                option(:value="category.id" v-for="category in categories" :key="category.id")
                  |  {{category.name}}
            .form-group
              label Image
              div.block.w-50.justify-content-center
                input.form-control.image(type='file', required='' @change="onImageChanged")
                div.overlay
                    b-icon(icon="image" aria-hidden="true" )
          .modal-footer
            input.btn.btn-default(type='button', data-dismiss='modal', value='Cancel')
            input.btn.btn-success(type='submit', value='Add' @click.prevent="addPost")
  // Delete Modal HTML
  #deletePostModal.modal.fade
    .modal-dialog
      .modal-content
        form
          .modal-header
            h4.modal-title Delete Post
            button.close(type='button', data-dismiss='modal', aria-hidden='true') ×
          .modal-body
            p Are you sure you want to delete these Records?
            p.text-danger
              small
                | Selected Posts :
                strong {{ selectedPosts.length}}
          .modal-footer
            input.btn.btn-default(type='button', data-dismiss='modal', value='Cancel')
            input.btn.btn-danger(type='submit', value='Delete' @click.prevent="deletePosts()")
  editpost
  // Delete Modal HTML
  #deletePostModalnopost.modal.fade
    .modal-dialog
      .modal-content
        form
          .modal-header
            h4.modal-title Delete Post
            button.close(type='button', data-dismiss='modal', aria-hidden='true') ×
          .modal-body
             p No post selected !

</template>

<script>
import editpost from "./EditPost";
export default {
    components: {
        editpost
    },
    data() {
        return {
            posts: {}, // {}  for pagination
            title: "",
            body: "",
            image: "",
            category_id: "",
            categories: [],
            selectedPosts:[], //All ids  of checkBoxes
            allCheckBoxes: false
        };
    },
    created() {
        this.updateToken();
        this.getPosts();
        this.getCategories();
    },
    methods: {
        updateToken() {
            let token = JSON.parse(localStorage.getItem("userToken"));
            this.$store.commit("setUserToken", token);
        },
        getPosts(page = 1) {
            axios
                .get("/api/admin/posts/?page=" + page)
                .then(response => {
                    this.posts = response.data;
                    console.log("getPosts -> this.posts", this.posts);
                })
                .catch(error => {
                    console.log("getPosts -> error", error);
                });
        },
        getCategories() {
            axios
                .get("/api/admin/categories")
                .then(response => {
                    this.categories = response.data;
                    console.log(
                        "getCategories -> this.categories",
                        this.categories
                    );
                })
                .catch(error => {
                    console.log("getCategories -> error", error);
                });
        },
        onImageChanged(event) {
            this.image = event.target.files[0]; // in vue.js   inspect    appear file  not changed
            console.log("onImageChanged -> this.image", this.image);
        },

        addPost() {
            // formdata   easy for send multipart files
            let config = {
                headers: { "content-type": "multipart/form-data" }
            };
            let formdata = new FormData();
            formdata.append("title", this.title);
            formdata.append("body", this.body);
            formdata.append("image", this.image);
            formdata.append("category_id", this.category_id);
            axios.post("/api/admin/addPost", formdata, config).then(res => {
                console.log(res);
                this.title = "";
                this.body = "";
                this.category_id = "";
                this.image = "";
                $("#addPostModal").modal("hide");
                $(".modal-backdrop").css("display", "none");
            });
        },
        editPost(post, event) {
            // event  controll element html in Dom   color  , preventDefault , ect ..
            this.$store.commit("EditPost", post);
            // if (event) {
            //     alert(event.target.tagName);
            // }
        },
        selectAll(event) {
            if (event.target.checked) {
                //$('input[type="checkbox"]').prop('checked',true)
                this.allCheckBoxes = true;
                this.posts.data.forEach( (post) => {
                    this.selectedPosts.push(post.id);
                    console.log("selectAll -> this.selectedPosts", this.selectedPosts);

                });
            } else {
                // $('input[type="checkbox"]').prop('checked',false)
                this.allCheckBoxes = false;

                this.selectedPosts = [];
            }
        },
        selectPost(post,event){
			let index = this.selectedPosts.indexOf(post.id);   // post you has it  define index in array
			if(index > -1){   // if exist    --> remove
				this.selectedPosts.splice(index,1)
				event.target.checked = false //uncheck
			}else{  // if not exist    --> add
				 this.selectedPosts.push(post.id);
				 event.target.checked = true;
			}
        },
        deletePosts(){
			 axios.post('/api/admin/deletePosts',{posts_ids: this.selectedPosts})
			 .then(res => {
				 console.log(res.data)
				 $('#deletePostModal').modal('hide');
				$('.modal-backdrop').css('display','none');
                // this.allCheckBoxes = false;
                 this.getPosts();  // for refresh

			 })
			 .catch(err =>{
				 console.log(err)
			 })
        },

    }
};

// $(document).ready(function() {
//     // for select all checkboxes
//     // Activate tooltip
//     $('[data-toggle="tooltip"]').tooltip();
//     // Select/Deselect checkboxes
//     var checkbox = $('table tbody input[type="checkbox"]');
//     $("#selectAll").click(function() {
//         if (this.checked) {
//             checkbox.each(function() {
//                 this.checked = true;
//             });
//         } else {
//             checkbox.each(function() {
//                 this.checked = false;
//             });
//         }
//     });
//     checkbox.click(function() {
//         if (!this.checked) {
//             $("#selectAll").prop("checked", false);
//         }
//     });
// });
</script>

<style lang="scss" scoped>
::v-deep .modal-content{width:130%;}
.block{
    position:relative;


    .image{
            position: absolute;
            opacity: 0;
            z-index: 1;
            overflow: hidden;
            width:18%;

    }

    .overlay{
        position:absolute;
    }
    .b-icon{
            font-size: 30px;
            color: #ea5a6f;
            text-align:center;

    }
}

#cont {
    color: #566787;
    background: white;
    font-family: "Varela Round", sans-serif;
    font-size: 13px;
}
.table-wrapper {
    background: #fff;
    padding: 20px 25px;
    margin: 30px 0;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    padding-bottom:0px;
}
.table-title {
    padding-bottom: 15px;
    background: #435d7d;
    color: #fff;
    padding: 16px 30px;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}
.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}
.table-title .btn-group {
    float: right;
}
.table-title .btn {
    color: #fff;
    float: right;
    font-size: 13px;
    border: none;
    min-width: 50px;
    border-radius: 2px;
    border: none;
    outline: none !important;
    margin-left: 10px;
}
.table-title .btn i {
    float: left;
    font-size: 21px;
    margin-right: 5px;
}
.table-title .btn span {
    float: left;
    margin-top: 2px;
}
table.table tr th,
table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}
table.table tr th:first-child {
    width: 60px;
}
table.table tr th:last-child {
    width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table td:last-child i {
    opacity: 0.9;
    font-size: 22px;
    margin: 0 5px;
}
table.table td a {
    font-weight: bold;
    color: #566787;
    display: inline-block;
    text-decoration: none;
    outline: none !important;
}
table.table td a:hover {
    color: #2196f3;
}
table.table td a.edit {
    color: #ffc107;
}
table.table td a.delete {
    color: #f44336;
}
table.table td i {
    font-size: 19px;
}
table.table .avatar {
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 10px;
}
// .pagination {
//     float: right;
//     margin: 0 0 5px;
// }
// .pagination li a {
//     border: none;
//     font-size: 13px;
//     min-width: 30px;
//     min-height: 30px;
//     color: #999;
//     margin: 0 2px;
//     line-height: 30px;
//     border-radius: 2px !important;
//     text-align: center;
//     padding: 0 6px;
// }
// .pagination li a:hover {
//     color: #666;
// }
// .pagination li.active a,
// .pagination li.active a.page-link {
//     background: #03a9f4;
// }
// .pagination li.active a:hover {
//     background: #0397d6;
// }
// .pagination li.disabled i {
//     color: #ccc;
// }
// .pagination li i {
//     font-size: 16px;
//     padding-top: 6px;
// }
.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}
/* Custom checkbox */
.custom-checkbox {
    position: relative;
}
.custom-checkbox input[type="checkbox"] {
    opacity: 0;
    position: absolute;
    margin: 5px 0 0 3px;
    z-index: 9;
}
.custom-checkbox label:before {
    width: 18px;
    height: 18px;
}
.custom-checkbox label:before {
    content: "";
    margin-right: 10px;
    display: inline-block;
    vertical-align: text-top;
    background: white;
    border: 1px solid #bbb;
    border-radius: 2px;
    box-sizing: border-box;
    z-index: 2;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
    content: "";
    position: absolute;
    left: 6px;
    top: 3px;
    width: 6px;
    height: 11px;
    border: solid #000;
    border-width: 0 3px 3px 0;
    transform: inherit;
    z-index: 3;
    transform: rotateZ(45deg);
}
.custom-checkbox input[type="checkbox"]:checked + label:before {
    border-color: #03a9f4;
    background: #03a9f4;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
    border-color: #fff;
}
.custom-checkbox input[type="checkbox"]:disabled + label:before {
    color: #b8b8b8;
    cursor: auto;
    box-shadow: none;
    background: #ddd;
}
/* Modal styles */
.modal .modal-dialog {
    max-width: 400px;
}
.modal .modal-header,
.modal .modal-body,
.modal .modal-footer {
    padding: 20px 30px;
}
.modal .modal-content {
    border-radius: 3px;
}
.modal .modal-footer {
    background: #ecf0f1;
    border-radius: 0 0 3px 3px;
}
.modal .modal-title {
    display: inline-block;
}
.modal .form-control {
    border-radius: 2px;
    box-shadow: none;
    border-color: #dddddd;
}
.modal textarea.form-control {
    resize: vertical;
}
.modal .btn {
    border-radius: 2px;
    min-width: 100px;
}
.modal form label {
    font-weight: normal;
}
</style>
