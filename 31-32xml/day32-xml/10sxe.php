<?php
//方法一：实例化sxe对象，使用构造方法完成
//$data = file_get_contents('bookstore.xml');
//$sxe = new SimpleXMLElement($data);

//方法二:使用普通方法构造sxe对象
$sxe = simplexml_load_file('bookstore.xml');

//方法一与方法二的效果一致

echo "<pre>";
var_dump($sxe);
echo "</pre>";