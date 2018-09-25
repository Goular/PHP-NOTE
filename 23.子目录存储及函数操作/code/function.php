<?php

//strrchr()从右边算起，遇到指定标识停下，同时获取后边的内容，标识位内容不算


/**
 * prefix有用的参数。例如：如果在多台主机上可能在同一微秒生成唯一ID。
 * prefix为空，则返回的字符串长度为13。more_entropy 为 TRUE，则返回的字符串长度为23。
 * more_entropy如果设置为 TRUE，uniqid() 会在返回的字符串结尾增加额外的煽（使用combined linear congruential generator）。 使得唯一ID更具唯一性。
 */
//echo uniqid(), '<br/>';
//echo uniqid('goods_'), '<br/>';
//echo uniqid('', true), '<br/>';
//echo uniqid('goods_', true), '<br/>';

/**
 * 安全性
 * 对类型的限制
 * $_FILES中的type的信息，不是PHP检测出来的，而是浏览器提供的。
 *
 * 因此：PHP也需要检测文件类型才可以，不能完全信赖浏览器数据！
 *
 * PHP检测文件的MIME类型
 * （文件内容中，存储相关的类型）
 *
 *
 * PHP提供 fileinfo 相关函数（方法），来完成
 *
 * 记得开启php.ini的fileinfo扩展
 * restart apache httpd
 */

//不要过分相信传过来的内容(即内容和类型，因为这都是可以使用程序改的，可以逃过一般的检查)，需要使用php的方法再次进行校验保证征程运行
$file = './2016092705/57e9e879cb7032.47668746.jpg';
//This class provides an object oriented interface into the fileinfo functions.
$file_info = new Finfo(FILEINFO_MIME_TYPE);
//利用对象可以获得你想要的文件相关内容
$mine_type = $file_info->file($file);

echo $mine_type;
