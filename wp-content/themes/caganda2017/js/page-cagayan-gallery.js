/*! (c) 2016-2017 Cagayan PPDO-IT Dev Team | https://www.cagayan.gov.ph */

var navbarHeight = 58;
var mastheadHeight = 100;

(function($){
  $(function(e){
    $(document).ready(function(e){
      cag_gallery_page.initialize();
    });
  });
})(jQuery);

var cag_gallery_page = {

  initialize:function(){
    this.init_album('.album-selector');
    this.init_load_resize();
  },
  //load resize parallax
  init_load_resize:function(selector = window) {
    $( window ).on( 'load resize', function() {

      var screenHeight = $( this ).height();
      var headingHeight = $( '.cag-gallery-feature-heading' ).height();

      //Resising Parallax Container
      $( '.cag-news-page-parallax-container' ).height( screenHeight );

      // Centering the gallery-feature-heading
      var headingTop = ( ( screenHeight + ( navbarHeight + mastheadHeight ) ) - headingHeight ) / 2;
      // alert(headingTop);
      $( '.cag-gallery-feature-heading' ).css( 'margin-top', headingTop );

    });
  },
  //set album grid design
  init_album:function(selector){

    // Add Random Class Grids to the album-selector div
    $( selector ).each( function() {
      var x = Math.round( Math.random()*3 );
      var randomClass = [ 'gt', 'gb', 'gl', 'gr' ];
      $( this ).addClass( randomClass[x] );
    });

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $( 'a.page-scroll' ).on( 'click', function(event) {
        var $anchor = $(this);
        $( 'html, body' ).stop().animate({
            scrollTop: $($anchor.attr( 'href' )).offset().top - navbarHeight
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    // Set div link to the anchor link
    $( '.card' ).click( function() {
      window.location = $( this ).find( 'a' ).attr( 'href' );
      return false;
    });

  }

}



