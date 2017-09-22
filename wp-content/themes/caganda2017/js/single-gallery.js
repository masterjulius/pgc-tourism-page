/*! (c) 2016-2017 Cagayan PPDO-IT Dev Team | https://www.cagayan.gov.ph */
(function($){
  $(function(e){
    $(document).ready(function(e){
      cag_single_gallery.initialize();
    });
  });
})(jQuery);
var cag_single_gallery = {
  initialize:function(){
    this.init_justified('#gallery-selector-single');
    this.init_easing('a.page-scroll');
    this.init_gallery('#gallery-selector-single');
    this.init_parallax('.cag-single-gallery');
  },

  init_justified: function(selector){
    //Justified Gallery Config
    jQuery(selector).justifiedGallery({
      selector: '.gallery-thumb-single',
      rowHeight : 200,
      lastRow : 'nojustify',
      margins : 2,
      randomize: true,
      refreshTime: 200
    });
  },

  init_easing: function(selector){
    // jQuery for page scrolling feature - requires jQuery Easing plugin
    var navbarHeight = 58;
    $( selector ).on( 'click', function(event) {
      var $anchor = $( this );
      $( 'html, body' ).stop().animate({
        scrollTop: $( $anchor.attr( 'href' )).offset().top - navbarHeight
      }, 1500, 'easeInOutExpo');
      event.preventDefault();
    });
  },

  init_gallery: function(selector){
    //LightGallery Initialization
    jQuery( selector ).lightGallery({
      selector: '.gallery-thumb-single',
      thumbnail: true,
      showThumbByDefault: false,
      mode: 'lg-lollipop',
      hideBarsDelay: 2500
    });
  },

  init_parallax(selector){
    $(selector).parallax();
  }

}
