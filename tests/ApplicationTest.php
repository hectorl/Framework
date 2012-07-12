<?php

require_once 'application/php/libs/class.Application.php';
require_once 'application/php/libs/class.Cookiesetter.php';
require_once 'application/php/libs/class.Lang.php';
require_once 'application/php/libs/class.Browser.php';

class ApplicationTest extends PHPUnit_Framework_TestCase {

	public function test_explode_url () {

		$config = parse_ini_file('configs/config.ini', true);
		$config = array_merge(parse_ini_file("configs/config-{$config['env']}.ini", true), $config);

		$app = Application::init($config);

		$url = 'http://framework.gerty/home/init/var1/val1/var2/val2';

		$uri_example = array(
				'controller' => 'home',
				'method' => 'init',
				'var' => array(
						'var1' => 'val1',
						'var2' => 'val2'
					)
			);

		$uri = $app->explode_url($url);
		$this->assertEquals($uri_example, $uri);

	}//end test_explode_url

}//end ApplicationTest