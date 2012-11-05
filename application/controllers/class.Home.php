<?php
/**
 * Control class to load all the initial information
 *
 */

class Home extends Application
{

	/**
	 *
	 */
	private $smarty;

	/**
	 * Class constructor
	 */
	public function __construct ($smarty) {

		$this->smarty = $smarty;

		$this->load_model('Home_m');

	}//end __construct


	/**
	 * Default loader method.
	 */
	public function index () {

		$this->smarty->caching = true;

		if (!$this->smarty->isCached('home.tpl', parent::$lang->lang)) {

			$this->smarty->assign('lang_code', parent::$lang->lang);
			$this->smarty->assign('items', $this->Home_m->get_test_data());

		}//end if

		$this->smarty->display('home.tpl', parent::$lang->lang);

	}//end index

}//end Home