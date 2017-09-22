(function($) {
	$(function(e) {
		cag_ph_standard_footer_media_upload.initialize();
	});
})(jQuery);

var cag_ph_standard_footer_media_upload = {
	initialize: function() {
		this.components();
	},
	components: function() {
		this.uploadAction();
	},
	uploadAction: function () {

		this.trigger_tricks('.ph_standard_footer_img', '.cag_ph_standard_upload_image_button');

		onTriggerChooseFiles('.cag_ph_standard_upload_image_button', '.ph_standard_footer_img');

		function onTriggerChooseFiles(selector, location) {
			
			jQuery(document).on("click", selector, function (e) {
		      	e.preventDefault();
		      	var $button = jQuery(this);		 
		 
		      	// Create the media frame.
		      	var file_frame = wp.media.frames.file_frame = wp.media({
		         	title: 'Select or upload image',
		         	library: { // remove these to show all
		            	type: 'image' // specific mime
		         	},
		         	button: {
		            	text: 'Select'
		         	},
		         	multiple: false  // Set to true to allow multiple files to be selected
		      	});
		 
		      	// When an image is selected, run a callback.
		      	file_frame.on('select', function () {
		         	// We set multiple to false so only get one image from the uploader
		 
		         	var attachment = file_frame.state().get('selection').first().toJSON();
		 
		         	$button.siblings('input').val(attachment.url);
		         	jQuery(location).attr('src', attachment.url);
		 
		      	});
		 
		      	// Finally, open the modal
		      	file_frame.open();
		   	});

		}

	},
	trigger_tricks(selector, triggerer) {
		jQuery(selector).on('click', function(e) {
			jQuery(triggerer).click();
		});
	}

}