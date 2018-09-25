# MongoDB使用

### 介绍
<pre>
    MongoDB是一种面向文档的数据库，是一种NoSQL类型的产品。MongoDB中一个文档实际上就是一个json对象：比如：{ ‘goods_name’:’thinkpad’, ‘shop_price’:100 }，使用 javascript 语言来操作。
    最大特点：在超大规模【几十亿级别】数据的存取数据速度非常快！
    
    NoSQL：在处理大数据和高并发性能非常好。所以MongoDB这个数据库设计的目的就是为了解决这两个问题，所以的MongoDB特点：易于扩展、性能非常快、分布式存储与操作！
    因为也会牺牲一些东西：不支持事务和JOIN这种操作，适合做非事务型以及数据结构比较简单的数据：日志等，以数据存储为主。
</pre>

### MongoDB最主要的特点:分布式存储，因此不支持事务和join，不然就会造成分布式查询出现错误的;适合做非事务型和数据结构比较简单的数据和日志等，以数据存储为主

### 安装流程
<pre>
    MongoDB 端口号:27017
    MongoDB WEB服务管理页面 端口号:28017

    1.从官网上安装完成后，就可以进行配置安装，只有配置安装完成，才可以进行运行。
    2.mongod.exe --dbpath 路径 --logpath 路径 --serviceName "MongoDB" --install (这个一定要使用管理员来执行不然出错，MongoDB不会安装到Window服务中)
    3.添加环境变量
    
    4.添加php拓展(注意版本，在phpinfo()查看)
        在phpinfo页面中,
        PHP Extension :当前版本
        extentsion_dir:拓展路径
        
        在php.ini中添加拓展:extension=php_mongo.dll
        记得重启apache
        
</pre>

### MongoDB命令行
<pre>
    说明这个客户端其实主一个JS引擎，可以执行任何JS语句：
</pre>

### MongoDB帮助
<pre>
    系统级别：help
    数据库级别：db.help()
    集合级别：db.集合名.help()
    方法级别：查看一个方法有几个参数：db.集合名.方法名，如:db.goods.find
</pre>

### 一般命令的归类
<pre>
    show dbs;   //查询当前的所有数据库
    use dbName; //使用指定的数据库
    show users; //查询当前的所有用户
</pre>

### 面向文档的数据库概念
<pre>
    MySQL       MongoDB
    数据库         数据库
      表           集合
     记录          文档 
</pre>

### 客户端中的db变量代表当前数据库
<pre>
    use php39  //就算没有创建PHP39数据库也能直接使用，因为MongoDB为无模式的数据库
               //所有的集合，文档啊，都是我们的变量而已，
               //所以我们的可以随便调用集合和文档的内容，查不到对象时，判断对象是否为空就可以了
</pre>

### (重点)Mongodb是一个 无模式 的数据库
<pre>
    意思就说：无需创建数据库和集合，而且集合中的字段随意加不用提前定义好。
    扩展：甚至同一个集合中可以不完全不同的文档：比如把会员、商品、文章、品牌都放到一个集合中也可以。
    但是不推荐这样做，最好同一种结构的文档放到一个集合中这样性能更好而且便于管理！
</pre>

### MongoDB能进行分布式，多机子集群的原因
<pre>
    就是id(主键)，说明：mongodb会为每条新添加的记录增加一个_id字段，这个字段中的值可以确保在同一个集合中肯定是唯一的。
    这个_id的类型是 ObjectId 对象类型。为了避免分布式存储数据时ID冲突所以这里没有使用自增的整型。

    正式由于ObjectId，才能使分布式存储得以实现，不会因为主键一直而造成异常.
</pre>

### MongoDB 简单操作
<pre>
    1.向php39数据库中的商品集合插入100件商品
        说明：mongodb会为每条新添加的记录增加一个_id字段，这个字段中的值可以确保在同一个集合中肯定是唯一的。
        这个_id的类型是 ObjectId 对象类型。为了避免分布式存储数据时ID冲突所以这里没有使用自增的整型。
    
        use php39;
        for(var i=0;i<100;i++){
            db.goods.insert({"goods_name":"goods_"+i,"shop_price":100*Math.random()});
        }
        
    2.查询出100条记录
        db.goods.find();    
    
    3.删除goods_name=goods_14的商品
        db.goods.remove({"goods_name":"goods_9"})
    
    4.修改goods_name=goods_15的价格为100
        方式一:
            var d = db.goods.findOne({"goods_name":"goods_15"});
            d.shop_price = 16;
            db.goods.save(d);
        方式二:
        db.goods.update(
            {"goods_name":"goods_3"},
            {
               $set:{
                    "goods_price":88
               } 
            }
        );
        
    
    5.取出所有价格小于50元的商品
        db.goods.find({"shop_price":{"&lt":50}});
    
</pre>

###　常用的操作符(大于,小于等)
<pre>
    $lt (<),$lte (<=),$gte (>=),$ne (<>/!),$in,$nin (not in),$or,$not,$mod(取模),$exists,$where
    
    //例如，查询年龄小于20岁的用户
    db.user.find("age":{"$lt":20});
</pre>

### Mongodb
<pre>
    null:用于表示空或者不存在的字
        {"x":null}
    
    布尔:true,false
        {"x":true}
    
    32位整数:shell中所有数字都是64位浮点数，所以不能再shell中使用
    
    64位正数:不能用在shell中
    
    64位浮点数:shell中的数字都是这种类型
        {"pi":3.14}
    
    字符串:utf-8字符串
        {'x':'goular.tech'}
        
    对象id:
        {"_id":ObjectId()}
        
    日期:
        {"d":new Date()}
        
    正则表达式:
        {"x",/^abc$/}

    代码,方法:
        {"x":function(){}}
        
    未定义:
        {"a":undefined}
        
    数组:
        {"d":[1,2,3,4]}
    
    内嵌文档:
        {"x":{"y":"z"}}
</pre>

### 瞬间完成
<pre>
    插入，删除和更新都是瞬间完成的，就是说他们不想Mysql等待数据库的响应，操作完成并没有响应，发送成功与不成功都不知道。
    意思：客户端在执行这些操作时都没有返回值【不用等待服务器】，所以就不知道这次操作有没有成功，优点：无阻塞可以一直执行。
    有些操作必须要有返回值【要确切的知道有没有成功】，需要执行一个操作之后再额外执行一个指令询问服务器上个操作有没有成功。
</pre>

### 解决瞬间完成的同步性问题
<pre>
    MongoDB中修改，删除，更新，都是瞬间完成的，即客户端只是把命令发给服务器，但不会检查这条命令是否会执行成功
    
    解决之道:
        可以通过在执行完每条命令之后去执行， 使用getLastError()来检查是否成功
        db.runCommand({getlastError:1});
        执行后会返回一段状态json
</pre>

### 总结
<pre>
    MONGODB拥有的功能：基本的数据存取、索引、复制、分片、备份、还原等基本功能，
    做为一个数据库没有的功能：事务、视图、存储过程、不支持JOIN操作、触发器等。
</pre>

### 复制

### 分片
<pre>
    扩展：MYSQL中有个NDB集群也是这个东西。【大数据的分布式存储】
    扩展：MapReduce 编程模型：快速处理大数据。
    Map：把一个任何折分【映射】：Reduce：把多个任务的结果汇总统计
    1024B=1M
    1024M=1G
    1024G=1T
    1024T=1P
    大数据：如何存【分片】、如何快速统计。
    
    Hadoop【java写的】：hdfs【分布式文件系统】+ MapReduce接口编程 + 一套工具
</pre>

### Mongodb中的地理空间索引
<pre>
    用于寻找附近的店，附近的好友
    利用相关关系，寻找与之有关系的好友
</pre>

### 使用PHP操作MONGODB
<pre>
    $mongoDB = new MongoClient();
    //获取mangoDB游标
    $goods = $mongoDB->php39->goods->find();
    //遍历内容获取
    foreach ($goods as $key => $value) {
        var_dump($value);
        echo "<br/>";
    }
    
    //添加一条记录
    $mongoDB->php39->goods->insert([
        "goods_name"=>'tom',
        "shop_price"=>99
    ]);
</pre>