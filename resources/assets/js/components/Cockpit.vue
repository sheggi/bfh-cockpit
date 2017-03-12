<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <lessons-panel :lessons="lessons" :time="time"></lessons-panel>
                <debug-panel :lessons="lessons" :time="time"></debug-panel>
            </div>
        </div>
    </div>
</template>


<script>
  import moment from 'moment'

  export default {
    name: 'cockpit',

    data: function () {
      return {
        time: Date.now(),
        lessons: []
      }
    },

    methods: {
      moment: function (time) {
        return moment(time)
      }
    },

    created: function () {

      setInterval(() => {
        this.time = moment().valueOf()
      }, 1000)

      this.$http.get(Laravel.api + '/lessons').then(response => {
        this.lessons = response.body.data;
        this.lessons = this.lessons || [];
        this.lessons = this.lessons.filter((lesson) => {
          return moment(this.time).day() <= lesson.dayofweek
        });
      }, response => {
        console.error('couldn\'t fetch lessons')
      })

    }
  }
</script>
