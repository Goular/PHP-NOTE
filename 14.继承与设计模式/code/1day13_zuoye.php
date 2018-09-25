<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

/*
定义一个“教师类”，并由此类实例化两个“教师对象”。
该类至少包括3个属性，3个方法，其中有个方法是“自我介绍”，
就能够把自身的所有信息显示出来。
*/

class Teacher
{
    public $p1 = 1;
    var $p2;
    public $name = '匿名';

    public function introMe()
    {
        echo "<p>";
        echo "<br />属性p1：" . $this->p1;
        echo "<br />属性p2：" . $this->p2;
        echo "<br />姓名：" . $this->name;
        echo "</p>";
    }
}

$s1 = "Teacher";
$t1 = new $s1();
$t1->p2 = 22;
$t1->name = "张三";
$t1->IntroMe();


/*
定义一个“学生类”，并由此类实例化两个“学生对象”。
该类包括姓名，性别，年龄等基本信息，并至少包括一个静态属性（表示总学生数）和一个常量，
以及包括构造方法和析构方法。
该对象还可以调用一个方法来进行“自我介绍”（显示其中的所有属性）。
构造方法可以自动初始化一个学生的基本信息，并显示“ｘｘ加入传智，当前有xx个学生”。
*/

class Student
{
    const SCHOOL = '传智';
    public $name = '匿名';
    public $age = 0;
    static $count = 0;
    var $sex = '男';

    /**
     * Student constructor.
     * @param string $name
     * @param int $age
     * @param string $sex
     */
    public function __construct($name, $age, $sex='男')
    {
        $this->name = $name;
        $this->age = $age;
        $this->sex = $sex;
        self::$count++;
        echo "<br />{$name}加入传智，当前有" . self::$count . "个学生";
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
        echo "<br />{$this->name}对象被销毁；";
    }
    public  function IntroMe(){
        echo "<p>";
        echo "<br />姓名：" . $this->name;
        echo "<br />性别：" . $this->sex;
        echo "<br />年龄：" . $this->age;
        echo "</p>";
        //$a = new self();
    }


}

$a1 = new Student('张大帅',20);
$a2 = new Student('张大帅',20,'女');
?>
</body>
</html>