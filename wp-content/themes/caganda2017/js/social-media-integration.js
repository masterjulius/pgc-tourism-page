(function($) {

	$(function(e) {

		// Call functions
		   	// * FB
		var app_id_old = '1174938765909663';
		var app_id_new = '208661972923509';
		cag_social_media_integration.facebook(app_id_new, 'v2.8', '#cag-news-post-share-btn-fb');
		   	// * Twitter
		// cag_social_media_integration.twitter();
		   	// * Google Plus
		cag_social_media_integration.google_plus('#cag-news-post-share-btn-gglepls');

	});

})(jQuery);

var cag_social_media_integration = {

	facebook: function( appId, version, selector ) {

	   	init();
	   	share(selector);

	   	function init() {
	   		window.fbAsyncInit = function() {
					FB.init({
						appId      : appId,
						xfbml      : true,
						version    : version
					});
				};
				(function(d, s, id){
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) {return;}
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/en_US/sdk.js";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
	   	}

	   	function share(selector) {
	   		$(document).on('click', selector, function(e) {
				e.preventDefault();
				var cag_news_single_url = $(this).attr('href');
			   	FB.ui({
					method: 'share',
					display: 'popup',
					href: cag_news_single_url,
				}, function(response){});
			});
	   	}

	},
	twitter: function(selector) {

	},
	google_plus: function(selector) {
	   	$(document).on('click', selector, function(e) {
	   		e.preventDefault();
	   		var href = $(this).attr('href');
	   		gPlus( href );
	   		function gPlus(url){
				window.open(
					'https://plus.google.com/share?url='+ url,
					'popupwindow',
					'scrollbars=yes,width=800,height=400'
				).focus();
				return false;
			}
	   	});
	}

} // end var