<template lang="pug">
div
  .card
    .card-header
      h3 Notifications : {{notifications.length}}
    .card-body
      .media.p-2(v-for='(n,i) in notifications', :key='i')
        img.mr-2(style='    height: 60px;width: 60px;', :src="'/user/'+n.data.comment_owner.profile_img", alt='commenter image')
        .media-body
          .mt-0
            strong {{n.data.comment_owner.name}}
            |  Added a comment on your post
            i.fa.fa-check.float-right(:class="n.read_at ? 'text-success' : 'text-danger'", @click='markAsRead(n,$event)')
          router-link.p-0(:to='`/post/${n.data.post.slug}`', target='_blank') {{n.data.post.title}}
          p.m-0
            i.fa.fa-clock-o.mr-1
            |  {{formatTime(n.data.commented_at)}}

</template>
<script>
export default {
  data(){
      return {
          notifications :[]
      }
  },
  mounted(){
   this.getAllNotifications();
  },
  methods:{
      getAllNotifications(){
          axios.get('/api/getAllNotifications')
          .then(res =>{
              this.notifications = res.data
          })
      },
      formatTime(date){
           let d = new Date(date);
           return `${d.getFullYear()}/${d.getMonth()}/${d.getDate()}`
       },
    //    markAsRead(n,event){
    //        axios.put('/api/markNotificationAsRead',{id:n.id})
    //        .then(res =>{
    //            console.log(res.data);
    //            if(res.data.msg == 'ok'){
    //                event.target.classList.remove('text-danger');
    //                event.target.classList.add('text-success');
    //            }
    //        })
    //        .catch(err =>{
    //            console.log(err);
    //        })
    //    }
  }
}
</script>

<style scoped>
.media{
    border-bottom :1px solid #999;padding:5px;
}
.fa-check{
cursor:pointer
}
</style>
