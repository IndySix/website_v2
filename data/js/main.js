var l = window.location;
var base_url = l.protocol + "//" + l.host + "/projecten/website_v2/";

function setFriendButtonStatus(button, status){
	//reset button
	jQuery(button).removeClass('friend-request request-send friend');

	if(status == 'request'){
		jQuery(button).addClass('friend-request');
		jQuery(button).html('add friend');
	} else  if(status == 'request_send'){
		jQuery(button).addClass('request-send');
		jQuery(button).html('request send');
	} else if(status == 'friend'){
		jQuery(button).html('friend');
		jQuery(button).addClass('friend');
	}

} 

function friendClickButtonHanlder(button, id, status){
	if(status == "request"){
		jQuery.get( base_url+"friend/request/"+id, function( data ) {
			resp = JSON.parse(data);
			setFriendButtonStatus(button, resp.status);
		});
		jQuery(button).html('request send');
		jQuery(button).removeClass('friend-request friend');
		jQuery(button).addClass('request-send');
	} 
}

function checkFriendRequests(){
	jQuery.get( base_url+"friend/getRequests/", function( data ) {
		resp = JSON.parse(data);
		var html = "";
		var counter = 0;
		for (var i = 0; i < resp.requests.length; i++) {
			counter += 1;

			html += "<p id='friend-reguest-"+resp.requests[i]['id']+"'>";
			html += "<a href='"+base_url+'user/view/'+resp.requests[i]['id']+"'>";
			html += "<img src='"+base_url+"data/avatars/"+resp.requests[i]['avatar']+"' height='30px'>";
			html += " "+resp.requests[i]['username']+ "</a>";
			html += " <a href='javascript:void(0);' onclick=\"acceptFriendRequest("+resp.requests[i]['id']+");\" >Accept</a>";
			html += " <a href='javascript:void(0);' onclick=\"refuseFriendRequest("+resp.requests[i]['id']+");\" >Refuse</a>";
		};

		jQuery('#friend-requests').html(html);
		jQuery('#friend-requests-button').html('request '+counter);
	});
}

function acceptFriendRequest(id){
	jQuery.get( base_url+"friend/accept/"+id, function( data ) {});
	jQuery('#friend-reguest-'+id).stop().slideUp(200);
}

function refuseFriendRequest(id){
	jQuery.get( base_url+"friend/refuse/"+id, function( data ) {});
	jQuery('#friend-reguest-'+id).stop().slideUp(200);
}


jQuery(function() {
	//Friend button
	jQuery( ".friend-button" ).each(function( index ) {
		var id = jQuery( this ).data('id');
		var button = this;
		var status = "request" 
		
		//get friend status
		jQuery.get( base_url+"friend/status/"+id, function( data ) {
			resp = JSON.parse(data);
			console.log(resp.status);
			setFriendButtonStatus(button, resp.status);
		});
		
		jQuery(this).click(function(event) {
			event.preventDefault();
			friendClickButtonHanlder(this, id, status);
    	});
	});


	// Friend request menu
	jQuery(document).click(function () {
        jQuery('#friend-requests').stop().slideUp(200);
    });

    jQuery('#friend-requests').click(function (event) {
        event.stopPropagation();
    });


    jQuery('#friend-requests-button').click(function (event) {
        event.stopPropagation();
        jQuery("#friend-requests").stop().slideToggle(200);
    });
    checkFriendRequests();
    setInterval(function(){checkFriendRequests();},30000);
});

