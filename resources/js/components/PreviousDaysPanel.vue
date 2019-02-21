<template>
  <div class="mb-4">
    <div v-for="(day, index) in days" :key="index" v-show="lesson_by_day[day] && lesson_by_day[day].length">
      <p class="lead">{{moment().day(day).calendar(null, day_formatting)}}</p>
      <lesson-panel v-for="lesson in lesson_by_day[day]" :key="lesson.id" :lesson="lesson" :time="time"></lesson-panel>
    </div>
  </div>
</template>


<script>
  import moment from 'moment'

  export default {
    name: 'previous-days-panel',

    props: ['lessons', 'time'],

    data: function () {
      return {
        day_formatting: {
          sameDay: '[Today]',
          nextDay: '[Tomorrow]',
          nextWeek: 'dddd',
          lastDay: '[Yesterday]',
          lastWeek: '[Last] dddd',
          sameElse: 'DD/MM/YYYY'
        }
      }
    },

    computed: {
      lesson_by_day: function () {
        const by_day = {}
        this.lessons.forEach(function (lesson) {
          by_day[lesson.dayofweek] = by_day[lesson.dayofweek] || []
          by_day[lesson.dayofweek].push(lesson)
        })
        return by_day
      },
      days: function () {
        const days = [];
        for (let i = 0; i < moment(this.time).day(); i++) {
          days.push(i);
        }
        return days
      }
    },

    methods: {
      moment: function (time) {
        return moment(time)
      }
    }
  }
</script>
