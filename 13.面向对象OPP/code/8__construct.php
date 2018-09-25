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
    var $name;
    public $age;
    public $edu;

    function xiyifu()
    {
        echo "<br />{$this->age}岁的{$this->edu}学历";
        echo "的{$this->name}在勤快地洗衣服";
    }
}

$girl1 = new MyDreamGirl();    //创建一个对象
$girl1->name = "小花";    //然后分别设置其属性
$girl1->age = 18;
$girl1->edu = "大学";
$girl1->xiyifu();

$girl2 = new MyDreamGirl();    //再创建一个对象
$girl2->name = "小红";
$girl2->age = 19;
$girl2->edu = "高中";
$girl2->xiyifu();

echo "<hr/>";

/**
 * 女神类
 */
class NvShen
{
    var $name;
    public $age;
    var $edu;

    function __construct($p1, $p2, $p3)
    {
        $this->name = $p1;
        $this->age = $p2;
        $this->edu = $p3;
    }

    function xiyifu()
    {
        echo "<br />{$this->age}岁的{$this->edu}学历";
        echo "的{$this->name}在勤快地洗衣服";
    }
}

$girl3 = new NvShen('小花', 18, '大学');
$girl4 = new NvShen('小红', 22, '高中');
$girl3->xiyifu();
$girl4->xiyifu();

?>
</body>
</html>