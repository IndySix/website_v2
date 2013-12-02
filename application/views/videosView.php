
<?php foreach ($videos as $video): ?>

<div class="video">
	<a href="<?php echo baseUrl('videos/view/' . $video['id'])?>">
	 <h2>Level: <?php echo $video['level_id']; ?></h2>
		<img src="http://placehold.it/300x200" width="100%">
	</a>
</div>

<?php endforeach; ?>

<div class="clear"></div>