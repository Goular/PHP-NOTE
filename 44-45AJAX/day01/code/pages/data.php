<?php
header("content-type", "text/html;charset=utf-8");
//使用传统的方式进行分页效果
$link = mysqli_connect('localhost', 'root', '123456');
mysqli_select_db($link, 'ecshop3');
mysqli_query($link,'set names utf8;');

//实现数据的分页
//1.引入分页的类文件
include("./page.class.php");

//2.获得商品的总条数
$sql = "select count(*) from ecs_goods";
$qry = mysqli_query($link,$sql);
$rows = mysqli_fetch_row($qry);
$total = $rows[0];
$per = 4;

//3.实例化分页类对象
$page_obj = new Page($total, $per);

//4.拼接一条sql语句获得每页信息
$sql3 = "select goods_sn,goods_name,goods_number from ecs_goods ".$page_obj->limit;
$qry3 = mysqli_query($link,$sql3);

//5.获得页码列表
$pageList = $page_obj->fpage(array(3,4,5,6,7,8));

echo <<<eof
<style type="text/css">
    table{width:700px; border:1px solid black; margin:auto; border-collapse:collapse;}
    td {border:1px solid black;}
</style>
<table>
    <tr style="font-weight:bold;"><td>序号</td><td>名称</td><td>数量</td></tr>
eof;
while($rst3 = mysqli_fetch_assoc($qry3)){
    //$rst 代表每条记录的一维数组信息
    echo "<tr>";
    echo "<td>".$rst3['goods_sn']."</td>";
    echo "<td>".$rst3['goods_name']."</td>";
    echo "<td>".$rst3['goods_number']."</td>";
    echo "</tr>";
}

echo "<tr><td colspan='3'>$pageList</td></tr>";
echo "</table>";

