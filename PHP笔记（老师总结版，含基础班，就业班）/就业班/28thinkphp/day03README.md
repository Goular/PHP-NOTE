#ThinkPHP第三天

###最重要的就是命名空间的创建前必须前面没有内容，否则会报错

###TP框架session和cookie操作
<pre>
session(name); //获取指定session信息
session(name,value);//设置session信息
session(name,null);//删除指定session信息
session(null);//清空session信息

cookie(name); //获取指定cookie信息
cookie(name,value);//设置cookie信息
cookie(name,null);//删除指定cookie信息
cookie(null);//清空cookie信息
</pre>

###昨天总结
<pre>
PHP常量的的访问是没有$号的，静态变量是存在$号的

1.两种方式实例化model对象
普通model对象创建： new  \Model\XXXModel();
父类Model对象: D()   D(‘User/Goods’)
2.查询数据
a)select()  二维数组返回结果
select()  select(数字)   select(“n1,n2,n3...”)
b)find()   一维数组返回结果，只返回一条记录
find(数字)
3.辅助方法
where()/field()/limit()     order()/group()/having()

$model -> where()->field()->limit() ->order() ->select()
function  where/field/limit/order/group/having(){
xxxx
return  $this;
}
4.添加数据add()
a)数组
b)AR(active record)方式
add()方法返回新记录主键id值
5.修改数据save()
a)数组
b)AR方式
注意：两个条件必须二选一  where()  或 主键id值pk
save()方法返回受影响记录条数
6.删除数据delete()
delete(数字)  delete(“n1,n2,n3..”)
where()->delete()

$model -> user_id=100;
$model -> delete();
7.在后台实现商品的添加、修改操作
a)商品添加
添加数据的form表单(表单展现)
收集form表单数据，数据入库(数据收集)
function  tianjia(){
if(!empty($_POST)){ 数据收集 }else{表单展示}
}
b) 数据修改
表单展示、收集数据
① 利用pathinfo方式传递get参数信息  
http://网址/index.php/分组/控制器/操作方法/name1/value1/name2/value2
② 在操作方法里边设置形参接收get参数信息
function 操作方法($name1,$name2){}
8.执行原生sql语句query()/execute()
9.表单验证实现
通过create()方法触发表单自动验证
(create()方法还有收集数据、过滤数据、非法字段过滤等等功能)
制作表单验证规则UserModel.class.php
protected  $_validate = array(
array(字段，规则，提示信息[，条件，附加规则，时间]),
)
</pre>

#二. 命名空间(namespace命名空间)
###1. 什么是命名空间
<pre>
在php程序语言里边，语法规则要求同名称的函数、类名、常量在一个请求里边不允许出现多次。如果有的应用程序不得已必须出现多个同名的 函数、类名、常量，那么我们就可以把它们放到不同的空间里边做请求。这个不同的空间就称作“命名空间”。

同一个请求里边定义两个同名的函数getInfo()，右图由于有使用命名空间，使得程序可以正常执行。

同名称的两个函数在同一个空间进行访问系统要报错

同名称的两个函数放到不同空间做访问，就不会报错
</pre>

###2. 使用命名空间
<pre>
通过namespace关键字声明命名空间。
namespace  空间名称;
(空间名称 按照php正确的命名方式定义即可)

命名空间针对 函数、类名、const常量 三部分起作用，并统称为“元素”。
常量的声明：
define(名称，值);   	//(在类外部声明常量)与命名空间没有关系
//同名称常量只能define一次
const  名称=值;  		//与命名空间有关系
		① const可以在类的内部声明常量信息(类常量)
② const也可以在类外部声明常量(正常常量)
使用命名空间的时候const可以放到类外部声明常量。
同名称的多个常量，可以分别定义到不同的“命名空间”里边

const和define的区别：
前者针对命名空间发生影响，后者不发生影响。
const可以声明多个同名称的常量
define对同名称常量只能声明一个
</pre>

###使用命名空间注意注意事项
<pre>
1.同名称的函数在公共空间使用会报错
2.空间的名称与具体上级目录没有直接关系，按照php正确的命名方式定义即可
3.访问元素，元素在“没有任何限制”的时候，会访问"当前空间"元素；当前空间：上边挨着最近的空间就是当前空间
</pre>

###3. 子级(多级)空间
<pre>
命名空间可以让我们存放许多元素(函数、类、常量)，有的时候元素比较多，为了管理方便，可以对元素进行分门别类地存储。也就是说命名空间可以设置为多级空间。多级空间的最后一级空间就称为“子级空间”

多级空间的声明及空间元素的访问：
</pre>

###3.1 空间元素访问的三种形式
<pre>
① 非限定名称
	echo Animal::$name;   就近访问上边与其挨着最近空间的Animal元素
	(类似php引入文件：include “common.php”;      相对路径
引入当前目录下的common.php文件)
② 限定名称
	echo beijing\Animal::$name;  把当前空间 和 beijing空间联合获得Animal元素
	(类似php引入文件：include “Common/Conf/config.php”;  相对路径)
③ 完全限定名称
	echo \beijing\Animal::$name;  访问beijing空间的Animal元素
	(类似php引入文件：include “d:/web/1121/Conf/common.php”; 绝对路径引入文件)

访问空间元素的两种方式：
限定名称访问元素：
</pre>

###4.引入机制
<pre>
命名空间可以声明为多级空间，这个多级空间元素在其他空间内部访问的时候，不得已需要通过 完全限定名称 方式，这个完全限定名称不方便开发、维护，为了降低代码的复杂度，可以在当前的空间把指定的空间给引入进来，进而可以方便地通过“限定名称”的方便的形式使用其他空间的元素。

4.1 空间引入
use 空间;

4.2 类元素引入
use  空间\空间\空间\类元素;

空间引入 可以解决完全限定名称访问元素的繁琐性，但是还需要通过“限定名称”方式访问，仍然不够简便，如果引入空间的元素是类，就可以直接把这个类引入到当前空间，使用的时候也就可以通过“非限定名称”方式访问，非常便捷。
(只能做“类元素”引入，函数和常量不可以)

空间类元素的引入及使用

4.2.1 别名使用
use  空间\元素  as  别名;
把其他空间的一个“类元素”引入到当前空间，如果当前空间也有一个“同名”的类元素，则引入元素 与 当前空间元素就会有冲突，为了避免冲突产生，可以给引入空间元素起一个别名。

引入的Animal与当前空间Animal有冲突：
为了避免引入类元素  与 当前空间类元素有冲突，给引入的类元素起别名：
</pre>

###5. 公共空间(公共空间的内容前直接在前面使用\符号即可，使用当前空间的内容不需要使用标识，直接写就可以了)
<pre>
一个php文件里边没有namespace关键字声明，则该文件的元素都存在于“公共空间”
访问公共空间的元素统一设置为：  \元素
举例子：
两个文件：a.php    b.php     (a.php  include引入b.php)
1  a.php有namespace  b.php没有   (b.php处于公共空间)
被引入的文件空间针对当前空间不发生影响。

通过“非限定名称”访问访问一个元素(函数、常量)
① 首先获得本空间元素
② 其次获得公共空间元素

通过非限定名称  和 公共空间方式 访问各自空间的元素：

2.a.php没有namespace   b.php 有  (a.php 处于公共空间)

访问公共空间元素要设置”\”斜杠，提高代码可读性，访问其他空间元素要设置空间信息：

</pre>

###6. 命名空间使用注意
<pre>
1)声明命名空间的当前脚本的第一个namespace关键字前面不能有任何代码(header头代码也要写在下边)
2)命名空间是虚拟抽象的空间，不是真实存在的目录
3)同一请求的多个文件可以使用同名称的命名空间，
只要这些文件里边不出现多个同名称、同类型的元素就可以
</pre>

#三．验证码
###1.生成验证码
<pre>
在ManagerController控制器的verifyImg操作方法里边实现验证码效果

两种方式实例化Verify对象：完全限定名称、空间类元素引入
</pre>

###总结
<pre>
1.命名空间的使用
a)针对三种元素有起作用：类、函数、const常量
b)三种方式访问空间元素：
完全限定名称、限定名称、非限定名称
c) 多级空间
d) 引入机制(空间引入、空间类元素引入、别名机制)
e) 公共空间
    注意：php脚本文件的第一个namespace关键字前边除了注释，不能有任何代码
2.tp框架命名空间的使用
</pre>

###四．附件上传
<pre>
涉及技术点：
<form enctype=”multipart/form-data”>
< input type=”file”>
</form>
$_FILES接收附件信息
name  size  tmp_name  type  error
(error:0没有问题   1/2大小超限制   3只上传部分附件   4没有上传附件)
move_uploaded_file(临时路径名附件，真实路径名附件)

为添加商品表单页面增加一个上传图片的文件域：
在控制器里边接收到的附件信息：
Upload类的uploadOne()方法执行成功后会返回一些附件保存到服务器的相关信息：
在Goods/tianjia操作方法里边实现图片的上传逻辑：
</pre>

###五．缩略图
<pre>
原理：
把一个已有图片的打开
裁剪出已有图片的某个部分，该部分经过放大、缩小的处理，之后再把处理好的部分放到另外一个图片里边显示出来。具体使用imagecopyresampled函数实现

涉及技术点：
打开一个已有图片:imagecreatefromjpeg()  imagecreatefrompng()  
创建一个目标图片(白板):imagecreatetruecolor()
对图片的一部分进行缩放处理：imagecopyresampled();

在Goods/tianjia操作方法里边实现给原图制作“缩略图”逻辑：
在index.php文件设置一个网站域名常量(以方便上传图片通过绝对路由地址访问)：
在模板中把上传好的图片给显示出来
</pre>

###
六．数据分页
<pre>
1.给tp框架项目制作工具类
	给shop项目自定义Page工具类：
	制作Page分页工具类

2.利用分页工具类实现分页效果
	数据分页效果：
	在Goods/showlist操作方法里边，利用自定义Page工具类实现数据分页效果：
	在模板中显示页面列表：
</pre>

###总结
<pre>
1.验证码使用、上传图片、制作缩略图
Think\Verify
Think\Upload
Think\Image

实现以上功能类对象有两种方式：
① $obj = new  \Think\类名字();    //完全限定名称
② use  Think\类元素名称;    //空间类元素引入
   $obj = new 类名称();
2.为自己的项目封装功能类
shop/Tools/Page.class.php
namespace Tools;
class  Page{}
shop/Tools/Video/Play.class.php
namespace Tools\Video;
class Play{}
3.利用Page工具类实现分页效果
4.后台管理员登录系统实现
在ManagerModel里边实现checkNamePwd()方法，校验用户名和密码
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



