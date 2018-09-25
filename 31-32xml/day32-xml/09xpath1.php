<?php
//XPATH的使用
$dom = new DOMDocument('1.0', 'utf-8');
$dom->load('rss.xml');
//实例化XPATH对象
$xpath = new DOMXPath($dom);
//编写查询的路径
$query = "/rss/channel/title";//长度为1
$query = "/title";//长度为0
$query = "//title";//不考虑任何的节点关系来寻找title,长度为3
$query = "/rss/channel//title";//长度也是为3，所以只要使用了"//"那么就不会管位置，全局范围搜索合适的标记


$res = $xpath->query($query);
var_dump($res);
