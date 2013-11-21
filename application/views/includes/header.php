<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ramped</title>
	
	<script src="<?PHP echo baseUrl('data/js/jquery-1.10.2.min.js') ?>"> jQuery.noConflict(); </script>
	<script src="<?PHP echo baseUrl('data/js/jquery-ui-1.10.3.custom.min.js') ?>"></script>
	<script src="<?PHP echo baseUrl('data/js/main.js') ?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?PHP echo baseUrl('data/css/reset.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?PHP echo baseUrl('data/css/jquery-ui-1.10.3.custom.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?PHP echo baseUrl('data/css/style.css') ?>">
</head>
<body>
<div id="menu">
	<div class="wrapper">
	<?PHP if ($this->ModelLogin->isLoggedin()): ?>
	<ul>
		<li><a href="<?PHP echo baseUrl('user') ?>">Profile</a></li>
		<li><a href="#">Career</a></li>
		<li><a href="#">Battles</a></li>
		<li><a href="#">Friends</a></li>
		<li><a href="#">Video</a></li>
		<li><a href="#">Ranking</a></li>
		
	</ul>

	<a href="#" class="settings">&#9096;</a>

	<div class="profile">
		<img src="<?PHP echo baseUrl('data/avatars/'.$this->LibSession->get('user_avatar')) ?>" height="24px">
	</div>

	<div class="search">
		<form class="searchform" method="GET" action="<?PHP echo baseUrl('user/search') ?>">
			<input id="searchBar" name="search" type="text" placeholder="Search.."  autocomplete="off">
		</form>
		<img src="<?PHP echo baseUrl('data/css/images/search-icon.png'); ?>" width="16px"/>
	</div>

	<?PHP else: ?>
	<ul>
		<li><a href="<?PHP echo baseUrl('user/login') ?>">Login</a></li>
		<li><a href="<?PHP echo baseUrl('user/register') ?>">Register</a></li>
	</ul>
	<?PHP endif; ?>

	<div class="clear"></div>
	<div class="wrapper">
		<div id="content">