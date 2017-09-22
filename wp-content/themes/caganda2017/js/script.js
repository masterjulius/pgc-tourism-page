(function($) {
	$(function(e) {
		$(document).ready(function(){
	    	app.initialize();
		});
	});
})(jQuery);

var $main_container = '#main-container-home, .page-container-main, .cag-page-template, .caganda-single-main-page';

var app = {
	initialize: function() {
		this.ready_components();
	},
	ready_components: function() {
		// Welcome text
		// console.clear();
		console.log("%cWelcome to Cagayan.Gov.Ph", "font-size:3em;color:#ff0000;");
		this.scroll_fire();
		pages.news();
		$args = [".cag-news-page-parallax", ".cag-news-single-parallax", ".cag-gallery-page-parallax", ".cag-gallery-page-parallax", ".cag-activities-page-parallax", ".cag-activities-single-parallax", ".cag-announcements-page-parallax", ".cag-default-page-parallax", ".parallax-directory", ".parallax-pope", ".parallax-qrt", ".parallax-100days", ".parallax-advisory", ".parallax-investments", ".parallax-governors-corner", ".parallax-governors-corner-subpage",  ".contact-parallax"];
		this.init_theme_parallax($args);
	},
	scroll_fire: function(args, setoffset) {
		var customCallbackFunc = function(e) {
		}
		var options = [
		    {selector: '.class1', offset: 200, callback: customCallbackFunc },
		    {selector: '.class2', offset: 200, callback: function() {
		      customCallbackFunc();
		    } },
		];
		Materialize.scrollFire(options);
        
	},
	init_theme_parallax: function($args) {
		for (var i = 0; i < $args.length; i++) {
			$( $args[i] ).parallax();
		}
	}
}

var pages = {

	news: function() {
		pagination();
		function pagination() {

			// set the main pagination selectorparallax-directory
			var $selector = jQuery('.cag-page-new-pagination-row .cag-page-new-pagination ul.pagination li');

			// design the current pagination
			$selector.find('span.current').wrap('<a />').closest('li').addClass('active');

			// change previous and next button
			$selector.find('a.prev').empty().append('<i class="cagicon-chevron-left" />');
			$selector.find('a.next').empty().append('<i class="cagicon-chevron-right" />');

			// fix next and previous buttons
			$selector.find('a.prev, a.next').closest('li').addClass('nav-arrow');

		}

	}

}