
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