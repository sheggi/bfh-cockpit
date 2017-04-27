<template>
    <div>
        <div v-for="day in days" v-show="lesson_by_day[day] && lesson_by_day[day].length">
            <p class="lead">{{moment().day(day).calendar(null, day_formatting)}}</p>
            <lesson-panel v-for="lesson in lesson_by_day[day]" :lesson="lesson" :time="time"></lesson-panel>
        </div>
    </div>
</template>


<script>
  import moment from 'moment'

  export default {
    name: 'next-days-panel',

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
        for (let i = moment(this.time).day()+1; i <= 6; i++)
        {
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
