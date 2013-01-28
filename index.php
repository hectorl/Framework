<?php

try {

	header('Content-type: text/html; charset=utf-8');

	$config = parse_ini_file('configs/config.ini', true);

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

	require_once SITE_DIR . 'application/php/libs/class.Application.php';

	set_include_path(SITE_DIR . 'application/' . PATH_SEPARATOR .
	                 SITE_DIR . 'application/php/libs/');

	//spl_autoload_register('load_libs');
	spl_autoload_register('\Application::load_libs');

	$app = Application::init($config);

	$uri = $app->explode_url($_SERVER['REQUEST_URI']);
	$app->set_lang($uri);
	$app->load_controller($uri);

} catch(K_error $e) {

	$e->get_decorate_message();

}//end catch