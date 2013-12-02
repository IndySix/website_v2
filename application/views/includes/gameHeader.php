<html>
<head>
	<title>Beat The KING!</title>
	<meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="<?PHP echo baseUrl('data/game/css/style.css') ?>">
    
    <script src="<?PHP echo baseUrl('data/game/js/jquery-1.10.2.min.js') ?>">jQuery.noConflict();</script>
    <!--<script>
		$(document).bind("mobileinit", function(){
 			$.mobile.loadingMessage = false;
		});
 	</script>
    <script src="<?PHP echo baseUrl('data/game/js/jquery.mobile-1.3.2.min.js') ?>"></script>-->
    <script src="<?PHP echo baseUrl('data/game/js/main.js') ?>"></script>
</head>
<body>
	<div id="resize"></div>
	<div id="topBar">
		<div id="topTitle">Beat The KING!
			<?PHP if ($this->ModelLogin->isLoggedin()): ?>
				<?PHP if ( $this->ModelApp->getButtonValue('back', 'linkUrl') != '' ): ?>
					<a id="back-icon" href="<?PHP echo $this->ModelApp->getButtonValue('back', 'linkUrl') ?>">
						<img src="<?PHP echo baseUrl('data/img/back.png') ?>">
						back
					</a>
				<?PHP endif; ?>
				
				<a id="settings-icon" href="#"><span></span><span></span><span></span></a>
			<?PHP endif; ?>
		</div>
	</div>
	<div id="contentWrapper">
		<div id="content">