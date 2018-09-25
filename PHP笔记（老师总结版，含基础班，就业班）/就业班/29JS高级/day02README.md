#JavaScript高级第二天

###DOM
<pre>
dom: document  object  model  文档对象模型
DOM技术：
	php里边有：php语言 与 xml/html标签之间沟通的一个桥梁。
	javascript里边有：js语言 与 html/xml标签之间沟通的一个桥梁。

DOM可以让我们通过javascript语言对html文档进行增、删、改、查操作。

为了方便javascript语言通过dom操作html文档比较方便，
把html文档的各个组成内容划分为各种节点(对象)：
文档节点(document)，其是html根节点的父节点
元素节点
文本节点
属性节点
注释节点
</pre>


###元素节点获取
<pre>
具体操作方法：
① document.getElementById(id属性值);
每次只返回一个具体元素节点对象
② document.getElementsByTagName(tag标签名称);
每次返回一个“集合列表”对象，可以通过下标方式变为具体元素对象：
列表[下标] 或 列表.item(下标)
③ document.getElementsByName(name属性值);不推荐使用，有浏览器兼容问题,
有的浏览器针对form表单域才可以使用该方法。
通常应用在form表单里边，返回的信息同②，不是form的标签中使用该方法，很容易造成unfined的情况

    var it = document.getElementsByTagName('input');
    console.log(it);
    console.log(it['username']);//对象使用username进行获取
    console.log(it.useremail);//数组以对象属性进行获取
    console.log(it.item(0));//item方法为dom方法
</pre>


###文本节点获取
<pre>
< div>hello< / div>
需要借助div元素节点再获得其内部的文本节点:
div元素节点对象.firstChild;  //或调用lastChild，获得节点内部的第一个子节点
文本节点.nodeValue;  //获得文本节点对应的文本信息
</pre>


###子节点/兄弟节点
<pre>
firstChild、lastChild:父节点获得第一个/最后一个子节点
nextSibling:获得下一个兄弟节点
previousSibling:获得上一个兄弟节点
childNodes:父节点获得内部全部的子节点信息，注意这个是列表
length: 获得“集合列表”的长度
以上属性在主流浏览器(火狐firefox、chrome、safari、opera、IE9以上)中会给考虑空白节点(回车、空格)。在IE(6/7/8)浏览器中不考虑空白节点。

空白节点本质：其是文本节点,即从上一个前标签的空白位到下一个标签前的空白位
</pre>


###父节点
<pre>
节点.parentNode;
</pre>

#属性操作
###属性值操作
<pre>
< input type=”text”  name=”username”  value=”tom” class=”orange” />
< a href=”http://www.baidu.com”  addr=’beijing’ target=”_blank”>百度</a>
①获取属性值
元素节点node.属性名称;   //只能操作w3c规定的属性
元素节点node.getAttribute(属性名称);  //规定的 和 自定义的属性都可以获取
②设置(修改)属性值
元素节点node.属性名称 = 值;  //只能操作w3c规定的属性（style）
元素节点node.setAttribute(名称，值); //规定的 和 自定义的属性都可以设置
</pre>

###需要注意，想获取class属性，不能直接.class,需要写成.className

###属性节点获取
<pre>
var attrlist = 元素节点对象.attributes;  //以“数组列表”形式返回对应节点内部的全部属性节点信息
attrlist.属性名称;   //获得具体属性节点

获得节点类型nodeType：
节点.nodeType:
1------> 元素节点
2------> 属性节点
3------> 文本节点
9------> 文档节点

获取属性节点及类型判断：
</pre>

###注意，只有节点的insertBefore方法和replace方法能够进行新节点的接入

###节点创建和追加
<pre>
节点创建
元素节点：document.createElement(tag标签名称);
文本节点：document.createTextNode(文本内容);
属性设置：node.setAttribute(名称，值);
节点追加：
父节点.appendChild(子节点);
    父节点.insertBefore(newnode,oldnode); //newnode放到oldnode的前边
	父节点.replaceChild(newnode,oldnode); //newnode替换到oldnode节点

单个节点的创建追加
批量节点的创建和追加
点放到指定位置 和 替换节点操作
已有节点的追加、替换操作
</pre>


###节点复制操作
<pre>
被复制节点.cloneNode(true/false);
true:深层复制(本身节点 和 其内部节点)
false:浅层复制 (本身节点)
<div id=”apple”>hello</div>
</pre>


###节点删除
<pre>
父节点.removeChild(子节点);
子节点.parentNode.removeChild(子节点);
</pre>

###dom对css样式操作
<pre>
< div style=”width:300px;height:200px; background-color:pink;”></div>
①获取css样式
元素节点.style.css样式名称;
divnode.style.width;  //获取宽度样式
②设置css样式(有则修改、没有则添加)
	元素节点.style.css样式名称 = 值;
divnode.style.width =‘500px’;设置div宽度样式

注意：
①dom操作css样式只能操作“行内样式”(css样式分为 行内、内部、外部)
②操作复合样式例如background-color/border-left-color，font-size
需要变为backgroundColor、borderLeftColor，fontSize中恒线去掉，后边首字母大写。(原因：javascript的变量命名规则不允许有“-”中横线)
③ 修改样式，有则修改、无则新增,修改后的样式变为行内样式

样式的获取和设置
</pre>


###dom对css样式操作
<pre>
< div style=”width:300px;height:200px; background-color:pink;”></div>
①获取css样式
元素节点.style.css样式名称;
divnode.style.width;  //获取宽度样式
②设置css样式(有则修改、没有则添加)
	元素节点.style.css样式名称 = 值;
divnode.style.width =‘500px’;设置div宽度样式

注意：
①dom操作css样式只能操作“行内样式”(css样式分为 行内、内部、外部)
②操作复合样式例如background-color/border-left-color，font-size
需要变为backgroundColor、borderLeftColor，fontSize中恒线去掉，后边首字母大写。(原因：javascript的变量命名规则不允许有“-”中横线)
③ 修改样式，有则修改、无则新增,修改后的样式变为行内样式

样式的获取和设置


</pre>

#事件操作
###什么是事件
<pre>
通过鼠标、键盘对浏览器页面所做的动作就是事件。
事件一旦发生需要有事件处理，该处理称为“事件驱动”，事件驱动通常由函数担任
onclick：鼠标点击
onmouseover：鼠标移入
onmouseout：鼠标移出
onkeyup：键盘按下并抬起
onkeydown：键盘按下
onchange：内容改变
onblur：失去焦点
onfocus：获得焦点
onsubmit：表单提交
</pre>


#设置事件
###dom1级方式设置
<pre>
①< input  type=”text”  onclick=”函数名称()” />
	function 函数名称(){this[window]}

②< input  type=”text” onclick=”过程代码this[itnode]” />

③itnode.onclick = function(){this[itnode]}  匿名函数

④itnode.onclick = 函数名称;   有名函数
	function 函数名称(){this[itnode]}

取消dom1级事件：
itnode.onclick = null;

以上是dom1级事件设置的4种具体表现形式，this关键字除了第①种其代表window对象，其他三种都代表事件节点对象本身。
</pre>


###dom2级方式事件设置
<pre>
1) 主流浏览器方式(包括IE9以上 版本浏览器)：
itnode.addEventListener(事件类型，事件处理[，事件流]);  		//设置
itnode.removeEventListener(事件类型，事件处理[，事件流]);   	//取消
2) IE浏览器方式(IE6/7/8)：
itnode.attachEvent(事件类型，事件处理);  	//设置
itnode.detachEvent(事件类型，事件处理); 	//取消

	事件类型：就是我们可以设置的具体事件，例如onclick/onmouseover等
              主流浏览器方式没有”on标志”，例如addEventListener(‘click’，...);
			  IE浏览器方式有”on”标志，例如attachEvent(‘onclick’)
	事件处理：事件驱动，可以是一个有名/匿名 函数
			  例如addEventListener(‘click’,function(){}/有名函数);
	事件流：true捕捉型、[false冒泡型]
	
事件取消(removeEventListener/detachEvent)操作具体要求：
①事件处理 必须是有名函数，不可以是匿名函数。
②事件取消的参数与绑定的参数完全一致(数量/内容)

dom2级事件设置的特点：
①可以为同一个对象设置多个同类型事件。
②事件取消也非常灵活。
③对事件流也有很好的处理控制。

dom2级事件简单设置

可以为同一个对象绑定多个同类型事件

通过有名函数设置事件

事件取消操作

</pre>

###事件流
<pre>
多个彼此嵌套元素，他们拥有相同的事件，最内部元素事件被触发后，外边多个元素的同类型事件也会被触发，多个元素他们同类型事件同时执行的效果称为“事件流”

事件流分为两种类型：
冒泡型：事件从内部往外部依次执行。
捕捉型：事件从外部往内部依次执行。
//addEventListener(类型，处理，事件流true捕捉/[false冒泡]);

IE浏览器从开始到后期事件流始终是“冒泡型”的，直到IE9以后版本两种都开始支持。
网景的Navigator浏览器(现在火狐浏览器的许多血统来源于navigator浏览器)一开始的事件流是”捕捉型”。后期事件流有改进，针对捕捉型、冒泡型都可以支持。

对事件流类型的控制
</pre>


#事件对象
<pre>
事件对象，每个事件(包括鼠标、键盘事件)触发执行的过程中，都有对应的事件对象，通过事件对象可以获得鼠标相对页面的坐标信息、通过事件对象也可以感知什么键子被 触发执行、通过事件对象还可以阻止事件流产生、阻止浏览器默认动作。
</pre>


###获得事件对象
<pre>
获得：
①主流浏览器(IE9以上版本浏览器)：
	事件处理函数的第一个形参就是 事件对象
	例如：
	node.onclick = function(evt){evt就是事件对象}
	addEventListener(类型,function(evt){}/函数名字);
		function 函数名称(evt){}
	红色的evt就是事件对象
② IE(6/7/8)浏览器
	node.onclick = function(){window.event事件对象}
	全局变量event就是事件对象
全局变量直接上级对象是window。可以通过window访问全局变量信息。
window.document.getElementById()

获取事件对象
</pre>


###事件对象作用
<pre>
1) 获得鼠标的坐标信息
	event.clientX/clientY;    //相对dom区域坐标
	event.pageX/pageY;        //相对dom区域坐标，给考虑滚动条距离
	event.screenX/screenY;    //相对屏幕坐标

2) 阻止事件流：
	event.stopPropagation();  //主流浏览器
	window.event.cancelBubble = true; // IE(678)浏览器
	冒泡型、捕捉型都可以进行阻止,为了阻止比较有意义，只考虑冒泡型即可。

3) 感知被触发键盘键子信息
	event.keyCode  获得键盘对应的键值码信息
	通过事件触发时候获得的keyCode数值码信息可以对应键盘的键子信息。

4) 阻止浏览器默认动作
	浏览器默认动作，注册form表单页面，提交表单的时候，浏览器的页面会根据action属性值进行跳转，这个动作称为“浏览器默认动作”。
	form表单提交的时候，需要对各个表单域进行验证，如果验证失败则禁止浏览器跳转。

	event.preventDefault(); 	//主流浏览器(dom1和dom2级事件都起作用)	
	event.returnValue = false; 	//IE(678)浏览器
	return  false;          	//dom1级事件设置起作用
</pre>


###5.加载事件onload
<pre>
	什么是加载事件：
	js代码执行时候，需要html&css的支持，就让html代码先执行(先进入内存)，js代码后执行
	js代码在最后执行的过程就是“加载过程”，通常通过“加载事件”实现加载过程

	加载事件onload可以保证js代码后于html&css执行，其要在最后执行。
	
	具体设置：
	<body onload=”加载函数()”>
	window.onload = 匿名/有名 函数;  //推荐
</pre>

#BOM
<pre>
DOM：document  object model(文档对象模型)
BOM:browser  object  model(浏览器对象模型)
通过BOM技术可以模拟浏览器对页面进行各种操作：创建子级标签页面、操作历史记录页面、操作地址栏等等

获取和设置浏览器地址栏信息
通过setInterval和 clearInterval实现时钟显示和停止效果
</pre>


###总结
<pre>
1.dom2级事件操作
元素节点.addEventListener(类型，处理，事件流);
元素节点.removeEventListener(类型，处理，事件流);

dom2级事件特点：
① 同一个对象可以设置多个同类型事件
② 事件取消非常灵活
③ 可以操作事件流

2.事件流操作
多个彼此嵌套的元素，它们同类型事件按照顺序依次执行的过程就是“事件流”
类型：冒泡型、捕捉型
3.事件对象
1) 获取事件对象
主流浏览器：事件处理函数的第一个形参
2) 事件对象作用
① 获得鼠标坐标
② 获得被触发键子信息
③ 阻止事件流产生(冒泡)
④ 阻止浏览器默认动作
4.加载事件
该事件可以保证js代码在最后执行，先执行html和css代码
window.onload = (有名/匿名)函数;
<body onload = 函数()>
5.BOM浏览器对象模型
location.href 获取地址栏信息、修改地址信息进行页面跳转
</pre>
