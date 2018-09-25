<?php
header("content-type", "text/html;charset=utf-8");

//收集发表的聊天信息，并存储
//获得最新的聊天信息
$link = mysql_connect("localhost", "root", "123456");
mysql_select_db('test', $link);
mysql_query('set names utf8;');

//接收表单信息
$color = $_POST['color'];
$recevier = $_POST['receiver'];
$biaoqing = $_POST['biaoqing'];
$msg = $_POST["msg"];

//拼接insert语句
$sql = "insert into t_message values(null,'{$msg}','admin','{$recevier}','{$color}','{$biaoqing}',now())";
$qry = mysql_query($sql);
if($qry){
    echo "发表聊天成功！";
}else{
    echo "发表聊天失败！";
}
