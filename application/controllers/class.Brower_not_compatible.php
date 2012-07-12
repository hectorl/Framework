<?php
/**
 * Control class to load all the initial information
 *
 */
class Browser_not_compatible extends Application{

	/**
	 * Class constructor
	 */
	public function __construct(){


	}//end __construct


	/**
	 * Default loader method.
	 */
	public function index ($params) {

		$this->load_view('browser_not_compatible', $params);

	}//end init

}//end home