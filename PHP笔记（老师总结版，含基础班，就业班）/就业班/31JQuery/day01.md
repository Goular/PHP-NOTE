#JQuery第一天

###什么是jquery
<pre>
其是对javascript封装的一个框架包
简化对javascript的操作
javascript代码：dom获得页面节点对象、ajax操作、事件操作、事件对象
jquery代码：无需考虑浏览器兼容问题、代码非常少
</pre>

###宗旨和特点
<pre>
宗旨：写得代码很少，实现很多的功能
特点：
①语法简练、语义易懂、学习快速、丰富文档。 
②jQuery 是一个轻量级的脚本，其代码非常小巧 
③jQuery 支持 CSS1~CSS3 定义的属性和选择器 
④jQuery 是跨浏览器的，它支持的浏览器包括 IE 6.0+、FF 1.5+、Safari 2.0+和 Opera 9.0+。 
⑤能将 JavaScript (行为)脚本与 HTML (结构)源代码完全分离，便于后期编辑和维护。 
插件丰富，除了 jQuery 自身带有的一些特效外，可以通过插件实现更多功能 
</pre>

#选择器
<pre>
在页面上获得各种元素节点对象而使用的条件就是选择器。
document.getElementById() //返回的是单个元素
document.getElementsByTagName();//返回的是数组
document.getElementsByName();//返回的是数组
</pre>

###1.基本选择器
<pre>
$(‘#id属性值’)  ----------->document.getElementById()
$(‘tag标签名称’)----------->document.getElementsByTagName();
$(‘.class属性值’)	class属性值选择器
$(‘*’)     通配符选择器
$(‘s1,s2,s3’)联合选择器
</pre>

###层次选择器
<pre>
2.1 $(s1  s2) [后代]
派生选择器：在s1内部获得全部的s2节点(不考虑层次)

2.2 $(s1 > s2) [父子]
直接子元素选择器:  在s1内部获得子元素节点s2

2.3 $(s1 + s2) [兄弟]
直接兄弟选择器：在s1后边获得紧紧挨着的第一个兄弟关系的s2节点
$(“div + span”):

2.4 $(s1 ~ s2) [兄弟]
后续全部兄弟关系节点选择器：在s1后边获得全部兄弟关系的s2节点
$(“div ~ span”):
</pre>

###3.并且(过滤)选择器
<pre>
:first
:last
:not
:even
:odd
:eq
:gt
:lt
:header

3.1 基本用法
3.2 复杂用法
	注意：
	① 并且选择器可以单独使用
	② 各种选择器都可以构成“并且”关系
	③ 并且关系的选择器可以使用多个，每个选择器使用前，已经获得节点的下标要“归位”(归零)处理
	④ 多个并且关系的选择器，没有前后顺序要求，但是要避免产生“歧义”
</pre>

###内容过滤选择器
<pre>
4.1 :contains(内容)
包含内容选择器，获得的节点内部必须包含指定的内容

4.2 :empty
获得空元素(内部没有任何元素节点/文本(空) 节点)节点对象
$(“div:empty”)

4.3 :has(选择器)
节点内部必须包含指定选择器对应的元素
$(‘div:has(.apple)’)

4.4 :parent
寻找的节点必须作为父元素节点存在
$(‘div:parent’)

</pre>

###表单域选中选择器
<pre>
复选框、单选按钮、下拉列表
$(:checked)复选框、单选按钮 选中选择器
$(:selected) 下拉列表 选中选择器
</pre>

###总结
<pre>
1.选择器使用
a)基本
#id   .class    tag标签    *    s1,s2,s3(联合选择器)
b)层次
$(s1 s2)
$(s1 > s2)
$(s1 + s2)
$(s1 ~ s2)
c)并且
:first  :last
:eq()  :gt()  :lt()
:odd  :even
$(s1s2s3) 【并且选择器】 获得的节点必须满足s1/s2/s3全部条件
$(s1,s2,s3) 【联合选择器】 获得的节点满足s1/s2/s3其中的一个条件即可
d)内容过滤
:contains(text)  :empty   :has(选择器)  :parent
e)表单域选中
:checked  复选框、单选按钮
:selected  下拉列表
</pre>

###属性操作(注意，input标签的type属性最好不要进行修改)
<pre>
< input  type=”text”  class=”apple”  id=”username”  name=”username” value=”tom” 
	address=”beijing”  />

dom方式操作属性值：
获取：
itnode.属性名称
itnode.getAttribute(属性名称);
修改：
itnode.属性名称= 值;
itnode.setAttribute(属性名称，值);

jquery方式操作属性(attribute)：
$().attr(属性名称);  		//获得属性信息值
$().attr(属性名称，值);  	//设置(修改)属性的信息
$().removeAttr(属性名称); 	//删除属性
$().attr(json对象);  		//同时为多个属性设置信息值，json对象的键值对就是名称和值
$().attr(属性名称，fn);		//通过fn函数执行的return返回值对属性进行赋值
</pre>

###快捷操作
<pre>
1. class属性值操作
$().attr(‘class’,值);		//修改class属性
$().attr(‘class’);		//获取class属性
$().removeAttr(‘class属性’);  //删除class的属性

class具体快捷操作方法：
$().addClass(class属性值);  	//给class属性追加信息值
$().removeClass(class属性值);	//删除class属性中的某个信息值
$().toggleClass(class属性值);	//开关效果，信息值有就删除，没有就添加
</pre>

###标签包含内容操作
<pre>
<div>hello<span>world</span></div>
javascript操作：
dvnode.innerHTML; 			获得div包含的信息
dvnode.innerHTML = XXX；  	设置div包含的内容
(innerHTML不是w3c标准技术，许多浏览器对其有支持而已)

jquery操作：
$().html();   		//获得节点包含的信息
$().html(信息);  	//设置节点包含的内容
	$().text();			//获得节点包含的“文本字符串信息”内容
	$().text(信息);		//设置节点包含的内容(有html标签就把“><”符号变为符号实体)
</pre>

###html() 和 text()方法的区别
<pre>
①获取内容
前者可以获取html标签 和 普通字符串内容
后者只获取普通字符串内容 (会自动过滤html标签)
②设置内容	
前者可以设置html标签 和 普通字符串内容
后者只设置普通字符串内容，如果内容里边有tag标签内容，就把其中的”<”“>”符号转变为符号实体 <-----&lt;  >----&gt;   空格------&nbsp;

以上两种操作(获取/设置)如果针对的操作内容是纯字符串内容，则使用效果一致。
</pre>

###css样式操作
<pre>
$().css(name，value);  	//设置
$().css(name);    		//获取
$().css(json对象);		//同时修改多个css样式

3.1 css()样式操作特点：
//获取的时候，外部，内部，行内样式都会进行获取
//设置的时候仅仅会操作当前元素的行内元素

① 样式获取，jquery可以获取 行内、内部、外部的样式。
dom方式只能获得行内样式
② 获取复合属性样式 需要拆分为"具体样式"才可以操作
(有的浏览器是可以获得复合属性信息的，例如chrome)
例如： 	background 需要拆分为  background-color background-image 等进行操作
	border： border-left-style  border-left-width  border-left-color 等
	margin： margin-left  margin-top 等
③ 样式的设置，会被设置为“行内样式”
   有则修改，无则添加
(复合属性样式可以直接进行设置操作，无需拆分为具体样式)
</pre>

###value属性值快捷操作
<pre>
$().attr(‘value’);		//获取value值
$().attr(‘value’,信息值);//设置value值

快捷操作：
$().val();			//获得value属性值
$().val(信息值);	//设置value属性的值
该val()方法在 复选框、单选按钮、下拉列表 的使用有卓越表现。
</pre>

###复选框操作
<pre>
① 获得被选中复选框的value属性值
② 设置默认情况下哪个复选框被选中

获取选中复选框的value属性值
设置复选框默认选中项目
</pre>

###下拉列表操作
<pre>
① 获取选中项目的value值
② 设置默认选中项目
</pre>

###单选按钮操作
<pre>
单选按钮获取和设置操作

</pre>

###复选框操作
<pre>
全选、反选、全不选
$().attr(‘checked’,true);		//设置复选框选中
$().attr(‘checked’,false);		//取消复选框选中
$().attr(‘checked’);			//判断复选框选中情况，返回布尔值
</pre>

###总结
<pre>
1.属性操作
$().attr(name)
$().attr(name,value)
$().removeAttr(name)
$().attr(json对象);
$().attr(name,function(){return 信息})
2.快捷操作
a)class属性值快捷操作
$().addClass()
$().removeClass()
$().toggleClass()
b) 标签包含内容操作
html()/html(内容)
text()/text(内容)
c) css样式操作
$().css(name)  //获取样式 :行内、内部、外部
$().css(name,value)  //设置样式： 行内
$().css(json对象);
d)  val()   value属性值的快捷操作
$().attr(‘value’)  $().attr(value,值);
e) 	复选框选中、不选中
$().attr(‘checked’,true);
$().attr(‘checked’,false);
$().attr(‘checked’);
</pre>

