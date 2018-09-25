<?php
//echo "post:";
//print_r($_POST);
//
//echo "file:";
//print_r($_FILES);

if ($_FILES['userpic']['error'] > 0) {
    die("附件有错误");
}
//附件上传逻辑
$path = "./upload/";
$name = date("YmdHis") . "-" . mt_rand(1000, 9999);
$name_arr = explode('.', $_FILES['userpic']['name']);
//获取后缀名
$ext = "." . $name_arr[count($name_arr) - 1];

//附件真实路径名
$pathname = $path . $name . $ext;

//print_r($_FILES);
//echo $pathname;

if (move_uploaded_file($_FILES['userpic']['tmp_name'], $pathname)) {
    echo "success";
} else {
    echo "fail";
}