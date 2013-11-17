<script type="text/javascript">

</script>
<form method="post" action="<?PHP echo baseUrl("user/register") ?>">
	<label>Username: </label>
	<input type="text" placeholder="username" name="username" value="<?PHP echo $username ?>"/></br>
	<p><?PHP echo $error_username ?></p>
	
	<label>Password</label>
	<input type="password" placeholder="password" name="password" /></br>
	<p><?PHP echo $error_password ?></p>

	<label>email</label>
	<input type="text" placeholder="email" name="email" value="<?PHP echo $email ?>" /></br>
	<p><?PHP echo $error_email ?></p>

	<input type="submit" name="register" value="Register">

</form>