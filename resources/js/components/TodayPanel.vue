<template>
  <div class="mb-4">
    <p class="lead" id="today">{{moment(this.time).calendar(null, day_formatting)}}</p>
    <transport-panel :from="before" :to="here"></transport-panel>
    <lesson-panel v-for="lesson in today_lessons" :key="lesson.id" :lesson="lesson" :time="time"></lesson-panel>
    <transport-panel :from="here" :to="after"></transport-panel>
  </div>
</template>


<script>
  import moment from 'moment'
  import localstore from '../util/localstore'

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
        },
        before: localstore.get('transport-before') || 8576646, // Bern Hauptbahnhof
        here: localstore.get('transport-here') || 8576997, // Bern Markuskirche
        after: localstore.get('transport-after') || 8576646, // Bern Hauptbahnhof
      }
    },

    computed: {
      today_lessons: function () {
        const today = moment(this.time).day()
        return this.lessons.filter((lesson) => {
          return lesson.dayofweek === today
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
