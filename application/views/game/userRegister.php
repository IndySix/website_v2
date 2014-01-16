<div class="login">
<h1>Create account</h1>
<form method="post" action="<?PHP echo baseUrl('user/register') ?>" id="register-form">
	<label>Username</label>
	<input id="username" type="text" placeholder="username" name="username" value="<?PHP echo $username ?>"/></br>
	<p id="error_username"><?PHP echo $error_username ?></p>
	
	<label>Password</label>
	<input id="password" type="password" placeholder="password" name="password" /></br>
	<p id="error_password"><?PHP echo $error_password ?></p>

	<label>Email</label>
	<input id="email" type="text" placeholder="email" name="email" value="<?PHP echo $email ?>" /></br>
	<p id="error_email"><?PHP echo $error_email ?></p>

	<input type="submit" name="register" value="Create Account">
</form>
</div>
<script type="text/javascript">
jQuery( "#register-form" ).submit(function( event ) {
	event.preventDefault();
	jQuery.post( "<?PHP echo baseUrl('user/register/json') ?>", { register: "", 
																  username: jQuery("#username").val(), 
																  password: jQuery("#password").val(), 
																  email: jQuery("#email").val() })
		.done(function( data ) {
			resp = JSON.parse(data);
			validForm = true;

			jQuery("#error_username").html("")
			jQuery("#error_password").html("")
			jQuery("#error_email").html("")

			if(resp.error_username != ""){
				validForm = false;
				jQuery("#error_username").html(resp.error_username)
			}
			if(resp.error_password != ""){
				validForm = false;
				jQuery("#error_password").html(resp.error_password)
			}
			if(resp.error_email != ""){
				validForm = false;
				jQuery("#error_email").html(resp.error_email)
			}

			if(validForm){
				window.location.href = "<?PHP echo baseUrl('home') ?>";
			}
		});
	});
</script>
