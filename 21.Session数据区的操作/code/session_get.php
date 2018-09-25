<?php

class Student
{
    private $_name;

    public function __construct($n)
    {
        $this->_name = $n;
    }
}

session_start();
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
/**
 * __PHP_Incomplete_Class
 * 出现这个的原因是，session在反序列化的时候，找不到相关的类，从而产生这种问题，只要在前面重写上类的定义即可
 */