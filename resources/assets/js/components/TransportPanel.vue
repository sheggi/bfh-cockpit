<template>
    <div class="panel panel-default" v-if="!hide">
        <div class="panel-heading">
            <h3 class="panel-title center-line">{{from_location.name}} nach {{to_location.name}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <tbody>
                <tr v-for="connection in connections">
                    <td>
                        {{moment(connection.from.departure).format('HH:mm')}}<br>
                        {{moment(connection.to.arrival).format('HH:mm')}}
                    </td>
                    <td>
                        {{connection.duration}} &gt;
                        {{connection.route}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>
  import moment from 'moment'
  import transportApi from '../transport_api'
  import localstore from '../localstore'

  function duration (seconds) {
    const minutes = (parseInt(seconds / (60)) % 60);
    const hours   = (parseInt(seconds / (60*60)) % 24);
    return hours+":"+((minutes<10)?'0'+minutes:minutes);
  }

  export default {
    name: 'transport-panel',

    props: ['from', 'to'],

    created: function () {
      if (!this.hide)
      transportApi.connections(this.from, this.to, 3)
        .then((response) => {
          const data = response.data
          this.from_location = data.from
          this.to_location = data.to
          this.connections = data.connections.map((connection) => {
            connection.route = []
            connection.sections.forEach((section) => {
              if (section.walk === null)
                connection.route.push(section.departure.location.name)
            })
            connection.route.push(connection.to.location.name);
            connection.route = connection.route.join(' - ')
            connection.duration = duration(connection.to.arrivalTimestamp - connection.from.departureTimestamp)
            return connection;
          })
        })
    },

    data: function () {
      return {
        from_location: {name: 'loading...'},
        to_location: {name: 'loading...'},
        connections: [],
        hide: localstore.get('transport-hide') == 'true'
      }
    },

    methods: {
      moment: function (arg) {
        return moment(arg)
      }
    }
  }
</script>
