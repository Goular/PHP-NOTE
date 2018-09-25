<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

//播放器接口
interface Player
{
    function play();

    function stop();

    function next();

    function prev();
}

interface USB_SET
{
    const USBWidth = 12;
    const USBHeight = 5;

    function dataIn();

    function dataOut();
}

/**
 * 创建多接口实现类
 */
class MP3Player implements Player, USB_SET
{

    function play()
    {
    }

    function stop()
    {
    }

    function next()
    {
    }

    function prev()
    {
    }

    function dataIn()
    {
    }

    function dataOut()
    {
    }
}


?>
</body>
</html>