const mutations = {
    setUserToken(state, userToken) {
        state.userToken = userToken;
        localStorage.setItem("userToken", JSON.stringify(userToken));
        axios.defaults.headers.common.Authorization = `Bearer ${userToken}`; //store token in cookie in this browser
    },
    setUser(state, user) {
        //for check store all details of user is admin  or not
        state.user = user;
        Echo.connector.pusher.config.auth.headers.Authorization = `Bearer ${state.userToken}`; //here can use ${state.user}

        Echo.private(`users.${state.user.id}`) // run and not error
            .notification(notification => {
                //error here  .notification
                state.notifications.unshift(notification);
            });
    },
    logout(state) {
        state.userToken = null;
        localStorage.removeItem("userToken");
        window.location.pathname = "/"; //   go to home page
        //this.$router.push('/')
    },
    EditPost(state, post) {
        state.EditedPost = post;
    }
};

export default mutations;
