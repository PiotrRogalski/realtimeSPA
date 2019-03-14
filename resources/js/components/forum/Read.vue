<template>
  <div v-if="question">

    <edit-question
        v-if="editing"
        :data=question
    ></edit-question>

    <show-question
        v-else
        :data=question
    ></show-question>

  </div>
</template>

<script>
    import ShowQuestion from './ShowQuestion'
    import EditQuestion from './EditQuestion'

    export default {
        components: {ShowQuestion, EditQuestion},
        data() {
            return {
                question: null,
                editing: false,
            }
        },
        created() {
            this.isEditing();
            this.getQuestion();
        },
        methods: {
            isEditing() {
                EventBus.$on('startEditing', () => {
                    this.editing = true
                })

                EventBus.$on('cancelEditing', () => {
                    this.editing = false
                })
            },
            getQuestion() {
                let slug = this.$route.params.slug;
                axios.get(`/api/question/${slug}`)
                    .then(res => this.question = res.data.data)

            }

        }

    }
</script>
