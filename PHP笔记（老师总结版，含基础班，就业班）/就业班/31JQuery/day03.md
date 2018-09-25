#JQuery学习笔记(第三天)

#事件绑定
###1. 事件绑定(注意多事件绑定是使用一个空格进行阻隔)
<pre>
jquery事件的简单操作：
	$().事件类型(function事件处理);
	$().事件类型();

1.1 jquery事件绑定
	事件绑定后可以很方便地取消绑定。

$().bind(事件类型，function事件处理);
	$().bind(类型1 类型2 类型3，事件处理);   //给许多不同类型的事件绑定同一个处理
//不同事件使用”一个”空格分隔
	$().bind(json对象);						//同时绑定多个不同类型的事件
	(事件类型：click  mouseover  mouseout  focus  blur 等等)
	事件处理：有名函数、匿名函数



1.2 取消事件绑定

之前取消事件：
dvnode.onclick = null;   //dom1级事件取消
dvnode.removeEventListener(类型，(有名)处理，事件流);  //dom2级事件取消

jquery方式取消事件绑定：
① $().unbind(); 				 	//取消全部事件(无视事件类型、无视处理函数类型)
② $().unbind(事件类型);   		//取消指定类型的全部事件(无视处理函数类型)
③ $().unbind(事件类型，有名(事件)处理函数);  	//取消指定类型事件的指定处理
注意：第③种取消事件绑定，事件处理必须是有名函数。(这个方法是一个事件绑定多个触发，解除指定的方法的引用而使用的)	
</pre>

###2. 事件对象、阻止浏览器默认动作、阻止事件冒泡
<pre>
$().bind(‘click’,function(evt){ });
$().click(function(evt){});
$().bind(‘mouseover’,f1);
function f1(evt){}
事件对象：就使用红色的evt即可，在jquery框架内部有做浏览器兼容处理。
以上红色的evt对主流的事件对象 和 IE的事件对象有封装。
	
	以上jquery事件的具体操作是对javascript底层代码的封装，具体：
	dvnode.onclick = function(evt){}
	dvnode.addEventListener(类型,funciton(evt){})
	dvnode.attachEvent(类型，function(){window.event})
	红色的evt是对绿色evt/event的封装

阻止浏览器默认动作、阻止事件冒泡：
	dom2级浏览器默认动作阻止：
		事件对象.preventDefault();    主流浏览器
		事件对象.returnValue = false;   IE浏览器
	dom2级事件冒泡阻止：
		事件对象.stopPropagation();    主流浏览器
		事件对象.cancelBubule = true;   IE浏览器
	
在jquery里边：
	$().bind(‘click’,function(evt){
		evt.preventDefault();
		evt.stopPropagation();
	});
	preventDefault()方法是jquery的方法，名字与js底层代码的名字一致而已。
	             并且其有做浏览器兼容处理
	stopPropagation()方法是jquery的方法，名字与js底层代码的名字一致。
			     其有做浏览器兼容处理
</pre>

#四.动画效果
###1.基本动画
<pre>
show(speed,[callback]) 显示隐藏匹配元素
hide(speed,[callback]) 隐藏显示的元素
toggle() 切换元素的可见状态
toggle(switch) 根据switch参数切换元素的可见状态
toggle(speed,[callback])
	以优雅的动画切换所有匹配的元素的可见状态

</pre>

###2.垂直动画
<pre>
slideDown(speed,[,callback]) 显示元素
slideUp(speed,,[,callback]) 隐藏元素
slideToggle(speed,[,callback]) 切换所有匹配元素的可见性
</pre>

###3.颜色渐变动画
<pre>
fadeIn(speed,[,callback]) 不透明淡入显示
fadeOut(speed,[,callback]) 通过不透明的变化来实现淡出效果（即隐藏）
fadeTo(speed,opacity,[,callback]) 把所有匹配元素的透明度以渐进方式调整到指定不透明度
</pre>

###五．jquery封装的ajax
<pre>
具体操作：
$.get(url  [,data]  [,function(msg){}回调函数]   [, dataType]);

	data:给服务器传递的数据，请求字符串 、json对象 都可以设置
	funtion(msg){}：回调函数，ajax请求完成后调用该函数，可以在此函数完成ajax的后续处理，msg泛指从服务器传递回来的信息
	dataType：服务器返回数据类型，html、text、xml、json

$.post(url   [,data]  [,fn回调函数]  [, dataType]);
	该方法与$.get()方法使用完全一致，不同的是其为post方式请求
给服务器传递数据的时候，不需要设置header头

(以上两种ajax请求是异步的，如果需要设置同步请求，就换其他方法)
$.ajax({  //json对象
		url:请求地址,
		[data]:给服务器传递的数据(请求字符串/json对象)
		[dataType]:默认字符串返回信息，数据从服务器返回格式html、text、xml、json
		[type]:[get]/post请求方式
		[success]:function(msg){}  ajax成功请求后的回调函数，可以做后续处理使用
msg泛指服务器返回来的信息
相当于readyState==4的处理逻辑函数部分
		async:[true]异步/false同步，
		cache:[true]缓存/false不缓存,
})

</pre>

###总结:
<pre>
1.事件绑定
$().bind(类型，处理函数);
$().bind(类型1 类型2 类型3，处理函数);
$().bind(json对象);
2.取消绑定
$().unbind()
$().unbind(事件类型);
$().unbind(事件类型，处理函数[有名]);
3.动画效果
基本：show(速度，[回调函数])  hide(速度，[回调函数])  toggle()
垂直：slideDown()  slideUp()   slideToggle()
颜色渐变：fadeIn()   fadeOut()  fadeTo()
4.封装的ajax使用
$.get(url,[data,fn,dataType])
$.post()
$.ajax({url:  data:   type:   success:   dataType})
</pre>

###六.地区三级联动
<pre>
涉及技术点：jquery + Ajax + xml

1.省份的获取和显示
2.显示对应城市信息
根据选中的省份显示对应的城市信息，给省份下拉列表设置onchange内容改变事件。

xml文档不适合频繁请求，在第一次请求回来之后就赋予到一个全局变量xmldom里边，供后续访问使用：

从城市向地区切换
</pre>

###七. 迷你版jquery框架开发
<pre>
选择器：#id、tag标签、dom节点
方法：css()、attr()、each()方法

学习”迷你版jquery”可以认识到的地方：
①jquery里边的大部分方法有“遍历机制”
jquery方法里边的参数this是代表dom对象

1.制作选择器
2.各种方法的封装
	each()方法内部的this、m、n的来由。

</pre>

###jquery插件开发
<pre>
1. 什么是jquery插件
jquery框架本身给我们提供了一些方法供使用。但是方法的数目是有限的，其不能任意满足我们对各种功能的需求。那么我们自己可以来给jquery框架开发、扩展一些额外功能方法。

给jquery框架开发、扩展额外方法的过程就是“插件开发”
插件作用：避免写重复代码，简化开发
2. 制作一个应用插件
3. 两种形式丰富方法
①  给$.fn丰富成员(该成员可以给jquery对象使用)
	$.fn.成员 = 值;
	$.fn.extend(json对象);
②  给$函数对象丰富成员(该成员可以给$对象使用)
	$.成员 = 值;
	$.extend(json对象);
给jquery对象丰富成员：
给$函数对象丰富成员：

4. 使用”成品jquery插件”的步骤
① 引入jquery的插件文件
② 引入对应的css样式文件、img图片、辅助的相关js文件
③ 检查jquery插件对本身jquery是否有要求
</pre>

###总结
<pre>
1.地区三级联动案例
知识点：jquery+ajax+xml
$(父节点).find(子节点选择器)
2.迷你版jquery框架开发
选择器：#id   tag标签   dom对象
方法： css()  attr()   each()
注意：jquery的每个方法都有遍历机制
     this在jquery内部如何代表dom对象
3.插件开发
我们自己给jquery增加方法的过程就是插件开发

可以给两种对象增加方法
1)jquery对象
$.fn.成员名称= 值;
$.fn.extend(json对象);
2)$对象
$.成员名称 = 值;
$.extend(json对象);
</pre>

###
<pre>
插件开发的三种办法
1.$.extend(json对象)；
2.$.fn.属性 = ；
3.$.fn.extend(json对象);
注意，第一和第三的意思是一样的，因为
jq.fn.init.prototype = jq.fn;



//init构造函数通过原型方式继承fn
//结果：init实例化的对象可以调用fn成员
jq.fn.init.prototype = jq.fn;
window.$ = jq;
</pre>

