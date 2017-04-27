<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lokale Einstellungen</h3>
                    </div>
                    <div class="panel-body">
                        <p>Die Einstellungen werden im LocalStore gespeichert</p>
                        <div class="alert alert-danger" v-if="!feature_localstore">LocalStore wird im Browser nicht unterstützt!</div>
                        <h4>Transport Panel</h4>
                        <div class="form-group">
                            <label>Fahrplan anzeigen</label>
                            <button type="button" v-on:click="toggle_transport" :class="transport_hide?'btn btn-danger':'btn btn-success'">toggle</button>
                        </div>
                        <div v-if="!transport_hide">
                            <div class="form-group">
                                <label>Bevor Stunden</label>
                                <input v-model="transport_before" class="form-control" placeholder="Bern Hauptbahnhof"/>
                            </div>
                            <div class="form-group">
                                <label>Studium Standort</label>
                                <input v-model="transport_here" class="form-control" placeholder="Bern, Wankdorffeldstrasse 102"/>
                            </div>
                            <div class="form-group">
                                <label>Nach Stunden</label>
                                <input v-model="transport_after" class="form-control" placeholder="Bern Hauptbahnhof"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
  import moment from 'moment'
  import localstore from '../localstore'

  export default {
    name: 'config',

    data: function () {
      return {
        feature_localstore: localstore.supported(),
        transport_hide: localstore.get('transport-hide') == 'true'
      }
    },

    methods: {
      toggle_transport: function () {
        this.transport_hide = !this.transport_hide
        localstore.set('transport-hide',this.transport_hide)
        this.$forceUpdate()
      }
    },

    computed: {
      transport_before: {
        get: localstore.get.bind(this, 'transport-before'),
        set: localstore.set.bind(this, 'transport-before')
      },
      transport_here: {
        get: localstore.get.bind(this, 'transport-here'),
        set: localstore.set.bind(this, 'transport-here')
      },
      transport_after: {
        get: localstore.get.bind(this, 'transport-after'),
        set: localstore.set.bind(this, 'transport-after')
      },
    }
  }
</script>
