#第十二天笔记
###数据库控制语言（DCL）
数据控制语言，是用于对mysql的用户及其权限进行管理的语句；

###用户管理
	mysql中的所有用户，都存储在系统数据库（mysql）中的user 表中——不管哪个数据库的用户，都存储在这里。

###创建用户
#####需要注意的是，一个MySQL账号其实是有三个约束部分,即 账号名，密码，登录地址，其中登录地址+账户名是联合主键，就是说单纯账户名/登录地址是可以重复，但登录地址+账户名的组合必须要在MySQL数据库上是唯一的
	形式：
	create  user  ‘用户名’@’允许登录的地址/服务器’  identified  by  '密码'；

	说明：
	1，允许登录的地址/服务器就是，允许该设定的位置，来使用该设定的用户名和密码登录，其他位置不行；
	2，可见，mysql的安全身份验证，需要3个信息。
<pre>
例子源码:
创建用户user1，密码为：123的账号，登录地方为本机
create user 'user1'@'127.0.0.1' identified by '123';
创建用户user2，密码为：123的账号，登录地方为ip地址为192.168.0.10
create user 'user2'@'192.168.0.10' identified by '123';
</pre>

######重点，每次登录时校验三个位置，即登录IP，账户名，密码，只有这三个一并满足的时候，才能进入sql系统，但值得注意的是，就算是登录了，也是不能直接访问指定数据库，因为创建的账户没有授权到指定的数据库中

###删除用户(只有管理员权限，才能创建与删除用户)
drop  user  ‘用户名’@’允许登录的地址或服务器名’;
<pre>
例子源码:
drop user 'user2'@ '102/168.0.10';
</pre>
###修改与用户密码:
<pre>
修改的当前用户自己的密码:
set password = password('密码'); --password()是一个方法，对普通字符串进行加密并保存

修改他人的密码（前提是有权限,管理员权限一般可以做到）：
set password for '用户名'@'登录的地址' = password('密码');
</pre>

###权限管理
<pre>
mysql数据库，将其中所能做的所有事情，都分门别类分配到大约30多个权限中去了，其中每个权限，都是一个“单词”而已！，比如：
select：代表可以查询数据；
update：代表可以修改数据；
delete：代表可以删除数据；
.......
其中，有一个权限名叫做“all”：表示所有权限；
</pre>

######授予权限
<pre>
形式：
grant  权限列表  on  某库．某个对象  to  ‘用户名’@’允许登录的位置’  【identified  by  ‘密码’】；

说明：
1，权限列表，就是，多个权限的名词，相互之间用逗号分开，比如:  select,  insert,  update,也可以写：all

2，某库．某个对象，表示，给指定的某个数据库中的某个“下级单位”赋权；
下级单位有：表名，视图名，存储过程名；  存储函数名；
其中，有2个特殊的语法：
*.*：	代表所有数据库中的所有下级单位；
某库．*	：代表指定的该库中的所有下级单位；
3，【identified  by  ‘密码’】是可省略部分，如果不省略，就表示赋权的同时，也去修改它的密码；
但：如果该用户不存储，此时其实就是创建一个新用户；并此时就必须设置其密码了

注意一点，就是，每次grant的权限不会重置原来的内容，只会覆盖当前所改变的内容，就是说，授权select和insert可以分次授权,其实是一种添加模式，不会冲突

例子源码:
//授予MySQL权限
1.授予user3访问php39数据库select权限
grant select on php39.* to 'user3'@'localhost';
2.授予user3访问php39数据库insert权限
grant insert on php39.* to 'user3'@'localhost';
3.授予user3访问php39数据库all权限
grant all on php39.* to 'user3'@'localhost';

需要注意 grant语句 也有创建用户的语句 [indentified by '密码']的语句，这个除了用于变更密码以外，其实还有一个比较重要的内容的是，可以通过grant的语句直接创建的用户，而不用create user的语句来创建，而且使用grant创建的话，可以直接赋予权限，省了一部分语句

//授予user4 all权限在全部数据库中(*.*),顺便变更user4的密码为'321'
grant all on *.* to 'user4'@'localhost' identified by '321';
</pre>

######剥夺权限(移除grant添加的权限)
<pre>
形式：
revoke  权限列表  on  某库．某个对象  from  ‘用户名’@’允许登录的位置’
其含义，跟grant中完全一样,但是不能修改密码，而且grant的to改为revoke的from；

例子源码:
//创建用户user4
create user 'user4'@'localhost';
//授权user4的PHP39数据库的select的权限
grant select on php39.* to 'user4'@'localhost';
//移除php39数据库的查询权限
revoke select on php39.*  from'user4'@'localhost' identified by '123456';
</pre>

#事务控制（对增删改这三方面进行控制）
<pre>
什么叫做“事务”?
想象一个场景：
小明给小花 汇款 5000元 买 IPHONE，操作界面不用管，不管什么操作界面，最终都要落实到这样两条语句的执行：
update  存款表  set  money = money - 5000  where  账户=’小明’；
update  存款表  set  money = money + 5000  where  账户=’小花’；
当，第一条语句执行成功，突然断电了（或任何其他情况），就会造成数据的“不一致”。

要解决这个问题，就是“事务”的功能：
事务就是用来保证多条“增删改”语句的执行的“一致性”：要么都执行完成，要么都没有执行；
</pre>

#####事务的特点
- 原子性：一个事务中的所有语句，应该做到：要么全做，要么一个都不做；
- 一致性：让数据保持逻辑上的“合理性”，比如：一个商品出库时，既要让商品库中的该商品数量减1，又要让对应用户的购物车中的该商品加1；
- 隔离性：如果多个事务同时并发执行，但每个事务就像各自独立执行一样。
- 持久性：一个事务执行成功，则对数据来说应该是一个明确的硬盘数据更改（而不仅仅是内存中的变化）。

######事务模式
<pre>
需要记住的是，我们的autocommit仅限于cmd的使用，php使用的start transaction

在我们的cmd命令行模式中，是否开启了“一条语句就是一个事务”的这个开关：
默认情况下（安装后），这个模式是开启的，称为“自动提交模式”；
set  autocommit = 1;
这样之后，每条增删改语句，都会立即生效；
我们可以把它关闭，那就是“人为提交模式”——即需要人为提交；
set  autocommit = 0;
这样之后，所有增删改语句，都必须使用commit之后，才能生效；

源码例子
use php39；
set autocommit = 0; --设置不自动进行提交
insert into join1(id,f1,f2) values(123,'232','f67');
//若执行提交语句，他是不是生效的
commit;
</pre>

###事务执行的基本流程
<pre>

开启一个事务：
1.start  transaction；	//也可以写成：begin；
2，执行多条增删改语句；	//也就是相当于希望这多条语句要作为一个“不可分割”的整体去执行的任务
3，判断这些语句执行的结果情况，并进行提交或回滚：
if(  没有出错 ）{
commit；	//提交事务；此时就是一次性完成；
}
else{
rollback；	//回滚事务；此时就是全部撤销；
}

源码例子在php中

</pre>


###MySQL编程
-	mysql编程中语句块包含符
<pre>
其实就是相当于js或php中大括号语法：
[标识符：]begin
//语句。。。。
end  [标识符]；
标识符就是定义定义的任意的名字而已，比如：
if  (条件判断)  
begin
//。。。。
end;
end if;

if  (条件判断)  
A：begin
//。。。。
end  A;
end if;

A就是标识符，它的作用是“标识”该语句块，以期可以在该语句块中“使用它”——其实就是退出；


例子源码:
IF(@s>10)
	abc:begin


	end abc;
end IF;

其实就是每一个的语句块都可以说那个标识符来进行表示，该标识符可省略，但是在执行退出循环操作的时候，这个标识符是必须要的

还有一个需要注意的点是:begin 分号，而写end的时候需要在后面添加分号

</pre>

###流程控制语句
<pre>
------------------if语句的使用----------------------

if 条件语句 then
	begin
		执行的语句块
	end;
else if 条件语句 then
	begin 
		执行的语句块
	end；
else 
	begin
		执行的语句块
	end;
end if;

---------------case 语句 （相当于之前说是用的switch）----------

1.方式一:
case 变量值(@v1)
	when 常量值1 then
		begin
			执行语句块
		end；
	when 常量值2 then
		begin
			执行语句块
		end；
	else 
		begin
			执行语句块
		end； 
end case;

2.方式二：
case 
	when (比较的提交为真时)[@v1>10] then 
		begin
			执行语句块;
		end;
	when (比较的提交为真时) then 
		begin
			执行语句块;
		end;
	else 
		begin
			执行语句块;
		end;

end case;


--------------------------loop循环语句-----------------------------
标识符：loop
	begin
	//这里就是循环的语句块。。。
	//注意：这里必须有一个“退出循环”的逻辑机制；否则该循环就是死循环，其基本形式类似这样：
		if (条件) then
			leave  标识符;	//退出；
		end  if;
	end；
end  loop  标识符

--------------------------while循环语句-----------------------------
标识符: while 判断条件(@v1<10) do
	begin
		执行语句块;
	end;
end while 标识符;

注：WHILE语句可以被标注，除非begin_label也存在，end_label才能被用，如果两者都存在，他们必须是一样的

--------------------------repeat循环语句-----------------------------
标识符:repeat
	begin
		执行语句块;
		
	end
	until 判断语句块【值得注意的是:与while不同的是,这里是条件为真才跳出语句块，这样循环才算正常结束】
end repeat 标识符;

--------------------------leave循环语句-----------------------------
语法：
leave 标识符； 
作用：
用来退出begin...end结构或其他具有标识符的结构。
</pre>


###MySQL中的变量
mysql中，有两种变量的形式：
<pre>
普通变量： 不带“@”符号；
定义形式：	
declare  变量名  类型名   【default  默认值】；	//普通变量必须先这样定义
赋值形式：
set  变量名  =  值；
取值：就直接使用变量名；

使用“场所”：只能在“编程环境”中使用；
什么是编程环境？只有3个：
1，定义函数的内部；
2，定义存储过程的内部；
3，定义触发器的内部；

会话变量： 带“@”符号；
定义形式（其实也是赋值形式）：
set  @变量名  =  值；		//跟php类似，无需定义，直接赋值，第一次就算是定义
取值：就直接使用变量名；
使用“场所”：基本上哪里都可以用；

变量赋值有如下形式：
语法1（针对普通变量）：
set 变量名 = 表达式；#此语法中的变量必须先使用declare声明
语法2（针对会话变量）： 
set @变量名 = 表达式； #此方式可以无需declare语法声明，而是直接赋值，类似php定义变量并赋值。
语法3（针对会话变量）：
select @变量名 := 表达式；#此语句会给该变量赋值，同时还会作为一个select语句输出“结果集”。
语法4（针对会话变量）：
select 表达式 into @变量名；#此语句虽然看起来是select语句，但其实并不输出“结果集”，而只是给变量赋值。


注意:语法3与语法4的区别就是语法3会显示查询结果，而语法4是不会显示查询结果


例子源码:
set @v1 = 1;
select @v2 :=2;
select 3 into @v3;
select @v1,@v2,@v3;

</pre>

###存储函数(必须用于一个返回值,记住的是返回类型的语句是"returns"，不是"return")：
<pre>
函数，也说成“存储函数”，其实就是js或php中所说的函数！
唯一的区别：
这里的函数必须返回一个数据（值）；


///////////////////////////////////////////
创建函数的形式:

create function 函数名(形参1 类型1，形参2 类型2，形参3 类型3...)
returns 返回类型
begin
	#执行语句块;
	return xx值；
end;

形参类型可以多种多样:int，float，decimal，date，cahr，varchar等

需要注意的事项:
1， 在函数内容，可以有各种变量和流程控制的使用；
2， 在函数内部，也可以有各种增删改语句；
3， 在函数内部，不可以有select或其他“返回结果集”的查询类语句；

注意，使用函数的时候千万不能存在select语句及具有返回结果集能力的语句

如果使用关键词作为了变量名。可以使用``反单引号进行变量名的定义

例子源码:
#创建一个函数：
#函数的目标是：取得3个数中的最大值；

delimiter //
create function getMaxValue(p1 float,p2 float,p3 float)
returns float 
begin
	declare result float;
	if(p1 >= p2 and p1 >= p3) then 
		begin
			set result = p1;
		end;
	else if (p2>=p1 and p2<=p3) then
		begin
			set result = p2;
		end;
	else
		begin
			set result = p3;
		end;
	end if
	return result;
end;
</pre>


###删除函数
drop function getMaxValue；

###存储过程
<pre>
存储过程，其本质还是函数——但其规定：不能有返回值；
create procedure 存储过程名 ([in|out|inout] 形参1 类型1，[in| out | inout]形参2 类型2,......)
begin
	#这里写完整的过程中语句
	#其中可以右各种流程控制
	#开可以增删改查等等
	#其中查询语句(select)会作为存储过调用的结果，跟执行select一样，直接返回结果集
end

调用存储过程：
call  存储过程名 (实参1，实参2，.... ）

它应该是在“非编程环境中”调用，即执行增删改查的场景下；

例子源码:
create procedure insert_get_Data(p1 int,p2 tinyint,p3 bigint)
begin
	insert into tab_int2(f1,f2,f3)values(p1,p2,p3);
	select * from tab_int2 order by f1 desc limit 0,3;
end;

//调用内容
call insert_get_Data(21,31,41);


//调用存储过程例子2
create procedure pro1(in p1 int, out p2 tinyint,inout p3 bigint)
begin
	set p2 = p1*2;
	set p3 = p3+p1*3;
	insert into tab_int(f1,f2,f3) values (p1,p2,p3);	
end;

call pro1(1,2,3);/// --这样调用会直接报错，原因是p2,p3是out 和 inout 所以必须传入的是变量

下面的写法才能安全不报错的运行:
set @s3 = 3;///
call pro1(1,@s2,@s3);///
select @s2,@s3;///

//得到的结果可以直接打印@s2=2,@s3=6
</pre>

###删除存储过程
drop  procedure  存储过程名；

drop procedure pro1;

###触发器（trigger）
<pre>
含义：
触发器，也是一段预先定义好的编程代码（跟存储过程和存储函数一样），并有个名字。
但：
它不能调用，而是，在某个表发生某个事件（增，删，改）的时候，会自动“触发”而调用起来。

定义形式：
create  trigger  触发器名  触发时机  触发事件   on  表名   for  each  row  as
begin
//这里，才是编程的位置，也就是触发器的内部语句
end；

说明：
1，触发时机，只有2个：  before（在....之前），  after（在....之后）；
2，触发事件，只有3个：insert，  update，  delete
3，即其含义是：在某个表上进行insert(或update,或delete)之前（或之后），会去执行其中写好的代码（语句）；即每个表只有6个情形会可能调用该触发器；
4，通常，触发器用于在对某个表进行增删改操作的时候，需要同时去做另外一件事情的情形；
5，在触发器的内部，有2个关键字代表某种特定的含义，可以用于获取有关数据：
new：它代表当前正要执行的insert或update的时候的“新行”数据；通过它，可以获取这一新行数据的任意一个字段的值，形式为：
set  @v1 = new.id;		//获得该新插入或update行的id字段的值（前提是有该id）
set  @v2 = new.age;		//同上；
old：它代表当前正要执行的delete的时候的“旧行”数据，通过它，可以获取这一旧行数据的任意一个字段的值，形式为：
set  @v1 = old.id;			//获得该新插入或update行的id字段的值（前提是有该id）
set  @v2 = old.age;		//同上；

</pre>

<pre>
//触发器的例子源码
#定义一个触发器：
#在表tab_int插入一行数据的时候，能够同时将这个表中的第一个字段的最大值的行
#写入到另一个表中（tab_int_max1)
#其中表tab_int的结构为：
CREATE TABLE `tab_int` (
 `f1` int(11) DEFAULT NULL,
 `f2` tinyint(4) DEFAULT NULL,
 `f3` bigint(20) DEFAULT NULL
）
#然后， 表tab_int_max1的结构跟其一样：
#但其中永远都只存储tab_int中的最大值的行
CREATE TABLE `tab_int_max1` (
 `f1` int(11) DEFAULT NULL,
 `f2` tinyint(4) DEFAULT NULL,
 `f3` bigint(20) DEFAULT NULL
);

#然后，在tab_int上写触发器：
create trigger tri1 after insert on tab_int for each row 
begin
	#先删除tab_int_max中的所有数据；
	delete from tab_int_max;    

    #取得tab_int中的f1字段的最大值，并存入变量@maxf
	select max(f1) into @maxf1 from tab_int;

    #然后，根据该得到的f1字段的最大值，作为条件，取出3个字段的值：
	select f2 into @v2 from tab_int where f1 = @maxf1;
	select f3 into @v3 from tab_int where f1 = @maxf1;

    #然后，将@maxf1, @v2, @v3插入到表tab_int_max1
	insert into tab_int_max1(f1,f2,f3) values(@maxf1,@v2,@v3);

end;

#再建一个触发器，在表tab_int进行insert之前，将该行数据
#也同时插入到一个跟其类似结果的表(tab_int_some) 中：
CREATE TABLE tab_int_some (
 id int(11) DEFAULT NULL,
 age tinyint(4) DEFAULT NULL
);

create trigger copy_data before insert on tab_int for each row 
begin
    set @v1 = new.f1;   #获得新行的字段f1的值；
    set @v2 = new.f2;   #获得新行的字段f2的值；
	insert into tab_int_some(id,age) values(@v1,@v2);
end;

</pre>