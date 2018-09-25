<?php
class AdminModel extends BaseModel{

	/**
	 * 校验管理员是否合法
	 * @param string $user 管理员名
	 * @param string $pass 密码
	 * @return mixed array:合法，管理员信息数组；false:非法
	 */
	public function CheckAdminInfo($user, $pass) {

		$sql = "SELECT * FROM admin_user WHERE admin_name='$user' AND admin_pass=md5('$pass')";
		// 获取，一行
		return $this->_dao->getOneRow($sql);
	}

	/**
	 * 通过加密过的 ID 和 密码 校验是否合法
	 * @param string $id   加密（加盐）
	 * @param string $pass 加密（加盐）
	 * @return mixed array:验证通过，管理员信息数组；false：验证失败
	 */
	public function CheckCookieInfo($id, $pass) {
		// 比较时，要按照加密的方式进行比较！
		$sql = "SELECT * FROM admin_user WHERE md5(concat(id, 'SALT'))='$id' AND md5(concat(admin_pass, 'SALT'))='$pass'";
		// 一行
		return $this->_dao->getOneRow($sql);
	}

}