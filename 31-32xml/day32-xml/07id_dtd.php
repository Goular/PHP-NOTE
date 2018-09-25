<?php
//设置好了id这一特殊唯一属性后，那么在dom树中，可以使用getElementById进行读取指定的节点的的DOMElement的数据
$dom = new DOMDocument('1.0', 'utf-8');
$dom->validateOnParse = true;
$dom->load('note.xml');
$body = $dom->getElementById('body');
echo $body->nodeValue;

