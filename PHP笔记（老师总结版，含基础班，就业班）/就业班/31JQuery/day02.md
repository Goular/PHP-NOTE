#JQuery学习笔记(第二天)

##记住，选择器除了第一天的介绍外，还有最重要的属性选择器，记住了

###$符号的由来
<pre>
$(‘div’)  $(‘.apple’)  $(‘*’) $(’#id属性值‘)等等。
选择器使用的过程就是函数调用过程。
$符号就是一个函数，函数名称为”$”符号而已。也可以使用“jQuery”符号。

在jquery框架外部使用的$符号本质是一个“函数”，除此之外还可以使用jQuery
它们都是同一个函数的不同名字。并且是通过window声明的“全局变量”
</pre>

###jquery对象 与 dom对象关系
<pre>
jquery对象： $(‘#one’)   $(‘li’)  
等选择器使用返回的信息就是对象，称为“jquery对象”
dom对象： 	document.getElementById()  
		   	document.getElementsByTagName()
等返回的信息就是“dom对象”
</pre>

###互调对方的成员
<pre>
jquery对象 和 dom对象 互调对方成员(以失败告终)
</pre>

###jquery对象封装dom对象
<pre>
jquery对象如何封装的dom对象，它们的内部关系如何？
dom对象 就是jquery对象 的数组组成部分。

$(‘#id属性值’) 封装dom对象原理：
</pre>

#jquery对象 和 dom对象 的转化
###jquery对象--》dom对象
<pre>
$()[下标]

“jquery对象”变为“dom对象”就可以调用其成员
</pre>

###dom对象--》jquery对象
<pre>
$(dom对象)
“dom对象” 变为 “jquery对象” 就可以调用jquery对象的成员：
</pre>

###五. jQuery框架对象分析
<pre>
jQuery框架对象类型：jquery对象  和  $对象
① jquery对象(普通对象)：就是各种选择器创建出来的对象 $(div)$(.class) $(#id)
② $对象就是”函数对象”  $.get()


1.jquery对象
$(‘#one’)---->$函数 ---->new jQuery.fn.init()
$(‘#one’).css()/attr()/addClass()/html()/text()等等，jquery对象 可以调用许多成员方法

jquery对象可以调用的成员一共有三种：
① init本身成员
② fn的成员
③ fn.extend复制继承过来的(常用成员站到90%以上)

2.$对象
$对象使用例如： $.get(url请求地址) ajax请求
$本身就是函数，函数也是对象
在javascript里边可以给函数声明成员(称为”静态成员”)

</pre>

###六. 遍历方法
<pre>
each()遍历方法：
$.each(数组/对象,function处理);  //$对象      调用的
$(选择器).each(function处理);   //jquery对象  调用的
</pre>

###总结
<pre>
1.$符号的由来，其就是函数，除此还可以使用jQuery
2.jquery对象 和 dom对象 的关系
dom对象 是 jquery对象 的数组组成部分
jquery对象====>dom对象： $()[下标]
dom对象====>jquery对象：$(dom对象)
3.jQuery框架对象的分析
两种对象：jquery对象 和 $函数对象

jquery对象可调用的成员来之：
① init构造函数
② fn的成员
③ fn.extend复制继承的

$函数对象的成员也都来extend复制继承
4.each()遍历方法
$.each(数组/对象,function(){});
$().each(function(){});
</pre>

###加载事件
<pre>
javascript的加载事件：
	<body  onload = “函数()”>
	window.onload = function(){}
加载事件作用：使得html和css代码先执行，最后执行javascript代码。

1. jquery加载事件实现
① $(document).ready(function处理);
$(document)是把document的dom对象变为jquery对象
② $().ready(function处理);
$()也是创建jquery对象，不过内部没有dom对象的组成部分
③ $(function处理);  对第一种加载的封装而已

第三种函数选择器$(function)加载事件本质就是对第一种加载事件的封装

2.jquery加载事件与传统加载事件的区别
window.onload = function(){};
$(document).ready(function{});

2.1 设置个数
在同一个请求里边，jquery加载事件的可以设置多个，而传统方式只能设置一个
传统方式加载事件是给onload事件属性赋值，多次赋值，后者会覆盖前者。
jquery方式加载事件是把每个加载事件都存入一个数组里边并成为数组的元素，执行的时候就遍历该数组执行每个元素即可，因此其可以设置多个加载事件。


jquery加载事件在同一个请求里边可以出现多个：
传统加载事件在同一个请求里边只能设置一个：


2.2 执行时机不一样
传统方式加载事件，是全部内容(文字、图片、样式)在浏览器显示完毕再给执行加载事件。
	广告图片小叉隐藏图片显示（在加载事件里边给图片的小叉设置onclick事件）
	用户名输入框有点击隐藏灰色的文字(在加载事件里边给输入框设置onclick事件，隐藏灰色文字)
jquery方式加载事件，只要全部内容(文字、图片、样式)在内存里边对应的DOM树结构绘制完毕就给执行，有可能对应的内容在浏览器里边还没有显示。

jquery加载事件执行时机

3.jquery加载事件原理
onload时间


jquery加载事件是对DOMContentLoaded的封装(非onload)
</pre>

###八.普通(简单)事件操作
<pre>
① dom1级事件设置
	< input  type=”text”  onclick=”过程性代码” value=’tom’ />
	< input  type=”text”  onclick=”函数()” />
	itnode.onclick = function(){}
	itnode.onclick = 函数;
② dom2级事件设置
	itnode.addEventListener(类型，处理，事件流);
	itnode.removeEventListener(类型，处理，事件流);
	node.attachEvent();
	node.detachEvent();
③ jquery事件设置(无需考虑浏览器兼容问题)
	$().事件类型(事件处理函数fn);   	//设置事件
	$().事件类型();               		//触发事件执行

事件类型：click、keyup、keydown、mouseover、mouseout、blur、focus等等	
例如：
$(form).submit()可以使得表单进行提交。		//触发事件
$(‘div’).click(function(){事件触发过程});	//设置事件
</pre>

###九. jquery对文档的操作
<pre>
通过jquery方式实现页面各种节点的追加、删除、复制、替换等操作
</pre>

###1.节点追加
<pre>
1.1 父子关系追加
1.2 兄弟关系追加

2.节点替换
	$().replaceWith();  被动替换
	$().replaceAll();    主动替换

3.节点删除
	$(父节点).empty(); 		//父节点清空子节点
	$(匹配节点).remove();  	//删除指定的节点

4.复制节点
$().clone(true)    //节点 和 其身上的事件都给复制
$().clone(false)   //只给复制 节点 本身(包括节点内部信息)

dom的节点复制操作：
cloneNode(true/false)
true: 深层复制(本身节点和内部节点)
false: 浅层复制(本身节点)
<div>123</div>
</pre>

###十.属性选择器使用（重点）
<pre>
十.属性选择器使用

< input  type=”text”  name=”username”  id=”username”  class=”pear”  addr=’beijing’ />
$([name])   节点内部必须有”name名称”属性存在
$([name=value])  name属性值等于value
$([name^=value])  name属性值以value开始
$([name$=value])  name属性值以value结尾
$([name*=value])  name属性值必须包括value字样(位置不要求)
$([name!=value])  name属性值不等于value(没有name属性也可以)
$([][][][][])  并且关系，多个属性选择器构成“并且”关系
</pre>

###总结
<pre>
1.加载事件使用
三种形式：
$(document).ready(function);
$().ready(function);
$(function);

加载事件区别(jquery与传统)：
① 设置个数
② 执行时机

jquery加载事件原理，其是对DOMContentLoaded的封装.
2.简单事件设置
$().事件类型(function);  设置事件
$().事件类型();         触发事件
3.文档操作
a)节点追加
父子：append()  prepend()  appendTo()  prependTo()
兄弟：after()   before()  insertAfter()   insertBefore()
b)替换
replaceWith() 被动
replaceAll()  主动
c)删除
$(父节点).empty()
$(匹配节点).remove()
d)复制
$().clone(true/false)
4.属性选择器
[name]  [name=value]  [name^=value]   [name$=value]
        [name*=value]  [name][name!=value]   [][][][]
</pre>
