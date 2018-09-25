<?php
/**
 * section用于的是索引数组遍历，关联数组遍历会报错
 */
include "libs/Smarty.class.php";
$smarty = new Smarty();
$smarty->setTemplateDir("templates");
$smarty->setCompileDir("templates_c");

$smarty->assign("star", array('明星1', '明星2', '明星3', '明星4', '明星5'));

$smarty->assign("user", array('id' => 1, 'name' => '陈东'));

$smarty->display('Section.tpl');