<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<!--
第一步：创建先关的表
 --from是关键字，因为直接使用关键字会报错，但是若想使用关键字作为字段名的办法是使用反引号`` 键盘数字1左边的符号
(1)create table user_list(
    user_id int auto_increment primary key,
    user_name varchar(10),
    user_pass char(32),
    age tinyint unsigned,
    edu enum('小学','中学','大学','硕士','博士'),
    xingqu set('排球','篮球','足球','中国足球','地球'),
    `from` enum('东北','华北','西北','华东','华南','华西'),
    reg_time timestamp
)charset=utf8;
-->

<!--
这个版本的意义是最好多少使用数字来替代中文的表单传输的问题，因为毕竟有有一个问题就是，中文的传输的毕竟不是太好
-->

<?php
/**
 * 首先创建MySql链接
 */
$host = 'localhost';
$user = 'root';
$pwd = '123456';
$link = mysql_connect($host, $user, $pwd);
mysql_query("set names utf8");
mysql_query("use php39;");
if (!$link) {
    echo '数据库链接异常' . mysql_error($link);
    exit();
}
?>

<?php
//接收是否需要删除内容
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "delete from user_list where user_id = $id;";
    $result = mysql_query($sql);
    if (!$result) {
        echo '删除失败';
    }
}


?>






<?php
//获取当前的表单的内容，并提交到数据库
if (!empty($_POST)) {
    //先接收表单数据：
    $username = $_POST['username'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $xueli = $_POST['xueli'];
    $aihao = $_POST['aihao'];//这是一个数组结果，类似这样：array('aa','bb','cc');
    $xingqu = "";
    $from = $_POST['from'];

    //这句话可以替代上面的for语句，其实很多时候，程序的api都已经提供了相应的功能，只是没看到而自己去写，所以必须去多看api文档，这样才能写更少的代码，获得更大的进步
    $xingqu = array_sum($aihao);


    $sql = "insert into user_list (user_name,user_pass,age,edu,xingqu,`from`,reg_time)values(";
    $sql .= "'$username',md5('$password'),$age,'$xueli','$xingqu','$from',now())";

    $result = mysql_query($sql);
    //判断结果
    if (!$result) {
        echo "<br/>抱歉，插入数据失败,原因是:" . mysql_error($link);
    } else {
        echo "<br/>添加成功.";
    }
}
?>


<form name="form1" action="" method="post">
    <h1>添加数据</h1>
    用户名：<input type="text" name="username"><br/>
    密码:<input type="password" name="password"><br/>
    年龄：<input type="text" name="age"><br/>
    学历：<select name="xueli">
        <option value="1">小学</option>
        <option value="2">中学</option>
        <option value="3">大学</option>
        <option value="4">硕士</option>
        <option value="5">博士</option>
    </select><br/>
    兴趣爱好：

    <!-- PHP接收checkbox的选中的内容的时候，需要html的name属性是带上[],这样他才能辨认为数组   -->
    <input type="checkbox" name="aihao[]" value="1">排球
    <input type="checkbox" name="aihao[]" value="2">篮球
    <input type="checkbox" name="aihao[]" value="4">足球
    <input type="checkbox" name="aihao[]" value="8">中国足球
    <input type="checkbox" name="aihao[]" value="16">地球<br/>

    来自：<input type="radio" name='from' value="1">东北
    <input type="radio" name='from' value="2">华北
    <input type="radio" name='from' value="3">西北
    <input type="radio" name='from' value="4">华东
    <input type="radio" name='from' value="5">华北
    <input type="radio" name='from' value="6">华西<br/>

    <input type="submit" value="提交">
</form>

<?php
$sql = "select * from user_list;";
$result = mysql_query($sql);
echo "<table border='1' cellspacing='0'>";

while ($rec = mysql_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $rec['user_name'] . "</td>";
    echo "<td>" . $rec['age'] . "</td>";
    echo "<td>{$rec['edu']}</td>";
    echo "<td>{$rec['xingqu']}</td>";
    echo "<td>{$rec['from']}</td>";
    echo "<td>{$rec['reg_time']}</td>";

    echo "<td>";

    echo "<a href='day10_zuoye_biaodan2.php?id={$rec['user_id']}' onclick='return window.confirm(\"你真的要删除吗?\");'>删除</a>";


    echo "</td>";
    echo "</tr>";
}
echo "</table>";
?>


</body>
</html>