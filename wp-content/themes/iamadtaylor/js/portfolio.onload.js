$(document).ready(function() {
	// Set up universal navigation
	
    if(!$.fontAvailable('Graublau Web')) {
        Cufon.replace('#header ol li');
	}
	$("#header ol li").backgroundFade("#DA9D17", "#000");
	// Navigation Ends
	
	$("#portfolio").portfolioCycle();
	
});

// Functions

jQuery.fn.isRGBa = function() {
	var bgColour = $(this).css("background-color");
	var rgba = /rgba|RGBa|rgbA/;
	var matchCheck = bgColour.search(rgba);
	if(matchCheck != -1)
		return true; 
	else
		return false;
	
};

// For nav
jQuery.fn.backgroundFade = function(fadeInColour,fadeOutColour) {
	$(this).hover( 
		function() {
			$(this)
				//Fade to the new color
				.animate({backgroundColor:fadeInColour}, 750)
				
			}, 
		function(){
				//Fade back to original color
				
				$(this).animate({backgroundColor:fadeOutColour},750) 
				
			}
		);
};

