<?php
//利用sleep()方法延迟添加的内容，/tmp文件夹是xampp的缓存保存位置
//sleep(10);

//var_dump($_POST);
//echo "<hr/>";

echo "<pre>";
var_dump($_FILES);
echo "</pre>";

echo "<hr/>";

//处理上传的临时文件
$tmp_file = $_FILES['goods_image']['tmp_name'];
$dst_file = './upload.jpg';
$result = move_uploaded_file($tmp_file, $dst_file);



//$_FILES['file']['error']值
//
//UPLOAD_ERR_OK: 0 //正常，上传成功
//
//UPLOAD_ERR_INI_SIZE: 1 //上传文件大小超过服务器允许上传的最大值，php.ini中设置upload_max_filesize选项限制的值
//
//UPLOAD_ERR_FORM_SIZE: 2 //上传文件大小超过HTML表单中隐藏域MAX_FILE_SIZE选项指定的值
//
//UPLOAD_ERR_NO_TMP_DIR: 6 //没有找不到临时文件夹
//
//UPLOAD_ERR_CANT_WRITE: 7 //文件写入失败
//
//UPLOAD_ERR_EXTENSION: 8 //php文件上传扩展没有打开
//
//UPLOAD_ERR_PARTIAL: 3 //文件只有部分被上传

//一般来说，数字5一般是说接收到的文件的大小为0