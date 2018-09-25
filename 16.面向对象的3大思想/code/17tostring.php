<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/**
 * __toString()的作用是，当对象当做字符串被调用的时候，就会自动调用相关的魔术方__toString()
 * 返回字符串即可
 */
class  A
{
    public $name;
    public $age;
    public $edu;

    /**
     * A constructor.
     * @param $name
     * @param $age
     * @param $edu
     */
    public function __construct($name, $age, $edu)
    {
        $this->name = $name;
        $this->age = $age;
        $this->edu = $edu;
    }

    function __toString()
    {
        $str = "姓名:" . $this->name;
        $str .= "，年龄:" . $this->age;
        $str .= "，学历:" . $this->edu;
        return $str;
        //这里，可以返回“任何字符串内容”，
        //比如也可以这样：return $this->name
    }
}

$obj1 = new A('张三', 18, '大学');
echo $obj1;//没有__toString()方法会报错，以为对象不能直接转为字符串;


?>
</body>
</html>