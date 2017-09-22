/*! (c) 2016-2017 Cagayan PPDO-IT Dev Team | https://www.cagayan.gov.ph */

var navbarHeight = 58;
var mastheadHeight = 100;
// $('.slider').slider();

// (function($){
// 	$(function(e){
// 		$(document).ready(function(e){
// 			cag_page_govs_corner.initialize();
// 		});
// 	});
// })(jQuery);

// var cag_page_govs_corner = {
// 	initialize: function(){
// 		this.init_album();
// 		this.init_page_scroll();
// 		this.init_parallax_design();
// 		this.init_slider();
// 		this.init_scroll_spy();
// 	},
// 	init_album: function(){
// 		// Add Random Class Grids to the album-selector div
// 		$( '.album-selector' ).each( function() {
// 			var x = Math.round( Math.random()*3 );
// 			var randomClass = [ 'gt', 'gb', 'gl', 'gr' ];
// 			$( this ).addClass( randomClass[x] );
// 		});
// 	},
// 	init_page_scroll: function(){
// 		// jQuery for page scrolling feature - requires jQuery Easing plugin
// 		$( 'a.page-scroll' ).on( 'click', function(event) {
// 			var $anchor = $(this);
// 			$( 'html, body' ).stop().animate({
// 			scrollTop: $($anchor.attr( 'href' )).offset().top - navbarHeight
// 			}, 1500, 'easeInOutExpo');
// 			event.preventDefault();
// 		});
// 	},
// 	init_parallax_design: function(){
// 		var screenHeight = $( this ).height();
// 		var headingHeight = $( '.cag-governorscorner-feature-heading' ).height();

// 		//Resising Parallax Container
// 		$( '.parallax-container' ).height( screenHeight );

// 		// Centering the gallery-feature-heading
// 		var headingTop = ( ( screenHeight + ( navbarHeight + mastheadHeight ) ) - headingHeight ) / 2;
// 		$( '.cag-governorscorner-feature-heading' ).css( 'margin-top', headingTop );
// 	},
// 	init_slider: function(){
		
// 	},
// 	init_scroll_spy: function(){
// 		$('.scrollspy').scrollSpy();
// 	}
// }

$( document ).ready( function() {

	// Add Random Class Grids to the album-selector div
	$( '.album-selector' ).each( function() {
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

});


$( window ).on( 'load resize', function() {

	var screenHeight = $( this ).height();
	var headingHeight = $( '.cag-governorscorner-feature-heading' ).height();

	//Resising Parallax Container
	$( '.parallax-container' ).height( screenHeight );

	// Centering the gallery-feature-heading
	var headingTop = ( ( screenHeight + ( navbarHeight + mastheadHeight ) ) - headingHeight ) / 2;
	$( '.cag-governorscorner-feature-heading' ).css( 'margin-top', headingTop );

});

$(document).ready(function(){
	$('.slider').slider();
});
$(document).ready(function(){
	$('.scrollspy').scrollSpy();
});
