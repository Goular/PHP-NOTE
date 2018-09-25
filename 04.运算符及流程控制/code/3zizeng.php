<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php

$v1 = 1;
$v2 = 1;

$v1++;
++$v2;

echo "<br/>v1:{$v1},v2:{$v2}<br/>";

echo $v1++;
echo "<br/>";

echo ++$v2;
echo "<br/>";

echo "<br/>v1:{$v1},v2:{$v2}<br/>";

$s1 = $v1++;
$s2 = ++$v2;

echo "<br />s1=$s1, s2=$s2<br/>";
echo "<br />v1=$v1, v2=$v2<br/>";

//可见，在有加加运算的其他语句中，
//前加加和后加加会有区别：
//影响其他语句的执行结果：
//前加加是先对自加变量加1，然后做其他运算
//后加加是先做其他运算，然后对自加变量加1

$t1 = microtime(true);//获得当前时间，精确到万分之一秒
for ($i = 1; $i < 10000000; ++$i) {
}


$t2 = microtime(true);//获得当前时间，精确到万分之一秒
for ($i = 1; $i < 10000000; $i++) {
}

$t3 = microtime(true);


//是一千万条的循环的操作时间比较

echo "<p>前加加耗时</p>" . ($t2 - $t1);
echo "<p>后加加耗时</p>" . ($t3 - $t2);

?>
</body>
</html>