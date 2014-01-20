//jQuery.event.special.swipe.horizontalDistanceThreshold = '100';
var height = 0;
function setContentHeight() {
	jQuery('#resize').css('height', '100%');
	height = jQuery("#resize").height() - ( jQuery("#topBar").height() + jQuery("#bottomBar").height() );
	jQuery('#contentWrapper').css('height',  height );
}

function hideSettings(){
 		jQuery('#settings').removeClass('visible');
 		jQuery('#content').css('display', 'block'); 
 		jQuery('#settings').css('display', 'none');
}
function displaySettings(){
 		jQuery('#settings').addClass('visible');
 		jQuery('#content').css('display', 'none'); 
 		jQuery('#settings').css('display', 'block');
}

jQuery(function() {
	setContentHeight();
	setTimeout(function(){ setContentHeight();},3000);

	jQuery( window ).resize(function() {
		setContentHeight();
	});

	jQuery('#settings-icon').click(function(){
		if (jQuery('#settings').hasClass('visible')){
			hideSettings();
		} else {
		   displaySettings();
		}
    });

  //   jQuery( document ).on( "swiperight", function(){ 
  //   	if( jQuery('#settings').hasClass('visible') ){
  //   		hideSettings();
  //   	}
  //   });
  //   jQuery( document ).on( "swipeleft", function(){ 
		// if( !jQuery('#settings').hasClass('visible') ) {
		// 	displaySettings();
  //   	}
  //   });
});