<?php
//以下程序必须存在同名称的函数
function getInfo(){
    echo 'dog';
}

function getInfo(){
    echo "pig";
}

getInfo();// Cannot redeclare getInfo()