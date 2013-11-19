<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to MartensMVC</title>
	
	<script src="<?PHP echo baseUrl('data/js/jquery-1.10.2.min.js') ?>"> jQuery.noConflict(); </script>
	
	<link href="<?PHP echo baseUrl('data/css/style.css') ?>" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
	<?PHP if ($this->ModelLogin->isLoggedin()): ?>
		<a href="<?PHP echo baseUrl('user') ?>"><img src="<?PHP echo baseUrl('data/avatars/'.$this->LibSession->get('user_avatar')) ?>" height="60px"></a>
		<a href="<?PHP echo baseUrl('user') ?>"><?PHP echo $this->LibSession->get('user_username') ?></a>
		<a href="<?PHP echo baseUrl('user/logout') ?>">Logout</a>
		<hr>
		<a href="<?PHP echo baseUrl('Home') ?>">Home</a>
		<a href="<?PHP echo baseUrl('level/') ?>">Levels</a>
	<?PHP else: ?>
		<a href="<?PHP echo baseUrl('user/login') ?>">Login</a>
		<a href="<?PHP echo baseUrl('user/register') ?>">Register</a>
	<?PHP endif; ?>