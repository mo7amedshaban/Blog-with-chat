<template lang="pug">
#editPostModal.modal.fade
  .modal-dialog
    .modal-content
      form(enctype='multipart/form-data', novalidate='')
        .modal-header
          h4.modal-title Edit Post
          button.close(type='button', data-dismiss='modal', aria-hidden='true') ×
        .modal-body
          .form-group
            label title
            input.form-control(type='text', required='', v-model='PostToEdit.title')
          .form-group
            label body
            textarea.form-control(name='', cols='30', v-model='PostToEdit.body', rows='10')
          .form-group
            label category
            select.form-control(name='', v-if='PostToEdit.category', v-model='PostToEdit.category.id')
              option(value='0', disabled='', selected='') choose category
              option(:value='category_id.id', v-for='category_id in categories', :key='category_id.id')
                | {{ category_id.name }}
          .form-group
            label image
            img(:src="'photos/'+PostToEdit.image", style='height:60px;width:60px;border:1px solid #999', alt='')
            input.form-control(type='file', required='', @change='onImageChanged')
        .modal-footer
          input.btn.btn-default(type='button', data-dismiss='modal', value='Cancel')
          input.btn(type='submit', @click.prevent='updatePost', value='Save')

</template>

<script>
export default {
data(){
		return {
			categories : [],
		}
	},
	created(){
		this.getCategories();
    },
    computed:{   // postToEdit.title        postToEdit.body
        PostToEdit(){
            return this.$store.getters.PostToEdit;
        }
    },
	methods:{
		getCategories(){
               axios.get('/api/admin/categories')
                .then(res => {
                    console.log('categories',res.data)
                    this.categories = res.data;
                })
                .then(err => console.log(err))
		},
		onImageChanged(event){
			//console.log(event.target.files[0])
			this.PostToEdit.image = event.target.files[0]   //use data from computed  in vuex
		},
		updatePost(){
			let config ={
				headers :{"content-type" : 'multipart/form-data'}
			}
			let formdata = new FormData();
            formdata.append('title',this.PostToEdit.title)    //use data from computed  in vuex
            formdata.append('id',this.PostToEdit.id)
            formdata.append('body',this.PostToEdit.body)
            formdata.append('image',this.PostToEdit.image)
            formdata.append('category_id',this.PostToEdit.category.id)


			axios.post("/api/admin/updatePost/"+this.PostToEdit.id,formdata,config)
			.then(res => {
				console.log(res)
				/* this.title = '';
				this.body = '';
				this.category_id = '';
                this.image = ''; */
                this.PostToEdit.image = res.data.image
				$('#editPostModal').modal('hide');
				$('.modal-backdrop').css('display','none')
			})

		}

    },


}
</script>

<style>

</style>
