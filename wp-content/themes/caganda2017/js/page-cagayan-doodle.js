(function($){
	$(document).ready(function(e){
		cag_page_doodle.initialize();
	});
})(jQuery);

var cag_page_doodle = {
	initialize: function() {
		this.init_slider('.cag-page-doodle .slider');
		this.init_slider_indicators('.cag-page-doodle .slider .indicators li');
	},
	init_slider: function(selector) {
		$(selector).slider();
	},
	init_slider_indicators: function(selector) {
		var $this = $(selector);
		var totalCount = $this.length;
		var setWidth = 100 / totalCount;
		$this.css('width', (setWidth + "%") );
	}
}