<!-- https://github.com/yuche/vue-strap/blob/master/src/Panel.vue -->

<template>
    <div class="panel panel-default lesson-panel" v-show="!hidden" v-bind:id="isCurrent?'now':''">
        <div class="panel-heading" @click="toggle()">
            <div class="row">
                <div class="col-xs-1">
                    <span class="start">{{moment(lesson.start,'HH:mm:ss').format('HH:mm')}}</span><br>
                    <span class="end">{{moment(lesson.end,'HH:mm:ss').format('HH:mm')}}</span>
                </div>
                <div class="col-xs-2">
                    <h3 class="panel-title center-line">{{lesson.shortname}}</h3>
                </div>
                <div class="col-xs-7">
                    <h3 class="panel-title center-line">{{lesson.name}}</h3>
                </div>
                <div class="col-xs-2">
                    <button class="btn btn-primary pull-right" v-show="isPassed" @click="hide">X</button>
                    <h3 class="pull-right panel-title center-line" v-show="isCurrent || isScheduled">{{lesson.room}}</h3>
                </div>
            </div>
            <div class="progress" v-show="isCurrent">
                <div class="progress-bar" role="progressbar" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100" v-bind:style="{width:progress+'%'}"></div>
            </div>
        </div>
        <div class="panel-body panel-collapse" v-show="isOpen || isCurrent">
            <ul>
                <li><a :href="moduleLink">{{lesson.courseident}} Modulbeschreibung</a></li>
            </ul>
            <vue-markdown>{{lesson.links}}</vue-markdown>
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
        endTime: null,
        hidden: false
      }
    },

    methods: {
      hide(){
        this.hidden = true
      },

      toggle() {
        this.isOpen = !this.isOpen
      },

      moment (time, format) {
        return moment(time, format)
      },

      isCurrent(){
        return this.startTime.isBefore(this.time) && this.endTime.isAfter(this.time)
      }
    },

    computed: {
      isCurrent(){
        return this.startTime.isBefore(this.time) && this.endTime.isAfter(this.time)
      },
      isScheduled(){
        return this.startTime.isAfter(this.time)
      },
      isPassed(){
        return this.endTime.isBefore(this.time)
      },
      moduleLink(){
        return 'https://www.ti.bfh.ch/fileadmin/modules/' + this.lesson.courseident.replace(/[a-z]*$/i,'') + '-de.xml'
      },
      progress(){
        const full = this.endTime.valueOf() - this.startTime.valueOf();
        const is = this.time - this.startTime.valueOf();
        return (is < 0) ? 0 : (is > full) ? 100 : parseInt(is / full * 100)
      }
    },

    created() {
      const start = this.lesson.start.split(':');
      this.startTime = moment(Date.now()).day(this.lesson.dayofweek).hours(start[0]).minutes(start[1]).seconds(start[2])

      const end = this.lesson.end.split(':');
      this.endTime = moment(Date.now()).day(this.lesson.dayofweek).hours(end[0]).minutes(end[1]).seconds(end[2])

      this.isOpen = this.isCurrent
    }
  }
</script>


<style>
    h3.panel-title.center-line {
        margin-top: 12px;
    }

</style>
