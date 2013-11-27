<h1>Videos</h1>

<?php foreach ($videos as $video): ?>

<a href="<?php echo baseUrl('videos/view/' . $video['id'])?>"><?php echo $video['video_name']; ?></a>

<?php endforeach; ?>