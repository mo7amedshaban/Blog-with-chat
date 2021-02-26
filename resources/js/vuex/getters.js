const getters = {
    isLogged(state) {
        return !!state.userToken;
    },
    isAdmin(state) {
        if (state.user) {
            return state.user.is_admin; //return 1 or 0

        }
        return null;
    },
    PostToEdit(state) {
        return state.EditedPost;
    }
}


export default getters;
