<?php
//1.初始化,在学习更为复杂的功能之前，先来看一下在PHP中建立cURL请求的基本步骤
//curl_init();

//2.设置变量,curl_setopt() 。最为重要，一切玄妙均在此。有一长串cURL参数可供设置，它们能指定URL请求的各个细节。要一次性全部看完并理解可能比较困难，所以今天我们只试一下那些更常用也更有用的选项。
//curl_setopt();

//3.执行并获取结果
//curl_exec();

//释放CURL句柄
//curl_close();

//GET请求使用代码
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.jb51.net");//设定访问地址
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//设定TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。
curl_setopt($ch, CURLOPT_HEADER, false);//启用时会将头文件的信息作为数据流输出。
curl_setopt($ch,CURLOPT_HTTPHEADER,array (
    "content-type: application/x-www-form-urlencoded;charset=UTF-8"
));

//执行并获取HTML文档内容
$output = curl_exec($ch);

//执行curl句柄
curl_close($ch);

print_r($output);
//var_dump($output);