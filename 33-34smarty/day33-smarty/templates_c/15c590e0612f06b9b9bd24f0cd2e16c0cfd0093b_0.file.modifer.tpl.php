<?php
/* Smarty version 3.1.30, created on 2016-10-22 09:50:01
  from "E:\webroot\www\PHP_Learning\day33-smarty\templates\modifer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580b1a29a620a4_39232219',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15c590e0612f06b9b9bd24f0cd2e16c0cfd0093b' => 
    array (
      0 => 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\templates\\modifer.tpl',
      1 => 1477122600,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580b1a29a620a4_39232219 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\libs\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_truncate')) require_once 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\libs\\plugins\\modifier.truncate.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<?php echo time();?>

<br>
<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S');?>

<br>
<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d %T');?>

<hr/>

<?php echo $_smarty_tpl->tpl_vars['poem']->value;?>

<br>
<?php echo mb_strtoupper(smarty_modifier_truncate($_smarty_tpl->tpl_vars['poem']->value,15,'***'), 'UTF-8');?>


<hr/>
<?php echo str_repeat('hello',$_smarty_tpl->tpl_vars['level']->value);?>

</body>
</html><?php }
}
