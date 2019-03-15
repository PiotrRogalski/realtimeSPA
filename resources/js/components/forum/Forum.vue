<template>
  <v-container fluid grid-list-md>
    <v-layout row wrap>
      <v-flex xs8>
        <h1 v-if="isLoading">Loading...</h1>
        <question
          v-for="question in questions"
          :key="question.path"
          :data=question
        ></question>
      </v-flex>
      <v-flex xs-4>
        <app-sidebar></app-sidebar>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
    import Question from './Question'
    import AppSidebar from './AppSidebar'

    export default {
        components: {Question, AppSidebar},
        data() {
          return {
              questions: {},
              isLoading: true,
          }
        },
        created() {
            //get all questions
            axios.get('/api/question')
                .then(res => {
                    this.questions = res.data.data;
                    this.isLoading = false;
                })
                .catch(error => console.log(error.response.data))
        }
    }
</script>
