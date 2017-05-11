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
  import localstore from '../localstore'

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

      let include_classes = localstore.get('include-classes')
      let include_modules = localstore.get('include-modules')
      let exclude_modules = localstore.get('exclude-modules')

      if (!include_classes && !include_modules)
        include_classes = 'I2q';

      let query = '?' + 'include_classes=' + include_classes + '&include_modules=' + include_modules + '&exclude_moduels='+exclude_modules
      query = encodeURI(query)

      this.$http.get(Laravel.api + '/lessons' + query).then(response => {
        this.lessons = response.body.data
        this.lessons = this.lessons || []
        // sort lessons by day and starttime
        this.lessons.sort(function (a, b) {
          if (a.dayofweek < b.dayofweek || a.dayofweek === b.dayofweek && a.start < b.start ){
            return -1
          } else if (a.dayofweek > b.dayofweek || a.dayofweek === b.dayofweek && a.start > b.start ){
            return 1;
          } else {
            return 0;
          }
        })
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
