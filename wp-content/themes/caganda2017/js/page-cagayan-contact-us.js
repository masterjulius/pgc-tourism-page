/*! (c) 2016-2017 Cagayan PPDO-IT Dev Team | https://www.cagayan.gov.ph */
(function($){

  $(document).ready(function(e){
    cag_contact_us.initialize();
  });

})(jQuery);

var cag_contact_us = {

  initialize: function(){
    this.fix_matchHeight();
    this.showMap();
  },

  fix_matchHeight: function(){

    jQuery('.contact-staff .col').matchHeight({
      byRow: true,
      property: 'height',
      target: null,
      remove: false
    });

  },

  showMap: function() {

    var map = L.map('cag-map', {
      center: [17.64836, -238.25903],
      zoom: 13,
      attributionControl: false,
      zoomControl: true,
      scrollWheelZoom: false
    });

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
       minZoom: 8,
       maxZoom: 18,
       attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
          '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
    }).addTo(map);

    L.marker([17.64836, -238.23903]).addTo(map)
       .bindPopup("<b>PPDO IT Division</b>");//.openPopup();


    map.zoomControl.setPosition('bottomright');

  }

}