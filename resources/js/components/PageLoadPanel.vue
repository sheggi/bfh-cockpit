<template>
  <div v-show="loading" class="mb-4">
    <p class="lead">Loading data... Please wait. <i></i></p>
    <div class="progress progress-striped active page-progress-bar">
      <div class="progress-bar" style="width: 100%;"></div>
    </div>
  </div>
</template>


<script>
  import moment from 'moment'

  export default {
    name: 'page-load-panel',

    props: ['lessons', 'time'],

    data: function () {
      return {}
    },

    computed: {
      loading: function () {
        return this.lessons.length === 0
      }
    }
  }
</script>
