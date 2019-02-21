<template>
  <div>
    <lesson-panel v-for="lesson in lessons" :key="lesson.id" :lesson="lesson" :time="time"></lesson-panel>
  </div>
</template>


<script>
  import moment from 'moment'

  export default {
    name: 'lessons-panel',

    props: ['lessons', 'time'],

    data: function () {
      return {}
    },

    methods: {
      moment: function (time) {
        return moment(time)
      }
    }
  }
</script>
