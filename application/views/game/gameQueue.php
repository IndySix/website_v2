<div style="padding: 10px">
	<?PHP foreach ($queue as $key => $value): ?>
		<div style="padding: 5px; margin: 10px 0px; background-color: #ff6600; height: 40px;line-height: 40px; font-size: 20px;">
			<div style="display: inline-block; width: 40px; height: 40px; text-align:center; font-weight: bold;">
				<?PHP echo $key == 0 ? '>' : $key ?>
			</div>
			<img src="<?PHP echo baseUrl('data/avatars/'.$value['avatar']) ?>" width="40px" style="vertical-align: middle;">
			<?PHP echo $value['username'] ?>
		</div>
	<?PHP endforeach; ?>
</div>

<script type="text/javascript">
var checkQueueTimer = 0;

function displayPopUp(levelId){
	var r=confirm("Play game!");
	if (r){
  		window.location.href = "<?PHP echo baseUrl('game/play/'.$level['id']) ?>";
  	}
}

function checkQueue(){
	jQuery.get( "<?PHP echo baseUrl('game/play/'.$level['id'].'/json') ?>", function( data ) {
		jsonObj = JSON.parse(data);
		if(jsonObj.play) {
			displayPopUp(<?PHP echo $level['id'] ?>);
			clearInterval(checkQueueTimer);
		}
	});
}
checkQueueTimer = setInterval(function(){ checkQueue() },3000);
</script>