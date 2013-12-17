<script src="<?PHP echo baseUrl('data/game/js/jquery.knob.js') ?>"></script>
<div id="userView">
	<h2>Profile</h2><img class="avatar" src="<?PHP echo $avatarUrl ?>">
	<p class="profile">	
		
		<span class="username"><?PHP echo $username ?></span><br/>
		<span class="difficulty"><?PHP echo $difficulty ?></span>
	</p>

	<h2><span class="field">Carreer</span><span class="field">Battles</span></h2>
		<div style="padding: 10px;">
			<div class="field" style="position: relative; min-height: 100px;">
				<h3>Game complete:</h3>
			        <div style="width: 70px; height: 70px; position: absolute; left: 50%; margin-left: -35px; top: 30px;">
			    		<input class="knob"  data-thickness=".3" data-fgcolor="rgba(254,254,254,1)" data-bgColor="rgba(204,204,204,1)"  data-width="70" data-height="70" readonly value="22">
					</div>
			    </div>
			<div class="field">
				<h3>Game played:</h3>
			</div>
		</div>

	<h2><span class="field">Latest video</span><span class="field">Latest game</span></h2>
</div>

<script type="text/javascript">
    jQuery(function() {
    	jQuery(".knob").knob();

    	var progress = 0;
    	var curruntProgress = <?PHP echo $data['progress']; ?>;
    	var timer = setInterval(function(){
    	progress += 1;
    	if(progress > curruntProgress){
    		window.clearInterval(timer)
    	}
    	jQuery(".knob").val(progress).trigger("change");
    	},10);
	});
</script>