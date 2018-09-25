<?php
//1.引入smarty
include "libs/Smarty.class.php";
//2.实例化smarty
$smarty = new Smarty;
//3.设置相关属性
$smarty->template_dir = "templates";
$smarty->compile_dir = "templates_c";
//4.分配数据
$smarty->assign('man',array('周恩来','梅兰芳','张学良','汪精卫'));
// $smarty->assign('selected',array('潘安','宋玉'));
//5.载入模板
$smarty->display('select.tpl');