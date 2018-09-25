<?php
/* Smarty version 3.1.30, created on 2016-10-22 10:26:36
  from "E:\webroot\www\PHP_Learning\day33-smarty\templates\checkbox.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580b22bc6ddc80_90177718',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '065319c2fee6fac6f8da0478353ad45786833fa2' => 
    array (
      0 => 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\templates\\checkbox.tpl',
      1 => 1477124795,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580b22bc6ddc80_90177718 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_html_checkboxes')) require_once 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\libs\\plugins\\function.html_checkboxes.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
</head>
<body>
	请选择你喜欢的人
    <?php echo smarty_function_html_checkboxes(array('name'=>"man",'values'=>$_smarty_tpl->tpl_vars['man']->value,'output'=>$_smarty_tpl->tpl_vars['man']->value,'selected'=>$_smarty_tpl->tpl_vars['selected']->value),$_smarty_tpl);?>


    <hr/>

    请选择你喜欢的人
    <?php echo smarty_function_html_checkboxes(array('name'=>"man1",'options'=>$_smarty_tpl->tpl_vars['man']->value),$_smarty_tpl);?>

</body>
</html><?php }
}
