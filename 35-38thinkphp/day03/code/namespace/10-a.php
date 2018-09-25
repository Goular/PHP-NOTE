<?php
namespace beijing;
function f1(){
    echo "rain";
}
const BANJI = "java0610";
function f2(){
    echo "Saturday";
}

//引入文件空间针对当前空间没有影响
include "10-b.php";
f1();

//访问公共空间的元素
echo "<br/>",\BANJI;

echo "<br/>",BANJI;
echo "<br/>";
f2();
echo "<br/>";
\f2();