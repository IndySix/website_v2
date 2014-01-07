
<div id="ranking">
<!-- <h1>Ranking</h1> -->
<div id="king">
	<h1>The King Ranking</h1>
	<ol>
		<?php foreach ($ranking as $key => $rank): ?>
			<li class="<?php echo $key%2 != 0 ? 'row' : '' ?>">
				<span><?php echo $key+1 ?></span>
				<a href="<?php echo baseUrl('user/view/'.$rank['id'].'/ranking') ?>">
					<img src="<?php echo baseUrl('data/avatars/'.$rank['avatar']) ?>" height="20px"> 
					<?php echo $rank['username']; ?>
				</a>
				<span><?php echo $rank['highscore']; ?> pt</span>
			</li>
		<?php endforeach; ?>	
	</ol>
</div>

<div id="levelranking">
<h1>Part ranking</h1>
<?php $part_id = 0 ?>
<?php foreach ($partRanking as $key => $part): ?>
	<div>
		<h2><?php echo $part['description'] ?></h2>
		<?php if(!empty($part['ranks'])): ?>
		<ol>
			<?php foreach ($part['ranks'] as $key => $rank): ?>
				<li class="<?php echo $key%2 != 0 ? 'row' : '' ?>">
					<span><?php echo $key+1 ?></span>
					<a href="<?php echo baseUrl('user/view/'.$rank['id'].'/ranking') ?>">
						<img src="<?php echo baseUrl('data/avatars/'.$rank['avatar']) ?>" height="20px"> 
						<?php echo $rank['username'] ?> 
					</a>
					<span><?php echo $rank['score'] ?> pt</li></span>
			<?php endforeach; ?>

		</ol>
		<?php else: ?>
			<p>No ranking results</p>
		<?php endif; ?>
	</div>
<?php endforeach; ?>	
</div>
<div class="clear"></div>

</div>