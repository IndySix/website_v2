$.event.special.swipe.horizontalDistanceThreshold = '100';
var height = 0;

function setContentHeight() {
	$('#resize').css('height', '100%');
	height = $("#resize").height() - ( $("#topBar").height() + $("#bottomBar").height() );
	$('#contentWrapper').css('height',  height );
}

function hideSettings(){
 		$('#settings').removeClass('visible');
 		$('#content').css('display', 'block'); 
 		$('#settings').css('display', 'none');
}
function displaySettings(){
 		$('#settings').addClass('visible');
 		$('#content').css('display', 'none'); 
 		$('#settings').css('display', 'block');
}

$(function() {
	setContentHeight();
	setTimeout(function(){ setContentHeight();},3000);

	$( window ).resize(function() {
		setContentHeight();
	});

	$('#settings-icon').click(function(){
		if ($('#settings').hasClass('visible')){
			hideSettings();
		} else {
		   displaySettings();
		}
    });

    $( document ).on( "swiperight", function(){ 
    	if( $('#settings').hasClass('visible') ){
    		hideSettings();
    	}
    });
    $( document ).on( "swipeleft", function(){ 
		if( !$('#settings').hasClass('visible') ) {
			displaySettings();
    	}
    });
});