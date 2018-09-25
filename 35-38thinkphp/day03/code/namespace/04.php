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
$obj = new Animal();

echo $obj->name;

//访问其他空间的元素
$obj1 = new \beijing\haidian\xisanqi\Animal();
echo "<br/>",$obj1->name;