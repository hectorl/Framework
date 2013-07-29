<?php

try {

	header('Content-type: text/html; charset=utf-8');

	setlocale(LC_MONETARY, 'it_IT');
/*
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$starttime = $mtime;
*/


	//Get config file
	$config = parse_ini_file('configs/config.ini', true);


	//Define constants
	/**
	 * We create the constants from configuration file.
	 * We use the .ini section as prefix and each section variable as sufix. All uppercase
	 *
	 *
	 * @example
	 *  [SITE]
	 *  name = 'http://mysite.com'
	 *  -- the definition will be: define('SITE_NAME', 'http://mysite.com')
	 *
	 */
	foreach ($config as $section => $var) {

		foreach ($var as $key => $val) {
			define(strtoupper($section . '_' . $key), $val);
		}//end foreach

	}//end foreach

	define('AJAX_CALL', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');


	//Initialize settings
	ini_set('date.timezone', PROJECT_TIMEZONE);

	if (PROJECT_SHOW_ERRORS) {

		error_reporting(E_ALL);
		ini_set('display_errors', '1');

	}//end if

	if (PROJECT_SESSION) {
		session_start();
	}//end if

	if (PROJECT_SMARTY) {
		require_once SITE_DIR . 'application/php/libs/smarty/Smarty.class.php';
	}//end if


	//Require paths
	require_once SITE_DIR . 'application/php/libs/class.Application.php';

	set_include_path(SITE_DIR . 'application/' . PATH_SEPARATOR .
					 SITE_DIR . 'application/controllers/' . PATH_SEPARATOR .
					 SITE_DIR . 'application/models/' . PATH_SEPARATOR .
	                 SITE_DIR . 'application/php/libs/');

	//spl_autoload_register('load_libs');
	spl_autoload_register('\Application::load_libs');


	//Start application
	$app = Application::init($config);

	$uri = $app->explode_url($_SERVER['REQUEST_URI']);
	$app->set_lang($uri);
	$app->load_controller($uri);

} catch(K_error $e) {

	$e->get_decorate_message();

}//end catch

/*
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$endtime = $mtime;
$totaltime = ($endtime - $starttime);
echo "This page was created in ".$totaltime." seconds";
*/