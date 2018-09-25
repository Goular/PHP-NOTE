<?php
function f1(){
    echo "rain";
}
const BANJI = "java0610";
function f2(){
    echo "Saturday";
}

include "./11-b.php";

//访问公共空间元素要有"\"斜杠，提高代码可读性
echo "<br/>";
\f2();
echo "<br/>";
echo \BANJI;
echo "<br/>";
//访问命名空间的元素必须通过“空间名称”进行访问
echo \tianjin\BANJI;
echo "<br/>";
\tianjin\f3();