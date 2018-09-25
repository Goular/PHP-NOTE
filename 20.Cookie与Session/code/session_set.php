<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * Cookie的劣势
 * 1.会话数据的安全性
 * 2.请求的传输数据量变大，一般浏览器都会限制Cookie的大小和数量
 */

/**
 * Session技术：
 * 实现方式如下：
 * 在 服务器端，建立很多的会话数据区（session数据区）
 * 为 每个session会话数据区分配唯一标识
 * 将该唯一标识，分配给对应会话浏览器
 * 因此：session技术基于COOKIE技术！
 */
//开启session
session_start();//使用$_SESSION必须启用的前置方法,之后的使用方法与普通的使用方法即可
//添加
$_SESSION['user'] = 'Zhao';
$_SESSION['password'] = '123456';

//修改
$_SESSION['user'] = 'ZhaoJingTao';

//删除
unset($_SESSION['password']);

//获取
var_dump($_SESSION['user']);
echo "<hr/>";
var_dump(isset($_SESSION['password']));


?>
</body>
</html>