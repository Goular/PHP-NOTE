<?php

// 确定当前平台
$p = !empty($_GET['p']) ? $_GET['p'] : "back";//确定使用哪个平台。
define("PLAT", $p);	//存储于常量中，保证不会被修改

// 确定当前控制器
$c = !empty($_GET['c']) ? $_GET['c'] : "Manage";//它也可能是"User"，“product”，或其他。我们这里，把“user”当做默认要使用的控制器
define('CONTROLLER', $c);

$a = !empty($_GET['a']) ? $_GET['a'] : "Index";
define('ACTION', $a);

// 定义系统路径常量
define("DS", DIRECTORY_SEPARATOR);//DIRECTORY_SEPARATOR表示“目录分隔符”，
						//只有2个：'/'（unix系统）, '\'(window系统)
define("ROOT", __DIR__ . DS);	//当前mvc框架的根目录：
define("APP", ROOT . 'Application' . DS);	//application的完整路径
define("FRAMEWORK", ROOT . 'Framework' . DS);	//框架基础类所在路径
define("PLAT_PATH", APP . PLAT . DS);	//当前平台所在目录
define("CTRL_PATH", PLAT_PATH . "Controllers" . DS);//当前控制器所在目录
define("MODEL_PATH", PLAT_PATH . "Models" . DS);//当前模型所在目录
define("VIEW_PATH", PLAT_PATH . "Views" . DS);//当前视图所在目录


// 定义自动记载，所有类文件的加载都使用该方法
function __autoload($class){
	// 框架中的基础类
	$base_class['MySQLDB'] = FRAMEWORK . 'MySQLDB.class.php';
	$base_class['BaseModel'] = FRAMEWORK . 'BaseModel.class.php';
	$base_class['ModelFactory'] = FRAMEWORK . 'ModelFactory.class.php';
	$base_class['BaseController'] = FRAMEWORK . 'BaseController.class.php';
	$base_class['Captcha'] = FRAMEWORK . 'tool/Captcha.class.php';
	if( isset($base_class[$class]) ){
		require $base_class[$class];
	}
	else if( substr($class, -5) == "Model"){//所需要的类的名字最后5个字符是"Model”时
			require  MODEL_PATH  .  $class  . ".class.php";
	}
	else if( substr($class, -10) == "Controller"){//所需要的类的名字最后10个字符是"Controller”时
			require  CTRL_PATH  .  $class  . ".class.php";
	}
}

// 实例化当前控制器类
$controller_name = $c . "Controller";		//构建控制器的类名
$ctrl = new $controller_name ();	//可变类


// 调用动作方法

$action = $a . "Action";
$ctrl->$action();