<?php
/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 2016/8/29
 * Time: 12:36
 */

$link = mysql_connect('localhost', 'root', '123456');
if (!$link) {
    echo '连接失败:' . mysql_error();
}
mysql_query('set names utf8;');
return $link;