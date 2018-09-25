<?php
/* Smarty version 3.1.30, created on 2016-10-22 05:20:17
  from "E:\webroot\www\PHP_Learning\day33-smarty\templates\Section.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580adaf147c846_29266763',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53ce8f742314972887de046d3a9e14c67904d0c8' => 
    array (
      0 => 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\templates\\Section.tpl',
      1 => 1477106416,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580adaf147c846_29266763 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
<?php
$__section_index_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index'] : false;
$__section_index_0_loop = (is_array(@$_loop='4') ? count($_loop) : max(0, (int) $_loop));
$__section_index_0_total = $__section_index_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_index'] = new Smarty_Variable(array());
if ($__section_index_0_total != 0) {
for ($__section_index_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] = 0; $__section_index_0_iteration <= $__section_index_0_total; $__section_index_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']++){
?>
    <li><?php echo $_smarty_tpl->tpl_vars['star']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)];?>
</li>
<?php
}
}
if ($__section_index_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_index'] = $__section_index_0_saved;
}
?>

<hr/>

<?php
$__section_index2_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_index2']) ? $_smarty_tpl->tpl_vars['__smarty_section_index2'] : false;
$__section_index2_1_loop = (is_array(@$_loop='4') ? count($_loop) : max(0, (int) $_loop));
$__section_index2_1_total = $__section_index2_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_index2'] = new Smarty_Variable(array());
if ($__section_index2_1_total != 0) {
for ($__section_index2_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_index2']->value['index'] = 0; $__section_index2_1_iteration <= $__section_index2_1_total; $__section_index2_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_index2']->value['index']++){
?>
    <li><?php echo $_smarty_tpl->tpl_vars['user']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index2']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index2']->value['index'] : null)];?>
</li>
<?php
}
}
if ($__section_index2_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_index2'] = $__section_index2_1_saved;
}
?>

<hr/>
<?php
$__section_index_2_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index'] : false;
$__section_index_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['star']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_index_2_total = $__section_index_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_index'] = new Smarty_Variable(array());
if ($__section_index_2_total != 0) {
for ($__section_index_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] = 0; $__section_index_2_iteration <= $__section_index_2_total; $__section_index_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']++){
?>
    <li><?php echo $_smarty_tpl->tpl_vars['star']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_index']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_index']->value['index'] : null)];?>
</li>
<?php
}
}
if ($__section_index_2_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_index'] = $__section_index_2_saved;
}
?>


</body>
</html><?php }
}
