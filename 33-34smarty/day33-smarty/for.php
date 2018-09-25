<?php
include "libs/Smarty.class.php";

$smarty = new Smarty();
$smarty->setTemplateDir("templates");
$smarty->setCompileDir("templates_c");

$smarty->assign("star", array('明星1', '明星2', '明星3', '明星4', '明星5'));


$user = array(
    array('id' => '1', 'name' => "人1"),
    array('id' => '2', 'name' => "人2"),
    array('id' => '3', 'name' => "人3"),
    array('id' => '4', 'name' => "人4"),
    array('id' => '5', 'name' => "人5")
);
$smarty->assign('user', $user);

$smarty->display("for.tpl");