<div id="videosView">
	<h1>Latests videos</h1>

	<?php foreach ($videos as $video): ?>

	<div class="video">
		<a href="<?php echo baseUrl('videos/view/' . $video['id'])?>">
		 	<h2><?php echo $video['levelName']; ?> level <?php echo $video['level']; ?> by <?php echo $video['username']; ?></h2>
		 	<img class="play" src="<?PHP echo baseUrl('data/img/play_button.png') ?>"> 
			<img src="<?php echo baseUrl('data/uploads/thumbnail/'.$video['video_name']) ?>.jpg" width="100%">
			<!-- <video class="video-embed" controls poster="http://www.placehold.it/900x400">
			  <source src="<?php echo baseUrl('data/uploads/'.$video['video_name'])?>.mp4" type="video/mp4">
			  <source src="http://media.w3.org/2010/05/sintel/trailer.ogv" type="video/ogg">
			</video> -->
		</a>
	</div>

	<?php endforeach; ?>
</div>