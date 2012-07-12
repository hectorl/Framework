<?php

class Error extends Application {

	public function __construct () {

	}


	/**
	 *
	 */
	public function index ($param = null) {

		switch ($param['error_type']) {

			case '404':

				header("HTTP/1.1 404 Not Found");
				header("Status: 404 Not Found");

				$this->load_view('404');

				break;

			default:

				die ('Unknown error.');

				break;

		}//end switch

	}//end index

}//end Error