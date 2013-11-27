		</div>
		<div id="settings">
			<a href="<?PHP echo baseUrl('user/logout') ?>">Logout</a>
		</div>
	</div>
	<?PHP if ($this->ModelLogin->isLoggedin()): ?>
	<div id="bottomBar">
		<div id="menu">

			<a id='playButton' href="#"><span class="playIcon"></span></a>
			<a class="left" href="#">
				<img src="<?PHP echo baseUrl('data/img/career.png') ?>"><br>
				Career
			</a>
			<a class="left" href="#">
				<img src="<?PHP echo baseUrl('data/img/battle.png') ?>"><br>
				Battles
			</a>
			<a class="right" href="#">
				<img src="<?PHP echo baseUrl('data/img/video.png') ?>"><br>
				Video
			</a>
			<a class="right" href="#">
				<img src="<?PHP echo baseUrl('data/img/ranks.png') ?>"><br>
				Ranks
			</a>
		</div>
	</div>
	<?PHP endif; ?>
</body>
</html>