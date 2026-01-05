class GMap {
  constructor() {
    // If Google Maps is not loaded yet – do not run anything
    if (!window.google || !window.google.maps) return

    const maps = document.querySelectorAll(".acf-map")
    if (!maps.length) return

    maps.forEach(el => this.new_map(el))
  }

  new_map($el) {
    if (!$el) return

    const $markers = $el.querySelectorAll(".marker")
    if (!$markers.length) return

    const args = {
      zoom: 16,
      center: new google.maps.LatLng(0, 0),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    const map = new google.maps.Map($el, args)
    map.markers = []

    $markers.forEach(markerEl => this.add_marker(markerEl, map))

    // Center the map only if markers were actually added
    if (map.markers.length) this.center_map(map)
  }

  add_marker($marker, map) {
    if (!$marker) return

    const lat = $marker.getAttribute("data-lat")
    const lng = $marker.getAttribute("data-lng")
    if (!lat || !lng) return

    const latlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng))

    const marker = new google.maps.Marker({
      position: latlng,
      map: map
    })

    map.markers.push(marker)

    const html = $marker.innerHTML?.trim()
    if (html) {
      const infowindow = new google.maps.InfoWindow({ content: html })
      google.maps.event.addListener(marker, "click", function () {
        infowindow.open(map, marker)
      })
    }
  }

  center_map(map) {
    if (!map?.markers?.length) return

    const bounds = new google.maps.LatLngBounds()

    map.markers.forEach(marker => {
      if (!marker?.position) return
      bounds.extend(marker.position)
    })

    if (map.markers.length === 1) {
      map.setCenter(bounds.getCenter())
      map.setZoom(16)
    } else {
      map.fitBounds(bounds)
    }
  }
}

export default GMap
