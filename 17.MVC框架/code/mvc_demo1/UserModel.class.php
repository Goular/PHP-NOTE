<?php
require "./MySQLDB.class.php";

class UserModel
{
    function getAllUser()
    {
        $config = array(
            'host' => "localhost",
            'port' => 3306,
            'user' => "root",
            'pass' => "123456",
            'charset' => "utf8",
            'dbname' => "php39"
        );
        $sql = "select * from user_list;";
        $db = MySQLDB::getInstance($config);
        $data = $db->GetRows($sql);
        return $data;
    }

    function getUserCount()
    {
        $config = array(
            'host' => "localhost",
            'port' => 3306,
            'user' => "root",
            'pass' => "123456",
            'charset' => "utf8",
            'dbname' => "php39"
        );
        $sql = "select count(*) as c from user_list;";
        $db = MySQLDB::getInstance($config);
        $data = $db->GetOneData($sql);
        return $data;
    }

    function getUserInfoById()
    {
    }

    function getUserInfoByUserName()
    {
    }
}