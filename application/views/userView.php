
<h1><?PHP echo $username ?></h1>
<?PHP if($owner): ?>
	<a href="<?PHP echo baseUrl('user/edit') ?>">Edit</a><br>
<?PHP endif; ?>

<img src="<?PHP echo $avatarUrl ?>">

<p>member since: <?PHP echo $registrationDate ?></p>
<p>level: <?PHP echo $difficulty ?></p>
<h3>User info</h3>
<?PHP foreach($userinfo as $label => $value): ?>
	<p><?PHP echo $label ?>: <?PHP echo $value ?></p>
<?PHP endforeach; ?>

<h3>About me</h3>
<?PHP echo $aboutMe ?>