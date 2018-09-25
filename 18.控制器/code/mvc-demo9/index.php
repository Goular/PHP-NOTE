<?php
$c = !empty($_GET['c']) ? $_GET['c'] : "User";//我们这里，把“user”当做默认要使用的控制器

//代表某个控制器，每个控制器是一个独立文件，但并不写在这里
//而是，有下一行根据$c的只来决定载入哪一个控制器文件：
//class  XXXController  extends  BaseController{ ...... }

//这里才是需要载入的“当前控制器类”
require "./" . $c . "Controller.class.php";

$controller_name = $c . "Controller";
$ctrl = new $controller_name();

$act = !empty($_GET['act']) ? $_GET['act'] : "Index";
$action = $act . "Action";
$ctrl->$action();//利用可变函数实现可变方法
