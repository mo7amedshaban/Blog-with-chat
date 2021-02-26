<template lang="pug">
div
 b-button(@click="showModel" variant="info") register
 b-modal(ref="my-modal" hide-footer='' title="REGISTER")
  .d-block.text-center
    b-form
        h2.text-center Register
        b-alert(v-if="success" show variant="success") register is Done
        b-form-group.my-4
            b-form-input(type="text" class="form-control" name='name' v-model="fields.name" )
            b-alert( show variant="danger" v-if="errors && errors.name") {{errors.name[0]}}
        b-form-group.my-4
            b-form-input(type="text" class="form-control" name='email' v-model="fields.email" )
            b-alert(show variant="danger" v-if="errors && errors.email") {{errors.email[0]}}
        b-form-group.my-4
            b-form-input(type="password" class="form-control" name='password' v-model="fields.password" )
            b-alert(show variant="danger" v-if="errors && errors.password") {{errors.password[0]}}
            b-button.my-4(type='submit' variant="primary" block='' @click.prevent="register") register
</template>
<script>
export default {

     data(){
         return {
             fields:{},
             errors:{},
             success:false,
         }
     },

     methods:{
         showModel(){
            this.$refs['my-modal'].show()
         },
         hideModel() {
             this.$refs['my-modadkjfl'].hide();
         },
        register(){
           axios.post('/api/register_user',this.fields)
           .then(response=>{
               this.$store.commit('setUserToken',response.data.token);
                this.fields = {};
                this.errors = {};
                this.success = true;
           })
           .then(response=>{
                    this.$refs['my-modal'].hide();
                    this.success=false;
                })
                .catch(error => {
                    if (error.response.status == 422) {  // error in console
                         this.errors = error.response.data.errors;
                         this.success = false;
                    }
            });
       }
     }
}
</script>
<style lang="scss" scoped>
section{margin-top:70px;}
a{opacity: 1;color:white;text-decoration: none;}
</style>
