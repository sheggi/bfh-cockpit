<template>
  <div class="card mb-4" v-show="authenticated">
    <div class="card-header">
      <h3 class="card-title">Debug Panel</h3>
    </div>
    <div class="card-body">
            <pre>String:      {{moment().format("dddd, MMMM Do YYYY, h:mm:ss a")}}
Day of Week: {{moment().day()}}
Time:        {{moment().format('h:mm:ss')}}
Lessons:     {{lessons.length}}
First Lesson:
{{lessons[0]}}</pre>
    </div>
  </div>
</template>


<script>
  import moment from 'moment'

  export default {
    name: 'debug-panel',

    props: ['lessons', 'time'],

    data: function () {
      return {
        authenticated: Laravel.admin
      }
    },

    methods: {
      moment: function () {
        return moment(this.time)
      }
    }
  }
</script>
