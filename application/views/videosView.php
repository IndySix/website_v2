
<?php foreach ($videos as $video): ?>

<div class="video">
	<a href="<?php echo baseUrl('videos/view/' . $video['id'])?>">
	 <h2>Level: <?php echo $video['level_id']; ?></h2>
		<img src="<?php echo baseUrl('data/uploads/thumbnail/'.$video['video_name']) ?>.jpg" width="100%">
	</a>
</div>

<?php endforeach; ?>

<div class="clear"></div>