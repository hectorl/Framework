<?php

/**
 * Nombre del proyecto
 */
define('PROJECT_NAME', 'ROUTER framework');
/**
 * Índica si es cualquiera de los dispositivos de Apple
 */
define('IPAD',   strpos($_SERVER['HTTP_USER_AGENT'], 'iPad'));
define('IPOD',   strpos($_SERVER['HTTP_USER_AGENT'], 'iPod'));
define('IPHONE', strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone'));
/**
 * Indicar la subcarpeta en la que este el proyecto.
 * Sólo necesario en caso de URL del tipo "http:example.com/project/"
 */
define('PATH', '');
/**
 * Pone el site en mantenimiento
 */
define('MAINTENANCE', false);
/**
 * Para mostrar los errores de PHP
 */
define('SHOW_ERRORS', true);