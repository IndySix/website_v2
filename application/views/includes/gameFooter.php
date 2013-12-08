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
			<?PHP if($this->ModelApp->getButtonValue('one', 'linkUrl') != ''): ?>
				<a class="left" href="<?PHP echo $this->ModelApp->getButtonValue('one', 'linkUrl') ?>">
					<img src="<?PHP echo $this->ModelApp->getButtonValue('one', 'imageUrl') ?>"><br>
					<?PHP echo $this->ModelApp->getButtonValue('one', 'label') ?>
				</a>
			<?PHP endif; ?>
			<?PHP if($this->ModelApp->getButtonValue('two', 'linkUrl') != ''): ?>
				<a class="left" href="<?PHP echo $this->ModelApp->getButtonValue('two', 'linkUrl') ?>">
					<img src="<?PHP echo $this->ModelApp->getButtonValue('two', 'imageUrl') ?>"><br>
					<?PHP echo $this->ModelApp->getButtonValue('two', 'label') ?>
				</a>
			<?PHP endif; ?>
			<?PHP if($this->ModelApp->getButtonValue('four', 'linkUrl') != ''): ?>
				<a class="right" href="<?PHP echo $this->ModelApp->getButtonValue('four', 'linkUrl') ?>">
					<img src="<?PHP echo $this->ModelApp->getButtonValue('four', 'imageUrl') ?>"><br>
					<?PHP echo $this->ModelApp->getButtonValue('four', 'label') ?>
				</a>
			<?PHP endif; ?>
			<?PHP if($this->ModelApp->getButtonValue('three', 'linkUrl') != ''): ?>
				<a class="right" href="<?PHP echo $this->ModelApp->getButtonValue('three', 'linkUrl') ?>">
					<img src="<?PHP echo $this->ModelApp->getButtonValue('three', 'imageUrl') ?>"><br>
					<?PHP echo $this->ModelApp->getButtonValue('three', 'label') ?>
				</a>
			<?PHP endif; ?>
		</div>
	</div>
	<?PHP endif; ?>
</body>
</html>