<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

//公司成员:
class Member
{
    public $name = '匿名';
    public $age = 18;
    public $sex;

    /**
     * Member constructor.
     * @param int $age
     * @param string $name
     * @param $sex
     */
    public function __construct($age, $name, $sex)
    {
        $this->age = $age;
        $this->name = $name;
        $this->sex = $sex;
    }
}

//讲师类
class Teacher extends Member
{
    public $edu = '大学';
    public $major;

    /**
     * Teacher constructor.
     * @param string $edu
     * @param $major
     */
    public function __construct($age, $name, $sex, $edu, $major)
    {
        parent::__construct($age, $name, $sex);
        $this->edu = $edu;
        $this->major = $major;
    }

    function showInfo()
    {
        echo "<br/>姓名:{$this->name}";
        echo "<br/>年龄:{$this->age}";
        echo "<br/>性别:{$this->sex}";
        echo "<br/>学历:{$this->edu}";
        echo "<br/>专业:{$this->major}";
    }
}

$t1 = new Teacher('张三', 30, '男', '大学', 'PHP');
$t1->showInfo();

?>
</body>
</html>