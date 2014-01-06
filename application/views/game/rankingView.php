
<div class="ranking">


<div id="king">
	<h2>The King Ranking</h2>
	<ol>
		<?php foreach ($ranking as $rank): ?>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="username"><?php echo $rank['username']; ?></span> <span class="score"><?php echo $rank['highscore']; ?></span></li>
		<?php endforeach; ?>	
	</ol>
</div>

<div id="levelranking">
<?php foreach ($levelRanking as $level): ?>
	<div>
		<h2><?php echo $level['levelName'] ?></h2>
		<ol>
			<?php foreach ($level['ranks'] as $rank): ?>
				<li><img src="<?php echo baseUrl('data/avatars/'.$rank['avatar']) ?>" height="20px"> <?php echo $rank['username'] ?> <?php echo $rank['score'] ?>pt</li>
			<?php endforeach; ?>
		</ol>
	</div>
<?php endforeach; ?>	
</div>
<div class="clear"></div>

</div>