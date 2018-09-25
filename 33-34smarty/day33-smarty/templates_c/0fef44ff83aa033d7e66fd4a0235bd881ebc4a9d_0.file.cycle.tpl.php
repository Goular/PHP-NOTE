<?php
/* Smarty version 3.1.30, created on 2016-10-22 10:49:42
  from "E:\webroot\www\PHP_Learning\day33-smarty\templates\cycle.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_580b2826bdc452_43030570',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0fef44ff83aa033d7e66fd4a0235bd881ebc4a9d' => 
    array (
      0 => 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\templates\\cycle.tpl',
      1 => 1477126141,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_580b2826bdc452_43030570 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_cycle')) require_once 'E:\\webroot\\www\\PHP_Learning\\day33-smarty\\libs\\plugins\\function.cycle.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        
        .odd {background: #ddd;}
        
    </style>
</head>
<body>
<table width="600" border="1">
    <tr>
        <th>编号</th>
        <th>姓名</th>
        <th>绰号</th>
        <th>武器</th>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user']->value, 'v');
$_smarty_tpl->tpl_vars['v']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->iteration++;
$__foreach_v_0_saved = $_smarty_tpl->tpl_vars['v'];
?>
        <tr
                <?php if ((1 & $_smarty_tpl->tpl_vars['v']->iteration)) {?> class = 'odd' <?php }?>
        >
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['nickname'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['weapon'];?>
</td>
        </tr>
    <?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</table>

<hr>
<table width="600" border="1">
    <tr>
        <th>编号</th>
        <th>姓名</th>
        <th>绰号</th>
        <th>武器</th>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['user']->value, 'v');
$_smarty_tpl->tpl_vars['v']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->iteration++;
$__foreach_v_1_saved = $_smarty_tpl->tpl_vars['v'];
?>
        <tr class="<?php echo smarty_function_cycle(array('values'=>"odd,even"),$_smarty_tpl);?>
">
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['nickname'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['weapon'];?>
</td>
        </tr>
    <?php
$_smarty_tpl->tpl_vars['v'] = $__foreach_v_1_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</table>

</body>
</html><?php }
}
