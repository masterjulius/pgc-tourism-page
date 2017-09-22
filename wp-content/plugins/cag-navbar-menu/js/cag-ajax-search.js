(function($) {
	jQuery(function(e){
		jQuery(document).ready(function(ev) {
			cag_ajax_search.initialize();
		});
	});
})(jQuery);

var cag_ajax_search = {
	initialize: function() {
		// this.navbar_value_loader();
		this.start_search('.cag-nav .cag-search-wrapper input[name="s"]', '.cag-navbar-menu-search-results');
		this.toggle_close('.cag-navbar-menu-search-results li.close-result' ,'.cag-navbar-menu-search-results');
	},
	start_search: function(input, container) {

		jQuery(document).on('keypress', input, function(e) {
		    var $input = jQuery(this);
		    var query = $input.val();
		    var $content = jQuery(container);
		    var plugin_dir = myAjaxSearch.pluginsUrl;
		    
		    if ( query.length >= 2 ) {

		    	jQuery.ajax({
			        type : 'post',
			        url : myAjaxSearch.ajaxurl,
			        data : {
			            action : 'load_search_results',
			            query : query
			        },
			        beforeSend: function() {
			        	$input.next().hide();
			            $input.addClass('textbox-with-gif');
			        },
			        success: function( response ) {
			        	$input.next().show();
			        	$input.removeClass('textbox-with-gif');
			            $content.html( response );
			        },
			        error: function(err) {
			        	console.log(err);
			        	$input.next().show();
			        	$input.removeClass('textbox-with-gif');
			        }
			    });
			    
		    }

		});

		jQuery(document).on('keydown keyup', function(e) {
			var $input = jQuery(this);
		    var query = $input.val();
		    var $content = jQuery(container);
		    if (query.length === 0 || query === "") {
		    	$content.empty();
		    }
		});

	},
	toggle_result(selector, type = 'either', speed = 500) {
		switch(type) {
			case 'either':
				jQuery(selector).slideDown(speed);
				break;
			case 'up':
				jQuery(selector).slideUp(speed);
				break;
			case 'down':
				jQuery(selector).slideDown(speed);
				break;		
		}	
	},
	toggle_close(selector, container, speed = 500) {
		jQuery(document).on('click', selector, function(e) {
			cag_ajax_search.toggle_result(container, 'up', speed);
		});
	}

}