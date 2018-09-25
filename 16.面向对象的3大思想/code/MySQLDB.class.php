<?php

/*
设计一个类：mysql数据库操作类
设计目标：
1，该类一实例化，就可以自动连接上mysql数据库；
2，该类可以单独去设定要使用的连接编码（set  names  XXX）
3，该类可以单独去设定要使用的数据库（use  XXX）；
4，可以主动关闭连接；
*/

class MySQLDB
{
    private static $link = null;//用于存储连接成功后的“资源”

    //定义一些属性，以存储连接数据库的6项基本信息
    private $host;
    private $port;
    private $user;
    private $pass;
    private $charset;
    private $dbname;

    private static $instance = null;

    static function getInstance($config)
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    /**
     * 构造方法
     */
    private function __construct($config)
    {
        $this->host = !empty($config['host']) ? $config['host'] : 'localhost';
        $this->port = !empty($config['port']) ? $config['port'] : '3306';
        $this->user = !empty($config['user']) ? $config['user'] : 'root';
        $this->pass = !empty($config['pass']) ? $config['pass'] : '123456';
        $this->charset = !empty($config['charset']) ? $config['charset'] : 'utf8';
        $this->dbname = !empty($config['dbname']) ? $config['dbname'] : 'php39';

        //连接数据库
        $this->link = mysql_connect("{$this->host}:{$this->port}", "{$this->user}", "$this->pass");

        //设定编码
        $this->setCharset($this->charset);

        //选定需要使用的数据库的名称
        $this->selectDB($this->dbname);

    }

    //可以设定要使用的连接编码
    function setCharset($charset)
    {
        $this->charset = $charset;
        return mysql_query("set names {$this->charset};");
    }

    //可以设定要使用的数据库
    function selectDB($dbname)
    {
        $this->dbname = $dbname;
        return mysql_query("use {$this->dbname};");
    }

    //可关闭连接
    function closeDB()
    {
        mysql_close($this->link);
    }

    //这个方法为了执行一条增删改语句，它可以返回真假结果
    function exec($sql)
    {
        $result = $this->query($sql);
        return true;
    }

    //这个方法为了执行一条返回一行数据的语句，它可以返回一维数组
    //数组的下标，就是sql语句中的取出的字段名；
    function getOneRow($sql)
    {
        $result = $this->query($sql);
        //释放结果集的内存资源
        $this->freeResultSet($result);
        return mysql_fetch_assoc($result);
    }

    //这个方法为了执行一条返回多行数据的语句，它可以返回二维数组
    function getRows($sql)
    {
        $result = $this->query($sql);
        $arr = array();
        while ($rec = mysql_fetch_assoc($result)) {
            $arr[] = $rec;
        }
        //释放结果集的内存资源
        $this->freeResultSet($result);
        return $arr;
    }

    //这个方法为了执行一条返回一个数据的语句，它可以返回一个直接值
    //这条语句类似这样：select  count(*) as c  from  user_list
    function GetOneData($sql)
    {
        $result = $this->query($sql);
        //这里必须使用fetch_row这个函数！
        //这里得到$rec仍然是一个数组，但其类似这样：
        //  array ( 0=> 5 );或者 array( 0=>'user1');
        $arr = mysql_fetch_row($result);
        //释放结果集的内存资源
        $this->freeResultSet($result);
        return $arr[0];
    }

    //这个方法用于执行任何sql语句，并进行错误处理，或返回执行结果；
    private function query($sql)
    {
        $result = mysql_query($sql);
        if ($result === false) {
            //语句执行失败，则需要处理这种失败情况：
            echo "<p>sql语句执行失败，请参考如下信息：";
            echo "<br />错误代号：" . mysql_errno();    //获取错误代号
            echo "<br />错误信息：" . mysql_error();    //获取错误提示内部
            echo "<br />错误语句：" . $sql;
            die();
        }
        return $result;//返回的是结果集，而不是布尔值
    }

    /**
     * 执行释放mysql结果集的内存,由于不马上释放结果集内存，就要等到页面完全运行成功后，在进行内存的回收工作
     */
    function freeResultSet($result)
    {
        mysql_free_result($result);
    }


    /**
     * 禁止对象的的克隆十分简单，只要覆盖对象的__clone()方法即可
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

}