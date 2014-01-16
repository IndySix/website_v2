<!-- <ul class="levelParts">
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
</ul> -->
<div class="selectMode"><div class="seperator"></div>
	<a class="career" href="#">
		<img src="<?PHP echo baseUrl('data/img/big_career_o.png'); ?>">
	</a>
	<a class="battles" href="#">
		<img src="<?PHP echo baseUrl('data/img/big_battles_w.png'); ?>">
	</a>
</div>
<?PHP $partId = $levels[0]['part']; $lock = false; $levelNum = 1; ?>
<ul class="levelParts">
	<li>
		<h1><?PHP echo $levels[0]['description'] ?></h1>
		<ul class="levels<?PHP echo $levels[0]['part'] == $currentPart ? ' active': '' ?>">
		<?PHP foreach ($levels as $level): ?>
		<?PHP if($partId != $level['part']): $partId = $level['part']; $lock = false; $levelNum =1; ?>
			</ul>
			</li><li>
			<h1><?PHP echo $level['description'] ?></h1>
			<ul class="levels<?PHP echo $level['part'] == $currentPart ? ' active': '' ?>">
		<?PHP endif; ?>

		<li class="<?PHP echo $lock ? 'lock' : '' ?><?PHP echo $level['id'] == $currentLevel ? ' active': '' ?>" data-level-id="<?PHP echo $level['id'] ?>">
			<h2>Level <?PHP echo $levelNum ?></h2>
			<div><?PHP echo $level['level_description'] ?></div>
		</li>

		<?PHP $lock = $level['completed'] == 0 ?>
		<?PHP $levelNum++; ?>
		<?PHP endforeach; ?>
		</ul>
	</li>
</ul>

<script type="text/javascript">
	function setActivePart(part){
		jQuery('.levelParts ul').removeClass('active');
		jQuery(part).find('ul').addClass('active');
		setPlayButton();
	}

	function setActiveLevel(level){
		//levels = jQuery(level).parent();
		jQuery( '.levelParts' ).find('li').removeClass('active');
		jQuery(level).addClass('active');
		setPlayButton();
	}
	function setPlayButton(){
		var id = jQuery('.levelParts ul .active').data( "levelId" );
		if(id != null){
			jQuery('#playButton').css('border-color', '#ff6600');
		} else {
			jQuery('#playButton').css('border-color', '#b2b2b4');
		}
	}
	jQuery('.levels h2').click(function(){
		level = jQuery(this).parent();
		if( jQuery( level ).hasClass('lock') )
			return;
		setActiveLevel(level);
    });

	jQuery('.levelParts h1').click(function(){
		var part = jQuery(this).parent();
		setActivePart( part );
    });

    jQuery(function() {
    	setPlayButton();
		//playButton redirect to selected level
    	jQuery('#playButton').click(function(){
			var id = jQuery('.levelParts ul .active').data( "levelId" );
			console.log("<?PHP echo baseUrl('game/play/') ?>");
			if(id != null)
				window.location.href = "<?PHP echo baseUrl('game/play/') ?>"+id;
    	});
	});

</script>
