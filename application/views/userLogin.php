<p id="error_login"><?PHP echo $error_login ?></p>
<form method="post" action="<?PHP echo baseUrl('user/login') ?>" id="login-form">
	<label>Username: </label>
	<input id="username" type="text" placeholder="username" name="username" value="<?PHP echo $username ?>"/></br>
	
	<label>Password</label>
	<input id="password" type="password" placeholder="password" name="password" /></br>

	<input type="submit" name="login" value="Login">

</form>