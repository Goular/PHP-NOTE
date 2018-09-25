<?php
//引入机制
namespace beijing\haidian\xisanqi;
class Animal{
    static $name = "pig";
}

namespace liaoning\shenyang\tiexi;
const USER = "admin";
class Animal{
    static $name = "cat";
}

//把 beijing\haidian\xisanqi\Animal 类元素直接引入
use beijing\haidian\xisanqi\Animal as Aml;

//通过“别名”访问引入空间的元素
echo Aml::$name,"<br/>";
echo Animal::$name;