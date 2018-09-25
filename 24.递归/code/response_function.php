<?php
//响应header()方法的一般使用
//header('Location:https://www.baidu.com');

//设定输出的类型，若是文本就需要多加一个字符集
//header('Content-Type:text/html;charset=utf-8');
//echo '你好';

//保存cookie有两种方法，一是直接输入setCookie()方法进行解决，第二个是使用header('Set-Cookie:key=value,key2=value2')来解决
header('Set-Cookie:username=zhao');

