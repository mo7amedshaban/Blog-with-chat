<template lang="pug">
.conversation
  h1  nameconversation
  .feed(ref='feed')
   ul
    li(v-if='message' v-for='(message,index) in allMessages' :key='index' :class="`message${user.id == message.user_id ? ' received' : ' sent'}`")
      .text(v-if='message')
        | {{ message.message}}

  .composer
      textarea(v-model='message' @keydown.enter='send' placeholder='Message...')

  .contacts-list
   ul
    li(v-for='user in user' :key='user.id' @click='selectContact(contact)' :class="{ 'selected': contact == selected }")
      .avatar
        img(:src='contact.profile_image' :alt='contact.name')
      .contact
        p.name {{ contact.name }}
        p.email {{ contact.email }}
      span.unread(v-if='contact.unread') {{ contact.unread }}


</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {
            message: null,
            allMessages: [] // {user,message}
        };
    },
    created() {
        this.fetchMessages();
        Echo.private("chat").listen("NewMessage", e => {
            this.allMessages.push({
                message: e.message.message,
                user: e.user
            });
            this.scrollToEnd();
        });
    },
    computed: {
        ...mapState(["user"])
    },

    methods: {
        fetchMessages() {
            axios.get("api/messages").then(response => {
                this.allMessages = response.data;
            });
        },
        send() {
            axios.post("api/messages", { message: this.message })
                // .then(response => {
                //     this.message = null;
                //     this.allMessages.push(response.data.message);
                //     this.fetchMessages();
                //     this.scrollToEnd();
                // });
        },

        scrollToEnd() {
            setTimeout(() => {
                this.$refs.feed.scrollTop =
                    this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }, 100);
        }
    }
};
</script>

<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    h1 {
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
}
.composer textarea {
    width: 96%;
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 6px;
}
.feed {
    background: #f0f0f0;
    height: 100%;
    max-height: 470px;
    overflow: scroll;
    ul {
        list-style-type: none;
        padding: 5px;
        li {
            &.message {
                margin: 10px 0;
                width: 100%;
                .text {
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }
                &.received {
                    text-align: right;
                    .text {
                        background: #b2b2b2;
                    }
                }
                &.sent {
                    text-align: left;
                    .text {
                        background: #81c4f9;
                    }
                }
            }
        }
    }
}
.contacts-list {
    flex: 2;
    max-height: 100%;
    height: 600px;
    overflow: scroll;
    border-left: 1px solid #a6a6a6;

    ul {
        list-style-type: none;
        padding-left: 0;
        li {
            display: flex;
            padding: 2px;
            border-bottom: 1px solid #aaaaaa;
            height: 80px;
            position: relative;
            cursor: pointer;
            &.selected {
                background: #dfdfdf;
            }
            span.unread {
                background: #82e0a8;
                color: #fff;
                position: absolute;
                right: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }
            .avatar {
                flex: 1;
                display: flex;
                align-items: center;
                img {
                    width: 35px;
                    border-radius: 50%;
                    margin: 0 auto;
                }
            }
            .contact {
                flex: 3;
                font-size: 10px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;
                p {
                    margin: 0;
                    &.name {
                        font-weight: bold;
                    }
                }
            }
        }
    }
}
</style>
