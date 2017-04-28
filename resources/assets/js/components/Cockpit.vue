<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <previous-days-panel :lessons="lessons" :time="time"></previous-days-panel>
                <page-load-panel :lessons="lessons" :time="time"></page-load-panel>
                <today-panel :lessons="lessons" :time="time"></today-panel>
                <next-days-panel :lessons="lessons" :time="time"></next-days-panel>
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
        this.time = Date.now()
      }, 1000 * 15)

      this.$http.get(Laravel.api + '/lessons').then(response => {
        this.lessons = response.body.data;
        this.lessons = this.lessons || [];
        // jump to now or today section
        setTimeout(function () {
          if ($('#now'))
            location.href = '#now'
          if ($('#today'))
            location.href = '#today'
        }, 0)
      }, response => {
        console.error('couldn\'t fetch lessons')
      })

    }
  }
</script>
