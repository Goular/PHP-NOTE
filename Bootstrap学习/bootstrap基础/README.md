# Bootstrap

### Bootstrap简介
<pre>
	一套丰富的预定义样式表
	一组基于JQuery的JS插件表
	移动设备优先
	灵活的响应式栅格系统
	
	这个BootStrap是一套响应式设计框架，由下面的内容组成:
		CSS组件	JavaScript插件
		基础布局组件	12栅格系统
	
</pre>

### HTML标准模板
<pre>
	HTML5文档结构
	移动设备优先
	BootStrap css引入
	JQuery引入
	BootStrap.js引入
</pre>

# 栅格系统布局
### 响应式设计
<pre>	
	页面的设计与开发应当根据用户行为以及设备环境（系统平台，屏幕尺寸、屏幕定向等）进行相应的响应和调整，具体的实践方式由多方面决定，包括弹性网络布局、图片使用等。
	无论有户在平板上还是pc上应该能够自动切换分辨、图片尺寸及相关脚本等，以适应不同设备
	响应式设计是就一个网站能够兼容多个终端，而不是为每个终端特定的一个版本
</pre>

### 栅格实现原理[必须包含在.container之中]
<pre>
	把网页总宽度平分为12分，开发人员可以自由按分组合，以便开发出简洁方便的程序
	仅仅通过定义容器大小、平分12分，再调整内外边距，最后结合媒体查询，就制作出强大的响应式栅格系统
	栅格系统用于通过一系列的行（row）与列（column）的组合来创建页面布局，你的内容就可以放入这些创建好的布局中。下面就介绍一下 Bootstrap 栅格系统的工作原理：

	“行（row）”必须包含在 .container （固定宽度）或 .container-fluid （100% 宽度）中，以便为其赋予合适的排列（aligment）和内补（padding）。
	通过“行（row）”在水平方向创建一组“列（column）”。
	你的内容应当放置于“列（column）”内，并且，只有“列（column）”可以作为行（row）”的直接子元素。
	类似 .row 和 .col-xs-4 这种预定义的类，可以用来快速创建栅格布局。Bootstrap 源码中定义的 mixin 也可以用来创建语义化的布局。
	通过为“列（column）”设置 padding 属性，从而创建列与列之间的间隔（gutter）。通过为 .row 元素设置负值 margin 从而抵消掉为 .container 元素设置的 padding，也就间接为“行（row）”所包含的“列（column）”抵消掉了padding。
	负值的 margin就是下面的示例为什么是向外突出的原因。在栅格列中的内容排成一行。
	栅格系统中的列是通过指定1到12的值来表示其跨越的范围。例如，三个等宽的列可以使用三个 .col-xs-4 来创建。
	如果一“行（row）”中包含了的“列（column）”大于 12，多余的“列（column）”所在的元素将被作为一个整体另起一行排列。
	栅格类适用于与屏幕宽度大于或等于分界点大小的设备 ， 并且针对小屏幕设备覆盖栅格类。 
	因此，在元素上应用任何 .col-md-* 栅格类适用于与屏幕宽度大于或等于分界点大小的设备 ， 并且针对小屏幕设备覆盖栅格类。 因此，在元素上应用任何 .col-lg-* 不存在， 也影响大屏幕设备。
</pre>

### 媒体查询
<pre>
	媒体查询是进行响应式设计的核心要素，其功能非常强大
	Bootstrap主要用到min-width,max-width以及and语法，用于在不同的分辨率下设置不同的css样式
	
	示例：
		@media(max-width:767px){
		/*在小于767px的屏幕里，这里的样式才生效*/
		}
		@media(min-width:768px) and (max-width:991px)
		{
		/*768-991px屏幕里，这里的样式才生效*/
		}
		@media(min-width:1200px)
		{
		/*大于1200px屏幕里，这里的样式才生效*/
		}
</pre>

### 布局容器
<pre>
	Bootstrap 需要为页面内容和栅格系统包裹一个 .container 容器
	.container?类用于固定宽度并支持响应式布局的容器。
	.container-fluid?类用于 100% 宽度，占据全部视口（viewport）的容器
	浏览器宽度4种类型：<768px,>=768px,>=992px、>=1200px
</pre>

### 栅格布局基本用法
<pre>
	列组合：col-md-*
	列偏移:col-md-offset-*,
	列嵌套
	列排序 .col-md-push-*  .col-md-pull-*
</pre>

### 栅格参数
<pre>
	跨设备组合定义
	
	清除浮动clearfix visible-xs
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

### 
<pre>

</pre>

### 
<pre>

</pre>