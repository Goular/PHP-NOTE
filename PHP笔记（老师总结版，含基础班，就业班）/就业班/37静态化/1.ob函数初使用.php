<?php

//// comment out the following two lines when deployed to production
//defined('YII_DEBUG') or define('YII_DEBUG', true);
//defined('YII_ENV') or define('YII_ENV', 'dev');
//
//require(__DIR__ . '/../vendor/autoload.php');
//require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
//
//$config = require(__DIR__ . '/../config/web.php');
//
//(new yii\web\Application($config))->run();


//1.开启PHP缓冲区
ob_start();

//实现一个静态化的过程
for ($i = 0; $i < 10; $i++) {
    echo $i . "<hr/>";
}

//2.抓取php缓冲区的内容
$content = ob_get_contents();

//3.利用抓取的内容制作静态页面
file_put_contents('./01.html', $content);

//4.删除缓冲区内容并缓冲
ob_end_flush();