## Mysql优化(一)

### 需要注意的问题，互联网的企业一般不创建外键，因为在修改数据库的时候，很容易出现问题

### 昨天回顾
<pre>
1. memcache使用特点
    内存缓存技术
    数据模型为key-value
    每个key的最大数据量为1MB限制
    数据类型：String
    session可以存储到memcache里边
    thinkphp或其他框架有很好地支持memcache作为缓存技术
2.安装开启服务
    memcached.exe
    ① dos窗口前台方式启动memcache服务
    ② 使得memcache变为开机启动项服务
    memcached  -d  install		//安装服务
    memcached  -d  start			//启动服务
    memcached  -d  stop/restart //关闭或重启服务
    memcached  -d  uninstall    //卸载服务
3.php对memcache的操作
    memcache是php的一个扩展，具体体现为一个“类Memcache”
    设置：
    set(key,value,压缩,有效期)	//存在key就修改，不存在就添加
    add(key,value,压缩,有效期)  //存在key就报错，不存在就添加
    获取：
    get(key);
    删除：
    delete(key);
    flush();     		//清空全部key
4.终端对memcache的操作
    dos窗口、SecureCRT终端软件
    > telnet  主机名  端口号码
    telnet：远程登录协议
    
    set  key  是否压缩  有效期  长度
    data数据
    
    add  key  是否压缩  有效期  长度
    data数据
    
    get
    
    name1的有效期为无限

5.分布式部署
    Redis分布式：主从模式(一主多从)
    memcache分布式：多个服务器平均分担工作
    
    $mem -> addServer(主机名1，端口1);
    $mem -> addServer(主机名2，端口2);
    $mem -> addServer(主机名3，端口3);
    注意：所有php脚本文件的多个memcache服务器的设置有顺序要求。
6.缓存失效
    ① 有效期过期，懒惰模式，
    ② 没有可用空间，模式LRU(least  recently use)删除最近很少使用的key
       可以禁用LRU模式，启动服务设置”-M”参数即可
    -M参数在可用空间不足的情况下回报错，不会强制删除key
7.session存入memcache
    一个网站有多个服务器支撑，它们之间要共享用户的登录信息(即多个服务器要共享session信息)，这样session信息要存储在memcache里边(还可以存储在mysql数据库中)
    php.ini有配置
    ini_set(‘session.save_handler’,’memcache’);
    ini_set(‘session.save_path’,’tcp://127.0.0.1:11211;tcp://127.0.0.1:11212;’);
8.tp框架应用
    S() 操作缓存信息
  缓存类型：memcache、[file]、mysql等等
    S(array(‘type’=>’memcache’,’host’=>’主机名’，’port’=>’端口号码’))
    S(key,value,有效期);
    S(key)
    S(key,null);    
</pre>

### Mysql数据库优化
<pre>
    优化概述
        存储层：存储引擎、字段类型选择、范式设计
        设计层：索引、缓存、分区(分表)
        架构层：多个mysql服务器设置，读写分离(主从模式)
        sql语句层：多个sql语句都可以达到目的的情况下，要选择性能高、速度快的sql语句
    
    存储引擎
        什么是存储引擎：
            我们使用的数据是通过一定的技术存储在数据当中的，数据库的数据是以文件形式组织的硬盘当中的。技术不只一种，并且每种技术有自己独特的性能和功能体现。
            存储数据的技术和其功能的合并就称为“存储引擎”。
            在mysql中经常使用的存储引擎：Myisam或Innodb等等。
        常用的存储引擎有:MyIsam,InnoDB,Memory(内存),Archive(归档存储)    
    
    数据库的数据存储在不同的存储引擎里边，所有的特性就与当前的存储引擎有一定关联。
    需要按照项目的需求、特点选择不同的存储引擎。
    
    
    如何查看当前MySQL中支持的所有的存储引擎
        show engines;
        
        MariaDB目前支持:CSV,InnoDB,Memory,MyIsam,MRG_MyIsam,Aria,等...
</pre>

### 数据库中的每个数据表的数据设计都是包含三方面:表结构，数据，索引

### InnoDB -- 存储引擎
<pre>
    技术特点:支持事务，行级锁定，外键，表加密
    
    1)表结构、数据、索引的物理存储
        创建一个innodb数据表:
        create database if not exists youhua default charset utf8 collate utf8_general_ci; 
        //创建InnoDB存储引擎的数据表
        create table order1(
            id int not null auto_increment,
            order_num varchar(32),
            primary key(id)
        )engine=innodb charset=utf8;   
        
    在设置变量后，InnoDB的表在数据库会生成一个以.frm为尾缀文件来存储表结构文件,尾缀.idb存储表数据和索引;
    在没有设置变量前，所有的InnoDB表的数据和索引信息都会存储在MySQL存储顶级文件夹的ibdata1的文件
   
    给innodb类型表 的数据和索引创建自己对应的存储空间：
    默认情况下每个innodb表的 数据和索引 不会创建单独的文件存储
    
    使用一下语句可以查询是否会创建单独的文件来保存数据和索引
        show variables like 'innodb_file_per_table'; 
    
    设置变量，使得每个innodb表有独特的数据和索引 存储文件：
        set global innodb_file_per_table=1;//开启
        set global innodb_file_per_table=0;//关闭   
          
    2)数据存储顺序 -- 按照主键的顺序进行排序保存的
        innodb表数据的存储是按照主键的顺序排列每个写入的数据。
        该特点决定了该类型表的写入操作较慢。
        这是按照主键的顺序作为排序的依据
        
    3)事务、外键
        该类型数据表支持事务、外键
        
        事务：把许多写入(增、改、删)的sql语句捆绑在一起，要么执行、要么不执行
              事务经常用于与“钱”有关的方面。
        
        四个特性：原子、一致、持久、隔离
        具体操作：
            start transaction;
            
            许多写入sql语句
            sql语句有问题
            
            rollback;回滚
            commit;提交
        
        rollback和commit只能执行一个
        
    4) 并发性
        该类型表的并发性非常高
        多人同时操作该数据表
        为了操作数据表的时候，数据内容不会随便发生变化，要对信息进行“锁定”
        该类型锁定级别为：行锁。只锁定被操作的当前记录。
        重点:行锁
</pre>


### Myisam -- 存储引擎
<pre>
    1) 结构、数据、索引独立存储
        该类型的数据表  表结构、数据、索引 都有独立的存储文件：
        创建Myisam数据表
        create table order3(
            id int not null auto_increment,
            order_num varchar(32),
            primary key (id)
        )engine = myisam charset=utf8;
        
        创建数据库所属的文件夹多了三个新的文件来保存数据结构，表数据，数据索引，
        *.frm：表结构文件
        *.MYD：表数据文件
        *.MYI：表索引文件
        
        每个myisam数据表的 结构、数据、索引 都有独立的存储文件
        特点：独立的存储文件可以单独备份、还原。
        
    2） 数据存储顺序
        myisam表数据的存储是按照自然顺序排列每个写入的数据。
    
    3） 并发性
        该类型并发性较低
        该类型的锁定级别为：表锁
            
    4）压缩机制
        如果一个数据表的数据非常多，为了节省存储空间，需要对该表进行压缩处理。
        复制当前数据表的数据，复制order3表的数据:
            insert into order3(order_num) select order_num from order3;
        
        对应的存储该200万条信息的文件的物理大小为320多兆 
        到/bin/文件夹下，
          开始压缩order3数据表的数据
          压缩工具：myisampack.exe  表名
        由于使用了压缩后，会减少了物理的区间量，此时我们的需要重新建立索引，这样才会产生相关的查询便利
        
          开始压缩order3数据表的数据
          压缩工具：myisampack.exe  表名
          重建索引：myisamchk.exe  -rq  表名(记得重建索引啊)
          
          由于压缩后的表属于只读表，所以需要解压缩才能进行插入，删除，修改等操作，
          解压缩工具：myisamchk.exe  --unpack  表名
          记得重建索引，不然又找不到的了
          order3表信息被压缩的60%的空间：
          order3数据表有压缩，但是索引没有了：
          重建索引：
          索引果然被重建完毕：
          
          最后，记得刷新数据表：flush table  表名
</pre>

### 使用场景
<pre>
        innodb存储引擎：适合做修改、删除
        Myisam存储引擎：适合做查询、写入
        
        3.3 Archive
        归档型存储引擎，该引擎只有写入、查询操作，没有修改、删除操作
        比较适合存储“日志”性质的信息。
        3.4 memory
        内存型存储引擎，操作速度非常快速，比较适合存储临时信息，
        服务器断电，给存储引擎的数据立即丢失。 
</pre>

### 存储引擎的选择
<pre>
    Myisam和innodb
        网站大多数情况下“读和写”操作非常多，适合选择Myisam类型
        例如 dedecms、phpcms内容管理系统(新闻网站)、discuz论坛
    
    网站对业务逻辑有一定要求(办公网站、商城)适合选择innodb
        Mysql5.5默认存储引擎都是innodb的
</pre>

### 字段类型选择
<pre>
    4.1 尽量少的占据存储空间
        tinyint         1字节             (0,255)
        smallint        2字节             (0,65535)
        mediuint        3字节             (0,16777215)
        int/integer     4字节             (0,4294967295)
        bigint          8字节             (0,很大)
        
        时间类型date
        time()          时分秒
        datetime()      年月日，时分秒
        year            年份
        date            年月日
        timestamp       时间戳(1970-1-1到现在经历的秒数)，这个不能统计1970年前的内容
    4.2 数据的整合最好固定长度
        char(长度)
            固定长度，运行速度快
            长度：255字符限制
        varchar(长度)
            长度不固定，内容比较少要进行部位操作，该类型要保留1-2个字节保存当前数据的长度
            长度：65535字节限制
             存储汉字，例如字符集utf8的(每个汉字占据3个字节)，最多可以存储65535/3-2字节
        
        存储手机号码：char(11)
    
    4.3 信息最好存储为整型的
        时间信息可以存储为整型的(时间戳)
         select from_unixstamp(时间戳)  from 表名
        
        set集合类型 多选：set(‘篮球’,’足球’,’棒球’,’乒乓球’);
        enum枚举类型 单选： enum(‘男’,’女’,’保密’);
        推荐使用set和enum类型，内部会通过整型信息参数具体计算、运行。
        
        ip地址也可以变为整型信息进行存储(mysql内部有算法，把ip变为数字)：
                               
        mysql： inet_aton(ip)   inet_ntoa(数字)
        php:      ip2long(ip)       long2ip(数字)
        
        select inet_aton("192.168.1.1");
        select inet_ntoa("3232235777");
        
        总结：
        1.存储引擎
            数据存储技术格式
            Myisam
            innodb
        2.字段类型选择
            原则：占据空间小、数据长度最好固定、数据内容最好为整型的                       
</pre>

### 逆范式
<pre>
    数据库设计需要遵守三范式。
    
    两个数据表：商品表Goods、分类表Category
    Goods:  id   name   		cat_id   price
    101   iphone6s    2003     6000
    204   海尔冰箱      4502     2000
    ......
    
    create table goods(
    	id int not null auto_increment,
        name char(200) not null,
        cat_id int not null,
        price double not null,
        primary key(id)		
    )engine=InnoDB charset=utf8;
    
    MariaDB [youhua]>     insert into goods(name,cat_id,price) values ("荣耀12",3,6000);
    Query OK, 1 row affected (0.31 sec)
    
    MariaDB [youhua]>     insert into goods(name,cat_id,price) values ("荣耀13",3,6300);
    Query OK, 1 row affected (0.31 sec)
    
    MariaDB [youhua]>     insert into goods(name,cat_id,price) values ("荣耀14",3,6600);
    Query OK, 1 row affected (0.07 sec)
    
    MariaDB [youhua]>     insert into goods(name,cat_id,price) values ("神舟电脑12",1,6600);
    Query OK, 1 row affected (0.07 sec)
    
    MariaDB [youhua]>     insert into goods(name,cat_id,price) values ("神舟电脑16",1,6600);
    Query OK, 1 row affected (0.08 sec)
    
    MariaDB [youhua]>     insert into goods(name,cat_id,price) values ("神舟电脑19",1,6600);
    Query OK, 1 row affected (0.03 sec)
    
    MariaDB [youhua]>     insert into goods(name,cat_id,price) values ("神舟电脑195",1,6600);
    Query OK, 1 row affected (0.05 sec)
    
    MariaDB [youhua]>     insert into goods(name,cat_id,price) values ("神舟电脑1780000",1,6680);
    Query OK, 1 row affected (0.06 sec)
    
    MariaDB [youhua]>     insert into goods(name,cat_id,price) values ("海尔冰箱",2,6680);
    Query OK, 1 row affected (0.33 sec)
    
    Category: cat_id   name   goods_num
    2003     手机
    4502     冰箱
    .....
    
    create table category(
        id int not null auto_increment,
        name char(200) not null,
        primary key(id)		
    )engine=InnoDB charset=utf8;
    
    insert into category(name) values ("电脑");
    insert into category(name) values ("冰箱");
    insert into category(name) values ("手机");
    
    需求：
    计算每个分类下商品的数量是多少？
    select c.id,c.name,count(c.id) from category as c left join goods as g on g.cat_id = c.id;

    上边sql语句是一个多表查询，并且还有count的聚合计算。
    
    如果这样的需求很多，类似的sql语句查询速度没有优势，
    如果需要查询速度提升，最好设置为单表查询，并且没有聚合计算。
    
    解决方法是：给Category表增加一个商品数量的字段goods_num
    那么优化后的sql语句：
    select cat_id,name,goods_num from category;
    但是需要维护额外的工作：goods商品表增加、减少数据都需要维护goods_num字段的信息。
    
    以上对经常使用的需求做优化，增加一个goods_num字段，该字段的数据其实通过goods表做聚合计算也可以获得，该设计不满足三范式，因此成为”逆范式”.
</pre>

### 三范式（原子性，唯一性，独立性）
<pre>
    ① 一范式：原子性，数据不可以再分割
    ② 二范式：数据没有冗余
        order     goods
        ida   编号1   下单时间  商品信息1    商品价格   商品描述   商品产地
        idb   编号1   下单时间  商品信息2    商品价格   商品描述   商品产地
        idb   编号1   下单时间  商品信息3    商品价格   商品描述   商品产地
    
        订单表    id    编号1   下单时间   g1,g2,g3
    
    ③ 三范式
        数据表每个字段与当前表的主键产生直接关联(非间接关联)
        userid    name   height   weight   orderid  编号  订单时间
        优化：
        userid   name   height  weight
        userid  orderid
        orderid 编号  订单时间
</pre>

### 索引index
<pre>
    索引是优化数据库设计，提升数据库性能非常显著的技术之一。
    各个字段都可以设计为索引，经常使用的索引为主键索引primary key
    
    索引可以明显提升查询sql语句的速度
    
    6.1 是否使用索引速度的差别
        直接复制文件到数据库文件目录（直接将文件frm和MYI,MYD放到数据库文件夹即可使用）
        被复制到shop0407的数据库文件目录里
        数据库有体现emp数据表
        对一个没有索引的数据表进行数据查询操作
        没有索引，查询一条记录消耗1.49s的时间
        一旦设置索引，再做数据查询，时间提升是百倍至千倍级的
        alter table emp add primary key (empno);
        
    6.2 什么是索引
        索引本身是一个独立的存储单位，在该单位里边有记录着数据表某个字段和字段对应的物理空间。
        索引内部有算法支持，可以使得查询速度非常快。
        
        有了索引，我们根据索引为条件进行数据查询速度就非常快
        ① 索引本身有”算法”支持，可以快速定位我们要找到的关键字(字段)
        ② 索引字段与物理地址有直接对应，帮助我们快速定位要找到的信息
        一个数据表的全部字段都可以设置索引
        
    6.3 索引类型
        四种类型：
        ① 主键 primary  key      
            auto_increment必须给主键索引设置
            信息内容要求不能为null，唯一
        ② 唯一 unique  index
            信息内容不能重复
        ③ 普通 index
            没有具体要求
        ④ 全文 fulltext  index
            myisam数据表可以设置该索引
        
        复合索引：索引关联的字段是多个组成的，该索引就是复合索引。
                按索引字段的顺序进行搜索
                
        1) 创建索引
            创建：① 创建表时
        
            创建一个student数据表，并设置各种索引：    
                create table student(
                    id int not null auto_increment comment '主键',
                    name varchar(32) not null default '' comment '名称',
                    height tinyint not null default 0 comment '身高',
                    addr varchar(32) not null default '' comment '地址',
                    school varchar(32) not null default '' comment '学校',
                    intro text comment '简介',
                    primary key (id),
                    unique index nm (name),
                            index (height),
                    fulltext index (intro)        
                )engine=MyIsam charset=utf8;
        
            查看student表结构可以看到各种索引是成功的：
            show create table student;
        
            ② 给现有的数据表添加索引：
                alter table 表名 add primary key (字段);
                alter table 表名 add unique index [索引名] (字段);
                alter table 表名 add index [索引名] (字段);
                alter table 表名 add fulltext index [索引名] (字段);
                复合索引:
                alter table 表名 add index [索引名] (字段1,字段2,字段3)；
        
        2)删除索引
            alter table 表名  drop  primary  key;   //删除主键索引
                注意：该主键字段如果存在auto_increment属性，需要先删除之
            alter table 表名 modify 主键  int  not null  comment ‘主键’;
                去除数据表主键字段的auto_increment属性： 
                alter table student modify id int not null comment '主键';
                   
    6.4 执行计划explain  
        针对查询语句设置执行计划，当前数据库只有查询语句支持执行计划。
            每个select查询sql语句执行之前，需要把该语句需要用到的各方面资源都计划好
        例如：cpu资源、内存资源、索引支持、涉及到的数据量等资源
            查询sql语句真实执行之前所有的资源计划就是执行计划。    
        
        我们讨论的执行计划，就是看看一个查询sql语句是否可以使用上索引。
           具体操作：
                explain  查询sql语句\G;
           一条sql语句在没有执行之前，可以看一下执行计划。 
                
    6.5 索引适合场景
         1) where查询条件
            where 之后设置的查询条件字段都适合做索引。 
         2) 排序查询
            order by 字段   //排序字段适合做索引
            排序字段没有索引，做排序查询就没有使用
         
         where 和 order by后边的条件字段都可以适当设置索引
         
         3) 索引覆盖
            给ename和job设置一个复合索引
            索引覆盖：我们查询的全部字段(ename,job)已经在索引里边存在，就直接获取即可
            不用到数据表中再获取了。因此成为”索引覆盖”
            该查询速度非常快，效率高，该索引也称为”黄金索引”
            但是值得注意的是，因为索引也是占用硬盘资源的，不是所有的字段都应该建立索引，黄金索引由于太完美了，所以使用的频率不是很多.
            索引本身需要消耗资源的(空间资源、升级维护困难)
    
    4) 连接查询(尽量给外键做索引，这样能够提高并联查询的效率):
         join  join   on
         goods : id  name  cat_id  ...
         category: cat_id  name  ...
         在Goods数据表中给外键/约束字段cat_id设置索引，可以提高联表查询的速度 
            
    6.6 索引原则        
        1)字段独立原则   
            select * from emp where  empno=1325467;  //empno条件字段独立
            select * from emp where  empno+2=1325467; //empno条件字段不独立
            只有独立的条件字段才可以使用索引
            
        2) 左原则
           模糊查询，like    %   _
              %：关联多个模糊内容
              _: 关联一个模糊内容
           select * from 表名  like  “beijing%”;  //使用索引
           select * from 表名  like  “beijing_”;  //索引索引
           
           查询条件信息在左边出现，就给使用索引
           XXX%    YYY_  使用索引
           %AAA%   _ABC_   %UUU 不使用索引 
           
           没有使用索引(中间条件查询)：
           select * from emp where epassword like '%abc%'\G  (并没有走索引，而是全部走了一次)
           select * from emp where epassword like 'abc%'\G  (走索引了)
           select * from emp where epassword like '%abc'\G  (并没有走索引，而是全部走了一次)
           
        3) 复合索引
           ename复合索引 内部有两个字段（ename，job）
           ① ename(前者字段)作为查询条件可以使用复合索引
           ② job(后者字段)作为查询条件不能使用复合索引
           
           复合索引的第一个字段可以使用索引
                explain select * from emp where ename like  'abc%'\G (可以使用索引)
           复合索引的其余字段不能使用索引：
                explain select * from emp where job like  'abc%'\G (不可以使用索引)
           如果第一个字段的内容已经确定好，第二个字段也可以使用索引,若第二个不行，第一个行，也是走了第一个索引，所以也是提高了效率：
                explain select * from emp where ename like 'abc%' and job like 'def%'\G  (可以使用索引)
        
        4) OR原则
            OR左右的关联条件必须都具备索引 才可以使用索引：
            explain select * from emp where empno = 141234 or epassword like 'abc%'\G   --使用了两个索引进行检索
            (这个只有一个使用，另一个没有使用索引的or查询，最后导致不会产生索引) explain select * from emp where empno = 141234 or deptno<10\G   --or的左侧有使用索引，但是右侧没有，导致整体都没有使用索引

</pre>

###  总结
<pre>
    1.逆范式
    2.索引
    索引是数据表的某个字段作为关键字，该关键字与信息的物理地址进行对应
    通过索引查找信息，内部有算法，速度有保证，索引信息找到就找到记录的物理地址
    进而获得该记录信息
    
    索引类型：主键、唯一、普通、全文
    
    创建：创建数据表时设置索引
          给已有数据表设置索引
    删除：alter table 表名 drop  primary key;  
    //删除主键，需要先删除auto_incremenet
    alter  table  表名  drop  index  索引名
    
    3.exlain执行计划
    针对 查询sql语句  可以设置执行计划
    4.索引适合场景：where、order by、索引覆盖、连接查询(约束字段)
    5.索引使用原则：左原则、字段独立、复合索引、or原则
</pre>