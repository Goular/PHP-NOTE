<?php
/**
 * 读操作需要的函数
 * @param string $sess_id 当前会话的session-ID
 * @return string 当前session数据区内容
 */
//PHPsession机制调用：sessRead('已经确定好的session-ID');
function sessRead($session_id)
{
    echo "<br/>Read<br/>";
    $sql = "select sess_content from session where sess_id='$session_id';";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    if ($row) {
        return $row['sess_content'];
    } else {
        return '';
    }
}


/**
 * 写操作用到的函数
 * @param string $sess_Id session_ID
 * @param string $sess_content 处理好（序列化）的session数据
 * @return bool，写入结果
 */
function sessWrite($session_id, $session_content)
{
    echo "<br/>Write<br/>";
    $sql = "replace into session values('$session_id', '$session_content', unix_timestamp())";
    return mysql_query($sql);
}


/**
 * 删除对应的session数据，在用户强制执行了session_destory()时
 * @param  string $sess_id
 * @return bool          删除结果
 */
function sessDelete($session_id)
{
    echo "<br/>Delete<br/>";
    //删除操作
    $sql = "delete from session where sess_id='$session_id'";
    return mysql_query($sql);
}


/**
 * 垃圾回收，有几率执行！
 * @param int $maxlifetime 最大有效期
 * @return [type] [description]
 */
function sessGC($maxlifetime)
{
    echo "<br/>GC<br/>";
    // 最后写入时间 < 当前时间-最大有效期
    $sql = "delete from session where last_write < unix_timestamp()-$maxlifetime";
    return mysql_query($sql);
}

/**
 * session开始
 */
function sessBegin()
{
    echo "<br/>Begin<br/>";
    mysql_connect('localhost:3306', 'root', '123456');
    mysql_query('set names utf8;');
    mysql_query('use php39;');
}

/**
 * session关闭
 */
function sessEnd()
{
    echo "<br/>End<br/>";
    mysql_close();
    return true;
}

/**
 * 注册session存储处理的函数
 */
session_set_save_handler(
    'sessBegin', 'sessEnd', 'sessRead', 'sessWrite', 'sessDelete', 'sessGC'
);
//如果不使用下面的写法，默认是以文件进行存储的，所以相关的内容不会被触发，只有写成user后，那么原来的文件存储形式，才不会被执行，才能执行session_set_save_handler(...)方法
ini_set('session.save_handler', 'user');




// create table session (
//    sess_id varchar(40) not null,
// 	sess_content text,
// 	last_write int not null default 0,
// 	primary key (sess_id)
// ) engine=myisam charset=utf8;