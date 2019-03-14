<template>
  <div>

    <markdown-editor v-model="reply.body"></markdown-editor>

    <v-card-actions>
      <v-btn small icon>
        <v-icon color="green" @click="update">save</v-icon>
      </v-btn>

      <v-btn small icon>
        <v-icon @click="cancel">cancel</v-icon>
      </v-btn>
    </v-card-actions>

  </div>
</template>

<script>
    export default {
        props: ['reply'],
        methods: {
            cancel() {
                EventBus.$emit('cancelEditingReply');
            },
            update() {
                let questionSlug = this.reply.question_slug;
                let reply_id = this.reply.id;
                axios.patch(`/api/question/${questionSlug}/reply/${reply_id}`,
                    {body: this.reply.body})
                    .then(res => this.cancel())
            }

        },
    }
</script>