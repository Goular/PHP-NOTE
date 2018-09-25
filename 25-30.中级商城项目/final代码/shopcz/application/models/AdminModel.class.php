<?php

//后台管理员模型类
class AdminModel extends Model
{
    //获取当前系统所有的管理员
    public function getAdmins()
    {
        $sql = "select * from {$this->table}";
        return $this->db->getAll($sql);
    }

    //验证用户名和密码
    public function checkUser($username, $password)
    {
        $password = md5($password);
        $sql = "select * from {$this->table} where admin_name = '{$username}' and password = '{$password}' limit 1";
        return $this->db->getRow($sql);
    }
}