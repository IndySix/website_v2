<ul class="levelParts">
	<li id="partid-2">
		<h1>Part 1</h1>
		<ul class="levels active">
			<li class="active" data-level-id="4">
				<h2>Level 1</h2>
				<div>Description</div>
			</li>
			<li data-level-id="5">
				<h2>Level 2</h2>
				<div>Description</div>
			</li>
			<li data-level-id="6">
				<h2>Level 3</h2>
				<div>Description</div>
			</li>
		</ul>
	</li>
	<li id="partid-1">
		<h1>Part 2</h1>
		<ul class="levels">
			<li id="level-1-1" data-level-id="1">
				<h2>Level 1</h2>
				<div>Description</div>
			</li>
			<li id="level-1-2" class="active" data-level-id="2">
				<h2>Level 2</h2>
				<div>Description</div>
			</li>
			<li id="level-1-3" data-level-id="3">
				<h2>Level 3</h2>
				<div>Description</div>
			</li>
		</ul>
	</li>
</ul>
<style type="text/css">
	.levelParts li ul{
		display: none;
	}
	.levelParts li .active {
		display: block;
	}
	.levels li div {
		display: none;
	}
	.levels .active div{
		display: block;
	}
</style>
<script type="text/javascript">
	function setActivePart(part){
		jQuery('.levelParts ul').removeClass('active');
		jQuery(part).find('ul').addClass('active');
	}

	function setActiveLevel(level){
		levels = jQuery(level).parent();
		jQuery( levels ).find('li').removeClass('active');
		jQuery(level).addClass('active');
	}
	jQuery('.levels h2').click(function(){
		level = jQuery(this).parent();
		setActiveLevel(level);
    });

	jQuery('.levelParts h1').click(function(){
		var part = jQuery(this).parent();
		setActivePart( part );
    });

    jQuery(function() {
		//playButton redirect to selected level
    	jQuery('#playButton').click(function(){
			var id = jQuery('.levelParts .active .active').data( "levelId" );
			window.location.href = "<?PHP echo baseUrl('game/play/') ?>"+id;
    	});
	});

</script>