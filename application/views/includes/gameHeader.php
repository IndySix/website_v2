<html>
<head>
	<title>Beat The KING!</title>
	<meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    
    <meta name="apple-mobile-web-app-title" content="Beat the King">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="touch-icons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="touch-icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="touch-icons/apple-touch-icon-57x57.png">

    <link rel="stylesheet" href="<?PHP echo baseUrl('data/game/css/style.css') ?>">
    
    <script src="<?PHP echo baseUrl('data/game/js/jquery-1.10.2.min.js') ?>"></script>
    <script>
		$(document).bind("mobileinit", function(){
 			$.mobile.loadingMessage = false;
		});
 	</script>
    <script src="<?PHP echo baseUrl('data/game/js/jquery.mobile-1.3.2.min.js') ?>"></script>
    <script src="<?PHP echo baseUrl('data/game/js/main.js') ?>"></script>
</head>
<body>
	<div id="resize"></div>
	<div id="topBar">
		<div id="topTitle">Beat The KING!
			<a id="back-icon" href="#"><img src="<?PHP echo baseUrl('data/game/images/back.png') ?>"> back</a>
			<a id="settings-icon" href="#"><span></span><span></span><span></span></a>
		</div>
	</div>
	<div id="contentWrapper">
		<div id="content">