import Vue from "vue";
import VueRouter from "vue-router"; 
import DashboardLayout from "@/layout/dashboard-layout";  
import NotFound from "@/views/NotFoundPage.vue";

Vue.use(VueRouter);


export default new VueRouter({
  mode: "history",  
  linkActiveClass: "active",
  routes: [  
    {
      path: "/", 
      component: DashboardLayout,  
      children: [ 
        {
          path: "/",
          name: "post", 
          component: () => import("@/views/Index.vue"),
          meta: {
            requireAuth: false
          }, 
        },  
      ]
    }, 

    { path: "*", component: NotFound } 
  ],

});