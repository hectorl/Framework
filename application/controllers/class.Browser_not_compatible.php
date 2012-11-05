<?php
/**
 * Control class to load all the initial information
 *
 */

namespace controllers;

use Application;

class Browser_not_compatible extends Application
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

	}//end __construct


	/**
	 * Default loader method.
	 */
	public function index ($params) {

		$this->smarty->caching = true;

		$this->smarty->display('browser_not_compatible.tpl', parent::$lang->lang);

	}//end index

}//end Browser_not_compatible