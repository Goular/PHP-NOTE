#AJAX使用第二天

###昨天回顾
<pre>
	AJAX的get请求，由于中文和特殊字符的问题需要javascript的encodeUrlComponnet
	AJAX的post请求，需要注意的是在send(字符串)之前，open()方法之后，需要添加xhr.setRequestHeader(),借用此方法把requestbody以xml方式传递

	利用responseXML返回的dom对象是xml对象

	ajax消除缓存有两种方法，一种是直接在访问连接地址上加上随机数，以求缓存的作用每次都不一样，第二种办法是php返回的文件中添加三个消除缓存的header()
</pre>

#JSON
###什么是json
<pre>
	json: javascript  object  notation（javascript对象符号）

	其是我们之前学过js的“字面量对象”
	其是一种数据交换格式(之前的xml也是数据交换格式)。

	JSON和XML都是数据交换的格式

	为了各种语言(java/php/.net/javascript)的网站用户方便使用该数据接口，其接口的数据格式最好是大家都可以识别的，因此json/xml就被应用上了。
	json的生成和处理要比xml更加方便，因此在许多领域json正逐步取代xml的使用。


	PHP中JSON的方法
	json_encode()
	json_decode()

	JavaScript将JSON字符串读取出来的办法,使用eval出来并显示对象方法
	eval("var result = "+json_str);
</pre>

###json的使用
<pre>
2.1 javascript里边json体现
	json在javascript里边就是字面量对象
	var obj = {名称:值，名称:值，名称:function(){}}
2.2 通过php生成json信息
	json_encode(数组/对象)------------>生成json信息
	json_encode(关联数组)---->json对象
	json_encode(索引数组)---->js数组
	json_encode(索引关联数组)---->json对象
	json_encode(对象)---->json对象

在php中生成json信息：
(json信息在php中的数据类型是字符串)

2.3 php处理json信息
	json_decode(json信息，boolean); 反编码json信息
	对json字符串信息进行反编码，变为当前语言可以识别的信息。
	json_decode(json字符串,true)--->array
	json_decode(json字符串,[false])--->object

php中反编码处理json字符串信息：

2.4  javascript接收处理json信息
ajax获得接口信息，javascript本身处理json信息
通过eval()把接收的json字符串变成真实的对象信息
</pre>

###3.json改造ajax无刷新分页
<pre>
ajax的每次请求都要从服务器获得三部分信息，对 带宽、服务器资源、用户等待时间 等资源都要占据三份，我们要做优化：把不发生变化的css样式、html标签 放到客户端手动生成，从而减轻服务器端的工作、减轻带宽浪费。
此时服务器端数据可以通过json格式传递回来(之前是html标签格式)

在服务器端通过$info的二维数组把全部数据给组织起来并生成json信息

在分页index.html页面把”html标签”和获得”数据”做结合


总结：使用json无刷新进行分页，并使用json作为数据传递的格式，能够进一步降低网络传输的数据量

</pre>

#无刷新表单信息提交
###收集表单信息
<pre>
	利用新技术FormData表单数据对象，可以实现快速收集表单信息。

	FormData是html5的新技术，在主流浏览器都可以正常使用。

传统方式(javascript+dom+ajax)无刷新收集表单信息和提交

新技术FormData+ajax实现无刷新方式收集并提交表单信息
</pre>

###总结
<pre>
1.json: javascript  object  notation
是一种数据交换格式
2.php中生成、解析json
json_encode(数组/对象)
json_decode(json字符串,true/false)
3.javascript中处理解析json信息
eval(“var jn_info=”+json字符串);
4.利用json改造ajax无刷新分页效果
5.FormData快速收集表单信息
var  fd = new FormData(form元素节点对象)
ajax对象.send(fd);
</pre>

###ajax无刷新附件上传
<pre>
< form  enctype=”multipart/form-data”>
< input  type=”file”>
服务器端：$_FILES接收附件信息(name/error/size/type/tmp_name)
	error:
		0---->ok
		1---->大小超出php.ini限制
		2---->大小超出MAX_FILE_SIZE表单域限制
		3---->附件只上传了一部分
		4---->没有上传附件

move_uploaded_file(附件临时路径名，真实附件路径名);

收集附件信息：
	dom方式只可以收集普通的表单域信息，并且浏览器由于安全方面的限制也禁止通过javascript语言操作本地文件。

可以利用FormData实现附件信息的收集:普通表单域 和 上传文件域 均可以收集。

在服务器端收集到“普通表单域”和“上传文件域”信息
</pre>

###使用FormData注意
<pre>
①每个表单域必须有name属性
②重点，在form标签里边无需设置enctype=”multipart/form-data”属性(即使有上传文件域也不需要设置)
③ajax通过post方式传递FormData的数据不需要设置setRequestHeader()方
④普通表单域的特殊符号无需编码
</pre>

###上传大附件进度条设置
<pre>
php.ini开放大附件上传限制

ajax对象有成员upload，该upload成员是一个对象，本身有onprogress事件
该事件每间隔100ms左右就执行一次，执行的时候可以感知附件已经上传和总大小等信息，
使得“已经上传大小”和“总大小”做对比可以获得上传附件的百分比，进而就可以设置进度条。
</pre>

###进度条具体设置
<pre>
	xhr.upload.onprogress
</pre>

###ajax聊天室
<pre>
买火车票，在电脑上下单，在手机上支付宝支付，支付成功后，电脑上也显示支付成功。
利用”反向推技术”。 电脑浏览器定时向服务器发起请求判断车票是否有付款。
反向推技术就是轮询技术，在客户端每间隔一定时间就去完成一定的任务。

在电脑浏览器上，当下完单之后，就每间隔2s就去服务器查看下是否有付款，当通过手机付款成功后，电脑浏览器自然也就会感知到。
</pre>

###及时显示聊天内容
<pre>
避免获得重复聊天内容：
解决：把已经获取聊天信息的最大id回传给服务器端，让服务器端感觉最大id做对比查询。
</pre>

###天气预报设置
<pre>
浏览器由于安全方面的问题，禁止ajax跨域请求其他网站的数据。
解决：利用本域php代理间接获得其他网站的数据。

浏览器的js是不能进行跨域的，所以只能通过自身服务器的php来进行间接的访问

1. 天气信息获取注意事项
不同地区需要显示该地区对应的天气信息。

ip地址------->城市------->城市编码
① 通过ip地址 获得 城市信息
http://ip.taobao.com/service/getIpInfo.php?ip=9.9.9.9
② 通过城市 获得 城市编码
③ 通过城市编码 获得天气信息
http://www.cnblogs.com/wangjingblogs/p/3192953.html

www.tianqi.com网站已经把 ip/城市/编码 的关系都给处理好了，可以直接调用获得城市对应的天气信息。

通过接口显示天气信息
</pre>

###总结
<pre>
1.ajax无刷新方式附件上传
FormData实现收集附件信息
2.大附件上传进度条显示
ajax对象->upload->onprogress事件
3.ajax版聊天室
4.天气预报显示
ajax不能跨域请求
php可以跨域请求

显示天气预报原理：
用户ip地址------>城市----->城市编码
</pre>
