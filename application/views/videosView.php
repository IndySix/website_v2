<h1>Videos</h1>

<?php foreach ($videos as $video): ?>

<a href="<?php echo baseUrl('videos/view/' . $video['id'])?>"><img src="<?php echo $video['thumbnail']; ?>"></a>

<?php endforeach; ?>