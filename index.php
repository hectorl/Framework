<?php

header('Content-type: text/html; charset=utf-8');

$config = parse_ini_file('configs/config.ini', true);

if($config['PROJECT']['show_errors']){

	error_reporting(E_ALL);
	ini_set('display_errors', '1');

}//fin if

ini_set('date.timezone', $config['SITE']['timezone']);
define('DIR_SITE', $config['SITE']['dir_site']);

set_include_path(DIR_SITE . 'application/' . PATH_SEPARATOR .
	             DIR_SITE . 'application/php/libs/');

/**
 * Custom autoloader.
 *
 * Check if the class has namespace and loads it
 *
 * @param	string	$class		Name of the class
 */
function load_libs ($class){

	try {

		if (strpos($class, '\\')) {

			$class_pieces = explode('\\', $class);
			$dir = DIR_SITE . 'application/' . $class_pieces[0] . '/';
			$class = $class_pieces[1];

		} else {

			$dir = '';
			$class = $class;

		}//end if

		$found = stream_resolve_include_path($dir . 'class.' . $class . '.php');

		if ($found !== false) {

			require_once $dir . 'class.' . $class . '.php';

		} else {

			throw new K_error('Class <b>class.' . $class . '.php</b> does not exist.');

		}//end else

	} catch (K_error $e) {

		echo $e->get_decorate_message();
		die();

	}//end catch

}//end __autoload

try {

	require_once DIR_SITE . 'application/php/libs/smarty/Smarty.class.php';

	spl_autoload_register('load_libs');

	$app = Application::init($config);

	$uri = $app->explode_url($_SERVER['REQUEST_URI']);
	$app->set_lang($uri);
	$app->load_controller($uri);

} catch(K_error $e) {

	$e->get_decorate_message();

}//end catch