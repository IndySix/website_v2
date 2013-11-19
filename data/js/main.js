function friendClickButtonHanlder(button, status){
	console.log( "Clicked: " + jQuery( button ).data('id') );
	console.log(status);
}


jQuery(function() {
	jQuery( ".friend-button" ).each(function( index ) {
		var id = jQuery( this ).data('id');
		var button = this;
		var status = "request" 
		
		//get friend status
		jQuery.get( "../../../../../../../../projecten/website_v2/friend/status/"+id, function( data ) {
			resp = JSON.parse(data);
			console.log(resp.status);
			if(resp.status == 'request_send'){
				status = 'request_send';
				jQuery(button).html('request send');
				jQuery(button).removeClass('friend-request friend');
				jQuery(button).addClass('request-send');
			}
			if(resp.status == 'friend'){
				status = 'friend';
				jQuery(button).html('friend');
				jQuery(button).removeClass('friend-request request-send');
				jQuery(button).addClass('friend');
			}
		});
		
		jQuery(this).click(function(event) {
			event.preventDefault();
			friendClickButtonHanlder(this, status);
    	});
	});
});