<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to MartensMVC</title>
	
	<script src="<?PHP echo baseUrl('data/js/jquery-1.10.2.min.js') ?>"> jQuery.noConflict(); </script>
	<script src="<?PHP echo baseUrl('data/js/jquery-ui-1.10.3.custom.min.js') ?>"></script>
	<script src="<?PHP echo baseUrl('data/js/main.js') ?>"></script>
	
	<link href="<?PHP echo baseUrl('data/css/jquery-ui-1.10.3.custom.min.css') ?>" media="all" rel="stylesheet" type="text/css" />
	<link href="<?PHP echo baseUrl('data/css/style.css') ?>" media="all" rel="stylesheet" type="text/css" />
	
</head>
<body>
<div id="container">
	<?PHP if ($this->ModelLogin->isLoggedin()): ?>
		<a href="<?PHP echo baseUrl('user') ?>">
			<img src="<?PHP echo baseUrl('data/avatars/'.$this->LibSession->get('user_avatar')) ?>" height="60px">
		</a>
		<a href="<?PHP echo baseUrl('user') ?>"><?PHP echo $this->LibSession->get('user_username') ?></a>
		<a href="<?PHP echo baseUrl('user/logout') ?>">Logout</a>
		<hr>
		<u style="list-style: none outside none;">
			<li style="float: left; padding: 10px;"><a href="<?PHP echo baseUrl('Home') ?>">Home</a></li>
			<li style="float: left; padding: 10px;"><a href="<?PHP echo baseUrl('user/search') ?>">Search user</a></li>
			<li style="float: left; padding: 10px;">
				<a id="friend-requests-button" href="javascript:void(0);">request</a>
				<div id="friend-requests" style="position: absolute; display: none; background-color: #fff; padding: 10px;">
				</div>
			</li>
		</u>
		
	<?PHP else: ?>
		<a href="<?PHP echo baseUrl('user/login') ?>">Login</a>
		<a href="<?PHP echo baseUrl('user/register') ?>">Register</a>
	<?PHP endif; ?>