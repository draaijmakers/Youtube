/////////////////////////////////////////////////
//                                             //
//  DISCLAIMER                                 //
//  Deze is gemaakt door Davey Raaijmakers     //
//  Meer informatie: daveyraaijmakers.nl       //  
//                                             //
//  Bekijk de video die bij deze code hoort    //
//  https://www.youtube.com/watch?v=47xMj5KUrrA//
//                                             //
//                                             //
/////////////////////////////////////////////////

/* jQuery Sneeuweffect maken - Kerstspecial */


(function($){
	$.fn.snow=function(options){
		var $flake=$('<div id="flake" />')
		.css({'position':'absolute','top':'-50px'})
		.html('&#10052;'),
		
		documentHeight=$(document).height(),
		documentWidth=$(document).width(),
		defaults={
			minSize:10,
			maxSize:50,
			newOn:250,
			flakeColor:"#fdfdfd"
		},
		options=$.extend({},defaults,options);
		
		var interval=setInterval(function(){
			var startPositionLeft=Math.random()*documentWidth-100,
			startOpacity=0.5+Math.random(),
			sizeFlake=options.minSize+Math.random()*options.maxSize,
			endPositionTop=documentHeight-40,
			endPositionLeft=startPositionLeft-100+Math.random()*500,
			durationFall=documentHeight*10+Math.random()*5000;
			
			$flake.clone().appendTo('body')
			.css({
				left:startPositionLeft,
				opacity:startOpacity,
				'font-size':sizeFlake,
				color:options.flakeColor
			})
			.animate({
				top:endPositionTop,
				left:endPositionLeft,
				opacity:0.2
			},
			durationFall,'linear',function(){
				$(this).remove()
			});
		},
		options.newOn);
	};
})(jQuery);