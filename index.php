<?php

	header('Content-type: text/html; charset=utf-8');

	//incluimos los archivos de configuración
	$config = parse_ini_file('configs/config.ini', true);
	$config = array_merge(parse_ini_file("configs/config-{$config['env']}.ini", true), $config);

	if($config['show_errors']){

		error_reporting(E_ALL);
		ini_set('display_errors', '1');

	}//fin if

	//Nos ahorramos el tener que controlar el flujo en la función __autoload
	set_include_path($config['SITE']['dir_site'] . 'application/controllers/' . PATH_SEPARATOR .
					 $config['SITE']['dir_site'] . 'application/models/'      . PATH_SEPARATOR .
		             $config['SITE']['dir_site'] . 'application/php/libs/'    . PATH_SEPARATOR .
				     $config['SITE']['dir_site'] . 'application/php/libs/'    . 'PHPMAILER');

	/**
	 * Carga las librerías según se van necesitando
	 *
	 * @param	string	$lib		Nombre de la clase que se quiere cargar
	 */
	function __autoload($lib){

		require('class.' . $lib . '.php');

	}//fin __autoload

	try{

		$app = Application::init($config);

		$uri = $app->explode_url($_SERVER['REQUEST_URI']);
		$app->set_lang($uri);
		$app->load_controller($uri);

	}catch(K_error $e){

		$e->get_decorate_message();
		//echo '<p style="color:red">' . $e->getMessage() . '</p>';

	}//fin catch