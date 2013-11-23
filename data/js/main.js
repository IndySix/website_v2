var l = window.location;
var base_url = l.protocol + "//" + l.host + "/projecten/website_v2/";

function setFriendButtonStatus(button, status){
	//reset button
	jQuery(button).removeClass('friend-request request-send friend');

	if(status == 'request'){
		jQuery(button).addClass('friend-request');
		jQuery(button).html('Add Friend');
	} else  if(status == 'request_send'){
		jQuery(button).addClass('request-send');
		jQuery(button).html('Request Send');
	} else if(status == 'friend'){
		jQuery(button).html('Friend');
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
		
		html = "<table cellsapcing='0' cellpadding='0'>";
		for (var i = 0; i < resp.requests.length; i++) {
			counter += 1;
			html += "<tr id='friend-reguest-"+resp.requests[i]['id']+"'>";
			html += "<td><a href='"+base_url+'user/view/'+resp.requests[i]['id']+"'>";
			html += "<img src='"+base_url+"data/avatars/"+resp.requests[i]['avatar']+"' width='20px'></a></td>";
			html += "<td><a href='"+base_url+'user/view/'+resp.requests[i]['id']+"'>";
			html += resp.requests[i]['username']+ "</a></td>";
			html += "<td><a class='accept' href='javascript:void(0);' onclick=\"acceptFriendRequest("+resp.requests[i]['id']+");\" >Accept</a></td>";
			html += "<td><a class='refuse' href='javascript:void(0);' onclick=\"refuseFriendRequest("+resp.requests[i]['id']+");\" >Refuse</a></td>";
			html +="</tr>"
		};

		html += "</table>"
		
		if(counter == 0) {
			html = "<p>No friend request</p>";
			jQuery('#friend-requests-count').css('display', 'none');
		} else {
			jQuery('#friend-requests-count').html(counter);
			jQuery('#friend-requests-count').css('display', 'block');
		}
		jQuery('#friend-requests').html(html);
		//jQuery('#friend-requests-button').html('request '+counter);
	});
}

function acceptFriendRequest(id){
	jQuery.get( base_url+"friend/accept/"+id, function( data ) {});
	jQuery('#friend-reguest-'+id).stop().slideUp(200);
	checkFriendRequests();
}

function refuseFriendRequest(id){
	jQuery.get( base_url+"friend/refuse/"+id, function( data ) {});
	jQuery('#friend-reguest-'+id).stop().slideUp(200);
	checkFriendRequests();
}

function hideAllDisplays(ignoreDisplay){
    //settings
    if(ignoreDisplay != "#settings-menu")
        jQuery('#settings-menu').addClass("hide");
    //friend requests
    if(ignoreDisplay != "#friend-requests") {
        jQuery("#friend-requests").stop().animate({
            height: "hide",
            opacity: "hide"
        }, 500);
    }
    //search bar
    if(ignoreDisplay != "#searchBar")
        jQuery('#searchBar').addClass("hide")
}


jQuery(function() {
	// Document click close all drop down
	jQuery(document).click(function () {
    	hideAllDisplays("");
	});

	//Friend button
	jQuery( ".friend-button" ).each(function( index ) {
		var id = jQuery( this ).data('id');
		var button = this;
		var status = "request" 
		
		//get friend status
		jQuery.get( base_url+"friend/status/"+id, function( data ) {
			resp = JSON.parse(data);
			status = resp.status;
			setFriendButtonStatus(button, resp.status);
		});
		
		jQuery(this).click(function(event) {
			event.preventDefault();
			friendClickButtonHanlder(this, id, status);
    	});
	});

	//Display setting
	jQuery('#settings-menu-button').click(function (event){
	    event.stopPropagation();
	    hideAllDisplays("#settings-menu");
	    jQuery('#settings-menu').toggleClass("hide")
	})

	jQuery('#settings-menu').click(function (event){
	    event.stopPropagation();
	})
	//prevent clicking when opacity is 0
	jQuery('a').click(function(e){
    	if ( jQuery(this).parent().css('opacity')==0) 
    		e.preventDefault();
	});

	// Friend request menu
	//Display Friend request menu
	jQuery('#friend-requests-button').click(function (event) {
    	event.stopPropagation();
    	hideAllDisplays("#friend-requests");
    	jQuery("#friend-requests").stop().animate({
            height: "toggle",
            opacity: "toggle"
        }, 500);
	});

	jQuery('#friend-requests').click(function (event) {
    	event.stopPropagation();
	});

	//Set timer for checking new requests
    checkFriendRequests();
    setInterval(function(){checkFriendRequests();},30000);

    //searchBar
    //Display searchbar
	jQuery('#searchBarButton').click(function (event){
	    event.stopPropagation();
	    hideAllDisplays('#searchBar');
	    if( jQuery('#searchBar').hasClass("hide") ) {
	    	jQuery('#searchBar').removeClass("hide")
	    	jQuery('#searchBar').focus();
	    } else { 
	    	jQuery('.searchform').submit();
	    }
	})

	jQuery('#searchBar').click(function (event){
	    event.stopPropagation();
	})

    //jQeury UI autocomplete html extension
    var proto = $.ui.autocomplete.prototype,
    initSource = proto._initSource;

	function filter( array, term ) {
    	var matcher = new RegExp( jQuery.ui.autocomplete.escapeRegex(term), "i" );
    	return $.grep( array, function(value) {
        	return matcher.test( jQuery( "<div>" ).html( value.label || value.value || value ).text() );
    	});
	}

	jQuery.extend( proto, {_initSource: function() {
	        if ( this.options.html && jQuery.isArray(this.options.source) ) {
	            this.source = function( request, response ) {
	                response( filter( this.options.source, request.term ) );
	            };
	        } else {
	            initSource.call( this );
	        }
    	},_renderItem: function( ul, item) {
      		return jQuery( "<li></li>" )
            	.data( "item.autocomplete", item )
            	.append( jQuery( "<a></a>" )[ this.options.html ? "html" : "text" ]( item.label ) )
            	.appendTo( ul );
    	}
	});
	//Add autocomplete to searchBar
	
	jQuery( "#searchBar" ).autocomplete({
		source:  base_url+"user/search/searchBar",
		minLength: 1,
		html: true,
		messages: {
        	noResults: '',
        	results: function() {}
    	},
    	select: function( event, ui ) {
 			var div = jQuery.parseHTML(ui.item.label);
 			var id = jQuery(div).attr('id');
 			window.location.href = base_url+"user/view/"+id+"/"+ui.item.value;
    	}
	});
});

