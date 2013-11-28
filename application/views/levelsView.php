<ul id="levels">
	<?php foreach ($levels as $level): ?>
		<a href="<?php echo baseUrl('level/view/'. $level['id']); ?>">
		<li>
		
			<img class="level-image" src="<?php echo baseUrl('data/img/parts/' . $level['image'] . '.jpg'); ?>">	
			<div class="level-data">
			<h2>Level: <?php echo $level['id']; ?></h2>
			<p>Description: <?php echo $level['description']; ?></p>
			<p>Difficulty: <?php echo $level['difficulty']; ?></p>
			</div>
		</li>
		</a>
	<?php endforeach; ?>
</ul>

<div class="clear"></div>

