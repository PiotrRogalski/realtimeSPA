<template>
  <v-container>
    <v-form @submit.prevent="submit">
      <v-text-field
          label="Category Name"
          v-model="form.name"
          required
      ></v-text-field>

      <v-btn type="submit" color="teal" dark>Create</v-btn>
    </v-form>

    <category-list
        :deleteable="true"
        :form="form"
    ></category-list>

  </v-container>
</template>

<script>
    import CategoryList from '../category/CategoryList'

    export default {
        components: {CategoryList},
        data() {
            return {
                form: {
                    name: null
                },
            }
        },
        created() {
            if (!User.admin()) {
                this.$router.push('/forum')
            }
        },
        methods: {
            submit() {EventBus.$emit('createdCategory')},
        }
    }
</script>