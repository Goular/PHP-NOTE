<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
//我们准备要自己来定义错误“处理器”了
set_error_handler("my_error_handler");

ini_set('error_log', 'mylog.txt');

function my_error_handler($errCode, $errMsg, $errFile, $errLine){
    $str = "";
    $str .= "<p><font color='red'>大事不好，发生错误：</font>";
    $str .= "<br />错误代号为：" . $errCode;
    $str .= "<br />错误内容为：" . $errMsg;
    $str .= "<br />错误文件为：" . $errFile;
    $str .= "<br />错误行号为：" . $errLine;
    $str .= "<br />发生时间为：" . date("Y-d-m H:i:s");
    $str .= "</p>";
    echo $str;	//输出该“构建”的错误完整处理结果
    //也可以将该内容“写入”到某个文件中去，也就是所谓记录错误日志！
    //但，今天我们就做不到了——这涉及到文件操作！
}

//以下是有错误的代码：
echo "<br />aaa";
echo $v1;	//使用不存在的变量
echo C1;	//使用不存在的常量
echo "<br />bbb";
include './no_this_file.php';
echo "<br />ccc";

?>

</body>
</html>