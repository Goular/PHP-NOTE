<?php
require './BaseModel.class.php';

class UserModel extends BaseModel
{
    function GetAllUser()
    {
        $sql = "select * from user_list;";
        //$db = MySQLDB::GetInstance($config);
        $data = $this->_dao->GetRows($sql);
        return $data;
    }

    function GetUserCount()
    {
        $sql = "select count(*) as c from user_list;";
        //$db = MySQLDB::GetInstance($config);
        $data = $this->_dao->GetOneData($sql);
        return $data;
    }

    function GetUserInfoById($id)
    {
        $sql = "select * from user_list where user_id = $id";
        return $this->_dao->GetOneRow($sql);

    }

    function GetUserInfoByUserName($name)
    {
        //......
    }

    function delUserById($id)
    {
        $sql = "delete from user_list where user_id = $id";
        $data = $this->_dao->exec($sql);
        return $data;
    }

    function InsertUser($username, $password, $age, $xueli, $xingqu, $from)
    {
        $sql = "insert into user_list (user_name,user_pass,age,edu,xingqu,`from`,reg_time)values(";
        $sql .= "'$username',md5('$password'),$age,'$xueli','$xingqu','$from',now())";
        $result = $this->_dao->exec($sql);
        return $result;
    }
}
