<?php

namespace controllers;

use Application;

class Demo extends Application
{

	public function __construct () {

		$this->load_model('Demo');

	}//end __construct


	public function index () {

		$this->load_view('home');

	}//end index

}//end Demo