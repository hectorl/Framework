<?php

class LangTest extends PHPUnit_Framework_TestCase {

	public function test_set_lang () {

		$_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'es,es-es;q=0.8,en;q=0.5,en-us;q=0.3';

		$lang = new Lang ();

	}//end test_set_lang

}//end ApplicationTest