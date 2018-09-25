<?php
include "./libs/Smarty.class.php";
$smarty = new Smarty();
$smarty->setTemplateDir("templates");
$smarty->setCompileDir("templates_c");

$smarty->assign("iq", 50);

$smarty->display('if.tpl');