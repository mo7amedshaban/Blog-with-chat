<template lang="pug">
b-container
  b-tabs(
    content-class="mt-5",
    align='center',
    active-nav-item-class="font-weight-bold text-uppercase text-danger"
  )
    b-alert(show variant="danger" v-if="errors && errors.password") {{errors.password[0]}}
    b-alert(v-if="success" show variant="success") Password Changed
        i(class="far fa-check-circle")
    b-tab(title="Profile", title-item-class="w-20", active)
      .clearfix
        b-button.float-right.text-info(variant="warning")
          router-link(to="/Edit_User_Profile")
            | Edit
            b-icon.ml-2.text-info(icon="pen", aria-hidden="true")

      b-card-group.d-block(deck)
        .d-flex.justify-content-center
          b-card-img.rounded-50(
            :src="'user/'+image",
            alt="Image"
          )
        b-card.my-3(
          header="username",
          text-variant="white",
          border-variant="dark",
          header-bg-variant="dark"
        )
          b-card-text.py-2 {{username}}
        b-card.my-3(
          header="Email",
          text-variant="white",
          header-bg-variant="dark",
          border-variant="dark"
        )
          b-card-text.py-2 {{email}}
        b-card.my-3(
          header="Phone",
          text-variant="white",
          border-variant="dark",
          header-bg-variant="dark"
        )
          b-card-text.py-2 {{phone}}
    b-tab(title="Change Password", title-item-class="w-20")
       b-card-group.d-block.mt-5(deck)
         b-card.my-5(header='New Password' text-variant="white" border-variant="dark" header-bg-variant='dark')
            b-form-input.m-auto(v-model="password" type="password")
         b-card.my-4(header='Confirm Password' text-variant="white" header-bg-variant="dark" border-variant='dark')
            b-form-input.m-auto(v-model="password_confirmation" type="password")
       div.d-flex.justify-content-center
         b-button.mt-2(variant="outline-danger" size="lg" @click="changePassword") Save
</template>

<script>
export default {
  data() {
    return {
        errors:{},
        success:false,
      id:null,
      username: null,
      image:null,
      email: null,
      phone: null,
      password:null,
      password_confirmation:null,
    };
  },
  created(){
      this.updateToken();
  },
  mounted() {
    this.userInfo();
  },
  methods:{
    updateToken() {
      let token = JSON.parse(localStorage.getItem("userToken"));
      this.$store.commit("setUserToken", token);
    },
    userInfo()
    {
      axios.get("/api/user").then((response) => {
        console.log(response.data.user);
        this.id= response.data.user.id;
        this.username = response.data.user.username;
        this.email = response.data.user.email;
        this.phone = response.data.user.phone;
        this.image =response.data.user.profile_img;
      });
    },
    changePassword(){

        let {password,password_confirmation} = this
        axios.post(`/api/change_password/${this.id}`,{password,password_confirmation}).then(response=>{
            console.log('changePassword',response.data);
            this.fields = {};
                this.errors = {};
                this.success = true;
        }).catch(error => {
                    if (error.response.status == 422) {  // error in console
                         this.errors = error.response.data.errors;
                         this.success = false;
                    }
            });
    },
  },
};
</script>

 <style lang="scss"  scoped>
* {
  box-sizing: border-box;
}
a:hover {
  text-decoration: none;
}
::v-deep .card-img {
  width: 250px;
  height: 200px;
  border: 2px solid yellow;
  border-radius: 50%;
  box-shadow: 2px 2px 0px 0.5px rgba(232, 7, 105, 0.84),
    -2px -2px 0px 0.5px rgba(232, 7, 105, 0.84);
}
.fa-check-circle{
    font-size: 26px;
    float: right;
}
// @media(min-width:1200px){
//     .original{
//           margin-left: -156px;
//     }
// }

// @media screen and (max-width: 414px){
//      ::v-deep .original{top:-13px;}
//      ::v-deep .card-body{  padding: 0px;}
//      ::v-deep #__BVID__15__BV_tab_controls_{
//         padding:0px;
//         width:73%;
//         border-right:.25px grey solid;
//     }
//     ::v-deep .nav-pills .nav-link{ margin-top:6px;}
//     ::v-deep .nav-pills .nav-link.active, .nav-pills .show > .nav-link{
//         background:yellow;
//         color:blue;
//         font-weight:500;
//     }
//     ::v-deep .card-deck .card {
//         margin-left: -13%;
//         margin-right: 6%;
//     }
//     ::v-deep .card-text{
//         padding: 8px;
//         font-size: 14px;

//     }
//     ::v-deep .profile-img img{display:flex; margin-top:12% }
//     ::v-deep .profile-img .file{display:flex; top:6px;}
//     ::v-deep #__BVID__20{
//         .card-text{
//             margin-left: -13%;
//             margin-right: 20;
//             font-size: 18px;
//         }
//         .buttons{
//             float:right;
//             margin-right:2%;
//             margin-top:13%;
//             button{
//                 margin-left:7px;
//             }

//         }
//     }

// }
// @media screen and (min-width: 415px) and (max-width: 800px ){
//     div{padding:0px;top:-12.5px;
//      .original{margin-left:-7%;
//       ::v-deep .card-deck{
//         // margin-left: -13%;
//         // margin-right: 6%;
//         width:100%;
//          .card{
//              margin-right:3px;
//             .card-text{
//                 padding: 11px;
//                 font-size: 20px;
//                 word-wrap:normal;

//             }
//          }
//       }
//     }
//     ::v-deep .profile-img{
//         margin-top:65px;
//         .file{top:6px;}
//     }
//     ::v-deep #__BVID__15__BV_tab_controls_{
//         margin-right:10px;
//    }
//    ::v-deep .card-text{
//         padding: 8px;
//         font-size: 14px;

//     }
//     .buttons{
//         float:right;
//         button{
//         margin:2px;
//         }
//     }
//     .edit{
//         margin-top: 81px;
//     margin-bottom: 274px;
//     }

//     }
// }

// tab:hover{
//     text-decoration: none;
//     background-color: #eee;
// }
// .profile-img{
//     text-align: center;
// }
// .profile-img img{
//     width: 70%;
//     height: 100%;
// }
// .profile-img .file {
//     position: relative;
//     overflow: hidden;
//     margin-top: -20%;
//     width: 70%;
//     border: none;
//     border-radius: 0;
//     font-size: 15px;
//     word-wrap: normal;;
//     background: #212529b8;

// }
// .profile-img .file input {
//     position: absolute;
//     opacity: 0;
//     right: 0;
//     top: 0;
// }
// .profile-head h5{
//     color: #333;
// }

// //calc(0.25rem - 1px)
</style>
