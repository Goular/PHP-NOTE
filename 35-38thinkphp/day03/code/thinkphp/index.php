<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('require PHP > 5.3.0 !');
}

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG', true);//调试模式
//define('APP_DEBUG', false);//生产模式

// 定义应用目录
define('APP_PATH', './Application/');

//定义前台静态资源文件的常量路径
define('HOME_CSS_URL','/Application/Home/Public/css/');
define('HOME_IMG_URL','/Application/Home/Public/images/');
define('HOME_JS_URL','/Application/Home/Public/js/');

//定义后台静态资源文件的常量路径
define('ADMIN_CSS_URL','/Application/Admin/Public/css/');
define('ADMIN_IMG_URL','/Application/Admin/Public/img/');



// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单
