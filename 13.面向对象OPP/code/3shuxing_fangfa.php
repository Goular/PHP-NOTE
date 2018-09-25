<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

class MyDreamGirl
{
    var $name = '笑话';
    var $age = 25;
    var $edu = '本科';

    function xiyifu()
    {
        echo "<br>{$this->age}岁的{$this->edu}学历的{$this->name}在勤快地洗衣服";
    }

    function zuofan()
    {
        echo "<br>{$this->age}岁的{$this->edu}学历的{$this->name}在快乐地做饭";
    }

    function GetPingfanghe($x, $y)
    {
        $result = $x * $x + $y * $y;
        return $result;
    }
}

$obj1 = new MyDreamGirl();
$obj1->xiyifu();
$obj1->zuofan();

$obj2 = new MyDreamGirl();
$obj2->name = '小红';
$obj2->age = 19;
$obj2->edu = '高中';
$obj2->xiyifu();
$obj2->zuofan();

$v1 = $obj2->GetPingfanghe(3, 4);
echo "<br/><br/>v1 = $v1";


?>
</body>
</html>