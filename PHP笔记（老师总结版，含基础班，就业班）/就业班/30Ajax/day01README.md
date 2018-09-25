#AJAX使用第一天

###什么是ajax
<pre>
Ajax:  asynchronous  javascript  and  xml (异步javascript和xml)
其是可以与服务器进行(异步/同步)交互的技术之一。
ajax的语言载体是javascript。其是浏览器的一个技术
</pre>

#AJAX最大特点
<pre>
最大特点：页面不刷新(用户体验非常好)
</pre>

###ajax技术是许多旧技术的集合
<pre>
xhtml、css、javascript、xml、xmlhttprequest对象(ajax对象)
	其中XMLHttpRuquest是ajax的官方的名称。

AJAX其实是在2005年才流行起来的
</pre>

#ajax使用
###创建ajax对象
<pre>
1.1 主流浏览器方式
	火狐、chrome(google)、safari(苹果)、opera包括IE7以上版本的浏览器
	
	var xhr = new XMLHttpRequest();

1.2 IE(6/7/8)方式
	var xhr = new ActiveXObject(“Microsoft.XMLHTTP”);  //最原始方式
	var xhr = new ActiveXObject(“Msxml2.XMLHTTP”);    //升级
	var xhr = new ActiveXObject(“Msxml2.XMLHTTP.3.0”);  //升级
	var xhr = new ActiveXObject(“Msxml2.XMLHTTP.5.0”);  //升级
	var xhr = new ActiveXObject(“Msxml2.XMLHTTP.6.0”);  //IE维护的最高版本
</pre>

###发起对服务器的请求
<pre>
	请求的服务器端页面
	ajax对服务器端请求的结果：生成02.txt文件并追加内容
</pre>

###ajax接收服务器返回信息
<pre>
ajax可以接收什么信息？
答：浏览器可以接收的信息ajax都可以接收，例如字符串、html标签、css样式内容、xml内容、json内容等等。

ajax接收返回的信息，需要结合readyState/onreadystatechange/responseText等属性一并操作：
onreadystatechange事件最多感知4种状态改变信息
ajax对象常用属性和方法
ajax完整服务器端信息的接收

readystate的5种状态
0:对象已经建立，但是没有未初始化
1:对象已建立，但尚未调用send方法
2:send方法已经调用，但是当前的状态及http头未知
3:数据传输中，已接收了部分数据，因为响应和http头部不全，展示用过responsebody和responseText获取部分数据出现错误
4:数据接收完成，此时可以通过responsebody和responseText获取完整的回应数据
</pre>

###ajax最重要的对象属性
<pre>
onreadystatechange 事件处理句柄
readystate 当前请求的状态，只读
responsebody 
responsetext
responsexml
status :200,300,400,500
statustext
</pre>

###ajax对象常用方法
<pre>
xmlhttprequest 对象常用方法：
open
send
setRequestheader
</pre>

###get和post方式的ajax请求
<pre>
ajax对象.open(get/post, 请求地址);

4.1 两者的不同
① 给服务器传递数据量
   get方式的大小是受限于浏览器，大部分浏览器是2k的限制
   每个浏览器的限制不一样  chrome就是8K
		http://网址/index.php?name=tom
		上述请求通过get方式传递了9个字节的信息
		1024字节 = 1k
   post原则没有限制，php.ini对其限制为8M
② 安全方面，post传递数据较安全
③ 传递数据的形式不一样
	get方式在url地址后边以请求字符串形式传递参数
	http://网址/index.php?name=tom&age=23&addr=beijing
	蓝色部分就是请求字符串，就是一些“名-值”对，中间使用&符号连接。
post方式是把form表单的数据给请求出来以xml形式传递给服务器
</pre>

###ajax之get方式请求
<pre>
ajax之get请求需要注意的两个地方：
① 在url地址后边以请求字符串(传递的get参数信息)形式传递数据。
② 对中文、=、&等特殊符号需要编码处理

对特殊信息的处理：
在浏览器里通过get参数传递一些特殊符号信息会被误解混淆，例如 &  = 等，浏览器会把这样的信息当做get参数的一部分而进行一个错误的解析，为了避免这种情况发生，可以对该信息进行编码处理。有的浏览器传递中文会出现不识别问题，也可以进行编码处理。
(编码后的信息是相对底层的信息，浏览器会自动识别，获取的时候无需反编码)
①．在php里边可以函数 urlencode()/urldecode()对特殊符号进行编码、反编码处理
②．在javascript里边可以通过encodeURIComponent ()对特殊符号等信息进行编码。

(以上红色函数可以把”特殊符号、中文”转变为浏览器可以识别不会混淆的信息。
编码后的信息为%号后接两个十六进制数)


ajax通过get方式进行触发请求

在php中通过get方式传递特殊符号可以通过urlencode()进行处理
</pre>

###ajax之post方式请求
<pre>
ajax之post请求需要注意的四个地方：
① 给服务器传递数据需要调用send(请求字符串数据)方法
② 调用方法setRequestHeader()把传递的数据组织为xml格式(模仿form表单传递数据)
③ 传递的中文信息无需编码，特殊符号像 &、=等 仍需要编码
④ 该方式请求的同时也可以传递get参数信息，同样使用$_GET接收该信息

form表单的数据是通过xml格式发送给服务器端的

ajax进行post请求

服务器端处理
</pre>

###总结
<pre>
1.ajax对象创建
var xhr = new XMLHttpRequest();
var xhr = new ActiveXObject(‘Msxml2.XMLHTTP.6.0’);
2.ajax对象成员
a)属性：responseText、readyState、onreadystatechange
b)方法：open()、send()、setRequestHeader()
3.get请求和post请求
</pre>

###同步、异步
<pre>
ajax对象.open(方式get/post,  url地址, [异步true]/同步false);

ajax是可以与服务器进行(异步或同步)交互的技术之一。

异步：同一个时间点允许执行进程。
同步：同一个时间点只允许执行一个进程。
</pre>

###什么时候使用同步请求
<pre>
ajax绝大多数情况下进行异步请求，但是有的时候也要使用“同步请求”(其不能被取代)。例如页面有两部分内容，①ajax请求内容 和 ②正常的html内容输出，如果html的输出内容包括ajax请求的内容，就需要使得ajax请求完成了再进行html内容的输出，这样就要设置两者一前一后调用(而非同时调用)，既要进行同步请求。
</pre>

###ajax无刷新分页效果
<pre>
1. 无刷新分页的必要性
	如果我们通过“传统方式”实现上图的商品评论分页效果，每次分页的时候就会使得头部、左侧、底部等已经显示的信息重新从服务器获得出来，这样对带宽、服务器资源、用户等待时间都有额外的损耗。如果使用ajax无刷新分页，每次就只从服务器获得“商品评论区域”信息即可，对各方面资源的使用就有相应节省。因此ajax无刷新分页效果有其存在必要性。
2. 具体实现
	 商品总记录条数、每页显示多少条
	mysql数据库关键字limit。
	limit  偏移量，长度。
	偏移量：(当前页码-1)*每页显示条数。
	limit  0,7  
	limit  7,7
	limit  14,7

	ajax无刷新分页是对传统分页效果的封装：
	http://网址/data.php?page=1
	http://网址/data.php?page=2
	http://网址/data.php?page=3
	http://网址/data.php?page=4
	ajax对象.open(‘get’,’./data.php?page=3’);
	以上是ajax通过无刷新方式获得第3页数据
</pre>

###2.1制作分页
<pre>

2.1制作传统分页效果
2.2制作ajax无刷新分页效果


重点，传统与ajax的区别是，在a标签中的href从原来的地址改为执行javascript代码，即<a href = "javascript:showPage(...)">

页面加载完毕通过ajax无刷新方式获得第1页信息
在page.class.php里边把超链接的地方都改为ajax函数的调用：
</pre>

###四. ajax对xml信息的接收和处理
<pre>
php可以接收处理xml信息
javascript也可以接收处理xml信息
开发微信接口，微信里边大部分数据都是通过xml形式给组织起来的
这样就有需求，php的网站要和微信进行数据交换
		      静态网站(html/css/javascript)也要这微信进行数据交换

客户端(javascript+dom)<-----------ajax<-------------服务器端的xml信息

ajax负责请求xml和接收xml信息，dom负责处理xml信息
dom：
	php里边，dom是php与xml(html)之间的沟通桥梁
	javascript里边，dom是javascript与html(xml)之间沟通桥梁

返回到客户端被javascript处理
ajax：负责请求xml回来
DOM(javascript)：负责处理xml信息

掌握ajax+javascript对xml的接收处理技术,可以方便我们后期实现静态网站(html+css+javascript)对各个xml接口数据的处理。
</pre>

###ajax对缓存的处理
<pre>
缓存：
浏览器的一次请求需要从服务器获得许多 css、img、js 等相关的文件，如果每次请求都把相关的资源文件加载一次，对 带宽、服务器资源、用户等待时间 都有严重的损耗，浏览器有做优化处理，其把css、img、js等文件在第一次请求成功后就在本地保留一个缓存备份，后续的每次请求就在本身获得相关的缓存资源文件及可以了，可以明显地加快用户的访问速度。
css、img、js等文件可以缓存，但是动态程序文件例如php文件不能缓存，即使缓存我们也不要其缓存效果。(IE浏览器会缓存动态程序文件)

浏览器对动态程序文件缓存的处理解决：
① 给请求的地址设置随机数[推荐]
② 给动态程序设置header头信息，禁止浏览器对其缓存
</pre>

###重点，解决动态ajax缓存处理的办法
<pre>
① 给请求的地址设置随机数[推荐]
② 给动态程序设置header头信息，禁止浏览器对其缓存
</pre>

###六．thinkphp框架使用ajax
<pre>
（这个由于我没有学习thinkphp的使用而没有做，以后补回来）
</pre>

###总结
<pre>
1.同步、异步
ajax对象.open(请求方式，地址，[true异步]/false同步)
2.ajax无刷新分页效果实现
① 实现传统分页效果
② ajax对传统分页效果实现封装
   ajax对象.open(get,  ‘./data.php?page=n’);
3.ajax对xml信息的接收和处理
responseXML: 以xmldocument文档对象形式返回xml信息
document文档对象/元素对象. getElementsByTagName();
4.缓存处理
① 给请求地址设置随机数[推荐]
② 给动态页面设置header头，禁止浏览器缓存
5.tp框架对ajax使用
</pre>
