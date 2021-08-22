<template>
  <div class="mt-2"> 
       <b-card
            border-variant="secondary" 
            header-border-variant="secondary" 
        >
            <b-form-group  
                :state="isValid('user_name')"
                :invalid-feedback="errorMessage('user_name')"    
            >
                <b-form-input
                    id="name"                    
                    placeholder="Your name"
                    v-model="form.user_name"
                    size="sm"
                ></b-form-input>
            </b-form-group> 
            <b-form-group  
                :state="isValid('message')"
                :invalid-feedback="errorMessage('message')"    
            >
                <textarea rows="3" class="form-control border-input"
                            :placeholder="(!is_reply) ? 'Write a comment...' : 'Write a reply...'"
                            size="sm"
                            v-model="form.message">

                </textarea>
            </b-form-group>   
            <b-button href="#" variant="primary"  size="sm" @click="submit()"> {{ ((!is_reply) ? 'Send' : 'Reply') }}</b-button>
        </b-card> 
  </div>  
</template>
 
<script>
import { mapState } from "vuex"; 
export default {
    name: 'add-comment',  
    props: { 
        to_comment_id: {
            type: String,
            required: false,
            default: null
        },
        is_reply: {
            type: Boolean,
            required: false,
            default: false
        },
        post_id: {
            type: String,
            required: true
        },
    },
    
    data() {
        return {  
            form: {
                user_name: null,
                message: null, 
            },  
        }
    },

    computed: {  
        ...mapState("postComment", ["errors", "comment"]),  
    }, 
    methods: { 
        async submit(){  
            this.form.to_comment_id = this.to_comment_id 
            this.form.post_id = this.post_id 
            this.$store.commit("postComment/setComment", this.form);  
            await this.$store
            .dispatch("postComment/addComment")
            .then(() => {   
                if(this.errors == null) {           
                    this.clearForm(); 
                    this.alertSuccess = true;
                    this.alertMessage = this.comment.message;  
                } 
            });   
            await this.$store.dispatch("postComment/getPost"); 
        },
        //validations
        errorMessage(field) {    
            if (this.errors == null) {
                return "";
            }        
            return this.errors.errors[field];
        },
        
        isValid(field) {   
            if (this.errors == null) {
                return false;
            } 
            
            return this.errors.errors[field] ? false : true;
        },  

        clearForm(){  
            this.form.user_name = null;
            this.form.message = null; 
            this.form.to_comment_id = null; 
            this.form.post_id = null; 
        }, 
    },
}
</script> 