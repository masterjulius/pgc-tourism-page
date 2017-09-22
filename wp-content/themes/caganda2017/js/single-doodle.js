(function($){
	$(document).ready(function(e){
		cag_single_doodle.initialize();
	});
})(jQuery);

var cag_single_doodle = {
	initialize: function(){
		this.init_slider('.cag-doodle-single .cag-doodle-single-slider');
		this.init_slider_history('.cag-doodle-single-slider-container .navigate-buttons');
	},
	init_slider(selector) {
		jQuery(selector).slick({
	   		fade: true,
	   		default: true,
	    });
	},
	init_slider_history(selector) {
		$(selector).on('click', function(e){
			e.preventDefault();
			var $this = $(this);
			var action = $this.attr('data-action'),
				targetUrl = $this.attr('href'),
				postID = $this.attr('data-slider-id');

			if ( postID ) {
				// ajax load contents
				cag_single_doodle.ajax_load_details(postID);
			}


			// window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);		
		});
	},
	ajax_load_details: function($postID) {
		jQuery.ajax({
			type : 'post',
			    url : myAjaxDoodle.ajaxurl,
			   	data : {
			        'action' : 'get_single_doodle_details',
			        'post_id' : $postID
			    },
			    beforeSend: function() {
			    	$('.cag-doodle-single .cag-doodle-single-slider img#sliderDoodleMainImg').css('visibility', 'hidden');
			    },
			    success: function( response ) {
			    	// console.log(response);
			    	var res = response;
			    	var parentSelector = $('.cag-doodle-single');
			    	parentSelector.find('.cag-doodle-single-slider img#sliderDoodleMainImg').attr('src', res.thumbnail).css('visibility', 'visible');

			    	var btnPrev = parentSelector.find('a.nav-btn-prev'), btnNext = parentSelector.find('a.nav-btn-next');

					btnPrev.attr({'data-slider-id' : res.previous, 'href' : res.permalink, 'disabled' : false}).removeClass('disabled');
					btnNext.attr({'data-slider-id' : res.next, 'href' : res.permalink, 'disabled' : false}).removeClass('disabled');

					// console.log("Prev: " + res.previous);
					// console.log("Next: " + res.next);

					if ( (res.previous == null || res.previous == "") ) {
						btnPrev.attr('disabled', true).addClass('disabled').removeAttr('href')
					}

					if ( (res.next == null || res.next == "") ) {
						btnNext.attr('disabled', true).addClass('disabled').removeAttr('href');
					}

					// Details
					var detailsParentSelector = parentSelector.find('.doodle-main-details');
					
					detailsParentSelector.find('.detail-date').text(res.date);
					detailsParentSelector.find('.detail-title').text(res.title);
					detailsParentSelector.find('.detail-content').text(res.content);

					// artists details
					var sketchGroup = detailsParentSelector.find('.art-sketch-group'),
						graphicGroup = detailsParentSelector.find('.art-graphic-group'),
						animatorGroup = detailsParentSelector.find('.art-animator-group');

					var objArtists = res.artists;

					sketchGroup.find('p').text( objArtists.sktch_artist.name );
					if ( objArtists.sktch_artist.thumbnail ) {
						sketchGroup.find('img').attr({'src' : objArtists.sktch_artist.thumbnail , 'alt' : objArtists.sktch_artist.alt});
					}

					graphicGroup.find('p').text( objArtists.grphc_artist.name );
					if ( objArtists.grphc_artist.thumbnail ) {
						graphicGroup.find('img').attr({'src' : objArtists.grphc_artist.thumbnail , 'alt' : objArtists.grphc_artist.alt});
					}

					animatorGroup.find('p').text( objArtists.anmtn_artist.name );
					if ( objArtists.anmtn_artist.thumbnail ) {
						animatorGroup.find('img').attr({'src' : objArtists.anmtn_artist.thumbnail , 'alt' : objArtists.anmtn_artist.alt});
					}

			    	window.history.pushState(res.title, "", res.permalink);
			    },
			    error: function(err) {
			        console.log(err);
			    }
		});

	}

}