<template>
  <v-card>
    <v-card-title primary-title>
      <div>
        <h3 class="headline mb-0">
            {{ data.title }}
        </h3>
        <div class="grey--text">
          {{ data.user }} said {{ data.created_at }}.
        </div>
      </div>
      <v-spacer></v-spacer>
        <v-btn color="teal" dark>Replies: {{ data.replies_number }}</v-btn>
    </v-card-title>

    <v-card-text v-html="body"></v-card-text>
    <v-card-actions v-if="own">
      <v-btn icon small @click="edit">
        <v-icon color="orange">edit</v-icon>
      </v-btn>
      <v-btn icon small @click="destroy">
        <v-icon color="red">delete</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
    export default {
        props: ['data'],
        data(){
            return {
                own: User.own(this.data.user_id)
            }
        },
        computed: {
            body(){
                return md.parse(this.data.body);
            }
        },
        methods: {
            destroy() {
                axios.delete(`/api/question/${this.data.slug}`)
                    .then(res => this.$router.push('/forum'))
                    .catch(error => console.log(error.response.data))
            },
            edit() {
                EventBus.$emit('startEditing')
            },
        }
    }
</script>
