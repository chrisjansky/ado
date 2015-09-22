var mapIframe = document.getElementById("js-map");

// Google Maps.
if (mapIframe !== null) {
  function initMaps() {
    var mapOptions = {
      center: {lat: 49.2204118, lng: 17.6497536},
      zoom: 16,
      scrollwheel: false
    };
    var 
      map = new google.maps.Map(mapIframe, mapOptions),
      infoWindow = new google.maps.InfoWindow(),
      mapMarker = new google.maps.Marker({
        position: mapOptions.center,
        map: map,
        title: "Třída Tomáše Bati 4342, Zlín"
      });
    google.maps.event.addListener(mapMarker, "click", function() {
      infoWindow.setContent("Univerzita Tomáše Bati, budova U16 &mdash; Třída Tomáše Bati 4342, 760 01 Zlín");
      infoWindow.open(map, mapMarker);
    });
  }
  initMaps();
}
