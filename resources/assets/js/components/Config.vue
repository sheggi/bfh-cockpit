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
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Stundenplan Einstellungen</h3>
                    </div>
                    <div class="panel-body">
                        <p>Hier stellst du dein Stundenplan zusammen</p>
                        <div class="form-group">
                            <label>Klasse wählen</label>
                            <multiselect v-model="include_classes" :options="classes" track-by="classname" label="classname" :multiple="true" :close-on-select="false" :hide-selected="true"></multiselect>
                        </div>
                        <div class="form-group">
                            <label>Einzelne Module hinzufügen</label>
                            <multiselect v-model="include_modules" :options="modules" track-by="courseident" label="display" :custom-label="customModulLabel" :multiple="true" :close-on-select="false" :hide-selected="true"></multiselect>
                        </div>
                        <div class="form-group">
                            <label>Einzelne Module ausschliessen</label>
                            <multiselect v-model="exclude_modules" :options="modules" track-by="courseident" label="display" :custom-label="customModulLabel" :multiple="true" :close-on-select="false" :hide-selected="true"></multiselect>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Fahrplan Einstellungen</h3>
                    </div>
                    <div class="panel-body">
                        <p>Die Ausgangsorte und Bestimmungsorte können eingestellt werden. Der Fahrplan zeigt dir dann jeweils die nächsten verfügbaren Verbindungen von den eingestellten Orten.</p>
                        <div class="form-group">
                            <label>Fahrplan anzeigen</label>
                            <button type="button" v-on:click="toggle_transport" :class="transport_hide?'btn btn-danger':'btn btn-success'">toggle</button>
                        </div>
                        <div v-if="!transport_hide">
                            <div class="form-group">
                                <label>Von diesem Ort zum Studiums Ort</label>
                                <input v-model="transport_before" class="form-control" placeholder="Bern Hauptbahnhof"/>
                            </div>
                            <div class="form-group">
                                <label>Studium Standort</label>
                                <input v-model="transport_here" class="form-control" placeholder="Bern, Wankdorffeldstrasse 102"/>
                            </div>
                            <div class="form-group">
                                <label>Nach dem Studium zu diesem Ort</label>
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
  import bfhcockpitApi from '../bfhcockpit_api'

  export default {
    name: 'config',

    data: function () {
      return {
        feature_localstore: localstore.supported(),
        transport_hide: localstore.get('transport-hide') === 'true',
        classes: [],
        modules: []
      }
    },

    created: function () {
      bfhcockpitApi.classes().then(classes => {
        this.classes = classes
        this.$forceUpdate()
      })

      bfhcockpitApi.modules().then(modules => {
        modules.forEach(function(module){
          module.display = module.courseident + ' - ' + module.shortname + ' - ' + module.name;
        })
        this.modules = modules
        this.$forceUpdate()
      })
    },

    methods: {
      toggle_transport: function () {
        this.transport_hide = !this.transport_hide
        localstore.set('transport-hide',this.transport_hide)
        this.$forceUpdate()
      },
      
      customModulLabel: function (obj) {
        return `${obj.courseident} – ${obj.shortname} - ${obj.name}`
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
      include_classes: {
        get: localstore.getJSON.bind(this, 'include-classes'),
        set: localstore.setJSON.bind(this, 'include-classes')
      },
      include_modules: {
        get: localstore.getJSON.bind(this, 'include-modules'),
        set: localstore.setJSON.bind(this, 'include-modules')
      },
      exclude_modules: {
        get: localstore.getJSON.bind(this, 'exclude-modules'),
        set: localstore.setJSON.bind(this, 'exclude-modules')
      },
    }
  }
</script>
