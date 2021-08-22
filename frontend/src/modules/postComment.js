// import notificationService from "../services/notification";  
import genericService from "../services/generic"; 

export default {
    namespaced: true,
    state: { 
        loading: false,
        errors: null,  
        post: null,   
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
        setList(state, response) {
            state.list = response;
            state.loading = false;
        }, 
    },
    
    actions:{  
  
        // add: async ({ commit, state }) => {          
        //     try {  
        //         let response = await genericService.postRequest("ip-address", state.post);                   
        //         commit("setPost", response);
        //         commit("errors", null); 
        //         notificationService.successModal(response.message);
        //     } catch (errors) {    
        //         if(errors.status == 400){
        //             notificationService.errorModal(errors.errors.message);
        //         }      
        //         commit("errors", errors);
        //     }
        // }, 
 
        getPost: async ({ commit }) => {
            commit("loading", true); 
            try {   
                //assume post id is existing
                let response = await genericService.getRequest("api/posts/8dd56a09-33df-4c33-b52f-2f8a5b468abf"); 
                console.log(response);           
                commit("setPost", response.data); 
                commit("loading", false);
            } catch (errors) {
                commit("errors", errors);
                commit("loading", false);
            }
        }, 
    }
}