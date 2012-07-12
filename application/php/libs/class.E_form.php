<?php

	class E_FORM extends Exception{

		public $msg = array();

		public function __construct($msg, $field){

			$this->msg[$field] = $msg;

		}//fin __construct

	}//fin E_FORM