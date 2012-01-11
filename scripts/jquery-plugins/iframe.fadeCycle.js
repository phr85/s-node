/*
*  jquery fadeCycle Plugin
*  Proprietary licence avail. via info@iframe.ch
*  Version 0.2 
*  USAGE:
   $(document).ready(function () {
     $('#container').fadeCycle({ options });
});
*  Authors Dominik Zogg, Florian Gächter, Veith Zäch
*/

$.fn.fadeCycle = function(options) {
	var cycles = 0;	// current cycle, start with 0
	var currentIndex = 0;  // not used at the moment, this var is just informative now, will be needed for pause / next / prev methods
	// set default option values
	options = $.extend({}, $.fn.fadeCycle.defaults, options || {});	

	// make animation always nice
	if(options.effectSpeedIn > options.effectSpeedOut){
		options.effectSpeedIn = options.effectSpeedOut - 500;
	}	
	if(options.effectSpeedOut > options.delay){
		options.delay = options.effectSpeedOut + 500;
	}
	options = $.extend({loopDelay: options.delay}, options || {});		
	
	// set container element relative
	$(this).css('position','relative');

	// collect the elements
	var childElements = $(this).children();
	$(childElements).css({'display':'block','position':'absolute','display':'none' });
	$(childElements[0]).css('display','block');

	// start if there are enough elements
	if(childElements.length > 1){
		setTimeout(function(){animate(options)},options.delay);
	}
	
	// this is aat least one cycle
	function animate(options){
		cycles ++;
		currentIndex = i;
		for(var i = 1; i < childElements.length; i++){
			$(childElements[i-1]).fadeOut(options.effectSpeedOut);
			$(childElements[i]).fadeIn(options.effectSpeedIn);
		}
		if(options.loop || options.cycles > 0){
			if(cycles < options.cycles || options.cycles == 0){
			setTimeout(function(){looping(options)},options.loopDelay);
			}
		}
		if (options.debug){window.console.log('[cycle] ' + cycles);}
	}
	
	// loop from last to first slide
	function looping(options){
		// last to first animation
		$(childElements[childElements.length - 1]).fadeOut(options.effectSpeedOut);
		$(childElements[0]).fadeIn(options.effectSpeedIn);
		setTimeout(function(){animate(options)},options.delay);
	}
}

// default settings
$.fn.fadeCycle.defaults = {
	loop:true,				// loop cycle (false is the same like 1 cycle)
	effectSpeedIn: 1500,  	// fadeIn effect time
	effectSpeedOut: 2500,   // fadeOut effect time
	delay: 2600, 			// delay between cycles (bigger then effect time)
	debug: false,  			// console message
	cycles: 0 				// repetitions (overrides loop)
};