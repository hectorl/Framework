<?php

namespace controllers;

use Application;

class Maintenance extends Application
{

	/**
	 *
	 */
	private $smarty;

	/**
	 *
	 */
	public function __construct ($smarty) {

		$this->smarty = $smarty;

	}//end __construct


	/**
	 *
	 */
	public function index () {

		$this->smarty->caching = true;

		$this->smarty->display('maintenance.tpl', parent::$lang->lang);

	}//end index

}//end Maintenance