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
    //用于保存数据库的连接资源数据的
    private $link;

    //定义一些属性，以存储连接数据库的6项基本信息
    private $host;
    private $port;
    private $user;
    private $password;
    private $charset;
    private $dbname;

    /**
     * 利用构造方法，同时制造数据库连接资源并将主机等连接信息保存起来
     */
    public function __construct($config)
    {
        //先将这些基本的连接信息，保存起来！
        $this->host = !empty($config['host']) ? $config['host'] : "localhost";//考虑空值情况，使用默认值代替
        $this->port = !empty($config['port']) ? $config['port'] : "3306";//考虑空值情况，使用默认值代替
        $this->user = !empty($config['user']) ? $config['user'] : "root";//考虑空值情况，使用默认值代替
        $this->password = !empty($config['password']) ? $config['password'] : "123456";//考虑空值情况，使用默认值代替
        $this->charset = !empty($config['charset']) ? $config['charset'] : "utf8";//考虑空值情况，使用默认值代替
        $this->dbname = !empty($config['dbname']) ? $config['dbname'] : "php39";//考虑空值情况，使用默认值代替

        //连接数据库
        $this->link = @mysql_connect("{$this->host}:{$this->port}", "{$this->user}", "{$this->password}") or die("数据库连接失败");

        //设定编码
        $this->setCharset($this->charset);

        //选择相关的数据库
        $this->setDB($this->dbname);
    }

    //设定要使用的数据库名
    function setDB($dbname)
    {
        mysql_query("use $dbname;");
    }

    //设定客户端的编码字符集
    function setCharset($charset)
    {
        mysql_query("set names $charset");
    }

    //关闭数据库的连接，减少资源的消耗
    function closeDB()
    {
        mysql_close($this->link);
    }

    //这个方法为了执行一条增删改语句，它可以返回真假结果
    function exec($sql)
    {
        $result = mysql_query($sql);
        if ($result === false) {
            //语句执行失败，则需要处理这种失败情况：
            echo "<p>sql语句执行失败，请参考如下信息：";
            echo "<br/>错误代码：" . mysql_errno($this->link);
            echo "<br/>错误信息:" . mysql_error($this->link);
            echo "</p>";
            die();
        }
        return true;
    }

    //这个方法为了执行一条返回一行数据的语句，它可以返回一维数组
    //数组的下标，就是sql语句中的取出的字段名；
    function getOneRow($sql)
    {
        $result = mysql_query($sql);
        if ($result === false) {
            //语句执行失败，则需要处理这种失败情况：
            echo "<p>sql语句执行失败，请参考如下信息：";
            echo "<br/>错误代码：" . mysql_errno($this->link);
            echo "<br/>错误信息:" . mysql_error($this->link);
            echo "</p>";
            die();
        }
        //如果没有出错，则开始处理数据，以返回数组。此时$result是一个结果集
        $resource = mysql_fetch_assoc($result);//获得是关联数组,取出第一行数据（其实应该只有这一行）
        return $resource;
    }

    //这个方法为了执行一条返回多行数据的语句，它可以返回二维数组
    function GetRows($sql)
    {

    }

    //获取的是标量数据,这个方法为了执行一条返回一个数据的语句，它可以返回一个直接值
    function GetOneData($sql)
    {

    }
}