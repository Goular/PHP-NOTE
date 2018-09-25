#第八天笔记

#查看当前所有的数据库
show databases;

#选中指定的数据库
use db1;

#查看当前数据库的所有表
show tables;

#查看指定表的构成
show create table t_user;
desc t_user;

#创建数据库db1
create database db1 charset utf8;

#创建简单的表
create table tab1(
id tinyint,
name varchar(5)
);

#Windows7下打开数据库服务
#net start mysql;
#net stop mysql;

#登录mysql系统
mysql -h localhost -u root -p3306 -p123456
#登出mysql系统
exit;
quit;

#设定客户端的输入编码环境设置
注意一点是，所有的windows的cmd窗体都是GBK，就算你设置了编码个时候，cmd还是固定输入gbk到数据库管理系统中进行处理
#php的默认的编码环境是utf-8
set names utf8;

##数据库的备份(记住一点是这个执行语句没有分号的，因为">"后的是文件路径，不要加";"号)
mysqldump -h localhost -u root -p db1 > f:/db1.sql

数据库的恢复(记住一点是这个执行语句没有分号的，因为"<"后的是文件路径，不要加";"号

#首先创建新的数据库
create database db2 charset utf8；
#恢复数据写到指定的数据库中
mysql -h localhost -u root -p db2 > f:/db1.sql

#sql文件的注释写法
<pre>
#1.单行注释: #注释内容
#2.单行注释: -- 注释内容（注意一点,--后面有一个空格）
#3.多行注释: /*多行注释*/
</pre>

#语句行
#需要注意的是，默认的情况下，一般一个语句以一个";"号作为一条语句的结束符
-- 但在MySQL中，可以自己设定自己的结束符
delimiter //
#这种写法的意思是：将当前默认的结束符符号从原来的";"号变为"//"号

#值得注意的是：mysql的语句是不算大小写的，但是文件的路径因系统的不同可能算大小写，unix是算大小写的，windows是不算大小写的

###############################################################
#专题  数据库定义语句DDL
#创建数据库
形式：create database 数据库名 [charset 可选，字符编码的名称] [collate 排序规则];

#查看当前数据库所能支持的字符编码格式
show charset;

#查看当前数据库的字符编码的可用排序规则
show collation;

注意在常见数据库的时候，通常设定好了字符集就可以了，排序规则使用默认就可以了
_bin是以二进制进行排序，_general_ci是以默认的方式进行排序

#需要注意/*! */反注释的意义
<pre>
#/* ....  */ 在大部分语言中都一样是注释。这个之中的语句是不被执行的。
#但MYSQL中 为了保持兼容，比如从mysqldump 导出的SQL语句能被其它数据库直接使用，
#它把一些特有的仅在MYSQL上的语句放在 /*! ... */ 中，这样这些语句如果在其它数据库中是不会被执行，但在MYSQL中它会执行。
</pre>

#删除数据库
drop database if exists db1;

#修改数据库的字符集属性
alter database db1 charset utf8 collate utf8_general_ci;

#MySQL的数据类型有三种，数值型，字符串型，时间型

数值型分为整数型和浮点型，整数型的类型有tinyint(1字节) ,smallint(2字节),mediumint(3字节),int(4字节),bingint(8字节)


# 整数的类型的字段定义
<pre>
# 类型名称(M) [unsigned] [zerofill]
# M表示显示的长度
# unsigned 表示是否设置为无符号数，默认不写unsigned是代表有符号数，
# zerofill 表示在显示长度M设定好的情况下，若长度不满足M，那么将会使用0来填充
# 注意，如果设置了zerofill，说明自动设置了unsigned标志，因为使用0填充的内容不允许有符号的
</pre>

#练习
create table tab_int2(
f1 int unsigned,
f2 tinyint zerofill, 
f3 bigint(10) zerofill
);

tinyint最多到255，所以是最多的可现实数量是3，所以补0的时候仅仅需要补充1个0即可；

insert into tab_int2(f1,f2,f3) values(12,12,12);

#MySQL的浮点数类型有三种，即float，double，decimal
<pre>
#float 单精度浮点，使用4个字节进行存储，精度只有6-7个有效数字,在保存长整数的时候，损失很严重;
#double 双精度浮点，使用8个字节进行存储，精度只有15个有效数字
#decimal 定点小数类型，这种类型不一样，原因是这种的没有精度的问题，这种保存方式很像字符串，读取的时候在进行显示，这样就会就能保存不丢失精度的
#decimal 保存的能保存65位整数部分，小数的部分可以最长保存30位
#decimal 的定义格式decimal(总长度,小数部分的位数)
</pre>

#演示小数类型的使用
create table tab_xiaoshu(
f1 float,
f2 double,
f3 decimal(10,3)
);

#插入数据
insert into tab_xiaoshu(f1,f2,f3) values(123.456789,123.456789,123.456789);
insert into tab_xiaoshu(f1,f2,f3) values(123456789,123456789,123456789);

###其实在每次使用php获取结果集的时候，我们能从结果集中获取到的不只是结果集的数据，其实我们可以获取包括“select/show tables/show databases/desc tables ”等所有关于结果集的结果与列名，下面有三个函数就能获取通用结果集的效果，实际作用并不大，因为不是所有程序都是需要通用的，只有Mysql管理程序才需要通用的获取结果接内容
<pre>
1.获取结果集的行数：mysql_num_rows($resource);
2.获取结果集的列数: mysql_num_fields($resource);
3.获取结果集的列名：mysql_fields_name($resource,$i);
</pre>

#下面这段就是获取通用结果集并显示出来的方法
<pre>

//数据库的名称
$dbName = "php39";
if (!empty($_GET['db'])) {
    $dbName = $_GET['db'];
}
$link = mysql_connect('localhost', 'root', '123456');
mysql_query('set names utf8;');
mysql_query('use php39;');
$sql = 'select * from tab_temp1;';
$sql = 'select * from user_info;';
$sql = 'select * from tab_int2;';
$sql = 'show tables;';
$sql = 'desc tab_temp2;';
$result = mysql_query($sql);
if ($result == false) {
    echo '执行成功!请参考:' . mysql_error();
} else {
    //此时，$result就是"结果集"
    echo '执行成功！数据如下:';
    echo '<table border=\'1\' cellspacing=\'0\'>';
    //获取fields的列数
    $field_count = mysql_num_fields($result);
    echo "<tr>";
    for ($i = 0; $i < $field_count; ++$i) {
        $field_name = mysql_field_name($result, $i);
        echo '<td>' . $field_name . '</td>';
    }
    echo "</tr>";
    while ($rec = mysql_fetch_array($result)) {
        echo "<tr>";
        for ($i = 0; $i < $field_count; ++$i) {
            $field_name = mysql_field_name($result, $i);
            echo "<td>" . $rec[$field_name] . "</td>";
        }
        echo "\<\/tr>";
    }
    echo '<\/table>';
}
</pre>