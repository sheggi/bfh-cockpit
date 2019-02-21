<template>
  <div class="container mt-4">
    <div class="card mb-4">
      <div class="card-header">
        <h3 class="card-title">Lokale Einstellungen</h3>
      </div>
      <div class="card-body">
        <p>Die Einstellungen werden sofort im Browser gespeichert. Zur Zeit werden die Einstellungen nicht zwischen
          deinen Browsern synchronisiert</p>
        <div class="alert alert-danger" v-if="!feature_localstore">LocalStore wird im Browser nicht unterstützt!</div>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-header">
        <h3 class="card-title">Stundenplan Einstellungen</h3>
      </div>
      <div class="card-body">
        <p>Hier stellst du dein Stundenplan zusammen</p>
        <div class="form-group">
          <label>Klasse wählen</label>
          <multiselect v-model="include_classes" :options="classes" track-by="classname" label="classname"
                       :multiple="true" :close-on-select="false" :hide-selected="true"></multiselect>
        </div>
        <div class="form-group">
          <label>Einzelne Module hinzufügen</label>
          <multiselect v-model="include_modules" :options="modules" track-by="courseident" label="display"
                       :custom-label="customModulLabel" :multiple="true" :close-on-select="false"
                       :hide-selected="true"></multiselect>
        </div>
        <div class="form-group">
          <label>Einzelne Module ausschliessen</label>
          <multiselect v-model="exclude_modules" :options="modules" track-by="courseident" label="display"
                       :custom-label="customModulLabel" :multiple="true" :close-on-select="false"
                       :hide-selected="true"></multiselect>
        </div>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-header">
        <h3 class="card-title">Fahrplan Einstellungen</h3>
      </div>
      <div class="card-body">
        <p>Die Ausgangsorte und Bestimmungsorte können eingestellt werden. Der Fahrplan zeigt dir dann jeweils die
          nächsten verfügbaren Verbindungen von den eingestellten Orten.</p>
        <div class="form-group">
          <label>Fahrplan anzeigen</label>
          <button type="button" v-on:click="toggle_transport"
                  :class="transport_hide?'btn btn-danger':'btn btn-success'">toggle
          </button>
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
</template>


<script>
  import localstore from '../util/localstore'
  import bfhcockpitApi from '../util/bfhcockpit_api'
  import Multiselect from 'vue-multiselect'

  export default {
    name: 'config',

    components: {Multiselect},

    data: function () {
      return {
        feature_localstore: localstore.supported(),
        transport_hide: localstore.get('transport-hide') === 'true',
        classes: [],
        modules: [],
        transport_before:  localstore.get('transport-before'),
        transport_here: localstore.get('transport-here'),
        transport_after: localstore.get('transport-after'),
        include_classes: localstore.getJSON('include-classes'),
        include_modules:  localstore.getJSON('include-modules'),
        exclude_modules: localstore.getJSON('exclude-modules'),
      }
    },

    created: function () {
      bfhcockpitApi.classes().then(classes => {
        this.classes = classes
        this.$forceUpdate()
      })

      bfhcockpitApi.modules().then(modules => {
        modules.forEach(function (module) {
          module.display = module.courseident + ' - ' + module.shortname + ' - ' + module.name;
        })
        this.modules = modules
        this.$forceUpdate()
      })
    },

    methods: {
      toggle_transport: function () {
        this.transport_hide = !this.transport_hide
        localstore.set('transport-hide', this.transport_hide)
        this.$forceUpdate()
      },

      customModulLabel: function (obj) {
        return `${obj.courseident} – ${obj.shortname} - ${obj.name}`
      }
    },

    watch: {
      transport_before(value) {
        localstore.set('transport-before', value)
      },
      transport_here(value) {
        localstore.set('transport-here', value)
      },
      transport_after(value) {
        localstore.set('transport-after', value)
      },
      include_classes(value) {
        localstore.setJSON('include-classes', value)
      },
      include_modules(value) {
        localstore.setJSON('include-modules', value)
      },
      exclude_modules(value) {
        localstore.setJSON('exclude-modules', value)
      },
    }
  }
</script>
