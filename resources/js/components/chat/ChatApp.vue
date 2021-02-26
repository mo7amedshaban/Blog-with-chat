<template lang="pug">
.container
  .messaging
    .inbox_msg
      .inbox_people
        .headind_srch
          .recent_heading
            //- span image
            h4 Chats
        //-   .srch_bar
        //-     .stylish-input-group
        //-       input.search-bar(type="text", placeholder="Search")
        //-       span.input-group-addon
        //-         button(type="button")
        //-           i.fa.fa-search(aria-hidden="true")
        .inbox_chat
          ul.chat_list.active_chat
            li.chat_people(
              v-for="friend in friends",
              :key="friend.id",
              @click="reciever_id = friend.id",
              :class="[reciever_id == friend.id ? 'active_chat' : '']"
            )
              .chat_img
                b-card-img.rounded-50(:src="'/user/' + friend.profile_img", alt="Image")
              .chat_ib
                h5
                  | {{ friend.username }}
                  i.fa.fa-circle.float-right(
                data-v-46de097a="",
                :class="[onlineFriends.find((user) => user.id == friend.id) ? 'active' : '']"
                )
                .unread_content
                  span.unread(v-if="friend.unread") {{ friend.unread }}
          div.mt-2.pl-2
            i.fas.fa-user-friends.fa-2x
            b-badge(pill="", variant="danger") {{ friends.length }}


      .mesgs(v-if="reciever_id")
        ul.msg_history.feed(ref="feed")
          li(
            v-for="(message, index) in allMessages",
            :key="index",
            :class="[user.id === message.user_id ? 'incoming_msg' : 'outgoing_msg']"
          )
            div(
              :class="[user.id === message.user_id ? 'incoming_msg_img' : 'delete image']"
            )
            img(v-if="message.image", :src="'/chat/' + message.image", alt="" style="width:150px;height:150px;padding:3px")
            div(
              :class="[user.id === message.user_id ? 'received_msg' : 'sent_msg']"
            )
              div(
                :class="[user.id === message.user_id ? 'received_withd_msg' : '']"
              )
                p
                  | {{ message.text }}
                span.time_date {{ message.created_at }}
        .type_msg
          .input_msg_write
            input.write_msg.position-relative(
              v-model="text",
              @keydown="sendTypingEvent",
              @keydown.enter="send",
              type="text",
              placeholder="Type a message"
            )

            button.msg_send_btn(type="button", @click.prevent="send")
              i.fa.fa-paper-plane-o(aria-hidden="true")
            //- span.text-muted.float-right(v-if="typingFriend") {{ typingFriend.username }} is typing...
        div.picker_Block.d-block.clearfix
          button.picker-button(@click="toggleEmo", fab="", dark="", small="", color="pink")
           i.fas.fa-smile-beam.fa-2x
        div.blockFile
          b-form-file.mt-3(accept="image/*", ref="file",@change="onImageChanged(); send()") ok
          b-icon(icon="image" aria-hidden="true" size="lg")
          span.text-muted.position-absolute.text-center.typeing(v-if="typingFriend") {{   typingFriend. username }} is typing...

        div
          picker( style="width:100%;"
            v-if="emoStatus",
            set="emojione",
            @select="onInput",
            title="Pick your emoji…"
          )
</template>

<script>
import { Picker } from "emoji-mart-vue";
import { mapState } from "vuex";
export default {
  data() {
    return {
      text: null,
      reciever_id: null,
      contacts: [],
      allMessages: [],
      onlineFriends: [],
      typingFriend: false,
      typingTimer: false,
      image: "",
      emoStatus: false,
      file: null,
    };
  },
  components: {
    Picker,
  },

  computed: {
    ...mapState(["user", "userToken"]),

    friends() {
      return this.contacts.filter((user) => {
        return user.id !== this.user.id;
      });
    },
  },
  watch: {
    reciever_id(val) {
      this.fetchMessages();
    },
  },

  created() {
    this.getContacts();
    this.updateToken();
    Echo.join("presence_for_private_chat")
      .here((users) => {
        this.onlineFriends = users;
      })
      .joining((user) => {
        this.onlineFriends.push(user);
      })
      .leaving((user) => {
        this.onlineFriends.splice(this.onlineFriends.indexOf(user), 1);
      });
  },

  methods: {
    updateUnreadCount(reset) {
      //reset == false or true
      this.contacts = this.contacts.map((single) => {
        if (single.id !== this.reciever_id) {
          return single;
        }
        if (reset) single.unread = 0;
        else single.unread += 1;
        return single;
      });
    },
    onImageChanged() {
      this.image = event.target.files[0]; // in vue.js   inspect    appear file  not changed
      console.log('image',this.image);
    },

    send() {
      if (!this.text) {
        return "";
      }
      let data = new FormData();
      data.set("image", this.image); //when use set not use enctype="multipart/form-data"  because it object from form
      data.set("reciever_id", this.reciever_id);
      data.set("text", this.text);

      axios.post("api/messages", data).then((response) => {
        this.$refs.file.value = null; //  == this.image = null
        this.text = null;
        this.allMessages.push(response.data); //.message
        this.scrollToEnd();
        //this.updateUnreadCount(contacts, true);
      });
    },
    fetchMessages() {
      this.updateUnreadCount(true);
      axios
        .get("api/messages/" + this.reciever_id)
        .then((response) => {
          this.allMessages = response.data;
          this.channel();
          this.scrollToEnd();
        })
        .catch((error) => error.data);
    },
    getContacts() {
      axios.get("api/contacts").then((response) => {
        this.contacts = response.data;
      });
    },

    sendTypingEvent() {
      Echo.private(`Private_Chat.${this.reciever_id}`).whisper(
        "typing",
        this.user
      );
      // must go to websockets.php
      //'enable_client_messages' => true,
      //'enable_statistics' => true,
    },
    channel() {
      Echo.private(`Private_Chat.${this.user.id}`)
        .listen("NewMessage", (e) => {
          this.allMessages.push(e.message);
          this.scrollToEnd();
          //   this.updateUnreadCount(false);
        })
        .listenForWhisper("typing", (user) => {
          if (user.id == this.reciever_id) {
            this.typingFriend = user;
            if (this.typingTimer) clearTimeout();

            this.typingTimer = setTimeout(() => {
              this.typingFriend = false; // for  3s    typingFriend is hidden
            }, 3000);
          }
        });
    },

    toggleEmo() {
      this.emoStatus = !this.emoStatus;
    },
    onInput(e) {
      //can    set="emojione"  or  facebook , twitter else
      if (!e) {
        return false;
      }
      if (!this.text) {
        this.text = e.native;
      } else {
        this.text = this.text + e.native; // native is icon
      }
      this.emoStatus = false;
    },
    updateToken() {
      let token = JSON.parse(localStorage.getItem("userToken"));
      this.$store.commit("setUserToken", token);
    },
    scrollToEnd() {
      setTimeout(() => {
        this.$refs.feed.scrollTop =
          this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
      }, 100);
    },
  },
};
</script>

<style lang="scss" scoped>
.typeing{
padding-left: 21%;}
.blockFile {
  position: relative;
  ::v-deep .custom-file {
    width: 35px;
    white-space: nowrap;
    overflow: hidden;
    .custom-file-label {
      opacity: 0;
      z-index: 999;
      margin-top:-43%;
    }
  }
  ::v-deep .b-icon.bi {
        top: 0px;
        position: absolute;
        left: 0px;
        font-size: 32px;
        margin-left: 5px;
        cursor: pointer;
}
}


::v-deep .card-img {
  width: 70px;
  height: 50px;
  border: 1px solid yellow;
   border-radius: 50%;
//   box-shadow: 2px 2px 0px 0.5px rgba(232, 7, 105, 0.84),
//     -2px -2px 0px 0.5px rgba(232, 7, 105, 0.84);
}
.picker_Block{
    position: relative;
    .picker-button{width:100%; float:right;position: relative;width: 6%;background:white;border:white;
float: left;}
    .fas.fa-smile-beam{position:absolute;top:0px;left:0px;margin-left:5px;font-size: 32px; margin-top: 5px;}
}

.fa.fa-circle{
    padding:1.5%;
}
.unread_content {
  position: relative;
}
.unread {
  position: absolute;
  background: red;
  right: 3px;
  padding: 2px;
  top: -21px;
  text-align: center;
  color: white;
  position: absolute;
background: red;
right: 50%;
padding: 3px;
top: -21px;
text-align: center;
color: white;
z-index: 999;
justify-content: center;
border-radius: 104%;
width: 25px;
}
.postition_fixed {
  position: fixed;
}
.active {
  color: #52d552
}
.container {
  max-width: 1170px;
  margin: auto;
}
img {
  max-width: 100%;
}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%;
  border-right: 1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac {
  margin: 20px 0 0;
}

.recent_heading {
  float: left;
  width: 40%;
}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%;
}
.headind_srch {
  padding: 10px 29px 10px 20px;
  overflow: hidden;
  border-bottom: 1px solid #c4c4c4;
}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input {
  border: 1px solid #cdcdcd;
  border-width: 0 0 1px 0;
  width: 80%;
  padding: 2px 0 4px 6px;
  background: none;
}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon {
  margin: 0 0 0 -27px;
}

.chat_ib h5 {
  font-size: 15px;
  color: #464646;
  margin: 0 0 8px 0;
}
.chat_ib h5 span {
  font-size: 13px;
  float: right;
}
.chat_ib p {
  font-size: 14px;
  color: #989898;
  margin: auto;
}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people {
  overflow: hidden;
  clear: both;
  margin-bottom: 3%;
}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat {
  height: 550px;
  overflow-y: scroll;
}

.active_chat:hover {

  background: #ebebeb;
}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
}
.received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg {
  width: 57%;
}
.mesgs {
  float: left;
//   padding: 30px 15px 0 25px;
  width: 60%;
}

.sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0;
  color: #fff;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.outgoing_msg {
  overflow: hidden;
  margin: 26px 0 26px;
}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;

  width: 87%;
float: right;
border: 1px rgb(176, 176, 172) solid;
}

.type_msg {
  border-top: 1px solid #c4c4c4;
  position: relative;
  z-index: 1;
}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging {
  padding: 0 0 50px 0;
}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
ul {
  list-style: none;
  padding: 0px;
  margin: 0px;
}
</style>
