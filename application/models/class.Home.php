<?php
/**
 * Home model
 */

namespace models;

class Home
{

	/**
	 * Class constructor.
	 * Asigns the value to the lang attribute
	 */
	public function __construct () {



	}//end __construct


	/**
	 *
	 */
	public function get_test_data () {

		$data = array(

				array('id' => 1, 'title' => 'Título 1'),
				array('id' => 2, 'title' => 'Título 2'),
				array('id' => 3, 'title' => 'Título 3'),
				array('id' => 4, 'title' => 'Título 4'),
				array('id' => 5, 'title' => 'Título 5')

			);

		return $data;

	}//end get_test_data


	/**
	 *
	 */
	public function get_more_data () {

		$data = array(

				array('id' => 6,  'title' => 'Título 6 vía AJAX'),
				array('id' => 7,  'title' => 'Título 7 vía AJAX'),
				array('id' => 8,  'title' => 'Título 8 vía AJAX'),
				array('id' => 9,  'title' => 'Título 9 vía AJAX'),
				array('id' => 10, 'title' => 'Título 10 vía AJAX')

			);

		return $data;

	}//end get_more_data

}//end Home_m
