<?php
//DOM方式操作xml
//实例化一个DOMDocument对象
$dom = new DOMDocument("1.0", "utf-8");
//echo "<pre>";
//var_dump($dom);
//echo "</pre>";
//载入xml文档，将其转为树模型
$dom->load("bookstore.xml");
//处理过程
$titles = $dom->getElementsByTagName('title');
//var_dump($titles);
$title_1 = $titles->item(0);
echo $title_1->nodeValue;
//echo "<pre>";
//var_dump($title_1);
//echo "</pre>";

//将处理后的结果保存回来
//$dom->save('save_book.xml');