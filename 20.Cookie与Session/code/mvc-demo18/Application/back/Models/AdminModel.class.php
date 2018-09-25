<?php

class AdminModel extends BaseModel
{
    function CheckAdmin($username, $password)
    {
        $sql = "select count(*) as c from admin_user where admin_name='{$username}' and admin_pass=md5('$password');";
        $result = $this->_dao->GetOneData($sql);
        //由于sql中并没有布尔值，所以计算出数量后即可
        if ($result == 1) {
            $sql = "update admin_user set login_times = login_times+1, last_login_time = now()";
            $sql .= " where admin_name='$username' and admin_pass =md5('$password')";
            $result = $this->_dao->exec($sql);
            return true;
        } else {
            //其他都是错误（通常就是0）
            return false;
        }

    }

    function CheckAdminInfo($username, $password)
    {
        $sql = "select * from admin_user where admin_name='{$username}' and admin_pass=md5('$password');";
        $result = $this->_dao->getOneRow($sql);
        if (!empty($result)) {
            $sql = "update admin_user set login_times = login_times+1, last_login_time = now()";
            $sql .= " where admin_name='$username' and admin_pass =md5('$password')";
            $this->_dao->exec($sql);
        }
        return $result;
    }
}