(function($) {
  	//
	//  Portfolio Cycle
	//
	//  Created by Adam Taylor on 2009-06-04.
	//  Copyright (c) 2009 I am Ad Taylor. All rights reserved.
	//

	$.fn.portfolioCycle = function(options) {
    debug(this, true);

    // build main options before element iteration
	var opts = $.extend({}, $.fn.portfolioCycle.defaults, options);
	
	var next = $(this).siblings("a#"+opts.nextID);
	var prev = $(this).siblings("a#"+opts.prevID);
	
	// Default previous button as inactive
	prev.addClass('inactive');
	
    // iterate and reformat each matched element
	return this.each(function() {
		$this = $(this);
				
		// Add on click actions
		next.click(function(){
			if(!next.hasClass('inactive'))	{
				$.fn.portfolioCycle.transition("next", opts.speed);
				if(prev.hasClass('inactive'))	{
					prev.removeClass('inactive');
				}
					if ($('li:visible',$this).next('li').length == 1) {
						next.addClass('inactive');
					}
			} 
			return false;
		});
		
		prev.click(function(){
			if(!prev.hasClass('inactive'))	{
				$.fn.portfolioCycle.transition("prev", opts.speed);
				if(next.hasClass('inactive'))	{
									next.removeClass('inactive');
				}
					if ($('li:visible',$this).prev('li').prev('li').length == 0) {
							prev.addClass('inactive');
					}
			}
			return false;	
		});
		
		});
	};

  //
  // private function for debugging
  //
	function debug($obj, size) {
		if (window.console && window.console.log)
			if (size == true)
				window.console.log('portfolioCycle selection count: ' + $obj.size());
			window.console.log($obj);
		};

  //
  // define and expose the transition
  //
	$.fn.portfolioCycle.transition = function(direction,fadespeed) {
		if (direction == "prev") {
			$('li:visible',$this).fadeOut(fadespeed).prev('li').fadeIn(fadespeed);
		}
		else if (direction == "next") {
			$('li:visible',$this).fadeOut(fadespeed).next('li').fadeIn(fadespeed);
		}

	};

  //
  // plugin defaults
  //
	$.fn.portfolioCycle.defaults = {
		speed : 'slow',
		transition : 'fade',
		prevID : 'prev',
		nextID : 'next'
	};
})(jQuery);