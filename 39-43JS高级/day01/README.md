#JavaScript高级
###重点：for..in 既可以遍历数组也可以遍历对象，for只能遍历索引数组，关联属性是不能遍历的
###使用语法规范
<pre>
① 在html代码里边引入js语言
	<script  type=”text/javascript”>具体js代码</script>
	<script  type=”text/javascript” src=”js文件”></script>
② 代码大小写敏感
	true/false       布尔值
	TRUE/FALSE   非布尔值
	php语言大小写敏感(其中函数名、类名、类方法名称不敏感) $name  $NAME
③ 结束符号
   每个简单语句使用”;”分号结束，与php类似
   在javascript里边，该分号不是必须的，但是推荐使用
④ 注释
	//  单行注释
/*多行注释*/
⑤ 变量
	其值可以发生改变的量就是变量。
	变量是内存中运行的最小单位
	var name = “tom”;
	var age = 23;
	var address_123 = ‘北京’;

变量名字命名规则：
php里边：字母、数字、下划线组成，开始有$符号标志，$符号后边数字不能作为第一个连接内容。
$shoudu = “huashengdun”;
$beijing = “shoudu”;
$path = “beijing”;
$$$path = “./web/”;   //$$beijing  ----> $shoudu   $shoudu = ‘./web/’ //可变变量
$23color = “red”;    //错误的命名方式

js里边：字母、数字、下划线、$符号、汉字 等5个组成部分，数字不能作为名字的开始内容。
var  shoudu = “xxxx”;
var abc_$_123 = “hello”;
var  首都 = “北京”;
var 99_num = 101;  //错误变量名字
⑥ 数据类型
php(8种)：int  float  string  boolean  array  object  null   resource

javascript(6种):  number(int/float)  string   boolean   null   undefined   object
          (数组是对象的一部分)

null类型：空对象 类型。
问：什么时候使用null？
答：使用null声明变量可以提高代码可读性，
	可以预先声明一个null类型的变量，后期使用一个具体对象进行赋值。
	var  name = “”;
	var  age  = 0;
	var  per  = null;   //先声明，后期再使用具体对象进行赋值

undefined未定义类型：使用一个没有声明的变量。

⑦ typeof 判断变量的数据类型
判断变量的数据类型：
</pre>

###重要的类型的分类
<pre>
php(8种)：int  float  string  boolean  array  object  null   resource

javascript(6种):  number(int/float)  string   boolean   null   undefined   object
          (数组是对象的一部分)
</pre>

###Number数值数据类型
<pre>
1. 各种进制数表示

各种进制数变为十进制数：
	各个位数数字 * 进制数的(位数-1)次方 的算数和

2. 浮点数
	带小数点的数。

3. 最大数、最小数
	最大值:NUMBER_MAX
	最小值:NUMBER_MIN

4. 无穷大的数
例如：两个最大数的算术和超出了javascript的表示范围，就显示无穷大infinity
      或者一个数去除以0，获得的结果也是infinity

重点：Infinity代表数值为无穷大的意思

</pre>

###运算符
<pre>
1. 算术运算符
+  -   *   /   %取余数(模)    ++  --
i++ : 先赋值、再++计算  
++i : 先++计算，再赋值

i++和++i在没有赋值情况下的运行结果都一致：
i++和++i在赋值情况下有区别：

2. 比较运算符
>    <    >=     <=     !=     ==
===全等于    !==不全等于

比较运算符的返回信息是boolean结果信息


3. 逻辑运算符
3.1 && 逻辑与
两边结果都为真，结果为真

        //逻辑运算要求两边的操作数最好是boolean布尔类型
        //如果为非布尔类型，要进行自动类型转换
        //0 "" null [] 等等都会转换为false，其他实体信息转换为true
        //1) &&和|| 运算符最终结果为一个操作数


3.2 || 逻辑或
两边结果只要有一个为真，结果为真

3.3 ！逻辑取非
真即假，假即真

注意点：
1）逻辑运算符最终结果
在php里边，最终结果是“布尔”结果
在javascript里边，
&& 和 || 是其中一个操作数(是最终影响结果的那个操作数)
!是布尔结果

2）短路运算
前一个操作数已经可以决定最终结果，后边的操作数就不给执行，其被短路。
只给执行一个操作数，不执行另一个操作数，不被执行的操作数
就被短路。


4. +加号运算符
两个意思：
① 算术+加法运算符(两边操作数都需要为是Number数值类型)
② 字符串连接运算符(只要有一个操作数为字符串就做连接运算)

(php里边+加号只有加法运算使用.点进行字符串连接运算)

    console.log(15+23);  	//38
    console.log('32'+56);  	//3256
    console.log('hello'+'beijing');  	//hellobeijing

</pre>

###流程控制
<pre>
顺序结构
分支选择结构:if  else if  else    switch
循环结构:while(){}   do{}while()   for()

1. 条件表达式switch用法
	switch(变量){
		case  常量:
		分支;break;
		case  常量:	
		分支;break;
		case  常量:
		分支;break;
		default:
		分支;break;
	}
	if(score >=90 && score<100)
	score = 95;
	switch(){
	case  条件判断表达式:
		分支;break;
	case  条件判断表达式:
	分支;break;
	case  条件判断表达式:
	分支;break;
	default:
		分支;break;
	}

2. 两个关键字break和continue
break：在循环、switch里边有使用
       结束当前的本层循环，跳出switch的分支结构
continue：在循环里边使用
   跳出本次循环，进入下次循环

</pre>

###函数function
<pre>
1. 什么是函数
有一定功能代码体的集合。
2. 函数的封装
2.1 传统方式
function  函数名(){}
该方式的函数有“预加载”过程，允许我们先调用函数、再声明函数
预加载：先把函数的声明放入内存。代码看起来是先调用、后声明，本质是先声明、后调用的。
函数名();
function  函数名(){}

函数先调用、后声明的条件是：全部代码在同一个”< script>”标记里边。

传统方式函数声明：


2.2 变量赋值方式声明函数(匿名函数使用)
	var  函数名 = function(){}
	在javascript里边，函数就是一个变量,数据类型是对象。
	该方式没有“预加载”，必须“先声明、后调用”。

</pre>

###总结
<pre>
1. 数据类型：number  string  boolean  null  undefined    object
2. number数值类型：各种进制数的使用
	各个位数的数字 *  进制数的(位数-1)次方 的算术和
	浮点数
	最大数、最小数
	无穷大的数
3. 运算符(算术、比较、逻辑、+号)
4. 流程控制(switch  break/continue)
5. 函数：两种声明
</pre>

###函数的参数
<pre>
	function  函数名(name,age，city=’beijing’){}
	
	3.1 实参和形参的对应关系
	参数没有默认值情况下：
	在php里边：实参的个数小于形参，系统要报错
	在javascript里边：实参与形参个数没有严格的对应要求

</pre>

### 3.2 关键字arguments
<pre>
	arguments
	function  函数名(){}  //函数声明没有形参
	函数名(实参，实参);  //调用的时候有传递实参
	利用arguments可以在函数里边接收实参信息。
</pre>

###callee关键字
<pre>
	callee关键字：
	意思：在函数内部使用，代表当前函数的引用(名字)。
	作用：降低代码的耦合度。

	耦合度：一处代码的修改会导致其他代码也要发生改变(耦合度高)
  		在项目里边要开发低耦合度的代码(一处代码修改尽量少地引起其他代码的变化)。

	function f1(){
		arguments.callee();   //调用本函数（或者f1()）
	}
	f1();
</pre>

###函数返回值return
<pre>
function 函数名称(){
函数执行体代码...
return  信息;
xxxxxx
}
console.log(函数名称());  //可以输出函数的return信息
var rst = 函数名称();     //可以使得return信息对变量进行赋值


一个函数执行完毕可以通过return关键字返回一定的信息，该信息可以直接输出、也可以进行变量赋值。return本身还有结束函数的执行效果。
在一定意义上看，全部的数据类型(数值、字符串、布尔、对象、null)信息都可以返回(undefined类型无需返回，本身无意义)

在javascript里边函数return除了可以返回基本类型的信息，其还可以返回function函数。

在javascript里边，一切都是对象
在一个函数内部，可以声明数值、字符串、布尔、对象等局部变量信息，言外之意就还可以声明函数(函数内部还要嵌套函数)变量信息，因为函数是对象，并且函数可以被return给返回出来。

</pre>

###基本数据类型，即number和string采用值传递，object采用引用传递
###函数返回可以返回一个函数对象，js一切都是对象


###函数调用
<pre>
6.1 传统方式函数调用
函数名();
6.2 匿名函数自调用
(function(){})();//这个可以定义名字或者是不定义名字，效果都一样,建议不定义名字，浪费内存
特点：程序代码没有停顿，立即发生执行
好处：可以避免变量污染
</pre>

###全局/局部变量
<pre>
7.1 全局变量
php里边：	① 函数外部声明的变量。
			② 在函数内部也可以声明全局变量(函数调用之后起作用)
javascript里边：① 在函数外部声明的变量
           ② 函数内部不使用“var”声明的变量(函数调用之后起作用)

php允许在函数内部声明全局变量：global，$Globals
在javascript里边声明全局变量：在函数体内部不使用var定义变量就是全局的

7.2 局部变量
php里边：在函数内部声明的变量
javascript里边：在函数内部声明的变量，变量前边有”var”关键字。
</pre>

###数组
<pre>
1.什么是数组
有许多变量，它们的名称和数据类型都是一致的，把这些变量的集合称为“数组”。
(实际应用中数组内部各个元素的数据类型可以是不同的)
2.
数组声明
三种方式：
① var arr = [元素，元素，元素。。。];
② var arr = new Array(元素，元素，元素。。。);
③ var arr = new Array();
arr[0] = 元素;
arr[1] = 元素;
注意：
A. javascript数组的下标都是数字的
B. ①和②两种方式声明的数组，各个元素不能显示设置下标
C. ③方式给数组逐一丰富的每个元素必须要设置下标，数字、字符串类型下标都可以
   数字下标就是数组部分
   字符串下标就是对象的成员属性
D. javascript中的数组本身是一个对象，内部有数组元素部分也有对象成员部分。

重点：关联数组其实是数组对象的成员属性，所以可以使用'.'进行访问
    console.log(city[1]);
    console.log(city['shandong']);
    console.log(city.zhejiang);

3.获取数组长度
数组.length;    //获得数组元素个数和
length属性在数组里边是获得数组元素“最大数字下标”加1的信息。

4.数组遍历
沿着一定的顺序对数组内部的元素做一次且仅做一次访问，称作遍历。
① for循环 遍历    //适合遍历下标是0/1/2/3..等规则、连续的数组
② for-in遍历       //数组、对象都可以遍历，并且数组的下标没有具体要求

5.数组常用方法
push,pop
shift,unshift
indexOf,lastIndexof
</pre>

###字符串
<pre>
定义：通过(单/双)引号把键盘上用于显示的一些信息给括起来，就是一个字符串
var  name = ‘tom’;
var  addr  = “beiji9828392^$^%$^%ng”;

思考：在javascript里边，字符串为什么可以调用一些方法
	(传统思维是只有对象可以调用方法)

</pre>

###神奇的eval
<pre>
eval(参数字符串)
该eval可以把内部参数字符串当成表达式，在上下文环境中运行。
该eval()经常用于把其他用户传递过来的字符串信息转变为javascript的实体(对象、数组等)信息。
eval(参数字符串)：参数要求必须符合js语法规则。
</pre>

###总结：
<pre>
1.函数使用(参数、arguments[.length]、callee、return返回值、函数调用)
2.数组使用
a)声明
var  arr = [元素，元素。。。]
var  arr = new Array(元素，元素。。。);
var  arr = new Array()
arr[下标] = 值;
b)长度length
c)遍历
for循环
for-in
d)常用方法
push()  pop()  indexOf()  lastIndexOf()
3.字符串使用
eval(参数字符串)语法结构
</pre>

