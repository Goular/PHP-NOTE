#第六天笔记
###注意一点，就是在普通函数中使用static 定义一个变量，此变量会作用于该函数，重复调用可达到一个累加的功能，不会因函数运行完而消失，注意这个点与类中使用static的异同,记住该变量的作用域仅仅是当前的函数，用途除了记录外，还有在递归的时候也会使用http://www.php100.com/html/php/lei/2013/0905/5279.html
1. 函数的定义，调用
2. 函数的参数问题，即普通参数和带默认值的参数(必须右置)，还有一种是不带参数，但是调用时直接添加实参到调用方法中
<pre>
此时应该使用func_get_args(),func_num_args(),func_get_arg(index).
</pre>
3. 函数的传值问题，一般直接使用的实际参数都是值传递，如果想使用引用传递，从而改变传递过来的参数的实际值，可以在定义的使用使用&$n来定义，使用的时候直接传递$n即可，这样就是获取到$n的数据存储区域的指针，从而改变指针代表的值
4. 函数的返回参数，return后面的语句不执行，返回到调用者的源代码中
5. 可变函数，跟可变参数类似，使用字符串加'$'在后面加上括号，即可调用相关定义的方法$str();其中$str为字符串，内容为函数名func1,加上括号就是调用func1();
6. 匿名函数，形式1：$f1 = function(){}，形式2，类似js的回调定义：function v1($n,$m){},调用时，传入匿名函数作为参数:v1("abc",function($a,$b){echo '匿名函数执行区域'});
7. 变量的作用域问题：1.全局作用域不能访问局部函数变量，2.局部函数作用域不能访问全局的作用域的变量。解决办法，使用超全局作用域的变量即$_POST,$_GET,$GLOBALS,$_REQUEST,$_SERVER等，或者使用关键字global声明全局区域的同名变量，这样就能正常使用全局的变量，但需要关注unset（）方法下global声明的变量，是不会去除内容的，因为global声明是引用传递，而unset（）$GLOBAL['V1']会直接删除掉v1的应用控件，下次再外面想调用，会出现未定义的notice。 
8. 利用function_exists()方法判断函数是否存在定义，有定义就不走定义的流程，这样才符合内存节省的原则，是优化代码的一种手段
9. 有关函数的系统函数：
	<pre>
	function_exists()：判断一个函数是否被定义过。其中使用的参数为“函数名”：

	func_get_arg($i)：	获取第i个实参值
	func_get_args()：	获取所有实参（结果是一个数组）
	func_num_args()：	获取所有实参的个数。
	</pre>
10. 其他系统函数：
<pre>
字符串函数：
o输出与格式化：echo , print, printf, print_r, var_dump.
o字符串去除与填充：trim, ltrim, rtrim, str_pad
o字符串连接与分割：implode, join， explode, str_split
o字符串截取：substr, strchr, strrchr,
o字符串替换：str_replace, substr_replace
o字符串长度与位置： strlen, strpos, strrpos,
o字符转换：strtolower, strtoupper, lcfirst, ucfirst, ucwords
o特殊字符处理：nl2br, addslashes, htmlspecialchars, htmlspecialchars_decode,
时间函数：
otime, microtime, mktime, date, idate, strtotime, date_add, date_diff, date_default_timezone_set, date_default_timezone_get
数学函数：
omax, min, round, ceil, floor, abs, sqrt, pow, round, rand
</pre>
11. 递归与递推思想的异同，递推是最简单的逻辑一步一步往下推得到结果，递归是先送结果出发，一步一步的递推过去，直至到达边界，然后进行回溯，最后得出结果。所以递归一般是包含递推的，但是比普通的递推多了回溯的这一步。一般来说，普通的递推是正向的，递归是逆向的递推加回溯的集合.
	

