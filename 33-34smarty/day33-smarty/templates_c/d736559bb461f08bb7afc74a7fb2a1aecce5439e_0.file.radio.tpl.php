<?php
/* Smarty version 3.1.30, created on 2016-10-22 10:03:27
  from "E:\webroot\www\PHP_Learning\day33-smarty\templates\radio.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580b1d4f03ca19_44957255',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd736559bb461f08bb7afc74a7fb2a1aecce5439e' => 
    array (
      0 => 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\templates\\radio.tpl',
      1 => 1477123405,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580b1d4f03ca19_44957255 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_html_radios')) require_once 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\libs\\plugins\\function.html_radios.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
请选择你喜欢的类型
<?php echo smarty_function_html_radios(array('name'=>'beauty','values'=>$_smarty_tpl->tpl_vars['beauty']->value,'output'=>$_smarty_tpl->tpl_vars['beauty']->value,'selected'=>'貂蝉'),$_smarty_tpl);?>


<hr/>

请选择你喜欢的类型
<?php echo smarty_function_html_radios(array('name'=>'beauty','options'=>$_smarty_tpl->tpl_vars['beauty2']->value,'selected'=>"2"),$_smarty_tpl);?>

</body>
</html><?php }
}
