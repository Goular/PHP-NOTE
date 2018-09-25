#第九天笔记
#第九天代码
###字符串的种类：char，varchar， enum ，set ，text(不占据当前数据行的位置，一行最多能容纳65535个字节，是一整行，而不是一个内容项)，binary，varbinary，blob(用于保存二进制的文件，音频，视频内容，单确实少用，因为io接口是瓶颈)


#演示varchar，char的使用
create table tab_char_varchar(
	postcode char(6),
	name varchar(10)
);

#插入数据
<pre>
insert into tab_char_varchar (postcode,name) values ('510168','张三');
insert into tab_char_varchar (postcode,name) values (510122,'李四');
insert into tab_char_varchar (postcode,name) values (52334444444,'123333klklkl李四fsdfdsfds');
insert into tab_char_varchar (postcode,name) values (523,'李四fsdfdsfds');
</pre>

#演示enum(单选，最多选择65535)，set(多选，最多64个)
create table enum_set(
    id int auto_increment primary key,
    sex enum('男', '女'),-- '男'=1，'女'=2
    fav set('篮球','排球','足球','中国足球','台球') --'篮球'=1,'排球'=2,'足球'=4,'中国足球'=8,'台球'=16,也可以使用加数后的值，作为传入参数
)charset utf8;

#插入数据演示
<pre>
insert into enum_set(id,sex,fav) values (null,'男t','篮球'); --数据还是能插入，但是在没有'男t'这个enum的选项的时候，就不会插入进去，其他数据会插入进去
insert into enum_set(id,sex,fav) values (null,'女','足球'); 
insert into enum_set(id,sex,fav) values (null,'女','足球,篮球,排球'); 

insert into enum_set(id,sex,fav) values (null,2,4); 
insert into enum_set(id,sex,fav) values (null,2,28); 
</pre>

#时间类型
--datetime,date,time,year,timestamp(timestamp是一个时间的数据值，sql利用now()获取的unix的时间值，就是数字)
create table tab_time(
	dt datetime,
	d2 date,
	t2 time,
	y year,
	ts timestamp
)charset utf8;

#插入数据
	insert into tab_time(dt,d2,t2,y) values ('2016-9-1 10:20:03','2016-08-31','14:12:13','2016');

	insert into tab_time(dt,d2,t2,y) values (now(),now(),now(),'2015');


#表定义语句
<pre>
--创建表
----基本的语法
--create table 【if not exists】 表名 (字段列表 【，索引或约束列表】) 【表选项列表】；
--或这样来表达：
--create table 【if not exists】 表名 (字段1， 字段2， ....  【，索引1， 索引2， ....，约束1，约束2，....  】) 【表选项1,  表选项2，.... 】

--总结目前学习过的类型
--数值型:
-------整型(tinyint,smallint,mediaint,int,bigint) 创建语法: 字段名 整数类型(M:可展示的位数) unsigned zerofill
-------浮点数(float,double,decimel),float有效位为6-17位，使用科学计数法，精度损失极大，double有效位为13-15位，也是科学计数法，精度损失大，dicimel(M,N),M为可保存的最大位数，N为小数占了几位，值得注意，这个dicimel没有精度损失问题，但是效率损耗较大，所以需要明确使用的范围
--字符串型:
----char,varchar
----enum,set
----text
----binary，varbinary，blob
--时间型:
----datetime,date,time,timestamp

</pre>

#定义表的字段的属性
auto_increment (自增)
primary key  (主键)
unique key  (唯一)
not null  (非空)
key (普通键)
default xx  (默认值)
comment '创建字段的说明性文字'


#演示字段属性的使用：
<pre>
create table tab_shuxing(
	id int auto_increment primary key,
	user_name varchar(20) not null unique key,
	password varchar(48) not null comment '密码',
	age tinyint default 18,
	email varchar(50) comment '电子邮箱'
)charset utf8;

--插入数据的使用
insert into tab_shuxing(id,user_name,password,age,email) values
(1,'user1','1234',20,'admin@qq.com');
insert into tab_shuxing (id, user_name, password, age, email)values
    (null, 'user2',  md5('1234'), null,  'ldh1@qq.com');
insert into tab_shuxing 
    ( user_name, password,      email       )values
    ( 'user3',  md5('123456'), 'ldh2@qq.com');
</pre>


#索引
--索引是系统内容自动维护的隐藏的"数据表",作用是加快表的搜索速度
--这个隐藏的数据表，其中的数据是自动排序好的，查找速度就是建立在索引上，没有索引，搜索速度会慢了很多倍

#索引的类型
--普通索引 :key(字段名)
--唯一索引 :unique key(字段名)
--主键索引 :primary key(字段名)
--全文索引 :fulltext (字段名)
--外键索引 :foreign key (字段名) references 其他表 (该表对应的字段)  
--注意创建外键记得括号啊

#演示索引创建语法：
create  table  tab_suoyin (
    id int auto_increment ,
    user_name varchar(20),
    email varchar(50),
    age int,                /*没有索引*/
    key (email),            /*这是普通索引*/
    primary key(id),        /*这就是主键索引*/
    unique key(user_name)   /*这就是唯一索引*/
);

--外键索引的使用:foreign key(id) references tab_suoyin(user_name)
#演示外键索引：
<pre>
create table banji(
   id int auto_increment primary key,
   banjihao varchar(10) unique key comment '班级号',
   banzhuren varchar(10) comment '班主任',
   open_date date comment '开班日期'
);

create table xuesheng(
   stu_id int auto_increment primary key,
   name varchar(10),
   age tinyint,
   banji_id int comment '班级id',
   foreign key (banji_id) references banji(id)
);
</pre>

#区别索引与约束 （约束包含索引）
--约束的种类:主键约束，唯一约束，外键约束，非空约束，默认约束,检查约束(定义默认是接受定义的，但目前mysql5不执行这个检查约束)

#表选项的列表
--charset,engine,auto_increment,comment (关于表的说明性文字)

#演示表选项语法:
<pre>
create table tab_xuanxiang(
    id int auto_increment primary key,
	name varchar(10),
	age tinyint
)
charset = gbk,
auto_increment =2000,
engine = MyIsam,
comment '这是一张表'
;
insert into tab_xuanxiang (id, name, age)values(null, '张三', 11);

--添加字段：alter  table 表名 add  [column] 新字段名 字段类型  [字段属性列表]；
--修改字段（并可改名）：alter  table 表名 change [column] 旧字段名 新字段名 新字段类型 [新字段属性列表]；
--删除字段：alter  table  表名 drop  [column] 字段名；
--添加普通索引：alter  table 表名 add  key  [索引名]  (字段名1[，字段名2,...])；
--添加唯一索引(约束)：alter table 表名 add unique key (字段名1[，字段名2,...])；
--添加主键索引(约束)：alter table 表名 add primary key (字段名1[，字段名2,...])；
--修改表名：alter  table  旧表名   rename  [to] 新表名；

alter table tab_xuanxiang add column email varchar(30);
alter table tab_xuanxiang add key (age);

</pre>

#复制表的结构，并创建一张新的表
create table if not exists tab_copy like banji;

#视图(创建成功后会添加到正常的表中，show tables即可看到相关的表)
--定义：就是将一段select语句封装起来，然后创建一个标识来代表这一个查询，这个标识就是视图

#视图的创建语法:
create view v1 as select fav from enum_set;

使用方法，直接当视图是一张表直接访问成员属性的名字就可以查询了

#视图的删除方法:
drop view if exists v1;

