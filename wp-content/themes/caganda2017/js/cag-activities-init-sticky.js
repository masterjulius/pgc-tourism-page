/*! (c) 2016-2017 Cagayan PPDO-IT Dev Team | https://www.cagayan.gov.ph */
(function($) {
	$(function(e) {
		$(document).ready(function(e){
			cag_cagayan_activities.initialize();		
		});
	});
})(jQuery);

var cag_cagayan_activities = {
	initialize:function(){
		this.init_sticky();
	},
	init_sticky:function(){
		var mobileMaxWidth = 600; // MaterializeCSS max mobile size
		if ( jQuery( window ).width() > mobileMaxWidth ) { // Run only if not on mobile
			jQuery( '.cag-sticky-column' ).stick_in_parent( {
			    parent: '.cag-sticky-parent'
			});
			//$(document.body).trigger( "sticky_kit:tick" );
		}
	}
}