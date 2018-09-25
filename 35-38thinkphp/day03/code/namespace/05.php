<?php
//多级空间使用
namespace beijing\haidian\xisanqi;
class Animal{
    public $name = "wolf";
}

namespace liaoning\shenyang\tiexi;
class Animal{
    public $name = "tiger";
}

//① 【非限定名称方式】  访问元素
$obj = new Animal();
echo $obj->name,"<br/>";

//访问其他空间元素
$obj1 = new \beijing\haidian\xisanqi\Animal();
echo $obj1->name; //wolf
