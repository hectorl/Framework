<?php

namespace controllers;

use Application;
use Dbug;

class Browser_not_supported extends Application
{

	public function __construct () {

	}//end construct

	public function index () {

		$this->load_view('browser_not_supported');

	}//end index

}//end Browser_not_supported