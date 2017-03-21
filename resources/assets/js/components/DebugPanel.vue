<template>
    <div class="panel panel-default" v-show="authenticated">
        <div class="panel-heading">
            <h3 class="panel-title">Debug Panel</h3>
        </div>
        <div class="panel-body">
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
        authenticated: Laravel.authenticated
      }
    },

    methods: {
      moment: function () {
        return moment(this.time)
      }
    }
  }
</script>
