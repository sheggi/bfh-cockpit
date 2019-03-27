<!-- https://github.com/yuche/vue-strap/blob/master/src/Panel.vue -->

<template>
  <div class="card lesson-panel mb-4" v-bind:id="isCurrent?'now':''">
    <div class="card-header" @click="toggle()">
      <div class="row">
        <div class="col-2">
          <span class="start">{{moment(lesson.start,'HH:mm:ss').format('HH:mm')}}</span>
        </div>
        <div class="col">
          <span class="text-lg">{{lesson.shortname}}</span>
          <span class="text-secondary">{{lesson.name}}</span>
          <span class="pull-right" v-show="isPassed">
            <div class="label label-success"><i class="glyphicon glyphicon-ok"></i></div>
          </span>
        </div>
      </div>
      <div class="row">
        <div class="col col-2">
          <span class="end">{{moment(lesson.end,'HH:mm:ss').format('HH:mm')}}</span>
        </div>
        <div class="col">
          <span class="text-secondary">{{lesson.place}} {{lesson.room}}</span>
        </div>
      </div>
      <div class="progress mt-2" v-show="isCurrent">
        <div class="progress-bar" role="progressbar" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100"
             v-bind:style="{width:progress+'%'}"></div>
      </div>
    </div>
    <div class="card-body card-collapse" v-show="isOpen || isCurrent">
      <div v-if="!(lesson.links.length || lesson.courseident)">Keine Links vorhanden.</div>
      <div v-if="lesson.links.length || lesson.courseident">Links:</div>
      <ul>
        <li><a :href="moduleLink" target="_blank">{{lesson.courseident}} Modulbeschreibung</a></li>
        <li v-for="link in lesson.links"><a :href="link.url" target="_blank">{{link.title}}</a></li>
      </ul>
    </div>
  </div>
</template>


<script>
  import moment from 'moment'

  export default {
    name: 'lesson-panel',

    props: ['lesson', 'time'],

    data: function () {
      return {
        isOpen: false,
        startTime: null,
        endTime: null
      }
    },

    watch: {
      isCurrent: function (val) {
        if (val) {
          setTimeout(function () {
            location.href = '#now'
          }, 100)
        }
      }
    },

    methods: {
      toggle() {
        this.isOpen = !this.isOpen
      },

      moment(time, format) {
        return moment(time, format)
      },
    },

    computed: {
      isCurrent() {
        return this.startTime === null ? false : this.startTime.isBefore(this.time) && this.endTime.isAfter(this.time)
      },
      isScheduled() {
        return this.startTime === null ? false : this.startTime.isAfter(this.time)
      },
      isPassed() {
        return this.endTime === null ? false : this.endTime.isBefore(this.time)
      },
      progress() {
        const full = this.endTime.valueOf() - this.startTime.valueOf();
        const is = this.time - this.startTime.valueOf();
        return (is < 0) ? 0 : (is > full) ? 100 : parseInt(is / full * 100)
      },
      moduleLink() {
        return 'https://content.bfh.ch/fileadmin/ti/modules/' + this.lesson.courseident.replace(/[a-z]*$/i, '') + '-de.xml'
      },
      linkCompiled() {
        return marked()
      }
    },

    created() {
      const start = this.lesson.start.split(':');
      this.startTime = moment(this.time).day(this.lesson.dayofweek).hours(start[0]).minutes(start[1]).seconds(start[2])

      const end = this.lesson.end.split(':');
      this.endTime = moment(this.time).day(this.lesson.dayofweek).hours(end[0]).minutes(end[1]).seconds(end[2])

      this.isOpen = this.isCurrent
    }
  }
</script>


<style>
  h3.card-title.center-line {
    margin-top: 12px;
  }

  .text-lg {
    font-size: 150%;
  }

  .card-body li {
    list-style: none;
  }
</style>
