<div id="levelCarreer">
	<div id="map">
 		<img src="<?PHP echo baseUrl('data/img/career_map.jpg') ?>">
 		<a id="link-level1" href="#level1" onClick="displayLevel('level1')">
 			<?php if($levels[0]['score'] > 0): ?>
 				<img class="button" src="<?php echo baseUrl('data/img/wheel_button_trophy.png') ?>">
 			<?php endif; ?>
 		</a>

 		<a id="link-level2" href="#level2" onClick="displayLevel('level2')">
 			<?php if($levels[1]['score'] > 0): ?>
 				<img class="button" src="<?php echo baseUrl('data/img/wheel_button_trophy.png') ?>">
 			<?php elseif($levels[0]['score'] <= 0): ?>
 				<img class="button" src="<?php echo baseUrl('data/img/map_slotje.png') ?>">
 			<?php endif; ?>
 		</a>

 		<a id="link-level3" href="#level3" onClick="displayLevel('level3')">
 			<?php if($levels[2]['score'] > 0): ?>
 				<img class="button" src="<?php echo baseUrl('data/img/wheel_button_trophy.png') ?>">
 			<?php elseif($levels[1]['score'] <= 0): ?>
 				<img class="button" src="<?php echo baseUrl('data/img/map_slotje.png') ?>">
 			<?php endif; ?>
 		</a>
 		
 	</div>
 	<div id="level1" class="level">
 		<h1>Boardslide</h1>
 		<p>
 			Approach the rail at a 20 degree angle with your back facing it. 
 			Your speed should be based on the surface and length of the obstacle.
			Put your feet in the ollie position.
			When you're close enough to the rail, ollie 90 degrees onto it. Make sure you get one truck over the rail. 
			If you go fast enough, you'll slide over the rail. Try to keep your balance.
			At the end of the rail, swing your arms to turn your body back and land.
 		</p>
 		<hr />
 		<p>
 			<span>Level</span>
 			<span>25% Compleet</span>
 		</p>
 	</div>
 	<div id="level2" class="level">
 		<h1>50-50 trick</h1>
 		<p>
 			Approach the rail at a 20 degree angle in the ollie position.
When you're close enough, ollie onto the rail with both your trucks.
If you're going fast enough, you'll grind over the rail. Keeping your balance should be easy, unless it's a round rail. When you're nearing the end, lift your nose a little bit and just ride off.

 		</p>
 		<hr />
 		<p>
 			<span>Level</span>
 			<span>25% Compleet</span>
 		</p>
 	</div>
 	<div id="level3" class="level">
 		<h1>Smith Grind</h1>
 		<p>
 			Approach the rail at an angle with enough speed.
Ollie towards the rail, just like a 5-0.
Press the nose of the board down, next to the rail.
<br>
The tricky part is that you should lean backwards and support on your back truck. Don't put any pressure on the front or you will faceplant... on a rail.
Slide untill the end of the rail, then lift up the nose of the board and turn it back so you can simply ride off.	
 		</p>
 		<hr />
 		<p>
 			<span>Level</span>
 			<span>25% Compleet</span>
 		</p>
 	</div>
</div>
<script type="text/javascript">
	function displayLevel(level){
		document.getElementById('level1').style.display = 'none';
		document.getElementById('level2').style.display = 'none';
		document.getElementById('level3').style.display = 'none';
		document.getElementById(level).style.display = 'block';
		return false;
	}
</script>