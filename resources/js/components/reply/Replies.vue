<template>
  <div>
    <reply
        v-if="repliesList"
        v-for="(reply, index) in repliesList"
        :key="`reply-${index}`"
        :index="index"
        :data="reply"
    ></reply>
  </div>
</template>

<script>
    import Reply from './Reply'

    export default {
        props: ['question'],
        components: {Reply},
        data() {
            return {
                repliesList: this.question.replies,
            }
        },
        created() {
            this.listen()
        },
        methods: {
            listen() {
                EventBus.$on('createdReply', (reply) => {
                    this.repliesList.unshift(reply);
                    window.scrollTo(0, 0);
                });

                EventBus.$on('deleteReply', (index) => {
                    let replyId = this.repliesList[index].id;
                    let questionSlug = this.question.slug;
                    axios.delete(`/api/question/${questionSlug}/reply/${replyId}`, this.form)
                        .then(res => {
                            this.repliesList.splice(index, 1)
                        })
                });
            }
        },

    }
</script>
