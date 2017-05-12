/* global Laravel */
import Vue from 'vue'

const apiUrl = Laravel.api

export default {

  /**
   * fetching all lessons from server
   *
   * @returns {Promise}
   */
  lessons: function () {
    const resource = 'lessons'
    return Vue.http({
      method: 'GET',
      url: apiUrl + '/' + resource
    }).then(response => {
      return response.body.data || []
    })
  },

  /**
   * filter lessons by options
   *
   * first include classes and modules then exclude modules
   *
   * @param {Object} options
   * @param {String} options.include_classes
   * @param {String} options.include_modules
   * @param {String} options.exclude_modules
   */
  lessonsFiltered: function (options) {
    const resource = 'lessons'

    if (!options.include_classes && !options.include_modules) {
      options.include_classes = 'I2q'
    }

    let query = '?' + 'include_classes=' + options.include_classes + '&include_modules=' + options.include_modules + '&exclude_modules=' + options.exclude_modules
    query = encodeURI(query)

    console.info(apiUrl + '/' + resource + query)

    return Vue.http({
      method: 'GET',
      url: apiUrl + '/' + resource + query
    }).then(response => {
      return response.body.data || []
    })
  },

  /**
   * fetch all classes from server
   *
   * @returns {Promise}
   */
  classes: function () {
    const resource = 'classes'

    return Vue.http({
      method: 'GET',
      url: apiUrl + '/' + resource
    }).then(response => {
      return response.body.data || []
    })
  },

  /**
   * fetch all modules from server
   *
   * @returns {Promise}
   */
  modules: function () {
    const resource = 'modules'

    return Vue.http({
      method: 'GET',
      url: apiUrl + '/' + resource
    }).then(response => {
      return response.body.data || []
    })
  },

  /**
   * fetch modules by shortname
   *
   * @param {String} shortname
   * @returns {Promise}
   */
  modulesByShortname: function (shortname) {
    const resource = 'modules'

    return Vue.http({
      method: 'GET',
      url: apiUrl + '/' + resource + '/' + shortname
    }).then(response => {
      return response.body.data || []
    })
  }
}
