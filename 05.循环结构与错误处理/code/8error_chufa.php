<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<!--错误的触发-->
<?php

echo "<br/>aaa";
echo $v1;//打印不存在变量 NOTICES
echo C1;//打印不存在常量，注意这个位置还是会正常输出并将常量的值设置为C1 NOTICES
echo "<br/>bbb";

include_once "./page3.php";
include_once "./page3.php";//这一次是无效的，


include './no_this_file.php';//Warning

echo "<br/>ccc";

//如果正常的触发错误，都是由系统进行发起的，但是我们很有可能需要自定义错误的触发，由于完成自身业务的完善
echo 'ccc1';
$age = 880;

if ($age > 127 || $age < 0) {
    trigger_error('年龄不符合要求', E_USER_ERROR);
} else {
    echo '你的年龄为:' . $age;
}
echo '<br/>ccc2';


//由于触发了E_USER_ERROR，造成了系统的崩溃(运行到知名错误后就不会执行下面的代码)，下面的代码是不会执行的
$s1 = no_this_function(1, 2);

echo 'dddd';

?>

</body>
</html>