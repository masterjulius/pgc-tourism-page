(function($){
	$(document).ready(function(e){
		page_tourism.initialize();
	});
})(jQuery);

var page_tourism = {
	initialize:function(){
		this.init_feature_parallax('.cag-tourism-body .keyart .parallax');
		this.init_lightsliders(['.cag-page-tourism .cag-tourism-topvisited #content-slider','.cag-page-tourism .cag-tourism-separator #separator-slider']);
		this.init_collapsible('.cag-page-tourism .collapsible');
		this.init_demography('tourism-demography-chart-container',demography_chartist_args);
	},
	init_feature_parallax:function(selector) {
		$(window).on("scroll", function(e){
			var top = this.pageYOffset;
			var layers = $(selector);
			var layer, speed, yPos;
			for (var i = 0; i < layers.length; i++) {
				layer = layers[i];
				speed = layer.getAttribute('data-speed');
				var yPos = -(top * speed / 100);
				layer.setAttribute('style', 'transform: translate3d(0px, ' + yPos + 'px, 0px)');
			}
		});
	},
	init_lightsliders(parentSelector){
		for (var i=0;i<=parentSelector.length-1;i++){
			jQuery(parentSelector[i]).lightSlider({
	            gallery:true,
	            item:8,
	            thumbItem:9,
	            slideMargin: 10,
	            speed:500,
	            auto:true,
	            loop:true,
	            pager: false,
	            controls: true,
	            enableTouch:true,
	            enableDrag:true,
	            freeMove:false,
	        });
		}
	},
	init_collapsible(selector){
		$(selector).collapsible();
	},
	init_demography: function(selectorIDName,series){

		for(var i=0;i<=series.LABELS.length;i++) {
			series.BGCOLORS.push(customChartColors[i]);
		}

		var config = {
			type: 'doughnut',
			data: {
				datasets: [{
					data: series.DATAS,
					backgroundColor: series.BGCOLORS,
					label: 'Ethnography Set'
				}],

				labels: series.LABELS

			},
			options: {
				responsive: true,
				cutoutPercentage: 25,
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Ethnography'
				},
				animation: {
					animateScale: true,
					animateRotate: true
				}
			}

		};

		var ctx = document.getElementById(selectorIDName).getContext("2d");
		var myDoughnut = new Chart(ctx, config);

	}

}