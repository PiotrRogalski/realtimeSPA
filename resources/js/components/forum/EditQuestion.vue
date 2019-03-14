<template>
  <v-container fluid>
    <v-card>
      <v-form>
      <!--<v-form @submit.prevent="update">-->

        <v-text-field
            label="Title"
            v-model="form.title"
            type="text"
            required
        ></v-text-field>

        <markdown-editor v-model="form.body" preview-class="markdown-body"></markdown-editor>

        <v-card-actions>
          <v-btn icon small @click="update">
          <!--<v-btn icon small type="submit">-->
            <v-icon color="teal">save</v-icon>
          </v-btn>

          <v-btn icon small @click="cancel">
            <v-icon color="black">cancel</v-icon>
          </v-btn>
        </v-card-actions>
      </v-form>
     </v-card>
  </v-container>

</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
                form: {
                    title: null,
                    body: null
                }
            }
        },
        methods: {
            update() {
                axios.patch(`/api/question/${this.form.slug}`, this.form)
                    .then(res => this.cancel())
                    .catch(error => console.log(error.response.data.errors))
            },
            cancel() {
                EventBus.$emit('cancelEditing')
            },

        },
        mounted() {
          this.form = this.data
        },
    }

</script>
