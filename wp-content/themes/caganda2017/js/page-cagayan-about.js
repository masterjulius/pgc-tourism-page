(function($) {
	$(function(e) {
		$(document).ready(function(e){
			page_cagayan_about.initialize();		
		});
	});
})(jQuery);

var page_cagayan_about = {
	initialize: function() {
		this.on_load();
		this.start_choose('.cag-about-side ul li a', '.cag-about-cagayan-main-contents');
		this.remove_img_attributes('.cag-page-aboutcagayan .cag-about-content img');
	},
	on_load: function(){
		var url = window.location.href;
		var urlSplit = url.split("/");

		var target = urlSplit[urlSplit.length - 1];
		// console.log(target[0]);
		if ( "#" === target[0] ){

			target = target.substring(1, target.length);
			var locationParent = '.cag-about-cagayan-main-contents';

			// Show active content
			$(locationParent).find('div.active').addClass('inactive').removeClass('active');
			var targetDiv = $(locationParent).find('div[data-container="' + target + '"]');
			targetDiv.removeClass('inactive').addClass('active');
			var theTitle = targetDiv.find('.cag-about-title h5');

			// call such script
			_set_demography_script();

			// set selected item in the sidebar
			// highlight current selected item
			var $itemSelected = $('.cag-about-cagayan-main-sidebar li a[href="'+ target +'"]');	
			$itemSelected.closest('ul').find('li.active').removeClass('active');
			$itemSelected.closest('li').addClass('active');

		}

	},
	start_choose: function(selector, locationParent) {
		$(document).on('click', selector, function(e) {
			e.preventDefault();
			var $this = $(this),
				target = $this.attr('href');

			// highlight current selected item
			$this.closest('ul').find('li.active').removeClass('active');
			$this.closest('li').addClass('active');

			// Show active content
			$(locationParent).find('div.active').addClass('inactive').removeClass('active');
			var targetDiv = $(locationParent).find('div[data-container="' + target + '"]');
			targetDiv.removeClass('inactive').addClass('active');
			var theTitle = targetDiv.find('.cag-about-title h5');		

			// call such script
			_set_demography_script();
		});

	},
	remove_img_attributes: function(selector) {
		// $(selector).removeAttr('width').removeAttr('height').removeAttr('sizes').removeAttr('srcset');
	}
}