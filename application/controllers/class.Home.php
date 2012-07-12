<?php
/**
 * Control class to load all the initial information
 *
 */
class Home extends Application{

	/**
	 * Class constructor
	 */
	public function __construct () {

		$this->load_model('Home_m');

	}//end __construct


	/**
	 * Default loader method.
	 */
	public function index () {

		$data['items'] = $this->Home_m->get_test_data();

		$this->load_view('home', $data);

	}//end index

}//end Home