<?php
/* Smarty version 3.1.30, created on 2016-10-22 10:29:46
  from "E:\webroot\www\PHP_Learning\day33-smarty\templates\select.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580b237a1dfd82_97317332',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f22eefa0ceeba8f14dee0e82d110af35501eabf7' => 
    array (
      0 => 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\templates\\select.tpl',
      1 => 1477124980,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580b237a1dfd82_97317332 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\libs\\plugins\\function.html_options.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<?php echo smarty_function_html_options(array('name'=>'man','values'=>$_smarty_tpl->tpl_vars['man']->value,'output'=>$_smarty_tpl->tpl_vars['man']->value),$_smarty_tpl);?>


<hr/>

<?php echo smarty_function_html_options(array('name'=>'man1','options'=>$_smarty_tpl->tpl_vars['man']->value,'selected'=>'2'),$_smarty_tpl);?>

</body>
</html><?php }
}
