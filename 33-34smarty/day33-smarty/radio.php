<?php
//1.引入smarty
include "libs/Smarty.class.php";
//2.实例化smarty
$smarty = new Smarty;
//3.设置相关属性
$smarty->template_dir = "templates";
$smarty->compile_dir = "templates_c";
//4.分配数据
$smarty->assign('beauty',array('西施','貂蝉','王昭君','杨玉环'));
$smarty->assign('beauty2' ,array(
	'0' => '西施',
	'1' => '貂蝉',
	'2' => '王昭君',
	'3' => '杨玉环'
));
//5.载入模板
$smarty->display('radio.tpl');