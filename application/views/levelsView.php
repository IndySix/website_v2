<h1>All levels</h1>

<ul>

<?php foreach ($levels as $level): ?>

<li>Level: <?php echo $level['id']; ?>: <a href="<?php echo baseUrl('level/view/'. $level['id']); ?>"><?php echo $level['description']; ?></a></li>

<?php endforeach; ?>

</ul>