<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

class Student
{
    public $name = '';//实例属性
    static $count = 0;
}

$s1 = new Student();
$s1->name = '杜峰';
Student::$count++;

$s2 = new Student();
$s2->name = '网盘';
Student::$count++;

echo '当前学生的总数为:'.Student::$count;

?>
</body>
</html>