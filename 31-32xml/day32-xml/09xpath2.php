<?php
//XPATH的使用
$dom = new DOMDocument('1.0', 'utf-8');
$dom->load('bookstore.xml');
$xpath = new DOMXPath($dom);
$query = "//book[1]";
$query = "/bookstore/book[last()]";//获取最后一个
$query = "//title[last()]";//其实这个获取的是第一个title,
//$query = "//book[@category='CHILDREN']";
//$query = "//book[price>35]";
//$query = "//book[price>35]/title";
$res = $xpath->query($query);


//var_dump($res);
echo "<pre>";
var_dump($res->item(0));
echo "</pre>";