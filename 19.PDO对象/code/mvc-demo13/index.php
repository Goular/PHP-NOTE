<?php

//选择平台
$p = !empty($_GET['p']) ? $_GET['p'] : "front";
//选择控制器
$c = !empty($_GET['c']) ? $_GET['c'] : "User";//我们这里，把“user”当做默认要使用的控制器


//定义实现自动加载的方法
function __autoload($class_name)
{
    $base_class = array('MySQLDB', 'BaseModel', 'ModelFactory', 'BaseController');
    if (in_array($class_name, $base_class)) {
        require FRAMEWORK . $class_name . '.class.php';
    } else if (substr($class_name, -5) == 'Model') {
        require MODEL_PATH . $class_name . ".class.php";
    } else if (substr($class_name, -10) == 'Controller') {
        require CTRL_PATH . $class_name . ".class.php";
    }
}

//------------常量定义联盟-------------
define("PLAT", $p);//已常量定义当前是前台还是后台
define("DS", DIRECTORY_SEPARATOR);//操作系统的目录分隔符
define("ROOT", __DIR__ . DS);    //当前mvc框架的根目录：
//echo ROOT;
define("APP", ROOT . 'Application' . DS);    //application的完整路径
define("FRAMEWORK", ROOT . 'Framework' . DS);    //框架基础类所在路径
define("PLAT_PATH", APP . PLAT . DS);    //当前平台所在目录
define("CTRL_PATH", PLAT_PATH . "Controllers" . DS);//当前控制器所在目录
define("MODEL_PATH", PLAT_PATH . "Models" . DS);//当前模型所在目录
define("VIEW_PATH", PLAT_PATH . "Views" . DS);//当前视图所在目录


//require FRAMEWORK . 'MySQLDB.class.php';
//require FRAMEWORK . 'BaseModel.class.php';
//require FRAMEWORK . 'ModelFactory.class.php';    //这个都一样，不同动
//require FRAMEWORK . 'BaseController.class.php';//这个都一样，不同动
//
//require MODEL_PATH . $c . "Model.class.php";
//
////这里才是需要载入的“当前控制器类”
//require CTRL_PATH . $c . "Controller.class.php";

$controller_name = $c . "Controller";
$ctrl = new $controller_name();

$act = !empty($_GET['act']) ? $_GET['act'] : "Index";
$action = $act . "Action";
$ctrl->$action();//利用可变函数实现可变方法
