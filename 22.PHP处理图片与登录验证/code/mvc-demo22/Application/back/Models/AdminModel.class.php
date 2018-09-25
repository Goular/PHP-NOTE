<?php

class AdminModel extends BaseModel
{

    /**
     * 校验管理员是否合法
     * @param string $user 管理员名
     * @param string $pass 密码
     * @return mixed array:合法，管理员信息数组；false:非法
     */
    public function CheckAdminInfo($user, $pass)
    {

        $sql = "SELECT * FROM admin_user WHERE admin_name='$user' AND admin_pass=md5('$pass')";
        // 获取，一行
        return $this->_dao->getOneRow($sql);
    }


    //    function CheckAdmin( $user, $pass ){
    // 	$sql = "select count(*) as c from admin_user where admin_name='$user' and admin_pass =md5('$pass'); ";
    // 	$result = $this->_dao->GetOneData($sql);	//

    // 	//返回一个数据值：表示找到的行数
    // 	if($result == 1){	//表示找到一条数据，就是正确的身份验证
    // 		//登录成功后，应该去修改（更新）该条数据：
    // 		$sql = "update admin_user set login_times = login_times+1, last_login_time = now() ";
    // 		$sql .= " where admin_name='$user' and admin_pass =md5('$pass')";
    // 		$result = $this->_dao->exec($sql);
    // 		return true;
    // 	}
    // 	else{	//其他都是错误（通常就是0）
    // 		return false;
    // 	}
    // }

    public function CheckCookieInfo($id, $pass)
    {
        $sql = "select * from admin_user where md5(concat(id,'SALT'))='$id' and md5(concat(admin_pass,'SALT'))='$pass'";
        return $this->_dao->getOneRow($sql);
    }
}