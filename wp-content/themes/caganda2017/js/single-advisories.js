// jQuery for page scrolling feature - requires jQuery Easing plugin
var navbarHeight = 58;
$( 'a.page-scroll' ).on( 'click', function(event) {
    var $anchor = $( this );
    $( 'html, body' ).stop().animate({
      scrollTop: $( $anchor.attr( 'href' )).offset().top - navbarHeight
    }, 1500, 'easeInOutExpo');
    event.preventDefault();
});