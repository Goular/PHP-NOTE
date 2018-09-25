# Redis

### 什么是Redis
<pre>
    Redis是Remote Dictionary Server(远程数据服务)的缩写
    由意大利人 antirez(Salvatore Sanfilippo)  开发的一款 内存高速缓存数据库
    该软件使用C语言编写,它的数据模型为 key-value
    它支持丰富的数据结构(类型)，比如 String  list  hash   set  sorted set。
    可持久化(随时把备份到硬盘中一份)，保证了数据安全。
    
    同一个select 查询语句，每天需要被执行查询100万次，为了减轻数据库的负载，就把查询好的数据给缓存起来(存储在内存中)，每天的第一个用户执行从mysql中获得数据并存储到内存中，第二个 到 第100万个用户就直接从内存中获得数据。
    
    
    使用缓存减轻数据库的负载。
    在开发网站的时候如果有一些数据在短时间之内不会发生变化，而它们还要被频繁访问，为了提高用户的请求速度和降低网站的负载，就把这些数据放到一个读取速度更快的介质上(或者是通过较少的计算量就可以获得该数据) ，该行为就称作对该数据的缓存。
    
    该介质可以是文件、数据库、内存，内存介子经常用于数据缓存。
</pre>

### 为什么使用Redis
<pre>
    是一款数据库产品，有数据存储功能
    高速读取数据(in-memory)
    减轻数据库负担
    有集合计算功能(优于普通数据库和同类别产品) 交集/并集/差集
    多种数据结构支持
</pre>

### 什么场合适合使用Redis
<pre>
     1.[Sort Set]排行榜应用，取top n操作，例如sina微博热门话题
     2.[List]获得最新N个数据 或 某个分类的最新数据
     3.计数器应用
     4.[Set]sns(social network site)获得共同好友
     5.[Set]防攻击系统(ip判断)等等
</pre>

### 使用Redis的好处(与memcache的比较)
<pre>
    Redis不仅仅支持简单的k/v类型的数据，同时还提供list，set，zset，hash等数据结构的存储。
    
    Redis支持master-slave(主—从)模式应用。
    
    Redis支持数据的持久化，可以将内存中的数据保持在磁盘中，重启的时候可以再次加载进行使用。
    
    Redis单个value的最大限制是1GB， memcached只能保存1MB的数据
</pre>

### Redis 数据类型
<pre>
    String 
    List
    Hash
    Set
    SortSet
</pre>

### PHP使用缓存的场景
<pre>
    缓存的两种形式：
        页面缓存经常用在CMS(content manage system)内存管理系统里边(Smarty缓存)
        数据缓存经常会用在页面的具体数据里边
    例子:    
        新闻信息(数据不变化、有实时性)页面适合做页面缓存 --页面缓存
        商品展示页面(数据有各种分类)，为了降低数据库负载，他们比较适合做各个小部分的数据缓存，数据更新也只是更新每个小块的数据缓存   --数据缓存
</pre>

### 安装 Redis
<pre>
    安装教程的网址:http://www.cnblogs.com/sandea/p/5782192.html
    
    安装完成后:
    
    默认为前台启动redis服务
        前台启动服务：始终有一个终端脚本被挂起执行(终端脚本被关闭后立即停止服务，不推荐)
        后台启动服务：服务以隐藏的方式执行，没有终端脚本，可以通过ps -A | grep 名称 查看是否有该服务。
        
    修改配置文件(/usr/local/redis/redis.conf)，设置后台启动redis服务：
        (1)配置文件中: daemonize yes   
        (2)删除进程: kill -9 PID 
            名词解析: SIGKILL	9	Kill(can't be caught or ignored) (POSIX)
    
    重启Redis redis-server /etc/redis/6379.conf 
</pre>

### Redis 具体使用
<pre>
    redis中数据的模型为：key / value,类似在php中定义变量:名称 = 值;
    1.key的操作("\n"和空格 不能作为名字组成内容)
          在redis里边，除了”\n”和空格 不能作为名字的组成内容外，其他内容都可以作为key的名字部分。名字长度不做要求。
          Redis中key的组成内容较随意(没有\n和空格即可)
    2.Redis 共有16个数据库
          在redis.conf配置文件中,配置文件84行附近,
          databases 16 (更改数字数量，即可拥有指定数据的数据库的数量)
    3.keys * :通过模糊方式查看当前数据库全部的key名称信息(*星 代表任意名字信息) 
    4.keys n*   查看当前数据库名称以n开始的key的名字/  keys *n*  查看当前数据库名称包含n的key的名字    
</pre>

### Key操作 (键操作)
<pre>
    1. exists key                   测试指定key是否存在
    2. del key1 key2 key3 ...       删除给定的key
    3. type key                     返回给定key的value的类型
    4. keys pattern                 即keys n*,pattern为正则表达式模式,返回匹配指定模式的所有key
    5. rename oldkey newkey         改名字
    6. dbsize                       返回当前数据库的key的数量
    7. expire key seconds           指定key的过期的时间
    8. ttl key                      返回key的剩余过期秒数
    9. select db-index              将key从当前数据库移动到指定的数据库
    10. flushdb                     删除当前数据库中所有的key
    11. flushall                    删除所有数据库中所有的key
</pre>

### String类型操作
<pre>
    String是Redis最基本的类型,Redis的String可以包含任何数据。包括jpg图片或者序列化的对象。
    单个value值最大上限是1G字节。
    
    操作:
    set key value                                       设置key对应的值为String类型的Value
    mset key1 value1 key2 value2 ... keyN valueN        一次设置多个key的值
    mget key1 key2 key3 ... keyN                        一次获取多个key的值
    incr key                                            对key的value做加加(++)的操作，并返回新的值
    decr key                                            对key的value做减减(--)的操作，并返回新的值
    incrby key integer                                  同incr,加指定的值
    decrby key integer                                  减decr,减指定的值
    append key value                                    给指定的key的字符串追加value
    substr key start end                                返回截取过的key的字符串值
 
    incr:  increment  增长
          该指令可以对key进行累加1操作，默认是累加1操作,类似i++操作
          该指令可以针对 新key或已有key 进行操作
    新key：创建该key并累加1，其值为1
    已有key：key的信息值类型要求必须为整型的
    已有key的信息必须为“整型”的才允许incr操作：
    decr  的操作模式与incr一致，不过其实减1操作
    
    substr: 对内容进行截取，包括start和end标记位置内容
    给key追加内容(如果被操作内容是空格分隔的多个信息，避免混淆，要使用引号)：
</pre>

### 数据类型List链表
<pre>
    list类型其实就是一个双向链表。通过push,pop操作从链表的头部或者尾部添加删除元素。
    这使得list既可以用作栈，也可以用作队列。
        上进上出 ：栈
        上进下出 ：队列
    
    List类型其实就是一个双向链表，通过push,pop操作从链表的头部或者尾部添加删除元素
    这使得list既可以用作栈，可以用作队列
    
    该list链表类型应用场合：
    获得最新的10个登录用户信息: select * from user order by logintime desc limit 10;
    	以上sql语句可以实现用户需求，但是数据多的时候，全部数据都要受到影响查询，对数据库的负载比较高。必要情况还需要给关键字段(id或logintime)设置索引，索引也比较耗费系统资源
    	如果通过list链表实现以上功能，可以在list链表中只保留最新的10个数据，每进来一个新数据就删除一个旧数据。每次就可以从链表中直接获得需要的数据。极大节省各方面资源消耗    

    
    List类型操作:
        lpush key string                            在key对应list的头部添加字符串元素
        rpop key                                    在list的尾部删除元素，并返回删除元素
        llen key                                    返回key对应list的长度，key不存在返回0，如果key对应类型不是list返回错误
        lrange key start end                        返回指定区间的元素，下标从0开始
        rpush key string                            同上，在尾部添加
        lpop key                                    从list的头部删除元素，并返回删除元素
        ltrim key start end                         截取list，保留指定区间内的元素
</pre>

### set集合类型(最重要的就是有集合的获取，这样的获取在sql中是很难做到的)
<pre>
    Set特点:每个集合中的各个元素不能重复。

    redis的set是string类型的无序集合。
    set元素最大可以包含(2的32次方-1)个元素。
    关于set集合类型除了基本的添加、删除操作，其他有用的操作还包含集合的取并集(union)，交集(intersection)，差集(difference)。通过这些操作可以很容易的实现sns中的好友推荐功能。
    
    该类型应用场合：qq好友推荐。
    
    Set类型操作:(注意:member为string类型)
        sadd key member                             添加一个string元素到key对应的set集合中，成功的话，返回1，如果元素已经在集合中，返回0,key对应的set不存在返回错误
        srem key member [...member]                 srem set1 s1 s2 s3 从key对应set中移除给定元素，成功返回1
        smove p1 p2 member                          从p1对应set中移除member并添加到p2对应的set中
        scard key                                   返回set的元素个数
        sismember key member                        判断member是否在set中
        sinter key1 key2 key3 ... keyN              返回所有给定的key的交集
        sunion key1 key2 key3 ... keyN              返回所有给定的key的并集
        sdiff key1 key2 key3  ... keyN              返回所有给定的key的差集 
        smember key                                 返回key对应set的所有元素，结果是无序的                    
</pre>

### Sort Set排序集合类型
<pre>
    该Sort Set是两种类型(list和set)的集中体现,称为排序集合类型。
    
    和set一样sorted set也是string类型元素的集合，
    不同的是每个元素都会关联一个权(score)。
    通过权/值可以有序的获取集合中的元素
    
    该Sort set类型适合场合：
    获得最热门(回复量)前5个帖子信息：
    select * from message order by backnum desc limit 5;
    (以上需求可以通过简单sql语句实现，但是sql语句比较耗费mysql数据库资源)
    案例：利用sort set实现获取最热门的前5帖子信息
    
    Sort Set排序类型操作
        zadd key score member                添加元素到集合，元素在集合中存在则更新对应的score
        zrem key member                      删除指定元素，1表示成功，如果元素不存在则返回0
        zincrby key incr member              按照incr幅度增加对应member的score值，返回score值
        zrank key member                     返回指定元素在集合中的排名(下标),集合中元素是按score从小到大排序的
        zrevrank key member                  同上,但是集合中元素是按score从大到小排序
        zrange key start end                 类似lrange操作从集合中去指定区间的元素，返回的是有序结果
        zrevrange key start end              同上，返回结果是score逆序的   
        zcard key                            返回集合中的元素个数
        zscore key element                   返回给定元素对应的score   
        zremrangebyrank key min max          删除集合中排名在给定区间的元素
    
</pre>

### 数据类型Hash
<pre>
    hash数据类型存储的数据与mysql数据库中存储的一条记录极为相似。
    
    Hash类型操作:
        hset key field value                                        设置hash field 为指定值，如果key不存在，则先创建
        hget key field                                              获取指定的hash field
        hmget key field1 field2,...fieldN                           获取全部指定的hash field
        hmset key field1 value1 field2 value2 ... fieldN valueN     同时设置hash的多个field
        hincrby key field integer                                   将指定的hash field加上给定值
        hexists key field                                           测试指定field是否存在
        hdel key field                                              删除指定的hash field
        hlen key                                                    返回指定hash的field数量
        hkeys key                                                   返回hash的所有field
        hvals key                                                   返回hash的所有value
        hgetall key                                                 返回hash的所有field和value
</pre>

### Redis基本使用总结
<pre>
    key的使用
        key具体操作：
            exists    keys  *     rename  
            del      dbsize       select 0-15
            flushdb  flushall
    数据类型：
        String:
            get  set  mget  mset   incr  decr   append   substr
        List:
            lpush     rpop      lrange    
            rpush     lpop       ltrim
        Set集合(集合运算):
            sadd        sinter    sunion       sdiff
            smembers   scard    sismember
</pre>


### Snap Shotting快照持久化
<pre>
    该持久化默认开启，一次性把redis中全部的数据保存一份存储在硬盘中，如果数据非常多(10-20G)就不适合频繁进行该持久化操作。
        快照持久化备份文件：dump.rdb
    
    该方式备份机制(频率)：
        save 900 1 		#900 秒内如果超过 1 个 key 被修改，则发起快照保存
        save 300 10     #300秒超过10个key被修改，发起快照
        save 60 10000   #60秒超过10000个key被修改，发起快照
        以上三个备份频率需要同时存在：
        数据变化非常快的时候，就快点做备份(保证数据安全)
        数据变化慢的时候，就慢点做备份(节省服务器资源)
     
    快照持久化备份文件的名称和目录设置：    
        redis.conf
            dbfilename dump.rdb             dump.rdb为备忘目录
            dir ./                          工作目录
            
    redis的持久化相关指令
        bgsave 异步保存数据到磁盘(快照保存)
        lastsave 返回上次成功保存到磁盘的unix时间戳
        shutdown  同步保存到服务器并关闭redis服务器
        bgrewriteaof  当日志文件过长时优化AOF日志文件存储
        
        ./redis-cli  bgrewriteaof
        ./redis-cli  bgsave
        ./redis-cli -h 127.0.0.1 -p 6379 bgsave   #手动发起快照
            
            
    操作(重点):
        1.1 手动发起快照持久化
            ./redis-cli bgsave
         
        2. append only file （AOF持久化）
            本质：把用户执行的每个“写”指令(添加、修改、删除)都备份到文件中，还原数据的时候就是执行具体写指令而已。
            
            该AOF持久化默认没有开启，现在就开启使用：(可以自定义该持久化备份文件的名称)
            
            配置文件redis.conf被修改后，为了有效果，需要重启redis服务：(杀掉旧进程，根据新配置文件启动新进程)
            
            AOF持久化开启后会自动生成一个备份文件 注意：AOF持久化开启后会自动清除目前redis中的全部数据(这个是重点，会清除所有的数据的)
            
            AOF备份的频率：
                数据最安全      服务器性能低  
                数据较安全      服务器性能中等
                数据不安全      服务器性能高(优良)
                # appendfsync always   //每次收到写命令就立即强制写入磁盘，最慢的，但是保证完全的持久化，不推荐使用
                appendfsync everysec   //每秒钟强制写入磁盘一次，在性能和持久化方面做了很好的折中，推荐
                # appendfsync no   //完全依赖 os，性能最好,持久化没保证
</pre>

### 快照恢复(开启aof,会优先从aof中读取,就不读取rdb) AOF会在打开的时候自动读取（记得开启aof，这个是第一个考察的地方）
<pre>
    恢复数据
    如果需要恢复数据，只需将备份文件 (dump.rdb) 移动到 redis 安装目录并启动服务即可。获取 redis 目录可以使用 CONFIG 命令，如下所示：
     
    redis 127.0.0.1:6379> CONFIG GET dir
    1) "dir"
    2) "/usr/local/redis/bin"

    有遇到过重启机器,但是dump.rdb中的数据却不自动加到内存中的情况么?
    
    
    搞定了,原来开启aof,会优先从aof中读取,就不读取rdb了
</pre>

### Redis主从模式
<pre>
    mysql为了降低每个服务器负载，可以设置读写分类(有写服务器、有读取服务器)
    
    为了降低每个redis服务器的负载，可以多设置几个，并做主从模式
    一个服务器负载“写”(添加、修改、删除)数据，其他服务器负载“读”数据
    主服务器数据会“自动”同步给从服务器
    
    在redis.conf里边设置并成为192.168.40.148服务器的从服务器：
    redis.conf配置文件修改后杀掉旧进程，启动新进程：
    此时就可以看到主服务器自动同步给从服务器的数据
    从服务器默认只读：
        slave-read-only yes
</pre>

### 搭建redis单机集群
<pre>
    CentOS单机多集群Redis:
    1.复制redis.conf文件
        找到redis.conf文件(我这边为/etc/redis/6379.conf)，复制文件/etc/redis/6380.conf,同时将文件内容关于6379的内容改为6380
    2.找到全局的redis存储的文件夹    
        redis 127.0.0.1:6379> CONFIG GET dir
        1) "dir"
        2) "/usr/local/redis/6379"
        
        找到文件夹，然后复制一个6379的文件夹变为6380文件夹
        
    3.开启特定端口的服务:
            redis-server /etc/redis/6379.conf   
            redis-server /etc/redis/6380.conf 
    4.访问特定端口的服务:redis-cli -c -p 端口号，进入某一个redis服务
</pre>

### php与redis结合
<pre>
    1. 安装php的redis扩展
        上传redis扩展软件和依赖软件：
        解压缩phpredis软件：
        
        顺序：redis与其他软件(xml、gd、jpeg等等)都是php的扩展(php依赖扩展软件)
        正确的安装顺序是先安装依赖软件、之后在安装php软件
        此时redis与php的安装顺序有前后颠倒的意味，但是php允许redis反方向安装进来。
        
        在phpredis的解压目录下运行/usr/local/php/bin/phpize，以便redis反方向安装进php里边：
</pre>

### (大重点)CentOS作为访问服务器，Redis安装在Linux中，外面机子如何访问
<pre>

	Redis作为Linux组件，对外生产服务时，需要配置下面的内容

	/redis.conf配置下面的内容，不然无法连接，若是允许其他机子访问，那么就注释所有的ip地址即可
	# bind 127.0.0.1  
	若把# bind 127.0.0.1前面的 注释#号去掉，然后把127.0.0.1改成你允许访问你的redis服务器的ip地址，表示只允许该ip进行访问,显示了本机才能访问的问题
	
	
	虚拟机上装了reids3.2版本，配置文件中已将bind的选项注释掉，
	linux的iptables的redis端口也开放
	其它机子的PHP访问redis爆“protocol error, got 'n' as reply type byte ”错误

	解决办法：
	在redis配置文件redis.conf中注释掉bind配置项的同时把redis3.2新增的配置项
	protected-mode由yes改为no,改完后重启redis服务，其它机子就可访问redis服务
</pre>


### 通过php操作redis
<pre>
    在php里边，redis就是一个功能类Redis，Redis类里边有许多成员方法(名字基本与redis指令的名字一致，参数也一致)
    3.php中redis的可操作方法有哪些
    获得Redis类内部一共的方法(利用反射Reflection实现)：
    php大部分操作都是正向的：类、实例化对象、对象调用成员
    其实类可以反向操作：类、反过来感知类的成员、反方向感知方法是否是公开的/私有的/受保护的/最终的
    
	//连接本地的 Redis 服务
	$redis = new Redis();
	$redis->connect('192.168.2.56', 6379);
	echo "Connection to server sucessfully";
	//查看服务是否运行
	echo "Server is running: " . $redis->ping();
</pre>

### 总结
<pre>
    1.数据类型 Sort Set
        获得最热门前5个帖子信息
        (优秀学员奥赛班分班使用)
    2.持久化
        1）快照持久化(默认开启)
        2）AOF追加持久化(精细)，本质备份用户的“写指令”
    3.主从模式
    4.php实现redis操作
        1）给php安装redis扩展
        2）php对redis操作
</pre>