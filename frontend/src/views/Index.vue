<template> 
  <div>
    <b-row class="mt-4">
      <b-col cols="12">
        <b-card
          v-if="post"
          :title="post.title"
          img-src="https://picsum.photos/600/300/?image=25"
          img-alt="Image"
          img-top
          tag="article"
          style="max-width: 300rem;"
          class="mt-2"
        >
          <b-card-text>
            {{ post.description }}
          </b-card-text>
          <b-button href="#" variant="primary">Add Comment</b-button>

           <b-row class="mt-4">
            <b-col cols="4">
              <h3>Comments:</h3>
                
              <template v-for="comment in post.comments">  
                  <b-row  :key="comment.id"  class="my-2">
                    <b-col cols="12">
                        <b-card
                          border-variant="secondary"
                          :header="comment.user_name"
                          header-border-variant="secondary"
                          
                        >
                          <b-card-text>{{ comment.message }}</b-card-text>
                          <b-button href="#" variant="primary" size="sm">Reply</b-button>
                        </b-card>
                    </b-col>
                  </b-row> 
              </template> 
            </b-col>
          </b-row> 
        </b-card>  
      </b-col>
      
    </b-row>
  </div>
</template>
<script> 
import { mapState } from "vuex"; 
export default {
    name: 'default-page', 
 
    async mounted(){
       this.getList()  
    },

    computed: {  
        ...mapState("postComment", [
            "post", 
            "errors", 
        ]), 
    },  

    methods: { 
        async getList() { 
            await this.$store.dispatch("postComment/getPost"); 
        },
    }
}
</script> 