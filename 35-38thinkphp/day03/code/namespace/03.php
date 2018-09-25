<?php
//以下程序必须存在同名称的函数
namespace banji310;
function getInfo(){
    echo 'dog';
}
const HOST = "LocalHost1";
//define('USER','root');

namespace banji311;
function getInfo(){
    echo "pig";
}
//define('USER','admin');//Constant USER already defined
const HOST = "127.0.0.1";

//访问元素
//元素在“没有任何限制”的时候，会访问"当前空间"元素
//当前空间：上边挨着最近的空间就是当前空间
getInfo();//pig
echo "<br/>",HOST,"<br/>";

//访问其他空间元素: \空间\元素;
\banji310\getInfo();
echo "<br/>",\banji310\HOST;