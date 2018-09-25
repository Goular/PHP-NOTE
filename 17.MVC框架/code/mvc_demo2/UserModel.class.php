<?php
require "./BaseModel.class.php";

class UserModel extends BaseModel
{
    function getAllUser()
    {
        $sql = "select * from user_list;";
        $data = $this->db->GetRows($sql);
        return $data;
    }

    function getUserCount()
    {
        $sql = "select count(*) as c from user_list;";
        $data = $this->db->GetOneData($sql);
        return $data;
    }

    function getUserInfoById()
    {
    }

    function getUserInfoByUserName()
    {
    }
}