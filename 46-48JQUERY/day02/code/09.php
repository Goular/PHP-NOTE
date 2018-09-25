<?php
//绘制一个图片

//创建一个画板
$im = imagecreatetruecolor('400','300');//创建真色彩的画板

//创建一个绿色画笔
$green = imagecolorallocate($im,0,128,0);

//填充画板颜色
imagefill($im,0,0,$green);

//线程休眠4秒钟
sleep(4);

//创建图片
header("content-type:image/jpeg");
imagejpeg($im);

//销毁图片
imagedestroy($im);