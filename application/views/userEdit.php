<?PHP if($saved): ?>
	<p id="success_edit" class="success">Profile saved</p>
<?PHP endif; ?>
<h1>Edit Profile</h1>

<form method="post" enctype="multipart/form-data" action="<?PHP echo baseUrl('user/edit') ?>">
	

	<img src="<?PHP echo baseUrl('data/avatars/'.$user['avatar'] ) ?>" width="70px">
	<input id="avatar" type="file" name="avatar">
	<input type="submit" name="upload" value="upload"><br>
	<p id="error_avatar"><?PHP echo $error_avatar ?></p><br>
</form>

<form method="post" action="<?PHP echo baseUrl('user/edit') ?>">
	<p id="error_form"><?PHP echo $error_form ?></p>
	<label>Email</label>
	<input id="email" type="text" name="email" value="<?PHP echo $user['email'] ?>" /></br>
	<p id="error_email"><?PHP echo $error_email ?></p>

	<label>Difficulty</label>
	<select id="difficulty" type="text" name="difficulty">
		<option <?PHP echo $user['difficulty'] == 'Easy' ? 'selected' : '' ?>>Easy</option>
		<option <?PHP echo $user['difficulty'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
		<option <?PHP echo $user['difficulty'] == 'Hard' ? 'selected' : '' ?>>Hard</option>
	</select></br>

	<h3>User info</h3>

	<label>Place</label>
	<input id="place" type="text" name="place" value="<?PHP echo $user['place'] ?>" /></br>
	<p id="error_place"><?PHP echo $error_place ?></p>

	<label>birthday</label>
	<input id="birthday" type="text" name="birthday" value="<?PHP echo $user['birthday'] ?>" readonly /></br>
	<p id="error_birthday"><?PHP echo $error_birthday ?></p>

	<label>gender</label>
	<select id="gender" type="text" name="gender">
		<option value="m" <?PHP echo $user['gender'] == 'm' ? 'selected' : '' ?>>Men</option>
		<option value="w" <?PHP echo $user['gender'] == 'w' ? 'selected' : '' ?>>Woman</option>
	</select></br>

	<label>About Me</label>
	<textarea id="aboutMe" type="text" name="aboutMe" /><?PHP echo $user['aboutMe'] ?></textarea></br>

	<br/>
	<h3>Change password</h3>
	<br/>
	<label>Password</label>
	<input id="password" type="password" placeholder="password" name="password" /></br>
	<p id="error_password"><?PHP echo $error_password ?></p>

	<label>Retype password</label>
	<input id="password2" type="password" placeholder="retype password" name="password2" /></br>

	<input type="submit" name="edit" value="Save">
</form>

 <script>
	jQuery( "#birthday" ).datepicker({ dateFormat: "yy-mm-dd", changeYear: true, showOn: "button", yearRange: "-100:+0"});

</script>