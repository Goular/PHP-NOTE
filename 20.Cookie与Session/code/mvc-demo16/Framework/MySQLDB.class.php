<?php
/*
设计一个类：mysql数据库操作类
设计目标：
1，该类一实例化，就可以自动连接上mysql数据库；
2，该类可以单独去设定要使用的连接编码（set  names  XXX）
3，该类可以单独去设定要使用的数据库（use  XXX）；
4，可以主动关闭连接；
*/

class MySQLDB{

	private $link = null;	//用于存储连接成功后的“资源”

	//定义一些属性，以存储连接数据库的6项基本信息
	private $host;
	private $port;
	private $user;
	private $pass;
	private $charset;
	private $dbname;

	//实现单例第2步：用于存储唯一的单例对象：
	private static $instance = null;
	//实现单例第3步：
	static  function GetInstance($config){
		//if( !isset( self::$instance )){	//还没有该对象
		if( !(self::$instance instanceof self) ){	//这一行代替上一行的判断，更常见
			self::$instance = new self($config); //就创建并存起来
		}
		return self::$instance;
	}
	//实现单例第4步：私有化这个克隆的魔术方法
	private function __clone(){}

	//实现单例第1步：
	private function __construct($config){
		//先将这些基本的连接信息，保存起来！
		$this->host = !empty($config['host']) ? $config['host'] : "localhost";	//考虑空值情况，使用默认值代替
		$this->port = !empty($config['port']) ? $config['port'] : "3306" ;
		$this->user = !empty($config['user']) ? $config['user'] : "root" ;
		$this->pass = !empty($config['pass']) ? $config['pass'] : "" ;
		$this->charset = !empty($config['charset']) ? $config['charset'] : "utf8" ;
		$this->dbname = !empty($config['dbname']) ? $config['dbname'] : "php39" ;
		
		//然后连接数据库！
		$this->link  =  mysql_connect("{$this->host}:{$this->port}", "{$this->user}", "{$this->pass}") 
			or die("连接失败");

		//设定编码
		//mysql_query("set names {$config['charset']}");
		$this->setCharset( $this->charset );//这一行代替上一行

		//选定要使用的数据库名
		//mysql_query("use  {$config['dbname']}");
		$this->selectDB( $this->dbname );//这一行代替上一行
	}
	//可以设定要使用的连接编码
	function setCharset( $charset ){
		mysql_query("set names $charset", $this->link);
	}
	//可以设定要使用的数据库
	function selectDB($dbname){
		mysql_query("use  $dbname", $this->link);
	}
	//可关闭连接
	function closeDB(){
		mysql_close($this->link);
	}

	//这个方法为了执行一条增删改语句，它可以返回真假结果
	function exec($sql){
		
		$result = $this->query($sql);
		return true;	//因为是增删改语句，直接返回true就可以
	}
	
	//这个方法为了执行一条返回一行数据的语句，它可以返回一维数组
	//数组的下标，就是sql语句中的取出的字段名；
	function GetOneRow($sql){
		
		$result = $this->query($sql);
		//这里开始处理数据，以返回数组。此时$result是一个结果集（单行数据）
		$rec = mysql_fetch_assoc( $result );//取出第一行数据（其实应该只有这一行）
		mysql_free_result( $result );	//提前释放资源（销毁结果集），否则需要等到页面结束才自动销毁
		return $rec;
	}
	
	//这个方法为了执行一条返回多行数据的语句，它可以返回二维数组
	function GetRows($sql){
		
		$result = $this->query($sql);
		//这里开始处理数据，以返回数组。此时$result是一个结果集(且是多行数据）
		$arr = array();	//空数组，用于存放要返回的结果数组（二维）
		while ( $rec = mysql_fetch_assoc( $result ) ){
			$arr[] = $rec;	//此时，$arr就是二维数组了！
		}
		mysql_free_result( $result );	//提前释放资源（销毁结果集），否则需要等到页面结束才自动销毁
		return $arr;
	}
	
	//这个方法为了执行一条返回一个数据的语句，它可以返回一个直接值
	//这条语句类似这样：select  count(*) as c  from  user_list
	function GetOneData($sql){
		
		$result = $this->query($sql);
		//这里开始处理数据，以返回一个数据（标量数据）！
		$rec = mysql_fetch_row( $result );	//这里也可以使用fetch_array这个函数！
											//这里得到$rec仍然是一个数组，但其类似这样：
											//  array ( 0=> 5 );或者 array( 0=>'user1');
		$data = $rec[0];
		mysql_free_result( $result );	//提前释放资源（销毁结果集），否则需要等到页面结束才自动销毁
		return $data;
	}

	//这个方法用于执行任何sql语句，并进行错误处理，或返回执行结果；
	private function query( $sql ){
		$result = mysql_query($sql, $this->link);
		if( $result === false){
			//对任何sql语句，执行失败，都需要处理这种失败情况：
			echo "<p>sql语句执行失败，请参考如下信息：";
			echo "<br />错误代号：" . mysql_errno();	//获取错误代号
			echo "<br />错误信息：" . mysql_error();	//获取错误提示内部
			echo "<br />错误语句：" . $sql;
			die();
		}
		return $result;	//返回的是“执行的结果”
	}

}
?>