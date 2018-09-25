<?php
/**
 * Session类型的存储
 * php.ini支持session.auto_start=1;开启session，但是这样的开启是不好的，缺乏了各个应用的独立性，因为，这个是全局的php设置
 */
session_start();
//整型
$_SESSION['int'] = 42;
//浮点
$_SESSION['float'] = 42.24;
//字符串
$_SESSION['string'] = "itcast";
//布尔
$_SESSION['bool'] = false;
//数组
$_SESSION['array'] = array('name' => 'zhao', 1 => 23);

class Student
{
    private $_name;

    public function __construct($n)
    {
        $this->_name = $n;
    }
}
//对象
$_SESSION['object'] = new Student('杭波');
//空
$_SESSION['null'] = null;

/**
 * 需要注意的是，resource不能存储到session中
 */
