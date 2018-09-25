<?php
//1.引入smarty
include "libs/Smarty.class.php";
//2.实例化smarty
$smarty = new Smarty;
//3.设置相关属性
$smarty->template_dir = "templates";
$smarty->compile_dir = "templates_c";
//4.分配数据
$smarty->assign('poem','a人的一生挺漫长的，但是关键的就那么几步,我们要走好这几步');
$smarty->assign('level',10);
//5.载入模板
$smarty->display('modifer.tpl');