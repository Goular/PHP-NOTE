<?php

class Xuliehua2
{
    public $p1 = 1;
    public $p2 = 2;
    public $p3 = 3;
    static $p4 = 4;

    function f1()
    {
        echo "<br/>f1方法被调用了.";
    }

    function __sleep()
    {
        echo "<br />要进行序列化了！";
        //下一行表示只指定p1和p2这两个属性数据进行序列化
        return array('p1', 'p2', 'p3');
    }

    function __wakeup()
    {
        echo "<br />要进行反序列化了！";
    }
}