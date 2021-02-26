import Admin_Panel from "../components/admin/Index.vue";
import AdminLogin from "../components/admin/Admin-login";
const routes = [
    {
        path: "/admin-panel",
        component: Admin_Panel,
        name: "Admin_Panel"
    },
    {
        path: "/admin",
        component: AdminLogin,
        name: "AdminLogin"
    }

]
export default routes;
