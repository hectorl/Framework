<?php /* Smarty version Smarty-3.1.11, created on 2012-07-14 17:34:44
         compiled from "/var/www/framework/application/views/pages/templates/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2239800500139ae0076f3-85196032%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78db9cc205bafdc63cf4c237dc18c5cb78c37522' => 
    array (
      0 => '/var/www/framework/application/views/pages/templates/home.tpl',
      1 => 1342280083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2239800500139ae0076f3-85196032',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_500139ae036064_42409060',
  'variables' => 
  array (
    'URL' => 0,
    'UPL' => 0,
    'CSS' => 0,
    'JS' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_500139ae036064_42409060')) {function content_500139ae036064_42409060($_smarty_tpl) {?><h1>hola mundo</h1>
<p><?php echo $_smarty_tpl->tpl_vars['URL']->value;?>
</p>
<p><?php echo $_smarty_tpl->tpl_vars['UPL']->value;?>
</p>
<p><?php echo $_smarty_tpl->tpl_vars['CSS']->value;?>
</p>
<p><?php echo $_smarty_tpl->tpl_vars['JS']->value;?>
</p><?php }} ?>