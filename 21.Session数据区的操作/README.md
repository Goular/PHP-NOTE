#第二十一天笔记
###__PHP_Incomplete_Class
<pre>
在session反序列化时，若找不到相关的同名类，在var_dump展示类型的时候就会出现__PHP_Incomplete_Class显示到类型上去，解决办法是在session调度前，在内存中include先关的类即可。

注意：对象型数据：
Unserialize()
在session中存储对象时，获取该对象时，需要找到对象对应的类：
</pre>

######数据会在session数据区，采用序列化serlize()方法进行文件的存储，存储到缓存中


###开启session
<pre>
(1)每次使用session，都必须要先开启
当然，PHP支持自动开启session机制
配置 php.ini :
session.auto_start = 1;

重要建议：不要自动开启！因为一般来说，不是所有的网站都需要这个配置，这样做就没有了差异性，因为php.ini是服务于所有网站的.
</pre>

###重点，不要自动开启session的原因
<pre>
最主要的原因是，若使用自动开启session，那就不是实现重写session的自定义操作了，因为重写seesion必须在start_session()之前执行
</pre>

###@符号的作用
<pre>
@ 是忽略错误提示,使其错误消息不会显示在程序里
</pre>

###重复开启Session
<pre>
Session不能重复开启。
一旦重复开启，后边的开启会被 忽略！
但是，会触发一个 notice 级别的错误。
</pre>

###Session属性
<pre>
有效期：
	默认关闭浏览器！

有效路径：/
	默认整站有效

有效域名：
	默认尽在当前域名下有效！

是否仅安全连接传输：
	默认为非

是否HTTPONLY：
	默认为非；


如何设置 session数据的属性？
设置COOKIE中session-ID这个COOKIE变量属性即可！	
设置方案如下：
1.方案一：配置变量php.ini:
session.cookie_lifetime=0;//默认为0的话说明当前session是会话结束立即关闭,即关闭浏览器，就会关闭session
session.cookie_path=/ //默认session的有效路径是整个域名根目录
session.cookie_domain=   //默认为空，那么就是当前的域名，若是子域名的话，那么当前默认的域名就是子域名
session.cookie_secure=   //默认不限制只能使用HTTPS作为访问
session.cookie_httponly =  //默认不禁止浏览器对sessionid进行js的脚本访问

当前配置好上述的内容就重启apache即可


2.方案二：2.在脚本中，开启session之前使用函数进行配置（建议）
Ini_set(配置项，值);用于设置某个PHP配置选项
ini_set('session.cookie_lifetime','3600');
ini_set('session.cookie_domain','.kang.com');


仅当注意的一点是，上述的配置，一定要在session_start()之前进行配置，否则无效，
若是自动开启的话，那么只能在php.ini中进行修改，否则动态修改内容会无效的。
</pre>

###方案三，Session_set_cookie_params，与设置ini是不一样的
<pre>
Session_set_cookie_params(有效期，有效路径，有效域，是否仅安全连接传输，是否HTTPONLY)

仅当注意的一点是，上述的配置，一定要在session_start()之前进行配置，否则无效，
若是自动开启的话，那么只能在php.ini中进行修改，否则动态修改内容会无效的。

建议使用该方法，仅仅影响当前脚本周期。不影响其他项目！

严重建议：
	实际环境中，很少该session的有效期。经常改有效域名。因此使用此方法时的有效期使用0代替
即，session_set_cookie_params(0,'/','.kang.com',false,false);//这个就是全默认的效果
	
</pre>

###重写session的存储机制
<pre>
Session数据区
	默认以 文件的形式存储与服务器操作系统临时目录中！

当 session数据区过多时，文件形式的存储，操作速度变慢。磁盘的读写（IO，input/output）开销是很大的。

实际项目中，都会采用其他的方式更快地存储session数据。典型的办法：数据库，内存。

以 数据库存储为例，讲解：session数据入库！


重写 与 session数据区直接的相关操作即可：
最基本的只有2个：读，写！

一：定义2个可以完成读和写的函数。
二：告知session机制，在需要读写时，使用用户自定义的读写函数完成。

定义2（其实共6个需要的相关函数）个可以完成读和写的函数

告知session机制，在需要读写时，使用用户自定义的读写函数完成
Session_set_save_handler(
	开始函数，结束函数，读函数，写函数，删除函数，GC函数
);
用来将用户自定义的函数，设置成session存储相关的函数。

Tip：以上的语法，仅仅是设置告知，不是调用以上6个函数，这六个函数，在session机制运行到某个时间点时，才会被调用！例如，咋开启session时，才需要调用sessRead()
</pre>

###常规使用session的存储机制步骤
<pre>
该session中，每条记录，就是一个session数据区，相当于原来的一个session文件。
表结构：

读操作：sessRead()
谁调用，谁传参！

在PHP的session机制调用该函数时，会将当前的session-ID作为参数传递到函数中：
因此，需要定一个形参，接受传递的session-ID 参数：

需要返回，读取到的session数据字符串。就是sess_content字段的内容。如果没有读到，则返回空字符串即可，表示没有session数据。

写操作：sessWrite()
当PHPsession机制调用该函数执行写操作时，会将 当前session-ID和 需要写入的内容（序列化好的）传递到函数！

删除操作：sessDelete()
销毁session时。
执行了PHP函数：
Session_destroy();
可以销毁session，删除对应的session数据区，同时关闭session机制！

由于需要删除session数据区，需要增加用于删除的方法：

PHP的session机制，在调用sessDelete时，会传递 当前session-ID作为参数：
需要定义形参来接收：

垃圾回收操作：sessGC()
垃圾：
	服务器上过时的session数据区。


垃圾如何判定？
	如果一个session数据区已经超过多久没有使用（最后一次写操作）了，就是被视为垃圾数据。
	该时间临界点：默认1440s。可以被配置：
配合最后写入时间，就可以断定是否为垃圾啦。
需要增加字段，记录最后写入时间。
判断条件：过期啦。
	Last_write < 当前时间-1440

如何删除？
	在 session_start()过程中，开启session机制过程中：有几率地执行 垃圾回收操作。一旦执行，就会删除所有的过期的垃圾数据区。
	默认的概率为1/1000。
	可以设置该几率：
可能性：

php.ini中有一下特性
session.gc_probability =1//被除数
session.gc_divisor=1000
重启后，那么将会有1000/1的几率执行session的gc方法

调整几率测试：
建议在脚本周期调整，使用函数ini_set(),在开启session机制前完成：

利用参数传递过来的有效时间即可判断出是否删除指定的方法


开始操作sessBegin():
	初始化工作
	可保证在第一个执行。将初始代码，在sessBegin完成：
例如初始化数据库连接：

结尾操作sessEnd()：
	收尾性工作
Return true;


</pre>

###语法细节
<pre>
语法细节
先设置在开启session机制
Session_set_save_handler()先于session_start()被调用。
不要自动开启session！php.ini: session.auto_start = 0

PHP配置项：session.save_handler
PHP所使用的存储机制：
session.save_handler = files //files为默认选项，若执行自行方法的session存储机制
那么可以这样写：
session.save_handler = user;

其实上面的配置都可以使用ini_set进行修改，避免影响其他项目
</pre>


#会话技术总结
<pre>
其实与session相关的配置有:
在php.ini中的配置(可以直接到php.ini文件中修改，但不建议这样做，建议的方法是使用ini_set()方法进行修改):
session.save_handler : files(默认)/user
session.save_path :session以文件存储方式的时候的保存地址
//修改session的相关cookie属性
session.cookie_XXX (lifetime,path,domain,secure,httponly)存储PHPSESSIONID这个cookie变量的属性，最重要的属性是path和domain，一般子域名最好改为用主域名的比较好，path的根目录是'/'

session变量的属性
session.gc_maxlifetime //最大存活时间，一般默认不修改即可
session.gc_probability //访问的可能性
session.gc_divisor //除数

访问的机率为:session.gc_probability/session.gc_divisor,即gc_probability=1，gc_divisor=3时，说明有三分之一的机会访问session会调用gc方法

</pre>

###Session，COOKIE联系和区别？
<pre>
联系
都是会话技术。
Session基于COOKIE，session-ID存储于COOKIE中！

区别：
			Cookie		session
存储位置	浏览器端	服务器端
安全性		低			高
大小限制	有			没有
数据类型	字符串		全部
有效期使用	长时间存储	几乎不做持久化
</pre>


###Session如何浏览器的持久化？
######[理论，一般不会去使用，因为服务器长时间保存session会有出现问题的，最好就是不设置，会话结束时结束本地的sessionid即可，等待gc回收，这样效率会高一点]
<pre>
Session-ID要持久化：session_set_cookie_params(3600);
服务器session数据区有效期修改：ini_set(‘session.gc_maxlifetime’, 3600);
</pre>

###浏览器禁用COOKIE，session是否可用？[理论]
<pre>
COOKIE被禁用，session-Id不能存储和传输。
不可用！


理论上的解决方案：
	通过 URL， 或者 POST数据数据向服务器端，每次传输session-ID！
例如下面的配置：php.ini
Session是否仅仅是用COOKIE完成传输session-ID：

php.ini属性变更可以修改是否仅仅只有以cookie作为session保存的唯一形式:
session.use_only_cookie = 1; //1为是，0为否

还有一个属性，是否通过其他方式自动传输session-ID，通常会自动在get地址栏中添加session和POST的表单中添加input的hidden属性的session属性：

session.use_trans_sid = 0

只有当这两个的配置配好时，才能在表单和地址栏中自动添加sessionid属性


</pre>

###mvc-demo项目
<pre>
同时提供 4 个动作，完成每个frame（框架）部分的实现：
由 动作 完成，不要直接写模板地址！
项目中任何的功能，都是由动作提供的！
</pre>

<pre>
后台实现集中校验,记得需要利用特例来完成逻辑越过，避免重复重定向的产生
</pre>

##最重要的一点是，不要把页面直接写到a标签或者是表单上，需要利用控制器来调用起来，才符合MVC的框架精神
