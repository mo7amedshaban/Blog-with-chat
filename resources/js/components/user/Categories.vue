<template lang="pug">
div.card.my-4
    h5.card-header Categories
    .card-body
      .row
        .col-lg-6
            ul.list-unstyled.mb-0(v-if="categories.length>0")
                li(v-for="(category,index) in categories"  :key="index")
                    router-link(:to="`category/${category.slug}/posts`")
                       b-badge(variant="success") {{category.name}}
</template>
<script>
export default {
    data(){
        return{
            categories:[],
        }
    },
    created(){
        this.getCategories();
    },
    methods:{
        getCategories(){
            axios.get('/api/categories')
            .then(res=>{this.categories=res.data})
            .catch(err=>console.log(err));
        }
    }
}
</script>
<style lang="scss" scoped>
::v-deep .badge{
    padding:5px; margin-bottom:5px;
}
</style>
