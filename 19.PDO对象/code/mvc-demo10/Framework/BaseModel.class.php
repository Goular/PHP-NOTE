<?php

class BaseModel{
	//这个，用于存储数据库工具类的实例（对象）
	protected $_dao = null;

	function __construct(){
		$config = array(
			'host' => "localhost",
			'port' => 3306,
			'user' => "root",
			'pass' => "123456",
			'charset' => "utf8",
			'dbname' => "php39"
		);
		$this->_dao = MySQLDB::GetInstance($config);
	}
	
}
