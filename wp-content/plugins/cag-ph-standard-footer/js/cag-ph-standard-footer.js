(function($) {
	$(function(e) {
		cag_ph_standard_footer.initialize();
	});
})(jQuery);

var cag_ph_standard_footer = {
	initialize: function() {
		this.components();
	},
	components: function() {
		this.format_multiple_links('ul.cag-ph-standard-footer-direct-links-group li a, ul.cag-ph-standard-footer-govt-links-group li a', 'grey-text text-lighten-3');
	},
	format_multiple_links: function(selector, setClass) {
		$(selector).each(function(e) {
			$(this).addClass(setClass);
		});
	}
}	