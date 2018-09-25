<?php
// 处理码值
// 将所有的可能字符，整理
$char_list = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
$char_list_len = strlen($char_list);
$code_len = 4;//4个字符
$code = '';//初始化码值字符串

for ($i = 1; $i <= $code_len; $i++) {
    //随机下标
    $rand_index = mt_rand(0, $char_list_len - 1);
    $code .= $char_list[$rand_index];
}

//将生成好的验证码存放到session中
session_start();
$_SESSION['code'] = $code;

// 处理验证码图片
$bg_file = "./captcha/captcha_bg" . mt_rand(1, 5) . '.jpg';

//创建画布
$image = imagecreatefromjpeg($bg_file);

//操作画布
//随机分配黑或者白
if (mt_rand(1, 2) == 1) {
    //白色
    $str_color = imagecolorallocate($image, 0xff, 0xff, 0xff);
} else {
    //黑色
    $str_color = imagecolorallocate($image, 0x00, 0x00, 0x00);
}

//计算图片宽高(获得画布的宽高)
$image_w = imagesx($image);//获取的是图片宽度
$image_h = imagesy($image);//获取的是图片高度

//字符串
$font = 5;

//计算字体的宽高(获得内置字体的宽高)
$font_w = imagefontwidth($font);
$font_h = imagefontheight($font);

//字符串的宽高
$str_w = $font_w * $code_len;
$str_h = $font_h;

//居中的位置是
$x = ($image_w - $str_w) / 2;
$y = ($image_h - $str_h) / 2;

imagestring($image, $font, $x, $y, $code, $str_color);

//输出
header('content-type:image/jpeg');
imagejpeg($image);


//销毁
imagedestroy($image);

