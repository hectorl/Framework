<?php

class Email extends Application {

	public function __construct () {}


	/**
	 *
	 */
	public function load ($params) {

		$params = array_map('urldecode', $params);

		$this->load_view($params['tpl'], $params, true);

	}//end load

}//end Email