<template>
  <v-container>
    <form @submit.prevent="create">
      <v-text-field
          label="Title"
          v-model="form.title"
          type="text"
          required
      ></v-text-field>

      <v-autocomplete
          :items="categories"
          item-text="name"
          item-value="id"
          v-model="form.category_id"
          label="Category"
      ></v-autocomplete>

      <markdown-editor v-model="form.body" preview-class="markdown-body"></markdown-editor>

      <v-btn
          color="green"
          type="submit"
      >Create
      </v-btn>

    </form>
  </v-container>
</template>

<script>

    export default {
        data() {
            return {
                form: {
                    title: null,
                    body: null,
                    category_id: null
                },
                categories: {},
                errors: {},
            }
        },
        created() {
            axios.get('/api/category')
                .then(res => this.categories = res.data.data);
        },
        methods: {
            create() {
                axios.post('/api/question', this.form)
                    .then(res => this.$router.push(res.data.path))
                    .catch(error => this.errors = error.data.response.errors)
            },
        }
    }
</script>
