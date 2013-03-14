<?php

namespace controllers;

use Application;

class Contacto extends Application
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


	public function index ($params) {
var_dump($params);
		$this->smarty->caching = false;

		$this->smarty->display('contacto.tpl', parent::$lang->lang);

	}//end index


	/**
	 * Envío del formulario
	 */
	public function send () {

		$this->smarty->caching = true;

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$this->smarty->assign('name', $_POST['name']);
			$this->smarty->assign('msg', $_POST['msg']);

		}//end if

		$this->smarty->display('contacto.tpl', parent::$lang->lang);

	}//end index

}//end Contacto