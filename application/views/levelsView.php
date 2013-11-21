<h1>All levels</h1>

<table>

<tr>
	<th>Level</th>
	<th>Part</th>
	<th>Assignment</th>
	<th>Difficulty</th>
	<th>Image</th>
</tr>

<?php foreach ($levels as $level): ?>

	<tr>
		<td><a href="<?php echo baseUrl('level/view/'. $level['id']); ?>">Level: <?php echo $level['id']; ?></a></td>
	
		<td><?php echo $level['description']; ?></td>

		<td><?php echo $level['level_description']; ?></td>

		<td><?php echo $level['difficulty']; ?></td>

		<td> 
			<img src="http://placehold.it/350x150">
			<!-- <img src="<?php echo baseUrl('data'. $level['image']); ?>" width="200px"> -->
		</td>
	</tr>


<?php endforeach; ?>

</table>
