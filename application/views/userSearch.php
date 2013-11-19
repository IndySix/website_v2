<form>
	<input id="search-user" type="text" name="search" value="<?PHP echo $search ?>" autocomplete="off">
	<input type="submit" value="search">
</form>
<hr>
<div id="search-results">
<?PHP foreach($users as $user): ?>
	<a href="<?PHP echo baseUrl('user/view/'.$user['id'].'/'.$user['username']) ?>">
		<p>
			<img src="<?PHP echo baseUrl('data/avatars/'.$user['avatar']) ?>" width="60px">
			<?PHP echo $user['username'] ?>
		</p>
	</a>
<?PHP endforeach; ?>
</div>

<script type="text/javascript">
	var ajaxReq = null;
	
	jQuery("#search-user").on('input', function() {
		if(ajaxReq != null)
       		ajaxReq.abort();

    	ajaxReq = jQuery.ajax({
    		type: "GET",
    		url: "<?PHP echo baseUrl('user/search/json') ?>",
    		data: "search="+jQuery('#search-user').val(),
    		success: function(msg){
       			jQuery('#search-results').html('');
       			//display result
       			resp = JSON.parse(msg);
       			for (var i = 0; i < resp.users.length; i++) {
       				var html = jQuery('#search-results').html(); 
       				html += "<a href='<?PHP echo baseUrl('user/view/') ?>"+resp.users[i]['id']+"'> <p>";
       				html += "<img src='<?PHP echo baseUrl('data/avatars/') ?>"+resp.users[i]['avatar']+"' width='60px'> ";
       				html += resp.users[i]['username']
       				html += "</p></a>";
       				jQuery('#search-results').html(html);
       			};
       			
    		}
		});
	});
</script>