<?php

$p = !empty($_GET['p']) ? $_GET['p'] : "front";

$c = !empty($_GET['c']) ? $_GET['c'] : "User";//我们这里，把“user”当做默认要使用的控制器


require './Framework/MySQLDB.class.php';
require './Framework/BaseModel.class.php';
require './Framework/ModelFactory.class.php';    //这个都一样，不同动
require './Framework/BaseController.class.php';//这个都一样，不同动

require "./Application/$p/Models/" . $c . "Model.class.php";

//这里才是需要载入的“当前控制器类”
require "./Application/$p/Controllers/" . $c . "Controller.class.php";

$controller_name = $c . "Controller";
$ctrl = new $controller_name();

$act = !empty($_GET['act']) ? $_GET['act'] : "Index";
$action = $act . "Action";
$ctrl->$action();//利用可变函数实现可变方法
