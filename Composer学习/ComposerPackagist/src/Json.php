<?php
namespace testjsonsoft;

class Json
{
    public static function encode($data)
    {
        return json_encode($data);
    }

    public static function decode($jsonData)
    {
        return json_decode($jsonData,true);
    }
}