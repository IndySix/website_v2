<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_App extends Core_Model  {

	private $frontView = 'website';

	function __construct() {
		$this->checkView();
	}

	public function checkView(){
		if(isset($_GET['play'])){
			$this->setStateGame();
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
        setcookie('frontView', 'game', $expire, "/", $domain, $secure, true);
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
        setcookie('frontView', 'website', $expire, "/", $domain, $secure, true);
        $this->frontView = 'website';
	}

	public function isGame(){
		return $this->frontView == 'game' ? true : false;
	}

	public function isWebsite(){
		return $this->frontView == 'website' ? true : false;
	}

}