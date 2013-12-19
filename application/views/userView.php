
<?PHP if( $user_id != $this->LibSession->get('user_id') ): ?>
    <a class="friend-button friend-request" href="#" data-id="<?PHP echo $user_id ?>" style="float:right" >Add Friend</a>
<?PHP endif; ?>
<h1><?PHP echo $username ?></h1> 

<img src="<?PHP echo $avatarUrl ?>">



<p>member since: <?PHP echo $registrationDate ?></p>
<p>level: <?PHP echo $difficulty ?></p>
<h3>User info</h3>
<?PHP foreach($userinfo as $label => $value): ?>
	<p><?PHP echo $label ?>: <?PHP echo $value ?></p>
<?PHP endforeach; ?>

<h3>About me</h3>
<?PHP echo $aboutMe ?>