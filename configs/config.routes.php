<?php

/**
* Project routes
* If global $_SERVER exists, means that the project is called from a browser.
* If not, could be a script execution through "php" command (like a cronjob)
*/

if (isset($_SERVER)) {

	$server_root = (!isset($_SERVER["DOCUMENT_ROOT"])) ? substr($_SERVER['SCRIPT_FILENAME'], 0, -strlen($_SERVER['PHP_SELF']) + 1) : $_SERVER["DOCUMENT_ROOT"] . '/';

	$server_name = 'http://' .( (substr($_SERVER['SERVER_NAME'], strlen($_SERVER['SERVER_NAME']), 1) == '/') ? $_SERVER['SERVER_NAME'] : $_SERVER['SERVER_NAME'] . '/');

} else {

	$server_root = '[ruta del proyecto en el servidor]';
	$server_name = '[URl del proyecto]';

}//end else

//Server

define('DIR_REAL',        $server_root);
define('DIR_VIEWS',       DIR_REAL  . 'application/views/');
define('DIR_PAGES',       DIR_VIEWS . 'pages/');
define('DIR_CONTROLLERS', DIR_REAL  . 'application/controllers/');
define('DIR_MODELS',      DIR_REAL  . 'application/models/');
define('DIR_PHP',         DIR_REAL  . 'application/php/');
define('DIR_LIBS',        DIR_PHP   . 'libs/');
define('DIR_UPL',         DIR_REAL  . 'uploads/');
define('DIR_LANGS',       DIR_REAL  . 'langs/');

//URI

define('URL_SITE',  $server_name);
define('URL_CSS',   URL_SITE . 'application/views/css/');
define('URL_JS',    URL_SITE . 'application/views/js/');
define('URL_IMG',   URL_SITE . 'application/views/img/');
define('URL_UPL',   URL_SITE . 'uploads/');
define('URL_PHP',   URL_SITE . 'application/php/');