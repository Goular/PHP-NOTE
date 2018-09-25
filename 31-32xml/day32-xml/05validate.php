<?php
header("Content-type:text/html;charset=utf-8");
$dom = new DOMDocument('1.0', 'utf-8');
//在载入之前进行强制加载外部的DTD
$dom->validateOnParse = true;//设置强制设置加载外部DTD
//设置好校验属性后进行载入xml
$dom->load('note.xml');
$body = $dom->getElementsByTagName("body")->item(0);
echo $body->nodeValue;