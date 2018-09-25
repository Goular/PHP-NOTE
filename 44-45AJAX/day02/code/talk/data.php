<?php
header("content-type", "text/html;charset=utf-8");
//获得最新的聊天信息
$link = mysql_connect('localhost', 'root', '123456');
mysql_select_db('test', $link);

mysql_query("set names utf8;");

$maxId = $_GET['maxID'];

//根据界面传递过来的最大值判断当前的信息，避免信息传递过多，浪费带宽
$sql = "select * from t_message where id>" . $maxId;
$mysql_query = mysql_query($sql);
$info = array();

while (!$mysql_query === false && $rst = mysql_fetch_assoc($mysql_query)) {
    $info[] = $rst;
}

echo json_encode($info);
