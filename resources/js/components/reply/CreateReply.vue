<template>
  <div class="mt-4">
    <h1>Leave the reply</h1>

    <markdown-editor v-model="body" preview-class="markdown-body"></markdown-editor>

    <p v-if="errors" class="red--text">{{ errors }}</p>

    <v-btn dark color="green" @click="submit">
      <v-icon>done</v-icon>
      Reply
    </v-btn>

  </div>
</template>

<script>
    export default {
        props: ['questionSlug'],
        data() {
          return {
              body: null,
              errors: null,
          }
        },
        methods: {
            submit() {
                if (this.body) {
                    axios.post(`/api/question/${this.questionSlug}/reply`, {body: this.body})
                        .then(res => {
                                this.body = '';
                                EventBus.$emit('createdReply', res.data.reply);
                            }
                        )
                } else {
                    this.errors = 'Body of the post can not be null!';
                }
            },
        },

    }
</script>