import genericService from "../services/generic"; 

export default {
    namespaced: true,
    state: { 
        loading: false,
        errors: null,  
        data: null,   
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
        setData(state, data){
            state.data = data;  
        },   
        setList(state, response) {
            state.list = response;
            state.loading = false;
        }, 
    },
    
    actions:{   
        getAuditLogs: async ({ commit }) => {
            commit("loading", true); 
            try {   
                let response = await genericService.getRequest("logs");            
                commit("setList", response.list); 
                commit("loading", false);
            } catch (errors) {
                commit("errors", errors);
                commit("loading", false);
            }
        },
    }
}