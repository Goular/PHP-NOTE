## MySQL优化(二)

### 昨日内容回顾
<pre>
    1. Myisam和Innodb存储引擎特点
    Myisam
        表结构、数据、索引 分别有对应的存储文件
        写入数据非常快，安装自然顺序写入数据
        数据稳定后可以压缩数据信息
        支持全文索引
        并发性：少低，锁表操作
    Innodb
        表结构有单独存储文件，数据和索引共享同一个存储文件(ibdata1、*.ibd)
        ibdata1 是全部innodb表的数据和索引的存储文件
        *.ibd 是每个innodb表的数据和索引的存储文件
    支持事务和外键的
        并发性：好，操作数据表时锁定记录(行)
    
        Mysql5.6版本有支持全文索引
    2.字段类型选择
        1)给数据分配的空间要尽量小
            tinyint  smallint  mediumint  int  bigint
        时间：datetime  date   year   time  timestamp
        2)数据最好整合为固定长度的信息
        3)数据最好变为整型信息存储(set   enum   时间戳  ip)
    3.逆范式
        获得每个分类下商品总数量(连表查询Goods  Category)
        为了查询速度快，给给Category维护一个商品总数量的字段，可以使得查询变为一条sql的执行
    
    4. 索引(四种类型、创建和删除、执行计划、使用场合、索引原则)
        索引就是把数据表的某个字段获得出来，该字段作为关键字与记录物理地址进行对应，以便快速定位记录信息(索引内部有算法，可以快速定义信息)
        四种类型：主键(auto_increment)、唯一、普通、全文
        
    创建：
        create table  表名(
            ……
            primary  key （字段）,
            unique index 索引名 (字段),
            index  索引名(字段)，
            fulltext  索引名(字段)
        )
        alter table 表名 add  primary key (id);
        alter table 表名 add  unique index 名称 (字段);
        alter table 表名 add  index 名称 (字段);
        alter table 表名 add  fulltext index 名称 (字段);
    删除：
        alter table 表名 drop  primary key ;
        alter table 表名 drop  index 索引名 ;  //唯一、普通、全文
    
    执行计划：explain
        针对查询语句起作用
        查询语句在没有执行之前可以看下该语句消耗资源情况，例如sql语句是否使用索引
        explain  查询语句\G   
         
    索引使用场合：
        where    order by     索引覆盖(复合索引)     连接查询
    索引使用原则：
        列独立    左原则   复合索引   OR原则    
</pre>

### 索引
<pre>
    1. 索引设计依据
        要估算每个数据表全部的查询sql语句类型
        分析、统计每个sql语句的特点(where/order by/or等等)
    
        原则(重点)：	
            ① 被频繁执行的sql语句要设置
            ② 执行时间比较长的sql语句(可以统计)
            ③ 业务逻辑比较重要的sql语句(例如支付宝2小时内答应返现的业务逻辑)
    2. 前缀索引
        设计索引的字段，不使用全部内容，而只使用该字段前边一部分内容。
    
        如果字段的前边N位的信息已经可以足够标识当前记录信息，就可以把前边N位信息设置为索引内容，好处：索引占据的物理空间小、运行速度就非常快。
    
        举个例子：
            石清清
            李德升
            许成宝
            王伟聪
        以上4条记录信息，通过前边一个字就可以唯一标识当前记录信息，创建索引的时候就使用前边第一个字即可，节省空间、运行速度快。
    
        具体实现：
    	    ① 操作  alter table  表名 add  index (字段(位数))
    	    ② 前边到底取得多少位，才是记录的唯一标识
    		    总记录数目/前n位记录数目 = 比值;
    		    
    		重点:当比值比较稳定的时候，那个那个稳定字段记录长度就是需要截取的长度 
    		   越靠近1越好，稳定值的第一个值为截取值。
    
    	    select count(*) from 表名;
    	    mysql字符串截取：substring(字段,开始位置1开始，长度)
    	    
    	例子: emp表，表的item数目是180万
    	    select count(*)/count(distinct substring(epassword,1,1)) from emp;   --112500.0000
    	    select count(*)/count(distinct substring(epassword,1,2)) from emp;   -- 7031.2500
            select count(*)/count(distinct substring(epassword,1,3)) from emp;   -- 439.4531
            select count(*)/count(distinct substring(epassword,1,4)) from emp;   -- 27.4658
            select count(*)/count(distinct substring(epassword,1,5)) from emp;   -- 2.4985
            select count(*)/count(distinct substring(epassword,1,6)) from emp;   -- 1.5314
            select count(*)/count(distinct substring(epassword,1,7)) from emp;   -- 1.4807
            select count(*)/count(distinct substring(epassword,1,8)) from emp;   -- 1.4776
            select count(*)/count(distinct substring(epassword,1,9)) from emp;   -- 1.4774
            select count(*)/count(distinct substring(epassword,1,10)) from emp;  -- 1.4774
            select count(*)/count(distinct substring(epassword,1,11)) from emp;  -- 1.4774
            
            得到的比值越接近1或等于1，就是我们需要的n的大小
            
            所以开到参数的返回，选择截取9位会比较合理
            
    3.索引设计原则
        字段内容需要足够花样
        性别字段不适合做索引      

    4. 全文索引(由于的'abc%'仅仅可能是普通索引支持--左原则，全文检索是可以使用'%abc%')
        Mysql5.5 Myisam存储引擎  支持全文索引
        Mysql5.6 Myisam和Innodb存储引擎 都支持全文索引
        
        目前中文不支持全文索引。
        
        全文索引可以应用在  like  ‘%XXX%’  的操作上边。
        
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
</pre>

### 索引结构(了解)
<pre>
    索引内部有算法，算法可以保证查询速度比较快速。
    算法的基础 是 数据结构。
    索引的直接称谓就是“数据结构”
    
    在Mysql数据库中，索引是存储引擎层面的技术。
    不同的存储引擎使用的数据结构是不一样的。
    
    两种索引结构
        ① 非聚集索引结构(Myisam)
        ② 聚集索引结构(Innodb)
        
    5.1 Myisam非聚集索引结构    
        称为：B+Tree索引结构
        由于存在三个文件，索引与表数据是分离的，所以是非聚集索引机构，利用B+树的特性保存索引与物理地址的关系。
        
        根节点-->二级子节点-->叶子节点
        
        上图为B+Tree索引结构，索引结构内部分为索引节点
        节点从左到右 是节点的“宽度”
        节点从上到下的层数 是 结构 的“高度”
        宽度或高度太大都不适合快速索引查找
        宽度 和 高度 的设计会根据数据量的大小做适当的选择(mysql底层的算法)
        
        该索引结构“叶子节点” 存储关键字和物理地址，非叶子节点存储关键字和指针，指针用于数据的比较、判断、向下个节点查找。
    
    5.2 Innodb聚集索引结构(索引和表数据是同一个文件，所以存储的时候就已经进行了数据结构的排序，MyIsam是写入的顺序)
        索引结构名称：B+Tree
        1)主键索引结构
        	重要一点：叶子节点 的关键字(主键id值)对应整条记录信息
        2)非主键索引结构(唯一、普通等)
        	叶子节点 的关键字 对应 主键id值
        	
    非主键索引-------------innodb的主键索引-------------整条记录
    这样我们可以看到：索引 和 数据 是在一起的
    
    innodb表物理文件的 索引 和 数据 确实在一起：
    (*.ibd集中存储order2数据表的 索引和 数据)
        
    概念问题：
        B-Tree、B+Tree、  Binary Tree
        B+Tree是B-Tree的一个变形
            B-Tree与B+Tree的明显区别是：B-Tree的每个节点的关键字都与“物理地址对应”
        Binary Tree二进制树结构	
        	
</pre>

### 查询缓存设置
<pre>
    一条查询sql语句有可能获得很多数据，并且有一定的时间消耗
    如果该sql语句被频繁执行获得数据(这些数据还不经常发生变化)，为了使得每次获得的信息速度较快，就可以把“执行结果”给缓存起来，供后续的每次使用。
    
    1. 查看并开启查询缓存
            show variables like 'query_cache%';
       现在就开启缓存，设置缓存空间大小为64M： 
            set global query_cache_size=64*1024*1014; 
       开启缓存后，查询速度有明显的提升  
    
    2.缓存失效
        数据表或数据有变动(增加、减少、修改)，会引起缓存失效         
</pre>

### 什么情况下不会使用缓存
<pre>
    sql语句有变动的信息，就不使用缓存
        例如：时间信息、随机数
        
    下面的语句是不会给缓存，准确说是就算缓存也查询不到上一个句子，原因是随机数和时间是经常变的
        select *,now() from emp where empno = 1412234; --时间
        select *,rand() from emp where empno = 1412234; --随机数   
</pre>

### 生成多个缓存
<pre>
    注意：获得相同结果的sql语句，如果有空格、大小写等内容不同，也会分别进行缓存。   
    相同结果不同样子的sql语句会分别缓存
</pre>

### 不进行缓存
<pre>
    针对特殊语句不需要缓存
    在查询中，添加sql_no_cache即可，
    select sql_no_cache * from emp where empno=1401234;
    
</pre>

### 查看缓存空间状态
<pre>
    show status like 'Qcache%';
</pre>

### 总结
<pre>
    1.索引设计依据
    2.前缀索引
    3.全文索引(Myisam)
    4.索引结构(B+Tree)
        聚集(Innodb）
            主键索引、非主键索引
        非聚集（Myisam）
            一般索引结构
</pre>

### 分表/分区
<pre>
    一个数据表里边可以存储许多记录信息，如果一个数据表里边存储的数据非常多(例如 淘宝商城 的商品表)，这样该商品表的相关工作量就很多(数据的增、删、改、查)
    负载(工作量)高到一定程度，会造成把表锁死的情况发生。
    
    为了降低商品表的负载/工作量，可以给该表拆分为多个数据表。这样每个数据表的工作量会有多降低。
    
    Mysql5.1版本之后就支持分表分区的设计。
    宏观拆分可以如下：
    Goods数据表需要拆分：Goods_1  Goods_2  Goods_3.....Goods_10
    
    数据表拆分为以后，需要考虑php如何操作这些数据表。
    php------------([手动/mysql]算法)--------------数据表(分表)
    
    手动算法：需要在php语言里边设计操作逻辑，增加php语言的代码工作量
    mysql算法：php语言不需要做额外操作就可以像以往一样操作同一个数据表的不同分区，是mysql分表推荐的方式
    
    1.创建一个”分表/分区”数据表 【这个属于分区的内容】
        Myisam和innodb数据表都可以做分表设计
        推荐使用Myisam
        
        设计分区的字段，需要是主键的一部分(重点)。
        
        创建一个有10个分区的goods数据表
        drop table goods_exp;
        create table IF NOT EXISTS goods_exp(
            id int auto_increment,
            name varchar(32) not null default '',
            price int not null default 0,
            pubdate datetime not null default '0000-00-00',
            primary key (id)
        )engine=MyIsam charset=utf8 partition by key(id) partitions 10;
        上图每个分区表 都独立的*.MYD数据文件和*.MYI索引文件
        给该表存放信息，信息会平均分摊到各个数据表里边。
        
    2. 四种分表分区算法
        各种分区设计关联的字段必须是主键的一部分
        或者是主键本身、或者是复合主键索引的从属主键部分
        求余：
        key   	根据指定的字段进行分区设计
        hash   根据指定的表达式进行分区设计
        条件：
        range  字段/表达式 符合某个条件范围的分区设计
        list   字段/表达式 符合某个列表范围的分区设计    
        
        2.1 key的分区算法
            create table goods_key(
                id int auto_increment,
                name varchar(32) not null default '',
                price int not null default 0,
                pubdate datetime not null default '0000-00-00',
                primary key(id)
            )engine=MyIsam charset=utf8 partition by key(id) partitions 10;

        2.2 hash分区算法
            根据指定的表达式进行分区设计       
            设计分区的时候，分区字段必须是主键的一部分
            create table goods_hash(
                id int auto_increment,
                name varchar(32) not null default '',
                price int not null default 0,
                pubdate datetime not null default '0000-00-00',
                primary key(id)
            )engine=MyIsam charset=utf8 partition by hash(month(pubdate)) partitions 12;
            报错，hash分区必须是主键
            ERROR 1503 (HY000): A PRIMARY KEY must include all columns in the table's partitioning function

            create table goods_hash(
                id int auto_increment,
                name varchar(32) not null default '',
                price int not null default 0,
                pubdate datetime not null default '0000-00-00',
                primary key(id,pubdate)
            )engine=MyIsam charset=utf8 partition by hash(month(pubdate)) partitions 12;
            插入数据后，查看文件大小:
            insert into goods_hash values (null,'apple',5000,'2015-9-23');
            insert into goods_hash values (null,'apple',5000,'2015-1-23');
            insert into goods_hash values (null,'apple',5000,'2015-2-23');
            insert into goods_hash values (null,'apple',5000,'2015-3-23');
            insert into goods_hash values (null,'apple',5000,'2015-12-23');
        
        2.3 range() 分区算法
            --range(字段/表达式)
            partition by range(字段/表达式)(
                partition 分区名字  values less than (常量),
            )
            create table goods_range(
                id int auto_increment,
                name varchar(32) not null default '',
                price int not null default 0,
                pubdate datetime not null default '0000-00-00',
                primary key(id,pubdate)
            )engine=MyIsam charset=utf8 partition by range(year(pubdate))(
                partition hou70 values less than (1980),
                partition hou80 values less than (1990),
                partition hou90 values less than (2000),
                partition hou00 values less than (2010)
            );
        
        2.4 list 分区算法
            --分表/分区   --list 列表范围分区  --根据 月份所属季节分区设计
            partition by list(字段/表达式)(
                partition 分区名字  values in (n1,n2,n3..),
            )
            
            create table goods_list(
                id int auto_increment,
                name varchar(32) not null default '',
                price int not null default 0,
                pubdate datetime not null default '0000-00-00',
                primary key(id,pubdate)
            )engine=MyIsam charset=utf8 partition by list(month(pubdate))(
                partition spring values in(3,4,5),
                partition summer values in(6,7,8), 
                partition autumn values in(9,10,11),
                partition winter values in(12,1,2)           
            );
            
    key：该方式区分不明显(不一定会严格平均给分区分配数据)，但是大方向明显
    hash/range/list:会根据业务特点把数据写入到对应的分区表里边。        
</pre>

### 管理分区
<pre>
    增加、减少分区
    
    3.1 求余(key、hash)算法管理
        增加分区：alter table 表名  add  partition  partitions  数量;
        减少分区：alter table  表名 coalesce  partition 数量;
            减少分区数据要丢失(重点)
        
    3.2 条件(range、list)算法管理
    增加分区：
        alter table 表名 add partition(
            partition 分区名  values less than[in] (常量[列表]),
            partition 分区名  values less than[in] (常量[列表]),
            ....
        )
    减少分区：
        alter table 表名 drop  partition 分区名称;
        减少分区，会丢失对应分区的数据。
        
        例子:            
            alter table goods_range add partition(
                partition hou10 values less than (2020),
                partition hou20 values less than (2030)
            );
            
            alter table goods_range drop partition hou70;
</pre>

### 物理分表设计(与mysql的内部分区不一样，这个的控制算法由我们的php控制，这样的方式有两种:水平分表[表按照数量分离，查询表与表会分离]和垂直分表[字段分离，查询合并])
<pre>
    该分表是纯”物理分表”
        Goods: Goods_1、Goods_2、Goods_3、Goods_4、Goods_5
        该物理分表需要通过php算法，实现数据平均分配给每个表存储。
        
        创建5张物理表(表内部结构完全一致)：
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
</pre>

### 水平分表 和 垂直分表
<pre>
    垂直分表

        对记录进行分割并存储到许多不同的表，称为“水平分表”
        对字段进行分割并存储到许多不同表，称为“垂直分表”
        
        一个数据表，内部有许多字段，有的字段频繁被操作，有的字段很少被操作。
        这样当操作数据表中一些字段的时候，没有直接业务关系的字段也需要给其分配相应的资源，这样速度会稍慢，还要消耗系统额外的工作量。
        
        例如数据表（student）有如下字段：
            id  登录名 名称  密码   生日   身高  体重   手机号码   qq号码  简介  城市
            student_zhu：  id  登录名  密码  手机号码
            student_fu：   id  名称  生日  身高  体重  qq号码  简介  城市
            以上两个数据表(student_zhu、student_fu)，其中zhu表需要被频繁操作。
            后期数据维护需要同时维护两个数据表
            insert into student_zhu  values (.....)
            生成一个zhu的id信息$zhuid
            那么就：insert into student_fu  values ($zhuid)
      
</pre>

### 架构(集群)设计 (主从模式，读写分离)
<pre>
    一个mysql服务器的操作分为：增、删、改、查
    其中查询操作最为频繁：查询/写入 = 7/1
    查询操作本身还最消耗资源
    
    架构设计：原先有一个mysql服务器做的工作现在平摊给多个mysql服务器实现。
            多个数据库设计与Redis的分布式设计雷同：
            主从模式(一主多从/读写分离)
    
    
    安装多个服务器(多个mysql服务器)
    负载均衡 软件
    主mysql  给 从mysql同步数据
</pre>

### 慢查询日志
<pre>
    系统运行起来，内部需要执行许多sql语句
    此时要把查询速度很慢的sql语句给统计出来，并做优化设计。
    设定一个时间阀值，超过该时间，就说明sql语句很慢。
    
    
    查询是否进行了慢查询日志保存的设置:
        show variables like 'slow_query%';
    
    开启慢查询日志:
        set global slow_query_log=1;
        
    查看慢查询的时间阀值:
        show variables like 'long_query_time%';
        
    设置时间阀值(set 后边没有 global)
        set long_query_time=2;
</pre>

### 总结
<pre>
    1.分区、分表设计
    	Mysql算法的分区(分表)
    	四种分区算法： key   hash   range   list
    		分区字段必须是主键部分(本身、(复合)辅助主键)
    	分区可以增加、减少操作
    
    	
    	物理算法的分表	
    		在php端实现分表的算法
    2.垂直分表
    	把一个表的多个字段进行分割为多个表存储设计
    3.架构设计
    	多个mysql服务器
    	设计模式为：主从、读写分离
    	读服务器有多个、写服务器有一个
    	写服务器 会自动给 读服务器 同步数据
    	负载均衡：可以保证读服务器平均被访问
    4.慢查询日志设置
    
    作业：
    1.把自己项目的主要数据表  设计为多个分区分表模式(hash/range/list随便选一个)
    	步骤：先给数据库做备份、再创建数据表的多个分区、在insert数据到分区表
</pre>