<?php
/**
 * 用于城市排序的显示
 */
header("Content-Type:text/html;charset=utf-8");
$city = array(
    array('id' => 1, 'name' => '北京', "pid" => 0),
    array('id' => 2, 'name' => '广东', "pid" => 0),
    array('id' => 3, 'name' => '海淀区', "pid" => 1),
    array('id' => 4, 'name' => '昌平区', "pid" => 1),
    array('id' => 5, 'name' => '上地', "pid" => 3),
    array('id' => 6, 'name' => '西二旗', "pid" => 3),
    array('id' => 7, 'name' => '回龙观', "pid" => 4),
    array('id' => 8, 'name' => '霍营', "pid" => 4),
    array('id' => 9, 'name' => '深圳', "pid" => 2),
    array('id' => 10, 'name' => '广州', "pid" => 2),
    array('id' => 11, 'name' => '福田', "pid" => 9),
    array('id' => 12, 'name' => '南山', "pid" => 9),
);

function tree($arr, $pid = 0)
{
    static $res = array();
    foreach ($arr as $city) {
        if ($city['pid'] == $pid) {
            $res[] = $city;
            tree($arr, $city['id']);
        }
    }
    return $res;
}

echo "<pre>";

var_dump($city);

echo "</pre>", "<hr/>";
$new = tree($city);
var_dump($new);

