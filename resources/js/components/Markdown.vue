<template>
  <div v-html="compiled"></div>
</template>

<script>
  import marked from 'marked'

  export default {
    props: ['value'],

    computed: {
      compiled() {
        return marked(this.value)
      }
    }
  }
</script>