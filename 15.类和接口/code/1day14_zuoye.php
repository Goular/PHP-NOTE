<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php

/*
设计如下几个类：
商品类，有名称，有价钱，库存数，可显示自身信息（名称，价钱）。
手机类，是商品的一种，并且有品牌，有产地，可显示自身信息。
图书类，是商品的一种，有作者，有出版社， 可显示自身信息。
创建一个手机对象，并显示其自身信息；
创建一个图书对象，并显示其自身信息；
扩展要求：尽量体现封装性就更好了。
*/


class Product
{
    protected $name;
    protected $price = 0;
    protected $count = 0;

    protected function ShowInfo()
    {
        echo "<p>商品名称：" . $this->name;
        echo "<br />商品价格：" . $this->price;
    }

    protected function __construct($n, $p, $c)
    {
        $this->name = $n;
        $this->price = $p;
        $this->count = $c;
    }
}

class Mobile extends Product
{
    private $pinpai;
    private $chandi;

    /**
     * Mobile constructor.
     * @param $pingpai
     * @param $chandi
     */
    public function __construct($name, $price, $count, $pingpai, $chandi)
    {
        $name = 'aa';
        $price = 22;
        $count = 33;
        parent::__construct($name, $price, $count);
        $this->pinpai = $pingpai;
        $this->chandi = $chandi;
    }

    function ShowInfo()
    {
        parent::ShowInfo();
        echo "<br />商品品牌：" . $this->pinpai;
        echo "<br />商品产地：" . $this->chandi;
        echo "<br />库存：" . $this->count;
    }
}

$m1 = new Mobile('联想3280', 1208, 1000, 'lenovo', '北京上地信息产业基地');
$m1->ShowInfo();


class Book extends Product
{
    protected $author;    //作者
    protected $publisher;    //出版社

    function __construct($name, $price, $count, $author, $publisher)
    {
        $this->name = $name;
        $this->price = $price;
        $this->count = $count;
        $this->author = $author;
        $this->publisher = $publisher;
    }

    function ShowInfo()
    {
        parent::ShowInfo();
        echo "<br />作者：" . $this->author;
        echo "<br />出版社：" . $this->publisher;
    }
}

?>
</body>
</html>