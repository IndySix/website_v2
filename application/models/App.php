<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_App extends Core_Model  {

	private $frontView  = 'website';
	private $buttons	= array();

	function __construct() {
		$this->checkView();
		//set Default app buttons
		$this->setButton('one', baseUrl('level/career'), 'Career', baseUrl('data/img/career.png') );
		$this->setButton('two', baseUrl('level/battle'), 'Battles', baseUrl('data/img/battle.png') );
		$this->setButton('three', baseUrl('videos/videos'), 'Video', baseUrl('data/img/video.png') );
		$this->setButton('four', baseUrl('ranking'), 'Ranks', baseUrl('data/img/ranks.png') );
		
		$this->setButton('main', baseUrl('level'), '<img class="mainButLogo" src="'.baseUrl('data/img/game_button_icon.png').'"/>');//<span class="playIcon"></span>
		$this->setButton('settings', '#', 'settings', baseUrl('#') );
	}

	public function checkView(){
		if(isset($_GET['front'])){
			$this->setStateGame();
			if($_GET['front'] == 'game')
				$this->setStateGame();
			else
				$this->setStateWebsite();
			return;
		}
		if(isset($_COOKIE['frontView'])){
			if($_COOKIE['frontView'] == 'game')
				$this->setStateGame();
			else
				$this->setStateWebsite();
		} else {
			$this->setStateWebsite();
		}
	}

	public function setStateGame(){
		$expire = time() + (60*60*24*365);

        /* Get domain */
        $domain = $_SERVER['SERVER_NAME'];
        /* get if http or https is used */
        if (isset($_SERVER['HTTPS'])) {
            $secure = true;
        } else {
            $secure = false;
        }
        /* Create cookie */
        setcookie('frontView', 'game', $expire, "/", null, $secure, true);
        $this->frontView = 'game';
	}

	public function setStateWebsite(){
		$expire = time() + (60*60*24*365);

        /* Get domain */
        $domain = $_SERVER['SERVER_NAME'];
        /* get if http or https is used */
        if (isset($_SERVER['HTTPS'])) {
            $secure = true;
        } else {
            $secure = false;
        }
        /* Create cookie */
        setcookie('frontView', 'website', $expire, "/", null, $secure, true);
        $this->frontView = 'website';
	}

	public function isGame(){
		return $this->frontView == 'game' ? true : false;
	}

	public function isWebsite(){
		return $this->frontView == 'website' ? true : false;
	}

	public function setButton($button, $linkUrl = '#', $label = '', $imageUrl = ''){
		$this->buttons[$button] = array('linkUrl'=> $linkUrl,
										'label' => $label,
										'imageUrl' => $imageUrl
										);
	}

	public function getButtonValue($button, $value = 'label'){
		if(isset($this->buttons[$button]) && isset($this->buttons[$button][$value]))
			return $this->buttons[$button][$value];
		return '';
	}
}