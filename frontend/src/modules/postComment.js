 import genericService from "../services/generic"; 

export default {
    namespaced: true,
    state: { 
        loading: false,
        errors: null,  
        post: null,  
        comment: null, 
        list: [], 
    },

    mutations: {
        loading(state, value) {
            state.loading = value;
        }, 
        errors(state, errors) {
            state.errors = errors;
            state.loading = false;
        },  
        setPost(state, post){
            state.post = post;  
        },   
        setComment(state, comment){
            state.comment = comment;  
        },  
        setList(state, response) {
            state.list = response;
            state.loading = false;
        }, 
    },
    
    actions:{   
        addComment: async ({ commit, state }) => {          
            try {   
                let response = await genericService.postRequest(`api/posts/${state.comment.post_id}/comments`, state.comment);                            
                commit("setComment", response);
                commit("errors", null);  
            } catch (errors) {     
                commit("errors", errors);
            }
        }, 
 
        getPost: async ({ commit }) => {
            commit("loading", true); 
            try {   
                //assume post id is existing
                let response = await genericService.getRequest("api/posts/8dd56a09-33df-4c33-b52f-2f8a5b468abf");                    
                commit("setPost", response.data); 
                commit("loading", false);
            } catch (errors) {
                commit("errors", errors);
                commit("loading", false);
            }
        }, 
    }
}