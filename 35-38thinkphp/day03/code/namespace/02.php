<?php
//空间的名称与具体上级目录没有直接关系
//按照php正确的命名方式定义即可
namespace banji310;
function getInfo(){
    echo 'dog';
}
const Host = "LocalHost";
//define('USER','root');

namespace banji311;
function getInfo(){
    echo "pig";
}
//define('USER','admin');//Constant USER already defined
const HOST = "127.0.0.1";

echo \banji310\Host;