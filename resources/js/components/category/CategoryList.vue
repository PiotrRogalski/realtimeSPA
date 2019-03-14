<template>
  <v-card>
    <v-toolbar color="cyan" dark dense class="mt-2">
      <v-toolbar-title>Categories</v-toolbar-title>
    </v-toolbar>

    <v-list>
        <v-list-tile v-for="(category, index) in categories" :key="`category-${index}`">
          <v-list-tile-action v-if="canEdit">
            <v-btn icon small @click="edit(index)">
              <v-icon color="orange">edit</v-icon>
            </v-btn>
          </v-list-tile-action>

          <v-list-tile-content>
            <v-list-tile-title>{{ category.name }}</v-list-tile-title>
          </v-list-tile-content>

          <v-list-tile-action v-if="canDestroy">
            <v-btn icon small @click="destroy(category.slug, index)">
              <v-icon color="red">delete</v-icon>
            </v-btn>
          </v-list-tile-action>

        </v-list-tile>
        <hr>
    </v-list>

  </v-card>
</template>

<script>
    export default {
        props: ['editable', 'deleteable', 'form'],
        data() {
            return {
                categories: {},
                canEdit: this.editable,
                canDestroy: this.deleteable,
            }
        },
        created() {
            //If category is created - push it on table
            if (User.admin()) {
                EventBus.$on('createdCategory', () => {
                    axios.post('/api/category', this.form)
                        .then(res => {
                            this.categories.unshift(res.data);
                            this.form.name = null;
                        }).catch(error => console.log(error.response.data.errors))
                })
            }
            //Get all categories
            axios.get('/api/category')
                .then(res => this.categories = res.data.data)
                .catch(error => console.log(error.response.data.errors))
        },
        methods: {
            edit(index) {},
            destroy(slug, index) {
                if (User.admin()) {
                    axios.delete(`/api/category/${slug}`, this.form)
                        .then(res => console.log(res.data))
                        .then(res => this.categories.splice(index, 1))
                        .catch(error => console.log(error.response.data.errors))
                }
            },

        }
    }
</script>