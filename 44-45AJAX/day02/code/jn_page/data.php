<?php
header("content-type", "text/html;charset=utf-8");
//使用传统的方式进行分页效果
$link = mysqli_connect('localhost', 'root', '123456');
mysqli_select_db($link, 'ecshop3');
mysqli_query($link, 'set names utf8;');

//实现数据的分页
//1.引入分页的类文件
include("./page.class.php");

//2.获得商品的总条数
$sql = "select count(*) from ecs_goods";
$qry = mysqli_query($link, $sql);
$rows = mysqli_fetch_row($qry);
$total = $rows[0];
$per = 4;

//3.实例化分页类对象
$page_obj = new Page($total, $per);

//4.拼接一条sql语句获得每页信息
$sql3 = "select goods_sn i,goods_name n,goods_number p from ecs_goods " . $page_obj->limit;
$qry3 = mysqli_query($link, $sql3);

//5.获得页码列表
$pageList = $page_obj->fpage(array(3, 4, 5, 6, 7, 8));

$info = array();
while ($rst3 = mysqli_fetch_assoc($qry3)) {
    $info[] = $rst3;
}
$info[] = $pageList;

//将多条的商品的信息传递到相关的json格式中
echo json_encode($info);
