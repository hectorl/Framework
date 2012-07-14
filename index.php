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
		             $config['SITE']['dir_site'] . 'application/php/libs/');

	/**
	 * Carga las librerías según se van necesitando
	 *
	 * @param	string	$class		Nombre de la clase que se quiere cargar
	 */
	function load_libs ($class){

		try {

			$found = stream_resolve_include_path('class.' . $class . '.php');

    		if($found !== false) {

				require_once 'class.' . $class . '.php';

			} else {

				throw new K_error('Class <b>class.' . $class . '.php</b> does not exist.');

			}//end else

		} catch (K_error $e) {

			echo $e->get_decorate_message();
			die();

		}//end catch

	}//fin __autoload



	try{

		require_once $config['SITE']['dir_site'] . 'application/php/libs/smarty/Smarty.class.php';

		spl_autoload_register('load_libs');

		$app = Application::init($config);

		$uri = $app->explode_url($_SERVER['REQUEST_URI']);
		$app->set_lang($uri);
		$app->load_controller($uri);

	}catch(K_error $e){

		$e->get_decorate_message();

	}//fin catch