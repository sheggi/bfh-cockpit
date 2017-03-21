<template>
    <div>
        <p class="lead" v-show="next_lessons.length" id="today">{{moment().calendar(null, day_formatting)}}</p>
        <lesson-panel v-for="lesson in next_lessons" :lesson="lesson" :time="time"></lesson-panel>
    </div>
</template>


<script>
  import moment from 'moment'

  let focus = true;

  export default {
    name: 'today-panel',

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
      next_lessons: function () {
        const today = moment().day()
        return this.lessons.filter((lesson) => {
          return lesson.dayofweek === today && moment(lesson.end, 'HH:mm:ss').day(lesson.dayofweek).isAfter(this.time)
        })
      }
    },

    methods: {
      moment: function (time) {
        return moment(time)
      }
    }
  }
</script>
