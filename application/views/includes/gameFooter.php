		</div>
		<div id="settings">
			<a href="<?PHP echo baseUrl('user/logout') ?>">Logout</a>
		</div>
	</div>
	<?PHP if ($this->ModelLogin->isLoggedin()): ?>
	<div id="bottomBar">
		<div id="menu">

			<a id='playButton' href="<?PHP echo $this->ModelApp->getButtonValue('main', 'linkUrl') ?>">
				<?PHP echo $this->ModelApp->getButtonValue('main', 'label') ?>
			</a>
			<a class="left" href="<?PHP echo $this->ModelApp->getButtonValue('one', 'linkUrl') ?>">
				<img src="<?PHP echo $this->ModelApp->getButtonValue('one', 'imageUrl') ?>"><br>
				<?PHP echo $this->ModelApp->getButtonValue('one', 'label') ?>
			</a>
			<a class="left" href="<?PHP echo $this->ModelApp->getButtonValue('two', 'linkUrl') ?>">
				<img src="<?PHP echo $this->ModelApp->getButtonValue('two', 'imageUrl') ?>"><br>
				<?PHP echo $this->ModelApp->getButtonValue('two', 'label') ?>
			</a>
			<a class="right" href="<?PHP echo $this->ModelApp->getButtonValue('three', 'linkUrl') ?>">
				<img src="<?PHP echo $this->ModelApp->getButtonValue('three', 'imageUrl') ?>"><br>
				<?PHP echo $this->ModelApp->getButtonValue('three', 'label') ?>
			</a>
			<a class="right" href="<?PHP echo $this->ModelApp->getButtonValue('four', 'linkUrl') ?>">
				<img src="<?PHP echo $this->ModelApp->getButtonValue('four', 'imageUrl') ?>"><br>
				<?PHP echo $this->ModelApp->getButtonValue('four', 'label') ?>
			</a>
		</div>
	</div>
	<?PHP endif; ?>
</body>
</html>