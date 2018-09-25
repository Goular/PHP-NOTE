
create table order1(
    id int not null auto_increment,
    order_num varchar(32),
    primary key (id)
)engine=innodb charset=utf8;

insert into order1 values (10,'itcast110');
insert into order1 values (35,'itcast112');
insert into order1 values (27,'itcast113');
insert into order1 values (16,'itcast114');


create table order2(
    id int not null auto_increment,
    order_num varchar(32),
    primary key (id)
)engine=innodb charset=utf8;

create table order3(
    id int not null auto_increment,
    order_num varchar(32),
    primary key (id)
)engine=myisam charset=utf8;


insert into order3 values (10,'itcast110');
insert into order3 values (35,'itcast112');
insert into order3 values (27,'itcast113');
insert into order3 values (16,'itcast114');

--以下sql语句作用：把order3的数据给读取出来再写入到order3数据表中
--其他表的数据也可以复制给当前表
insert into order3 select null,order_num from order3;


--创建索引
--① 创建数据表的时候
create table student(
    id int  not null auto_increment comment '主键',
    name  varchar(32)  not null default '' comment '名称',
    height  tinyint not null default 0 comment '身高',
    addr  varchar(32)  not null  default '' comment '地址',
    school varchar(32) not null default '' comment '学校',
    intro  text  comment '简介',
--创建索引(主键、唯一、普通、全文)
    primary key (id),
-- 唯一/普通/全文 index [索引名称] (字段)  索引名称不设置就使用字段
    unique  index nm (name),
            index (height),
    fulltext index (intro)
)engine=myisam  charset=utf8;

create table student(
    id int  not null auto_increment comment '主键',
    name  varchar(32)  not null default '' comment '名称',
    height  tinyint not null default 0 comment '身高',
    addr  varchar(32)  not null  default '' comment '地址',
    school varchar(32) not null default '' comment '学校',
    intro  text  comment '简介',
    primary key (id),
    unique  index nm (name),
            index (height),
    fulltext index (intro)
)engine=myisam  charset=utf8;

--给已有的数据表设置索引
alter table 表名 add  primary key (字段);
alter table 表名 add  unique index  [索引名] (字段);
alter table 表名 add         index  [索引名] (字段);
alter table 表名 add  fulltext index  [索引名] (字段);


--计算一个字段的前n位可以唯一标识记录信息
select count(*)/count(distinct substring(epassword,1,1))  from  emp;   //非常大
select count(*)/count(distinct substring(epassword,1,2))  from  emp;
select count(*)/count(distinct substring(epassword,1,3))  from  emp;
select count(*)/count(distinct substring(epassword,1,4))  from  emp;
select count(*)/count(distinct substring(epassword,1,5))  from  emp;   //稍小
select count(*)/count(distinct substring(epassword,1,6))  from  emp;
select count(*)/count(distinct substring(epassword,1,7))  from  emp;
select count(*)/count(distinct substring(epassword,1,8))  from  emp;
select count(*)/count(distinct substring(epassword,1,9))  from  emp;
select count(*)/count(distinct substring(epassword,1,10))  from  emp;   //直至稳定接近1
。。。。。。
select count(*)/count(distinct substring(epassword,1,n))  from  emp;   
得到的比值稳定或等于1，就是我们需要的n的大小

select count(*)/count(distinct substring(epassword,1,n))  from  emp;
select count(*)/count(distinct epassword)  from  emp;
或者89和90行的sql语句，获得的比值如果相等，n就是唯一标识


--全文索引
CREATE TABLE articles (
       id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
       title VARCHAR(200),
       body TEXT
)engine=myisam charset=utf8;
INSERT INTO articles (title,body) VALUES
     ('MySQL Tutorial','DBMS stands for DataBase ...'),
     ('How To Use MySQL Well','After you went through a ...'),
     ('Optimizing MySQL','In this tutorial we will show ...'),
     ('1001 MySQL Tricks','1. Never run mysqld as root. 2. ...'),
     ('MySQL vs. YourSQL','In the following database comparison ...'),
     ('MySQL Security','When configured properly, MySQL ...');
alter table articles add fulltext index `index_content` (title,body);

没有使用全文索引
explain select * from articles where title like '%MySQL%'\G
使用全文索引match()  against()
explain select * from articles where match(title,body) against ('MySQL,DataBase')\G



--分表/分区
create table goods(
    id int auto_increment,
    name varchar(32) not null default '',
    price int not null default 0,
    pubdate datetime not null default '0000-00-00',
    primary key (id)
) engine=Myisam charset=utf8 
partition by key(id) partitions 10;

--分表/分区
--hash 表达式分区
--month()函数可以获得时间信息的“月份”信息
create table goods_HH(
    id int auto_increment,
    name varchar(32) not null default '',
    price int not null default 0,
    pubdate datetime not null default '0000-00-00',
    primary key (id,pubdate)
) engine=Myisam charset=utf8 
partition by hash(month(pubdate)) partitions 12;

insert into goods_HH values (null,'apple',5000,'2015-9-23');
insert into goods_HH values (null,'apple',5000,'2015-1-23');
insert into goods_HH values (null,'apple',5000,'2015-2-23');
insert into goods_HH values (null,'apple',5000,'2015-3-23');
insert into goods_HH values (null,'apple',5000,'2015-12-23');

--分表/分区
--range 条件范围分区
--根据年代给数据包进行分区设计
--range(字段/表达式)
partition by range(字段/表达式)(
    partition 分区名字  values less than (常量),
)
create table goods_RR(
    id int auto_increment,
    name varchar(32) not null default '',
    price int not null default 0,
    pubdate datetime not null default '0000-00-00',
    primary key (id,pubdate)
) engine=Myisam charset=utf8 
partition by range(year(pubdate))(
    partition hou70 values less than(1980),
    partition hou80 values less than(1990),
    partition hou90 values less than(2000),
    partition hou00 values less than(2010)
);

insert into goods_RR values (null,'apple',5000,'1975-3-23');
insert into goods_RR values (null,'apple',5000,'1998-12-23');

--分表/分区
--list 列表范围分区
--根据 月份所属季节分区设计
partition by range(字段/表达式)(
    partition 分区名字  values in (n1,n2,n3..),
)
create table goods_LL(
    id int auto_increment,
    name varchar(32) not null default '',
    price int not null default 0,
    pubdate datetime not null default '0000-00-00',
    primary key (id,pubdate)
) engine=Myisam charset=utf8 
partition by list(month(pubdate))(
    partition spring values in(3,4,5),
    partition summer values in(6,7,8),
    partition autumn values in(9,10,11),
    partition winter values in(12,1,2)
);



给range分区算法增加一个分区
alter table goods_RR add partition(
    partition hou10 values less than (2020),
    partition hou20 values less than (2030)
);



--物理分表
create table goods_1(
    id int auto_increment,
    name varchar(32) not null default '',
    price int not null default 0,
    pubdate datetime not null default '0000-00-00',
    primary key (id)
) engine=Myisam charset=utf8;
create table goods_2(
    id int auto_increment,
    name varchar(32) not null default '',
    price int not null default 0,
    pubdate datetime not null default '0000-00-00',
    primary key (id)
) engine=Myisam charset=utf8;
create table goods_3(
    id int auto_increment,
    name varchar(32) not null default '',
    price int not null default 0,
    pubdate datetime not null default '0000-00-00',
    primary key (id)
) engine=Myisam charset=utf8;
create table goods_4(
    id int auto_increment,
    name varchar(32) not null default '',
    price int not null default 0,
    pubdate datetime not null default '0000-00-00',
    primary key (id)
) engine=Myisam charset=utf8;
create table goods_5(
    id int auto_increment,
    name varchar(32) not null default '',
    price int not null default 0,
    pubdate datetime not null default '0000-00-00',
    primary key (id)
) engine=Myisam charset=utf8;

--主键 1/2/3/4/5/6/7
--一个记录的主键%5  求余，余数就是操作的数据表：goods_n(余数)
--为数据表分区数据的原则就是“平均”

--① 根据id"获得"指定的一条记录信息
--到指定的分表获得指定的记录信息
$yu = $id%5;
$sql = "select * from goods_$yu where id=$id";
--以上可以根据$id获得指定的分表，进而操作该$id代表的记录信息
--那么"修改、删除"一样可以操作


--② 给指定的分表写入指定的记录信息
$sql = "insert into goods_fu values (null)";--注意辅助要把最大的id信息给维护起来
$maxId = "select last_insert_id()";--获得刚刚insert语句的生成的主键idid

$yu = $maxId%5;
$sql = "insert into goods_$yu values (......)";

--不清楚数据写入到那个分表里边
--答：获得数据表内部最大的主键id值(获得全部分表最大的主键id值，取其中最大的)

--    另一种解决：维护一张辅助表goods_fu(id一个字段)，只要往任何一个分表写入一条数据
--                该辅助表id都累加一



