<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 *
 */
function smarty_function_t($params, $template)
{
    return 'hola desde translate plugin .' . $params['lang'];
}//end smarty_function_t