<?php
include "libs/Smarty.class.php";
$smarty = new Smarty();
$smarty->setTemplateDir("templates");
$smarty->setCompileDir("templates_c");
$smarty->assign('love', false);//布尔型,由于false是什么都不会进行输出，所以显示的内容为空
$smarty->assign('age', 16);

//分配数组
//索引数组
$smarty->assign('star', array('周星驰', '鲳鱼', '段誉', '王语嫣', '姚明'));
//关联数组
$smarty->assign('user', array(
    'id' => 1,
    'name' => "123323",
    'nickname' => '小李飞刀'
));

define('ROOT', getcwd());

$smarty->display('assign.tpl');

