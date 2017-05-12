/* global localStorage */
const prefix = 'bfhcockpit:'

function supported () {
  return typeof localStorage !== 'undefined'
}

export default  {
  set: function (key, value) {
    if (supported()) {
      localStorage.setItem(prefix + key, value)
      return true
    }
    return false
  },

  get: function (key) {
    if (supported()) {
      return localStorage.getItem(prefix + key)
    }
  },

  setJSON: function (key, value) {
    if (supported()) {
      localStorage.setItem(prefix + key, JSON.stringify(value))
      return true
    }
    return false
  },

  getJSON: function (key) {
    if (supported()) {
      const valueString = localStorage.getItem(prefix + key)
      try {
        return JSON.parse(valueString)
      } catch (err) {
        // gracefully
      }
    }
  },

  supported
}
