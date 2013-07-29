<?php

namespace controllers;

use Application;
use Dbug;

class Msie extends Application
{

	public function __construct () {

	}//end construct

	public function index () {

		$this->load_view('msie');

	}//end index


}//end Msie