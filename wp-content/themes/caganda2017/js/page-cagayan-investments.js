(function($){
  $(function(e){
    $(document).ready(function(e){
      cag_investments.initialize();
    });
  });
})(jQuery);

var cag_investments = {
  initialize: function(){
    this.init_page_scroll();
    this.init_matchHeight();
  },
  init_page_scroll: function(){
    // jQuery for page scrolling feature - requires jQuery Easing plugin
    var navbarHeight = 58;
    $( 'a.page-scroll' ).on( 'click', function(event) {
      var $anchor = $( this );
      $( 'html, body' ).stop().animate({
        scrollTop: $( $anchor.attr( 'href' )).offset().top - navbarHeight
      }, 1500, 'easeInOutExpo');
      event.preventDefault();
    });
  },
  init_matchHeight: function(){
    $('.investments-contact .col').matchHeight({
      byRow: true,
      property: 'height',
      target: null,
      remove: false
    });
  }
}