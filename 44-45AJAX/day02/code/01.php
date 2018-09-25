<?php
//生成JSON信息
//json_encode(数组/对象)

//关联数组->json信息
$weather = array(
    'city' => "beijing",
    'wind' => "south",
    'tmep' => "26du"
);
$jn_weather = json_encode($weather);
echo $jn_weather;
echo "<br/>";

//索引数组->array数组信息,纯索引数组组会变为数组，关联数组会变为对象
$color = array('red','blue','green');
$jn_color = json_encode($color);
echo $jn_color;
echo "<br/>";

//混合数组->json对象
$weather2 = array(
    'city'=>'beijing',
    'wind'=>'south',
    'tmep'=>'26du',
    'qinglang'//这个位置会变为索引为0的对象
);
$jn_weather2 = json_encode($weather2);
echo $jn_weather2;
echo "<br/>";

//对象->json信息
//只给考虑成员属性
class Person{
    public $name = "tom";
    public $age = 20;
    public function run(){
        echo "Tom is running.";
    }
}
$per = new Person();
$jn_per = json_encode($per);
echo $jn_per;
echo "<br/>";