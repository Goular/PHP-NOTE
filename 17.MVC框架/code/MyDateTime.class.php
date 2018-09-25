<?php

class MyDateTime
{
    function getDate()
    {
        return date('Y年m月d日');
    }

    function getTime()
    {
        return date('H:i:s');
    }

    function getDateTime()
    {
        return date('Y年m月d日 H:i:s');
    }
}