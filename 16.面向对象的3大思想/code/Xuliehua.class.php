<?php

/**
 * 用于保存对象
 */
class Xuliehua
{
    public $p1 = 1;
    protected $p2 = 2;
    private $p3 = 4;
    static $p4 = 4;

    function f1()
    {
        echo "<br/>f1方法被调用了";
    }

    /**
     * 对象序列化所会回调的方法
     * __sleep() 不能返回父类的私有成员的名字
     * 返回一个包含对象中所有应被序列化的变量名称的数组
     */
    function __sleep()
    {
        echo '<br/>要进行对象的序列化';
        return array('p1', 'p2', 'p3');
    }

    function __wakeup()
    {
        echo "我在执行反序列化的操作.";
    }


}