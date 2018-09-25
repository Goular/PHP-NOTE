<?php
//使用validate方法进行校验
header("Content-type:text/html;charset=utf-8");
$dom = new DOMDocument('1.0', 'utf-8');
//载入
@$dom->load('note.xml');
//执行该方法，会自动执行自身的DTD文件进行校验
if ($dom->validate()) {
    echo "yes";
} else {
    echo "no";
}

//"@"符号为阻止警告的输出