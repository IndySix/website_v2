<div class="feedbackLevel">
<video width="320" height="240" controls poster="<?php echo baseUrl('data/uploads/thumbnail/'.$video) ?>.jpg">
  	<!-- <source src="<?php echo baseUrl('data/uploads/'.$video) ?>.mp4" type="video/mp4"> -->
  	<source src="<?php echo baseUrl('data/uploads/'.$video) ?>.ogv" type="video/ogg">
	Your browser does not support the video tag.
</video> 
<h2>Score</h2>
<p><span><?PHP echo $score ?> pt</span></p>
<h2>
	<span class="field">Try's</span>
	<span class="field">Time</span>
</h2>
<p>
	<span class="field"><?PHP echo $trys ?></span>
	<span class="field"><?PHP echo $time ?></span>
</p>
</div>