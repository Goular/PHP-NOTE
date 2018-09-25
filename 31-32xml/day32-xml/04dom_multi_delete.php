<?php
$dom = new DOMDocument('1.0', 'utf-8');
$dom->load('bookstore.xml');

$years = $dom->getElementsByTagName('year');
//循环删除
//迭代器的遍历不能像数组遍历删除指定元素一样使用应用传递解决（"&"），实现了迭代接口的数据列表的删除，只能使用多次循环来解决
//foreach ($years as &$year) {这是错误写法
//    $year->parentNode->removeChild($year);
//}

//第一步，保存所有year的节点
$temp = array();
foreach ($years as $year) {
    $temp[] = $year;
}
//遍历year节点并删除内容
foreach ($temp as $tem) {
    $tem->parentNode->removeChild($tem);
}


$dom->save('delete2_book.xml');