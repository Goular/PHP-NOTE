<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * 注意：：PDO有两种模式：静默模式和异常模式,默认为静默模式，需要pdo对象设定好属性才能打开异常模式
 */


//定义访问的资料
$dsn = "mysql:host=localhost;port=3306;dbname=php39";
//定义字符集，防止SQL注入攻击
$opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8');
//创建PDO对象
$pdo = new PDO($dsn, 'root', '123456', $opt);
var_dump($pdo);

//进行查询语句
//这个sql语句肯定是错误
$sql = "updateeeee  tab_int  set f1 = 1;";
$result = $pdo->exec($sql);
if ($result === false) {
    echo "<br/>发生错误:";
    echo "<br/>错误代号：" . $pdo->errorCode();
    //echo "<br/>错误信息:" . $pdo->errorInfo();
    //todo:注意一点的是:$pdo->errorInfo()返回的数组
    $error = $pdo->errorInfo();//这是一个数组！第3项才是错误信息

    echo "<pre>";
    var_dump($error);
    echo "</pre>";

    echo "<br/>错误信息是:" . $error[2];
}

//下面，让pdo对象“进入”异常模式，以处理出错信息：
//todo:因为PDO默认是静态模式,即出错还是会继续运行，同时将相关的错误归到errorcode和errorinfo中
//将默认模式设置成为异常模式
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $sql = "deleteeeeee  from  user_list;";
    $result = $pdo->exec($sql);
    echo "执行成功";
} catch (Exception $e) {
    echo "<p>TRY^CATCH::发生错误：";
    echo "<br />错误代号：" . $e->getCode();//获取该错误的对象的错误代号
    echo "<br />错误信息：" . $e->getMessage();//获取该错误的对象的错误提示
}
?>
</body>
</html>