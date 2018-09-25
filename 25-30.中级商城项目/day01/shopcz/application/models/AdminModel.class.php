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
}