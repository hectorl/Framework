<?php

namespace controllers;

use Application;

class Error extends Application
{

	/**
	 *
	 */
	private $smarty;


	public function __construct ($smarty) {

		$this->smarty = $smarty;

	}//end __construct


	/**
	 *
	 */
	public function index ($param = null) {

		$this->smarty->caching = true;

		switch ($param['error_type']) {

			case '404':

				header("HTTP/1.1 404 Not Found");
				header("Status: 404 Not Found");

				$this->smarty->display('error_404.tpl', parent::$lang->lang);

				break;

			default:

				die ('Unknown error.');

				break;

		}//end switch

	}//end index

}//end Error