const api_url = location.protocol + '//transport.opendata.ch/v1'

export default {
  connections: function (from, to, limit) {
    const resource = '/connections'
    return fetch(api_url + resource + '?from=' + from + '&to=' + to + (limit ? '&limit=' + limit : ''))
      .then(response => response.json())
  }
}