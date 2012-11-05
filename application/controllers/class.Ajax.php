<?php

namespace controllers;

use Application;

class Ajax extends Application {

	/**
	 * Class constructor.
	 * Check if there is an AJAX call
	 */
	public function __construct () {

		if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) ||
		   strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
		{

			die('Access Forbidden');

		}//end if

	}//end __construct


	/**
	 * Load some content for the AJAX example
	 */
	public function get_ajax_content () {

		$this->load_model('Home');

		$data = $this->Home->get_more_data();

		echo json_encode($data);

	}//end get_ajax_content

}//end Ajax