(function($) {
	$(document).ready(function(e){
		cag_page_search.initialize();
	});
})(jQuery);

var cag_page_search = {
	initialize: function(){
		// this.init_suggestions(sSuggestArr, '.cag-page-search #txtSearch');
	},
	init_suggestions: function(dataArray, selector) {
		$(selector).autocomplete({
		    data: dataArray,
		    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
		    onAutocomplete: function(val) {
		      // Callback function when value is autcompleted.
		    },
		    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
		});
	}
}