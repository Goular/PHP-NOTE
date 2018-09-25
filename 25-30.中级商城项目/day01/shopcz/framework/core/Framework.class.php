<?php

//核心启动类
class Framework
{

    //定义一个运行的方法
    public static function run()
    {
        //运行初始化常量方法
        static::init();
        //运行自动类加载功能方法
        static::autoload();
        //执行路由分发方法，即创建对象，执行相关方法
        static::dispatch();
    }

    //定义预定义初始化的方法
    private static function init()
    {
        //将当前二级文件夹全部以常量的形式作为保存，方便运行的时候读取相关的路径与内容
        define('DS', DIRECTORY_SEPARATOR);//目录分隔号的常量，UNIX和Windows不能的文件夹分隔符号是不一样的
        define('ROOT', getcwd() . DS);
        define('APP_PATH', ROOT . 'application' . DS);
        define('FRAMEWORK_PATH', ROOT . 'framework' . DS);
        define('PUBLIC_PATH', ROOT . 'public' . DS);
        define('CONFIG_PATH', APP_PATH . 'config' . DS);
        define('CONTROLLER_PATH', APP_PATH . 'controllers' . DS);
        define('MODEL_PATH', APP_PATH . 'models' . DS);
        define('VIEW_PATH', APP_PATH . 'views' . DS);
        define('CORE_PATH', FRAMEWORK_PATH . 'core' . DS);
        define('DB_PATH', FRAMEWORK_PATH . 'databases' . DS);
        define('LIB_PATH', FRAMEWORK_PATH . 'libraries' . DS);
        define('HELPER_PATH', FRAMEWORK_PATH . 'helpers' . DS);
        define('UPLOAD_PATH', PUBLIC_PATH . 'uploads' . DS);
        define('PLATFORM', isset($_GET['p']) ? $_GET['p'] : 'admin');
        define('CONTROLLER', isset($_GET['c']) ? $_GET['c'] : 'Index');
        define('ACTION', isset($_GET['a']) ? $_GET['a'] : 'index');
        //获取当前控制器和视图的目录(即分好的前台和后台)
        define('CUR_CONTROLLER_PATH', CONTROLLER_PATH . PLATFORM . DS);
        define('CUR_VIEW_PATH', VIEW_PATH . PLATFORM . DS);

        //将配置信息要赋值到超级全局变量config
        $GLOBALS['config'] = include CONFIG_PATH . 'config.php';

        //由于每次都需要加载核心类才能进行下面的业务操作，所以每次都是需要强制载入核心类
        include CORE_PATH . 'Controller.class.php';
        include CORE_PATH . 'Model.class.php';
        include DB_PATH . 'Mysql.class.php';
    }

    //路由方法，就是实例化对象并调用相关的方法
    private static function dispatch()
    {
        //获取当前的控制器名称
        $controller_name = CONTROLLER . 'Controller';
        //获取方法名
        $action_name = ACTION . 'Action';
        //实例化控制器对象
        $controller = new $controller_name();//利用可变类来创建对象
        //调用相关控制器的方法
        $controller->$action_name();//执行的是可变方法
    }

    //自动加载功能，此时我们仅实现控制器和数据库模型的自动加载
    private static function load($className)
    {
        if (substr($className, -10) == 'Controller') {
            include CUR_CONTROLLER_PATH . "{$className}.class.php";
        } else if (substr($className, -5) == 'Model') {
            include MODEL_PATH . "{$className}.class.php";
        } else {
            //暂无相关内容,用于卡位
        }
    }

    //执行自动加载类的方法
    public static function autoload()
    {
        //执行加载类自动加载方法
        //方法一,使用array创建callable参数，其实就是方法句柄
        spl_autoload_register(array(__CLASS__, 'load'));//callable可以用数组来组成，所以可以这样写
        //方法二,直接使用当前类的字符串生成callable
        //spl_autoload_register('static::load');
    }
}