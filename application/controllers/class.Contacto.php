<?php

class Contacto extends Application {

	public function __construct () {}


	public function index () {

		$this->load_view('contacto');

	}//end index


	/**
	 * Envío del formulario
	 */
	public function send () {

		$data = array();

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$data = array('name' => $_POST['name'], 'msg' => $_POST['msg']);

		}//end if

		$this->load_view('contacto', $data);

	}//end index

}//end Contacto