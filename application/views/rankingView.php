
<div class="ranking">


<div id="king">
	<h2>The King Ranking</h2>
	<ol>
		<?php foreach ($ranking as $rank): ?>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="username"><?php echo $rank['username']; ?></span> <span class="score"><?php echo $rank['highscore']; ?></span></li>
		<?php endforeach; ?>	
	</ol>
</div>

<div id="levels">
<?php foreach ($levels as $level): ?>
	<h2><?php echo $level['level_description']; ?></h2>
	<ol>
		<?php foreach ($scores as $score): ?>
			<?php if ($score['level_id'] == $level['id']): ?>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="username"><?php echo $score['username']; ?></span> <span class="score"><?php echo $score['score']; ?></span></li>
			<?php endif; ?>
		<?php endforeach; ?>	
	</ol>
<?php endforeach; ?>	
</div>
<div class="clear"></div>

</div>