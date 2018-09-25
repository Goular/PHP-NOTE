<?php
header("content-type:text/html;charset=utf-8");
require "./ModelFactory.php";

//实例化模型类，并从中获取2份数据：
if (!empty($_GET['act']) && $_GET['act'] == 'del') {
    $id = $_GET['id'];
    $obj = ModelFactory::M('UserModel');
    $result = $obj->delUserById($id);
    echo "<font color='red'>删除成功!</font>";
}

$obj_user = ModelFactory::M('UserModel');
$data1 = $obj_user->GetAllUser();
$data2 = $obj_user->GetUserCount();

include "./showAllUser_view.html";