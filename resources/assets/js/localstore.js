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
    return
  },

  supported
}