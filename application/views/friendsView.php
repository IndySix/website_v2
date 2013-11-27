<?PHP foreach($friends as $u): 
	if($u['user_id'] == $this->LibSession->get('user_id'))
		$user = $this->ModelUser->byId( $u['friend_id'] );
	else
		$user = $this->ModelUser->byId( $u['user_id'] );
?>
<p>
	<a href="<?PHP echo baseUrl('user/view/'.$user['id'].'/'.$user['username']) ?>">
		
			<img src="<?PHP echo baseUrl('data/avatars/'.$user['avatar']) ?>" width="60px">
			<?PHP echo $user['username'] ?>
	</a>
  </p>
<?PHP endforeach; ?>