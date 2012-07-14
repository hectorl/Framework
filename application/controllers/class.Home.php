<?php
/**
 * Control class to load all the initial information
 *
 */

class Home extends Application {

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

		//$smarty = $this->get_smarty();

		$this->smarty->assign('items', $this->Home_m->get_test_data());
		$this->smarty->display('home.tpl');

	}//end index

}//end Home