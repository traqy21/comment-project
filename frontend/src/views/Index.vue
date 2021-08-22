<template> 
  <div>
    <b-row class="mt-4">
      <b-col cols="12">
        <b-card
          v-if="post"
          :title="post.title"
          img-src="https://picsum.photos/600/300/?image=237"
          img-alt="Image"
          img-top
          tag="article"
          style="max-width: 100rem;"
          class="mt-2"
        >
          <b-card-text>
            {{ post.description }}
          </b-card-text>
          <b-button v-b-toggle.collapse-1 variant="primary">Add Comment</b-button>
          <b-collapse id="collapse-1" class="mt-2">
            <add-comment :post_id="post.id"></add-comment>  
          </b-collapse>

          
           <h4 v-if="post.comments.length > 0" class="mt-4">Comments:</h4>
           <b-row class="mt-2">
            <b-col cols="12"> 
              <!-- first level comment -->
              <template v-for="comment in post.comments">  
                  <b-row  :key="comment.id"  class="my-4">
                    <b-col cols="12">
                        <b-card
                          border-variant="primary"
                          header-bg-variant="primary"
                          header-text-variant="white" 
                          :header="`${comment.user_name} says:`"
                          header-border-variant="primary" 
                        >
                          <b-card-text>{{ comment.message }}</b-card-text> 
                          <b-button v-b-toggle="'collapse' + comment.id" variant="outline-primary" size="sm">Add Reply</b-button>
                          <b-collapse :id="`collapse${comment.id}`" class="mt-2">
                            <add-comment :post_id="post.id" :to_comment_id="comment.id" :is_reply="true"></add-comment> 
                          </b-collapse>
                          
                          <!-- second level comment --> 
                          <template v-for="reply in comment.replies">
                              <b-row :key="reply.id" class="my-4">
                                <b-col cols="12">
                                  <b-card
                                    border-variant="secondary"
                                    :header="`${reply.user_name} replies:`"
                                    header-border-variant="secondary" 
                                    header-bg-variant="secondary"
                                    header-text-variant="white" 
                                  >
                                    <b-card-text>{{ reply.message }}</b-card-text> 
                                    <b-button v-b-toggle="'collapse' + reply.id" variant="outline-primary" size="sm">Add Reply</b-button>
                                    <b-collapse :id="`collapse${reply.id}`" class="mt-2">
                                      <add-comment :post_id="post.id" :to_comment_id="reply.id" :is_reply="true"></add-comment>  
                                    </b-collapse> 

                                     <!-- Third level comment --> 
                                    <template v-for="lastReply in reply.replies">
                                      <b-row :key="lastReply.id"  class="my-4">
                                        <b-col cols="12">
                                          <b-card
                                            border-variant="info" 
                                            :header="`${lastReply.user_name} replies:`"
                                            header-border-variant="info" 
                                          >
                                            <b-card-text>{{ lastReply.message }}</b-card-text>  
                                          </b-card>
                                        </b-col>
                                      </b-row> 
                                    </template> 
                                  </b-card>
                                </b-col>
                              </b-row>
                          </template>
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
import { AddComment } from "@/components/index";
export default {
    name: 'default-page', 
    components: {
      AddComment
    },
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