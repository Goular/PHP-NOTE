<?php
//函数内部声明全局变量
function f1(){
    global $subject;
    $subject = 'PHP Learning.';
}

//函数调用后，全局变量起作用
f1();
echo $subject;