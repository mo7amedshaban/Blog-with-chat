import Post from "../components/user/Posts.vue";
import PostDetails from "../components/user/PostDetails.vue";
import CategoryPosts from "../components/user/CategoryPosts.vue";
import AllNotifications from "../components/user/AllNotifications.vue";
import contact from "../components/user/Contact.vue";
import setting from "../components/user/Setting.vue";
import Edit_User_Profile from "../components/user/EditUserProfile.vue";


const routes = [{
        path: "/",
        component: Post,
        name: "Post"
    },
    {
        path: "/contact",
        component: contact,
        name: "contact"
    },
    {
        path: "/post/:slug",
        component: PostDetails,
        name: "PostDetails"
    },
    {
        path: "/category/:slug/posts",
        component: CategoryPosts,
        name: "CategoryPosts"
    },
    {
        path: "/notifications",
        component: AllNotifications,
        name: "AllNotifications"
    },
    {
        path: "/setting",
        component: setting,
        name: "setting"
    },
    {
        path: "/Edit_User_Profile",
        component: Edit_User_Profile,
        name: "EditUserProfile"
    },


];
export default routes;
