
<?PHP if( !empty($error_login) ): ?>
	<p id="error_login" class="error"><?PHP echo $error_login ?></p>
<?PHP endif; ?>
<form method="post" action="<?PHP echo baseUrl('user/login') ?>" id="login-form">
	<label>Username: </label>
	<input id="username" type="text" placeholder="username" name="username" value="<?PHP echo $username ?>"/></br>
	
	<label>Password</label>
	<input id="password" type="password" placeholder="password" name="password" /></br>

	<input type="submit" name="login" value="Login"> or <a href="<?PHP echo baseUrl('user/register') ?>">Create Account</a>

</form>