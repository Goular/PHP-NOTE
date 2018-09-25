<?php
/**
 * 创建蓝色背景画布
 */
//1.创建画布
$width = 500;
$height = 250;

//创建新的画布资源
//$image = imagecreate($width,$height);//默认调色板颜色，颜色较少
$image = imagecreatetruecolor($width, $height);//默认真彩色，1600万色

//创建已有图像的资源
//$image = imagecreatefromjpeg(图片地址);
//$image = imagecreatefrompng(图片地址)
//$image = imagecreatefromgif(图片地址)

//查看图片资源
//var_dump($image);

//操作画布
//$blue = imagecolorallocate($image, 0, 0, 255);
//分配颜色:为某张画布分配某种颜色。
//其实类似于Java的画笔
$blue = imagecolorallocate($image, 0, 0, 0xff);////第一次调用即为画布设置背景颜色,后面的添加的颜色可以当做是画笔

//生成画布
imagefill($image, 0, 0, $blue);
//imagepng($image, './blue.png');

//若生成png的方法第二个内容为空，那么就会输出到html上，但值得注意的一点是:当前的内容是直接输出html/charset=utf8,所以要将头部变为显示头像，这样才能正常显示，而且显示图片的输出是不能输出其他的内容，不然以图片解码显示时会出现bug
header("content-type:image/png;");
imagepng($image);

//销毁画布
imagedestroy($image);