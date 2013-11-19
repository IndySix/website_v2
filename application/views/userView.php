
<h1><?PHP echo $username ?></h1>
<?PHP if($owner): ?>
	<a href="<?PHP echo baseUrl('user/edit') ?>">Edit</a><br>
<?PHP elseif($isConnection && $isFriend): ?>
	Friend<br>
<?PHP elseif($isConnection): ?>
	Friend request send<br>
<?PHP else: ?>
	add friend<br>
<?PHP endif; ?>

<a class="friend-button friend-request" href="#" data-id="26" >Add friend</a>
<a class="friend-button friend-request" href="#" data-id="27" >Add friend</a>

</a> 

<img src="<?PHP echo $avatarUrl ?>">

<p>member since: <?PHP echo $registrationDate ?></p>
<p>level: <?PHP echo $difficulty ?></p>
<h3>User info</h3>
<?PHP foreach($userinfo as $label => $value): ?>
	<p><?PHP echo $label ?>: <?PHP echo $value ?></p>
<?PHP endforeach; ?>

<h3>About me</h3>
<?PHP echo $aboutMe ?>