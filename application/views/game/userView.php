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
			<div class="field" style="float:right">
				<h3>Game played:</h3>
				<p><span>0</span></p>
			</div>
		</div>

	<h2><span class="field">Latest video</span><span class="field">Latest game</span></h2>
	<div class="field">
		<div style="padding: 10px;">
			<video id="video" controls="" preload="none" poster="http://media.w3.org/2010/05/sintel/poster.png">
      			<source id="mp4" src="http://media.w3.org/2010/05/sintel/trailer.mp4" type="video/mp4">
      			<source id="webm" src="http://media.w3.org/2010/05/sintel/trailer.webm" type="video/webm">
      			<source id="ogv" src="http://media.w3.org/2010/05/sintel/trailer.ogv" type="video/ogg">
      			<p>Your user agent does not support the HTML5 Video element.</p>
    		</video>
		</div> 
	</div>
	<div class="field" style="float:right; padding-top: 10px;">
		<h3><?PHP echo $latestLevelName ?></h3>
		<p><span><?PHP echo $latestLevelScore ?> pt</span></p>
	</div>
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