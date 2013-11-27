<div class="login">
	<img class="loginLogo" src="<?PHP echo baseUrl('data/img/logo_dropshadow.png') ?>">
	<h1>Beat The King!</h1>
	
	<?PHP if( !empty($error_login) ): ?>
		<p id="error_login" class="error"><?PHP echo $error_login ?></p>
	<?PHP endif; ?>
	
	<form method="post" action="<?PHP echo baseUrl('user/login') ?>" id="login-form">
		<input id="username" type="text" placeholder="Username" name="username" value="<?PHP echo $username ?>"/>
	
		<input id="password" type="password" placeholder="Password" name="password" />

		<input type="submit" name="login" value="Login">

		<a href="<?PHP echo baseUrl('user/register') ?>">Create Acount</a>
	</form>
</div>