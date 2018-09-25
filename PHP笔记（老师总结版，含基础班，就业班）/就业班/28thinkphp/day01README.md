#ThinkPHP3.2.3学习笔记（第一天）

#ThinkPHP框架
###什么是框架
<pre>
php框架是许多代码的集合，这些代码是程序结构的代码(并不是业务代码)代码中有许多函数、类、功能类包，框架的代码按照一定标准组成了一个有机的功能体，这个功能体里边有许多设计模式如MVC、单例、AR等等。
</pre>

###不使用框架开发遇到的问题
<pre>
①代码编写没有统一规范，项目生命时间非常短，不延续
②一个小地方的修改会牵扯到全局变化，牵一发动全身
③不能很好满足客户各方面需求
</pre>

###不使用框架开发遇到的问题
<pre>
①代码编写没有统一规范，项目生命时间非常短，不延续
②一个小地方的修改会牵扯到全局变化，牵一发动全身
③不能很好满足客户各方面需求
</pre>

###使用框架的好处
<pre>
①框架可以帮助我们快速、稳定、高效搭建程序系统
②该系统由于框架的使用使得本身的维护性、灵活性、适应客户需求方面得到最大化的增强。
③使用框架的过程中可以使得我们的注意力全部集中在业务层面，而无需关心程序的底层架构。
④可以节省很多的代码工作量
</pre>

###路由形式
<pre>
什么是路由：
答：系统从URL参数中分析出当前请求的分组(平台)、控制器和操作方法的过程就是“路由”。

p框架路由共有4种形式：
①基本get形式
http://网址/index.php?m=分组&c=控制器&a=操作方法
该方式是最底层的get形式、传统的参数传递方式，不时尚、不安全。
②pathinfo路径形式[默认方式]
http://网址/index.php/分组/控制器/操作方法 
http://网址/index.php/Home/Index/advert
③rewrite重写形式(伪静态技术)省略index.php入口文件
	http://网址/分组/控制器/操作方法
	http://网址/Home/Index/index
④兼容形式
http://网址/index.php?s=/分组/控制器/操作方法
http://网址/index.php?s=/Home/Index/advert
以上四种模式除了第③种，其他的url模式都可以使用
</pre>

###创建控制器
<pre>
NameController.class.php
</pre>

###view视图模板(View文件夹是对大小写敏感的)
<pre>
1.简单模板view调用
	$this -> display();   		//模板名称与当前操作方法的名称一致
	$this -> display(模板名称);  		//调用当前控制器对应目录指定名称的模板
	$this -> display(控制器/模板名称);  //调用其他控制器下的具体模板文件

模板文件及目录的创建
(模板文件的上级目录与对应控制器名称有对应关系)


tp框架有两种模式：开发(调试)、生产(线上)[默认]
生产模式：错误提示模糊
开发模式：错误提示友好
在index.php入口文件设置如下常量即可：
define(‘APP_DEBUG’,true);   //开发
define(‘APP_DEBUG’,false);   //生产
</pre>

###已有模板与tp框架做结合（CSS/JS路径最好使用绝对路径，不然在四种路由形式访问下，会出错）
<pre>
具体实现步骤：
a. 复制模板文件到View指定目录
b. 复制css、img、js静态资源文件到系统指定目录
c. 把静态资源（css、img、js）文件的路径设置为“常量”信息(在index入口文件设置) 
d. 在模板文件中通过常量引入静态资源（css、img、js）文件
e. css文件本身的图片设置，其路径相对css文件本身设置
后续a、d重复实现即可
</pre>

###静态资源文件引入
<pre>
在模板中引入css文件，最好不要使用相对路径，会收到路由的影响
(当前目录会收到路由的影响)
</pre>

###正确的引入css静态文件的方式最好是“绝对路径”，相对虚拟主机目录的绝对路径：

###css文件内部的图片是按照自身路径来觉得图片路径的，所以最好使用的是相对路径


###静态资源文件存放
<pre>
静态资源存放原则：通过独立路由可以访问到即可

在模板index.html里边引入css文件，引入地址 是相对index.php入口文件设置：
index.php+Controler控制器+模板文件==混编文件  引入 css文件
</pre>

###css文件引入图片
<pre>
什么方式引入图片：
A.绝对路径：不适合使用，不利于项目的升级、改造、移植等。
B.相对路径：适合使用

一个文件引入另一个文件，被引入文件的相对地址就相对引入文件设置。
① 在模板中引入静态资源文件，路径相对index.php设置
② 在style.css样式文件中引入img图片，路径相对本身style.css文件设置
   (原因是浏览器需要通过独立路由请求,把css样式文件给请求出来，与具体php等其他文件无关)

css文件本身的图片，要设置css文件本身的相对路径进行访问：
</pre>

###2.4 在入口文件处设置常量引入静态资源文件
<pre>
在入口文件index.php里边设置常量以方便静态文件引入
通过常量引入静态资源文件
</pre>

###总结
<pre>
1.创建应用
① 给项目引用创建apache虚拟主机服务
② 在运行目录下边存放tp框架目录  和  项目目录
③ 在每个项目目录下边直接创建index.php入口文件
④ 在index.php入口文件直接引入 ThinkPHP/ThinkPHP.php接口文件接口
2.四种路由形式
① get形式路由
② pathinfo路径路由形式
③ rewrite重写路由形式
④ 兼容路由形式
3 创建控制器
4 创建view视图模板
 	display()
display(模板名称)
display(控制器/模板名称)
已有模板与tp框架做结合
</pre>

#六.后台页面搭建
###分组设置
<pre>
分组：
	同一个项目里边，由于业务规则的划分，有多个相关的功能模块，它们都有独立的控制器、view视图、配置文件、函数库文件等文件，为了开发维护方便，就给它们创建独立的分组出来，每个分组都有自己的控制器、view视图、配置文件、函数库文件。
	如果还有其他的业务功能模块，也都是独立的，可以继续创建分组。

对分组进行访问：
http://网址/index.php/分组/控制器/操作方法 

在shop项目里边创建一个Admin后台分组，该分组与Home是平级的
</pre>

###3.1 获得当前请求的全部常量信息：
<pre>
tp框架提供了常量：
http://网址/shop/index.php/分组/控制器/操作方法/名称1/值/名称2/值
__MODULE__: 路由地址分组信息 （/shop/index.php/分组）
__CONTROLLER__: 路由地址控制器信息  （/shop/index.php/分组/控制器）
__ACTION__:路由地址操作方法信息 （/shop/index.php/分组/控制器/操作方法
）
__SELF__: 路由地址的全部信息(/shop/index.php/分组/控制器/操作方法/名称1/值/名称2/值）
MODULE_NAME:  分组名称
CONTROLLER_NAME：控制器名称
ACTION_NAME: 操作方法名称
</pre>

###4. frame的src属性值
<pre>
每个frame的src属性值需要通过独立路由地址访问,给每个src根据__CONTROLLER__常量设置绝对路径。


frame的src属性值要设置独立路由地址的绝对路径
(为了后期维护方便，使用__CONTROLLER__常量代表路由的一部分)


重点 tp框架有替换机制，会把模板中出现的一些特殊信息替换为具体常量信息
(例如__CONTROLLER__字符串替换为常量信息)

重点：：这里直接使用常量 __CONTROLLER__，是由于Library文件夹中，存在ContentReplaceBehavior.php,用于匹配模板来输出内容的，所以不需要直接写echo
</pre>

###5.后台商品相关页面搭建
<pre>
控制器：GoodsController
操作方法：function  tianjia/showlist/upd()
模板：View/Goods/tianjia.html   showlist.html  upd.html
</pre>

##七. 细节处理
###配置文件介绍(有三个层次)
<pre>
① ThinkPHP/Conf/convention.php  系统主要配置文件
② shop/Common/Conf/config.php   当前shop项目的配置文件
							针对各个分组起作用
③ shop/Home/Conf/config.php      当前shop项目Home分组的配置文件
以上三个配置文件，如果存在同名的配置变量，后者会覆盖前者。

系统里边并不是全部的配置变量都有在convention.php里边定义
A. 大部分在convention.php有定义
B. 在Behavior行为文件里边有定义一部分(例如：SHOW_PAGE_TRACE)
C. 在框架的代码角落里边有零星的一点配置变量(例如：MODULE_ALLOW_LIST)
</pre>

###2. 页面底部设置跟踪信息
<pre>
需要在配置文件里边定义配置变量(SHOW_PAGE_TRACE)

重要，C()函数可以读取或设置配置变量：
C(name,value) //设置
C(name) //读取

调用C()函数使得头部方法不要显示跟踪信息
由于分组的配置文件是全局控制的，所以需要在特定的页面渲染时不想加载页面的SHOW_PAGE_TRACE时候，需要使用C方法，动态的来设置配置信息
在head()方法下写下面的内容，就不会输出trace的内容
C('SHOW_PAGE_TRACE',false);
$this->dislay();

在Behavior行为文件里边有调用配置变量,要想获得预期的结果，最好在配置文件里边定义起来。
</pre>

###3.默认分组设置
<pre>
在shop/Common/conf/config.php里边定义默认分组设置

上图会把User想象成是分组，引入tp框架系统没有比较，要给其设置一个比较参数，告诉其什么内容才是分组。


在shop/Common/Conf/config.php里边给shop项目设置默认分组和允许访问的分组列表信息

框架代码角落里边访问的零星的配置变量
</pre>

###4. 框架的两种模式
<pre>
开发和生产模式
入口文件index.php：
define(‘APP_DEBUG’,true);  //开发调试模式
define(‘APP_DEBUG’,false);  //线上生产模式【默认】

修改index.php入口文件可以设置具体使用模式

开发模式(调试模式)：
	每次请求会加载每个应用程序文件，比较耗费资源，错误提示比较友好。
	会自动清除common~runtime.php文件，会依次加载每个需要的文件
	
生产模式(线上模式):
	该模式比较节省资源，会把请求过程中的一些通用程序文件给“编译”到一个文件里边(shop/Runtime/common~runtime.php)，这样系统的每次请求加载的文件数目就比较少(节省了许多文件打开、关闭的开销)
	错误信息模糊，不方便调试

生产模式下依旧可以使用SHOW_PAGE_TRACE的常量内容
</pre>

###5.开启Smarty模板引擎
<pre>
{}与css或js有冲突解决：
① 在{}与内容中间设置空格
② 使得{}左右标记不在同一行
③ 设置{literal}{/literal}
④ 外部方式引入css、js文件内容
⑤ 变换smarty的标记符号

可以通过配置TMPL_ENGINE_CONFIG配置变量为Smarty做相关配置

在shop/Common/Conf/config.php里边为Smarty做相关配置
</pre>

###总结
<pre>
1.为shop项目制作一个后台分组Admin
2.在后台Admin给管理员搭建登录页面
模板文件、静态资源文件、设置静态文件访问常量、
在模板中通过常量访问静态资源文件
3.搭建后台“品”字首页面
IndexController: left  head  right   index
frameset框架集
frame标签的src属性值设置路由访问头部、左侧、右侧的页面
src属性值要设置绝对路径地址
4.系统相关常量(showcontentreplace类中集成的)
__CONTROLLER__
__MODULE__
__ACTION__
__SELF__
CONTROLLER_NAME
MODULE_NAME
ACTION_NAME
5.框架细节
配置文件
(convention.php   shop/Common/Conf/config.php  shop/Home/Conf/config.php)
配置变量
底部显示跟踪信息  SHOW_PAGE_TRACE =>true
默认分组使用  MODULE_ALLOW_LIST
Smarty模板引擎切换
</pre>
