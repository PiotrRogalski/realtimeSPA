<template>
  <div>
    <v-btn icon @click="likeIt">
      <v-icon v-if="liked" color="red">favorite</v-icon>
      <v-icon v-else color="blue">favorite_border</v-icon>
      {{ count }}
    </v-btn>
  </div>
</template>

<script>
    export default {
        props: ['reply'],
        data() {
            return {
                liked: this.reply.isLiked,
                count: this.reply.likes,
            }
        },
        methods: {
            likeIt() {
                if (User.isLogged()) {
                    (this.liked) ? this.decrement() : this.increment();
                    this.liked = !this.liked;
                }
            },
            increment() {
                axios.post(`/api/like/${this.reply.id}`)
                  .then(res => this.count++)
            },
            decrement() {
                axios.delete(`/api/like/${this.reply.id}`)
                    .then(res => this.count--)
            },
        },
    }
</script>