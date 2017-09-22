(function($) {
	$(function(e) {
		cag_visit_cagayan.initialize();
	});
})(jQuery);

var cag_visit_cagayan = {
	initialize: function() {
		this.buildHtml('.cag-visit-cagayan ul.cag-visit-cagayan-menu-group');
	},
	buildHtml: function(selectorMain) {


		var childs = $(selectorMain).find('li a').selector;
		set_icons(childs, 'title');
		this.multipleAddClasses(childs, 'waves-effect waves-light');

		function set_icons(childs, attr) {

			$(childs).each(function(e) {
				var $this = $(this);
				var title = $this.attr('title');
				$this.removeAttr('title');
				$this.prepend('<i class="cagicon '+ title +'"></i>');
			});

		}

	},
	multipleAddClasses: function(selector, classToAdd) {

		$(selector).each(function(e) {
			var $this = $(this);
			$this.addClass(classToAdd);
		});

	}
}