(function($){
	$(function(e){
		$(document).ready(function(e){
			cag_page_directories.initialize();
		});
	});
})(jQuery);

var cag_page_directories = {
	initialize: function(){
		this.init_mobile();
		this.init_cards();
		this.init_page_scroll();
	},
	init_mobile:function(){
		var mobileMaxWidth = 600; // MaterializeCSS max mobile size
		if ($(window).width() > mobileMaxWidth) { // Run only if not on mobile
		    jQuery( ".cag-sticky-column" ).stick_in_parent({
		      	parent: ".cag-sticky-parent",
		      	offset_top: 58,
		      	recalc_every: 2
		   	});
		//  $(document.body).trigger( "sticky_kit:tick" );
		}
	},
	init_cards:function(){

		$('.material-card > .mc-btn-action').click(function () {
		    var card = $(this).parent('.material-card');
		    var icon = $(this).children('i');
		    icon.addClass('cagicon-spin-fast');

		    if (card.hasClass('mc-active')) {
		      card.removeClass('mc-active');
		      window.setTimeout(function() {
		        icon
		            .removeClass('cagicon-arrow-left')
		            .removeClass('cagicon-spin-fast')
		            .addClass('cagicon-dots-vertical');
		      }, 800);
		    } else {
		      card.addClass('mc-active');
		      window.setTimeout(function() {
		        icon
		            .removeClass('cagicon-dots-vertical')
		            .removeClass('cagicon-spin-fast')
		            .addClass('cagicon-arrow-left');
		      }, 800);
		    }
		});

	},

	init_page_scroll: function() {
		// jQuery for page scrolling feature - requires jQuery Easing plugin
		var navbarHeight = 58;
		$( 'a.page-scroll' ).on( 'click', function(event) {
		    var $anchor = $( this );
		    $( 'html, body' ).stop().animate({
		      	scrollTop: $( $anchor.attr( 'href' )).offset().top - navbarHeight
		    }, 1500, 'easeInOutExpo');
		    event.preventDefault();
		});
	}
}