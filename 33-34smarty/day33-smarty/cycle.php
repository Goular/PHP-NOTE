<?php
//1.引入smarty
include "libs/Smarty.class.php";
//2.实例化smarty
$smarty = new Smarty;
//3.设置相关属性
$smarty->template_dir = "templates";
$smarty->compile_dir = "templates_c";
//4.分配数据
$user = array(
	array('id'=>1,'name'=>'黄药师','nickname'=>'东邪','weapon'=>'萧'),
	array('id'=>2,'name'=>'欧阳锋','nickname'=>'西毒','weapon'=>'蛇'),
	array('id'=>3,'name'=>'一灯大师','nickname'=>'南帝','weapon'=>'手指'),
	array('id'=>4,'name'=>'洪七公','nickname'=>'北丐','weapon'=>'棒'),
	array('id'=>5,'name'=>'王重阳','nickname'=>'中神通','weapon'=>'剑'),
);
$smarty->assign('user',$user);
//5.载入模板
$smarty->display('cycle.tpl');
