# 静态化笔记

### 昨天内容回顾
<pre>
	1.索引设计依据
		与数据表有关系的sql语句都统计出来
		where   order by    or等等条件的字段适当做索引

	  原则：
		频率高的sql语句
		执行时间长的sql语句
		业务逻辑重要的sql语句

	  什么样子字段不适合做索引？
	    内容比较单调的字段不适合做索引
	2.前缀索引
	    一个字段只取前边的几位内容做索引
	    好处：索引空间比较少、运行速度快
	    前n位做索引，前n位要具备唯一标识当前记录的特点
	3.全文索引
	    Mysql5.5  只MYisam存储引擎可以实现
	    Mysql5.6  Myisam和Innodb存储引擎都可以实现
	    fulltext  index   索引名称 (字段,字段)

	select * from 表名  where  字段 like ‘%内容%’  or  字段  like ‘%内容%’;
	select  * from 表名  match(字段,字段)  against(“内容1,内容2”);
	match(字段,字段)  against(“内容1,内容2”)

	4.索引结构
		Mysql的索引结构是B+Tree结构
		索引就是数据结构(自然有算法)，算法可以保证数据非常快速被找到

	 非聚集(Myisam)
		叶子节点的关键字(索引字段内容) 与 记录的物理地址对应
	 聚集(Innodb)
		主(键)索引：叶子节点的关键字  与 整条记录对应
		非主(唯一/普通/全文)索引：叶子节点的关键字  与 主键关键字对应
	5.查询缓存
		开启缓存，开辟缓存空间(64MB)
		缓存失效：表 或 数据 内容改变
			不使用缓存：sql语句有变化的信息，例如当前时间、随机数
			同一个业务逻辑的多个sql语句，有不同结构(空格变化、大小写变哈)的变化，每个样子的sql语句会分别设置缓存
	6.分区、分表设计
		分区表算法(Mysql)：key   hash   range   list
			（php代码不会发生变化）

		分区增加或减少：
			减少：hash/range/list类型算法会丢失对应的数据

	7.垂直分表
		把一个数据表的多个字段进行拆分，分别分配到不同的数据表中
		涉及的算法是php层面的

	8.架构设计
		主从模式(读写分离、一主多从)
		主服务器负责“写”数据，从服务器负责“读”数据
		“主” 会 自动 给”从” 同步数据(mysql本身技术)
		通过“负载均衡”可以平均地从     从服务器 获得数据
		
	9.慢查询日志设置
		show variables  like ‘slow_query_log%’;
		开启慢查询日志开关
		设置时间阀值
</pre>

### Mysql优化
<pre>
	1. 大量写入记录信息
		保证数据非常快地写入到数据库中
		insert into 表名 values (),(),(),();
		以上一个insert语句可以同时写入多条记录信息，但是不要写入太多
		避免意外情况发生。
		可以一次少写一些,例如每次写入1000条，这样100万的记录信息，执行1000次insert语句就可以了。分批分时间把数据写入到数据库中。

		以上设计写入大量数据的方法损耗的时间：
		写入数据(1000条)----->为1000条数据维护索引
		写入数据(1000条)----->为第2个1000条数据维护索引
		......
		写入数据(1000条)----->为第1000个1000条数据维护索引

		以上设计写入100万条记录信息，时间主要都被“维护索引”给占据了
		如果做优化：就可以减少索引的维护，达到整体运行时间变少。
		(索引维护不需要做1000次，就想做一次)

		解决方式：
			先把索引给停掉，专门把数据先写入到数据库中，最后在一次性维护索引
			
	1.1 Myisam数据表
		1)数据表中已经存在数据(索引已经存在一部分)
			alter table 表名  disable  keys;
		大量写入数据
			alter table 表名  enable keys;  //最后统一维护索引
		2)数据表中没有数据(索引内部没有东西)
			alter table 表名 drop  primary key ,drop index  索引名称(唯一/普通/全文);
		大量写入数据
			alter table 表名 add primary key(id),(唯一/全文)index  索引名 (字段);
			
	1.2 Innodb数据表
		该存储引擎支持“事务”
		该特性使得我们可以一次性写入大量sql语句
		具体操作：
		start transaction;
		大量数据写入(100万条记录信息  insert被执行1000次)
		事务内部执行的insert的时候，数据还没有写入到数据库
		只有数据真实写入到数据库才会执行“索引”维护
		commit;
		commit执行完毕后最后会自动维护一次“索引”;	

	2. 单表、多表查询
		数据库操作有的时候设计到 连表查询、子查询操作。
			复合查询一般要涉及到多个数据表，
			多个数据表一起做查询好处：sql语句逻辑清晰、简单
			其中不妥当的地方是：消耗资源比较多、时间长
		不利于数据表的并发处理,因为需要长时间锁住多个表
		
		例如：
		查询每个品牌下商品的总数量（Goods/Brand）
			Goods:id  name   bd_id
			Brand: bd_id  name 
			select b.bd_id,b.name,count(g.*) from Brand b join Goods g on b.bd_id=g.bd_id group by b.bd_id;
		以上sql语句总运行时间是5s
		但是业务要求是数据库的并发性要高,就需要把”多个查询” 变为 “单表查询”
		步骤：
			① select bd_id,count(*) from Goods group by bd_id; //查询每个品牌的商品数量 //3s
			② select bd_id,name  from Brand;  //3s
			③ 在php通过逻辑代码整合① 和 ②  //1s

		其实是一样的，原因是总共使用的秒数差不多，但是由于是分开查询，单位时间内并发的内容就增多了，这样就可以提高并发查询效率	
</pre>

### limit使用
<pre>
	数据分页使用limit;
	limit 偏移量，长度(每页条数);
	偏移量：（当前页码-1）*每页条数

	分页实现：
	每页获得10条信息：
	limit 0,10;
	limit 10,10;
	limit 20,10;
	limit 30,10;
	limit 990,10;  //第100页
	limit 9990,10;   //第1000页
	limit 99990,10;   //第10000页
	limit 999990,10;   //第100000页
	limit 1499990,10;   //第150000页

	limit 1500000,10;   //第150001页
	方法1：select * from emp limit 1500000,10;  //4.52秒
	方法2：select * from emp where empno>1600001 limit 10;  //0.30秒
	
	数据表目前有empno主键索引
	limit  偏移量，长度；运行时间较长
	
	单纯运行limit 运行时间比较长，内部没有使用索引，翻页效果 之前页码的信息给获得出来，
	但是“越”过去，因此比较浪费时间
	
	现在对获得相同页码信息的sql语句进行优化
	由单纯limit变为 where 和 limit的组合：
	执行速度明显加快，因为其有使用where条件字段的索引
	
	
	注意:where,order by,or会使用索引，而单纯limit是不会使用索引的
	所以大数据下，查询单纯limit和where...limit的组合，后者明显在查询的速度上占优
</pre>

### order by null
<pre>
	强制不排序
		有的sql语句在执行的时候，本身默认会有排序效果
		但是有的时候我们的业务不需要排序效果，就可以进行强制限制，进而“节省默认排序”的资源。
		
	group by  字段；
		获得的结果默认情况会根据”分组字段”进行排序

	order by null强制不排序，节省对应资源：		
		select goods_category_id,count(*) from sw_goods group by goods_category_id order by null;
</pre>

### 
<pre>
--------------------------------------------    华丽的分割线    ------------------------------------------------------
</pre>

### 纯静态化
<pre>
	Smarty的缓存技术就是静态化的体现。
	1.什么是纯静态化
		把php执行、生成好的内容制作为一个“静态页面”，该制作过程就是静态化。

	2. 为什么使用静态化
		节省 php、mysql等服务器资源
		节省用户等待时间，访问速度快
		搜索引擎(百度)更喜欢收录“静态页面”
		
	3. 实现静态化
		php代码执行---->缓冲区---->被抓取----->生成静态页面
		
		现在利用php把对应的静态内容从“php缓冲区”里边给抓取出来，并制作静态页面
		以上程序代码在执行的时候，浏览器页面就没有输出内容，因为ob_end_clean已经把内容从缓冲区删除了。
		
	Flush刷新:数据从PHP缓冲区里边输出出来提供给用户的工程，若不使用flush删除，内容最后会自己刷新出来	
</pre>

### OB相关函数
<pre>
	开启缓冲
		ob_start()   
		php.ini       output_buffering=4096;
	
	获取内容：
        ob_get_contents();  //获取
        ob_get_clean();     //获取后清空
        ob_get_flush();     //获取刷新
	清空
		ob_clean()      //删除缓冲区内容
		ob_get_clean(); //获取并删除缓冲区内容
		ob_end_clean(); //清空并关闭缓冲区

	刷新(缓冲区内容自然做输出，给用户的浏览器显示)
		ob_flush()          //数据向下推送
		ob_get_flush();     //获取内容并推送内容
		ob_end_flush();     //推送内容并关闭缓冲区
		(没有调用flush时，每个php脚本结束后会自动flush，把内容呈现给用户)
	关闭
		ob_end_clean();     //清空关闭
		ob_end_flush();     //刷新关闭		
</pre>

### 总结
<pre>
	1.大量数据写入操作
		减少索引的维护次数
		Myisam表处理
		关掉索引
		写入大量数据
		开启索引
		Innodb表
		事务解决
		start  transaction;
		大量数据写入
		commit; 提交
	2.单表、多表查询
		网站访问量一般，适合使用多表查询
		网站访问量很高(每天1000万pv(point view))，对数据库要求有很高并发性，最好单表查询
	3.limit
		where 和 limit结合可以提高查询速度。where后边使用到了索引
	4.order by  null  强制不排序
	5.静态化
		实现：
		从php缓冲区获得内容、制作静态文件即可
</pre>

### tp项目对静态化的应用
<pre>
	在项目后台添加商品的时候  就给商品的详情生成静态页面
	前台就直接访问商品的静态详情页面。
	如果后期商品数据有修改，就根据修改后的信息重新生成静态页面就可以了。

	利用一个私有方法，实现静态页面制作，这样各种操作(添加/修改)直接调用该makehtml方法即可，非常方便：
</pre>

### 静态页面局部刷新
<pre>
	一个静态页面全部的内容都是固定的，但有的时候局部数据是随时需要变化的
	可以利用ajax随时感知变化的信息再显示。
	通过ajax给静态页面显示变化的信息
</pre>

### session_start/header()/setcookie()与php缓冲区的关系
<pre>
	缓存：缓存是可以看得见的，例如有缓存文件，数据较持久
	缓冲：是一个临时存储区域，其数据都是运行在内存中，数据容易消失
	session_start、header()函数、setcookie()设置cookie等语句在使用的时候前边不能有输出，否则系统要报错。
	
	注意：输出的语句最好放到session_start(),setcookie()还有header()函数
</pre>

### 伪静态
<pre>
	我们在网站输入的url地址是静态的地址，但是内部走是的“动态”的程序。
	伪静态就是一个伪装效果。
		http://网址/product/goods.php
		http://网址/product/goods.html
		
	伪静态好处：
		① 对搜索引擎(seo)的收录有好处
		② 用户使用体验非常好	
		
	1.伪静态配置
		apache(iis  tomcat  nginx)可以配置使用伪静态
		修改httpd.conf,开启伪静态的重写模块支持：
			
			LoadModule rewrite_module_modules/mod_rewrite.so
	
	    虚拟主机配置，添加AllowOverride All项目：
			在apache虚拟主机设置 AllowOverride All,并重启apache，同时覆盖.htaccess
	
	2. 伪静态简单使用
		访问：http://web.0710.com/week/order.xml
		真实指向地址： http://web.0710.com/week/order.php

		在被操作的“目录”下创建一个伪静态规则文件 “.htaccess”
		文件较特殊，需要DOS命令行： >echo a > .htaccess 创建
		
		
</pre>

### .htaccess内部编辑伪静态规则：
<pre>
	#开启重写开关
	RewriteEngine on
	
	RewriteRule ^order\.xml$ order\.php
</pre>

### 带参数指向
<pre>
	访问：http://web.0710.com/week/cat_567.xml
	真实指向地址： http://web.0710.com/week/cat.php?id=567
	访问：http://web.0710.com/week/dog_567_wangcai_beijing.xml
	真实指向地址：
	http://web.0710.com/week/dog.php?id=567&name=wangcai&addr=beijing
	
	Options +FollowSymLinks
	RewriteEngine on
	RewriteRule ^order\.xml$ order.php
	RewriteRule ^dog_(\d+)_([a-z]+)_([a-z]+)\.xml$ dog.php?id=$1&name=$&addr=$3
	
	#如果访问的主机域名地址是通过"www.0710.com"开始就要走的规则
	RewriteCond %{HTTP_HOST} web.0710.com  [访问旧域名，自动转跳到新域名]
	
	#需要转跳到web.0609.com域名进行访问
	RewriteRule (.*) http://web.0609.com/sun/$1
	
	#需要
	
	规则都是使用的是正则表达式
	$1 $2 $3 为正则表达式的模式1，2，3的括号内容
</pre>

### 隐藏index.php入口文件
<pre>
	#开启重写开关
	RewriteEngine on
	
	#访问的不是一个文件file
	RewriteCond %{REQUEST_FILENAME} !-f
	#访问的不是一个文件directory
	RewriteCond %{REQUEST_FILENAME} !-d
	
	#(.*)代表请求的时候后续给传递的内容
	#例如:http://web.0710.com/single/abc/def
	#(.*)代表abc/def
	RewriteRule ^(.*)$ index\.php/$1
</pre>

### tp框架的伪静态
<pre>
	有伪装后缀：login.html
	pathinfo路径模式是伪静态体现:
	路由设置伪静态:
</pre>

### 总结
<pre>
	1.纯静态应用
		tp项目引用
		在后台添加商品同时给前台生成一个静态页面
		
		可以通过ajax随时更新静态页面的局部的变化信息
		
		静态化好处：
			节省服务器资源
			提高请求速度
			便于搜索引擎收录

		一般新闻信息、文章信息 适合做纯静态。
	2.伪静态
		使用的地址是静态的，程序的执行是动态的
		
		apache层面
			在apache的httpd.conf内部开启rewrite模块
			虚拟主机开启Allowoverride  all(作用可以使得我们在任何一个apache主机文件目录下都可以使用.htaccess文件)		

			具体使用：简单使用、带参数使用、隐藏index.php入口文件、域名跳转
		php层面(tp框架、其他框架也有)
</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>

### 
<pre>

</pre>