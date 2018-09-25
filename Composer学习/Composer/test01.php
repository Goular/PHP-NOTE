<?php
//发现：上述案例有瑕疵每次都需要外部文件麻烦
//解决：通过composer 类的自动加载规避
require './class/class1.php';
require './class/class2.php';

$class1 = new Class1();//内置标准类
$class2 = new Class2();//内置标准类

var_dump($class1);
echo '<br/>';
var_dump($class2);

//原生的加载