# Memcached 学习笔记

### 系统核心优化
<pre>
    思路：以小博大、利用最小的资源换取最大的回报
          memcache、mysql优化、静态化技术
          
    数据缓存:Memcached,Redis
    页面缓存:ob_系列函数，用于页面静态化      
</pre>

### Memcache (Memory Cache)
<pre>
    Memcache或Redis是中间介质，可以帮助我们通过php语言实现对内存的操作
</pre>

### memcache和redis的区别、联系
<pre>
    区别：
        前者(Memcached)：
            每个key的数据最大是1M
            对各种技术支持比较全面，session可以存储memcache中，各种框架(例如thinkphp)对memcache支持的比较好
            比较老牌、传统的内存缓存技术
            适合存储简单、实用的数据
            数据类型只有String
            没有持久化
        后者(Redis)：
            每个key的数据最大是1G
            对各种技术支持没有memcache更好。
            新兴的内存缓存技术
            适合做集合计算(list/set/sortset)
            数据类型较丰富（String/list/Set/Sort set/hash）
            有持久化 (重点)
        联系：
            数据存储在内存当中，数据模型都是key-value
    
    两种内存缓存技术都要掌握，大家有各自擅长的地方
    memcache：对session支持，各种框架支持,可以直接在php.ini或者ini_set()方法出进行Memcached的session设置
    redis：集合计算
</pre>

### 安装使用memcache
<pre>
    Linux下安装:
        安装教程的网址:http://www.cnblogs.com/sandea/p/5782192.html
    
    Windows下安装:
        
</pre>

### 开启memcache服务
<pre>
    前台开启服务(不推荐):
        Ctrl+C结束掉
        开启服务可以设置的参数
        
        memcached -p 11211 -l 127.0.0.1 -m 128MB (这样只能本地进行访问，外部电脑使用telnet是不能访问的)
        
        //为了让外部的电脑能够访问memcached，必须设置为外部地址
        
</pre>

### php开启memcache扩展
<pre>
    给php.ini设置对应的扩展(没有就添加一行)：
        extension=php_memcache.dll
    给php扩展目录拷贝对应的扩展文件：
        php_memcache.dll
    重启Apache    
</pre>

### php操作memcache
<pre>
    在php中memcache体现为“类Memcache”
    具体使用：实例化对象，对象调用成员方法即可。
    
    具体操作：
        设置
            $obj -> set(key,value,是否有压缩0/1,有效期);
        是否压缩：
            不考虑速度，计较内存空间，压缩
            计较速度，不计较内存空间，不压缩
        有效期：
            单位：秒
        获取
            $obj -> get(key);
        删除
            $obj -> delete(key);
    
    01.php 连接memcache服务器成功
    02.php 给memcache设置一个week的key变量
    04.php 把刚才设置好的key给读取出来
</pre>

### key的命名
<pre>
    key的名字可以有许多字符组成，长度不能超过250字节。
    空格不能作为名字的组成内容。
    (utf-8字符集的一个汉字是3个字节)
</pre>

### 有效期
<pre>
    为0即不失效。
        两种方式：
        ① 时间戳：1970-1-1号到目前的秒数
        ② 时间差：时间数字，从目前往后延伸的时间长度
    时间差的值大到一定程度与时间戳的值可以保存一致
    (限制：时间差最多不能多于30天，否则其为时间戳,因为大家都是整数，如何判断是①还是②，所以需要一些内容的变更)
    
    两种方式设置key的有效期：  
        $mem->set('color','red',0,30);
        $mem->set('age',23,0,time()+30); 
           
    注意: 一个key的有效期为60天只能通过时间戳方式设置。       
</pre>

### 各种数据类型的存储
<pre>
    php的数据类型（8种）：
        基本类型：int  string  boolean  float
        复合类型：array  object  resource  null
        
    基本类型 数据在memcache内部通过字符串存储
    复合类型 数据在memcache中是原样存储
    有的时候在memcache中需要把各种数据类型信息都变为字符串存储，就需要对复合类型信息进行序列化操作:serialize（）  unserailize()
    
   在PHP拓展库中，$mem->set(对象,value，0); 
   在PHP拓展库中，$mem->set(数组,value,0); 
   在PHP拓展库中，$mem->set(null,value,0);
    
    传递到memcached中的时候会，自动执行序列化操作，在get方法中会采用反序列化的操作
    这样就会正常读取key的存储内容，返回的时候戴上了反序列化，返回正常的内容
</pre>

### 第三个参数压缩作用
<pre>
    通过zlib进行压缩处理
</pre>

### php中其他相关操作方法
<pre>
    add() 给memcache增加一个key,不存在就增加，存在就报错
    set() 给memcache设置key,  不存在就增加，存在就修改 
    close()  关闭memcache连接，一般根据具体情况，设置到php代码的最后
    decrement()  给key的值减少1  i--
    increment()  给key的值累加1   i++
    flush()	清空memcache的全部key
    replace() 替换key的值为其他值 存在就替换，不存在就报错    
</pre>

### 终端命令方式操作
<pre>
    注意使用xshell访问memcache的时候很容易在输入命令的时候报错，
    如果指令和后面的数据割了两个空格，错误出现的几率会大大缩小

    登录到memcache的操作终端：
        telnet是远程登录协议
    
    登录memcache终端成功   
     
     
    在终端窗口实现memcache的操作：
    设置：
    > set key  是否压缩  有效期  数据长度  [回车]
    > 数据
    
    > add  key  是否压缩  有效期  数据长度  [回车]
    > 数据
    
    > replace  key  是否压缩  有效期  数据长度 [回车]
    > 数据
    (数据真实长度 与 设置长度 要完全一致)
    获取：
    	> get  key
    删除：
    > delete key
    > flush_all    //删除全部的key 
    
    获取memcache统计的信息
        stats :具体的返回看word的图
</pre>

### 分布式memcache的部署
<pre>
    如果单个memcache保存的数据非常多，memcache本身工作负载就会非常高，为了降低该memcache的工作量，提高其运行速度，可以设置多个memcache平均分担工作量，该模式就是分布式。
    (例如一个memcache要保存1000W的数据，如果平均分配到5个memcache服务器，则每个就只保留200W的数据)
    
    
    Redis的分布式是“主从模式”结构，一主多从。
    Memcache的分布式与Redis的不同，其是把一台memcache的工作平均分配给多个memcache分担。
    
    分布式具体的实施：
    1)可以在一个服务器里边开启多个memcache服务
    2)可以配置多个服务器，每个服务器里边都运行memcache服务
    
    
    其实Memcache也是可以多服务器多memcache程序的，这样来构建集群，但是一般memcache的集群都是按顺序多memcache平均分配资源，而Redis一般是主从模式，这就是区别
    
    每个memcache服务器都是平等的，中间通过“算法”保证数据的平均分配。
    php代码的编写还保持原有习惯即可。
    key的分配原则：依次轮询、求余
    
    PHP的算法可以保证数据分配到每一个服务器，但是必须设置的与获取的服务器的顺序需要一致
    
    
</pre>

### 缓存失效
<pre>
    memcache中的key超过有效期、或被系统强制删除掉了。
    
    有效期过期
        session信息过期(失效了)，通过“懒惰”模式给删除的。
        session是在文件中存储，如果session已经过期，其文件还是存在的，下次有一个用户访问session信息(用户登录系统)，此时已经过期的session就有一定的几率被删除(session文件被删除)。
        
        memcache中key的删除也是懒惰模式，如果超过有效期，该key还是存在的，当你get获取它的时候，其就消失了。
    
    空间不足被强制删除
        memcache的内存可用空间默认为64MB，如果存储的数据非常多，可用空间不足了。
        此时仍然可以存储数据，因为memcache内部有LRU机制。
        LRU: Least  recently use  最近很少被使用的数据
        内存空间如果不足，就会删除最近很少经常使用的数据。
        
        如果不想使用LRU机制，就可以设置参数-M
        开启memcache服务的时候带参数-M:
</pre>

### session入memcache (每创建一个新的session都会创建一个item)
<pre>
    传统session的数据是在硬盘的文件中存储的。
    该session很大情况用于存储用户的相关信息。用于判断一个用户是否登录系统。
    
    两个服务器的session如果是文件形成存储，则他们的session互相不能通信。
    
    两个服务器的session如果是存储在memcache中的，则他们的session可以通信。
    
    一个网站是有多个服务器支撑的，用户在服务器1里边登录系统，其session持久化的信息报保存在一个memcache服务器里边，这样服务器2/3/4也可以去memcache读取session信息，就可以保证用户访问各个服务器的时候无需重复登录系统。
    (以上情况还可以把session存储在mysql中)
    
    具体操作:
        php.ini关于session的设置：
        存储session形式：
            session.save_handler = memcache
        
        存储位置:
            session.save_path = tcp://127.0.0.1:11211
            多并发部署:
            session.save_path = tcp://127.0.0.1:11211;tcp://127.0.0.1:11212;tcp://127.0.0.1:11213

        
    与文件保存的文件名不同:
         文件系统保存session文件是:sess_sessionId 为文件名
         memcache保存session是直接以session为key  
          
    stats  items                
    stats  cachedump 1 100       
</pre>

### Yii使用memcached作为session的存储介质的设置
<pre>
	'memcache' => [
				'class' => 'yii\caching\MemCache',
				'servers' => [
					[
						'host' => '192.168.148.156',
						'port' => 11211,
						'weight' => 40,
					],
					[
						'host' => '192.168.148.156',
						'port' => 11212,
						'weight' => 30,
					],
					[
						'host' => '192.168.148.156',
						'port' => 11213,
						'weight' => 30,
					]
				],
			]
</pre>

###
<pre>

</pre>