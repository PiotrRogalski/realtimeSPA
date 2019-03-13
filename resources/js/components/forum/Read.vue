<template>
<show-question :data = question></show-question>
</template>

<script>
  import ShowQuestion from './ShowQuestion'
    export default {
      components: {ShowQuestion},
        data() {
            return {
              question: {}
          }
        },
        created() {
            let slug = this.$route.params.slug;
            axios.get(`/api/question/${slug}`)
                .then(res => this.question = res.data.data)
        }
    }
</script>
