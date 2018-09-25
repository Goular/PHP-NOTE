<?php
//提供一个json信息
$weather = array(
    "city" => "北京",
    "wind" => "south",
    "temp" => "26du"
);

$jn_weather = json_encode($weather);

echo $jn_weather;