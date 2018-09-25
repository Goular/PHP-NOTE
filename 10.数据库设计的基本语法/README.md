#第十天笔记

1.数据库(表)设计的三范式：

- 第一范式：满足的是数据的原子性

- 第二范式：每一行数据具有唯一性，而且消除数据间的‘部分依赖’，使表中的非主键字段，完全依赖主键字段，每一行数据具有唯一性：只要给表设计主键，就可以保证唯一性；消除数据之间的“部分依赖”；
<pre>
什么叫做部分依赖？
如果某个字段，只依赖于“部分主键字段”，此时就称为“部分依赖”,
发生此情况的前提一定是：主键字段有多个！！！

（联合主键）常常容易出现部分依赖的情况，但是只要将联合主键是别人外键的情况下，联合主键也可以满足第二范式。

什么叫做完全依赖：
就是某个字段，是依赖于“主键的所有字段”。
——推论：如果一个表的主键只有一个字段，则此时必然是完全依赖。
</pre>

- 第三范式:独立性，消除的是传递依赖
<pre>
使每个字段都独立地依赖于主键字段（独立性），而要消除其中部分非主键字段的内部依赖——这种内部依赖会构成“传递依赖”
即，表中包含非主键属性B需要依赖其中一个非主键属性A的内容才能确定唯一性的内容，而属性A又依赖主键的奇特现象
</pre>

#经验总结：
<b>
通常，在设计表的时候，基本只要遵循这样一个原则，就可以满足前述3范式要求：
每一种数据，使用一个表来存储。</b>

#数据库操作语言
- 插入语言
	
	1. insert into table TABLE_NAME (字段名1，字段名2...) values (值表达式1，值表达式2...),(值表达式1，值表达式2...)...;
	2. (replace 与 insert的区别，若行数据没有创建，那么replace和insert一样，但是若行数据创建了，那么replace就是等同于update)：replace into table TABLE_NAME  (字段名1，字段名2...) values (值表达式1，值表达式2...),(值表达式1，值表达式2...)...;
	3. insert into TABLE_NAME select ...from...;
	4. insert into table set 字段名1=值表达式1，字段名2=值表达式2，字段名3=表达式3...;
<pre>
//演示主键的作用：保证每一行数据具有唯一性：
create table tab_zhujian1(
	id int,
	name varchar(10)
);
insert into tab_zhujian1(id,name)values(1,'aa');
insert into tab_zhujian1(id,name)values(1,'aa');
//以下为对比表（及对比数据）
create table tab_zhujian2(
	id int,
	name varchar(10),
	primary key(id)
);
insert into tab_zhujian2(id,name)values(1,'aa');
insert into tab_zhujian2(id,name)values(1,'aa'); -- 执行失败，因为主键已经存在

//演示replace into语句
insert into tab_zhujian2(id,name)values(1,'bb');
replace into tab_zhujian2(id,name)values(1,'bb');

//下面演示insert  into  ....  select ...语句：
insert into tab_zhujian1 select * from tab_zhujian2;
</pre>

#使用load data infile "完整的数据文件路径" into table 表名;
<pre>
	1.首先，需要创建于数据文件几乎差不多的表的的数据格式与名称
	2.使用load data infile "完整的数据文件路径" into table 表名；插入数据
	
	代码演示
	create table tab_load_data(
		id int auto_increment primary key,
		name varchar(10),
		sex enum('男','女'),
		jiguan varchar(10),
		f5 int
	)charset=gbk;

	load data infile "E:/GitHub/PHP-NOTE/10.数据库设计的基本语法/xueshengxinxi.txt" into table tab_load_data;
</pre>

#删除数据
<pre>
	语法形式:
		delete from 表名 where 条件 [order by 排序字段] [limit 限定行数];
</pre>

#修改数据
<pre>
	语法形式:
		update 表名 set 字段1 = 值1，字段2=值2，... [where 条件] [order by 排序条件] [limit 限定行数];
</pre>

#查询(select子句)
<pre>
	语句格式:select (all | distinct) 字段或表达式列表 [from 子句] [where 子句] [group by 子句][having 子句][order by 子句][limit 子句] 
</pre>

###字段或表达式列表
	1，字段，自然是来源于“表”，则其必然依赖于from子句；
	2，表达式是类似这样一个内容：8,   8+3,   now(), 
######值得注意的是concat('aa','bb')方法为mysql的内部方法，执行完返回的是两个字符串连接符的拼接后的字符串内容
<pre>
	select 8; --会直接输出结果8
	select 8+3;
	select concat('aa','bb');
	select now() as '时间';
</pre>
######别名，每个输出项("字段或表达式结果"),都可以给其设定一个"别名"，别名的定义的格式为:: 字段名或表达式 as 别名
<pre>
	select 8 as f1,8+3 as jieguo ,now() as 时间;
	select f1 as id,f2 as cc ,f3 from tab_int2;

	需要注意的是:表的字段并没有改变，只是改变了"结果集"字段名;
</pre>

######all 和 distinct
用于设定select出来的结果集数据，是否消除"重复行"，可以不写，那就是默认值all，否则就是消除重复的distinct

- all:表示不消除，即所有的数据都出来了，默认值；
- distinct:表示会消除

使用all （由于是默认值，所以可以不写）
<pre>
	select all * from tab_int2;
	select distinct * from tab_int2;
</pre>

######from
	from子句表示select部分中获取到的数据的数据源(其实就是表)
	select输出(取出)部分，如果给定的是字段名，则其必然来源于
	'数据源'的字段

######where子句
	
	1.where子句就是对from子句中的“数据源”中的数据进行筛选的条件设定，筛选的机制是“一行一行进行判断”，其作用，几乎就跟各种语言中if语句的作用一样。

	2.则可见where子句,依赖于from子句；

	3.where子句中，通常需要使用各种的运算符
		算术运算符:+ - * / %
		比较运算符:> >= < <= =(等于) <>(不等于，推荐不等于使用此方法) ==（等于的另一种写法，不推荐）,!=(不等于的另一种写法，不推荐)
		逻辑运算符:and  or  not(使用not的时候的标准是 not(sex='女')
<pre>
	select * from order_goods where id+1 =2;
	select * from order_goods where id>2 and id<5;
	select * from order_goods where id>4 or price=5499;
	select * from order_goods where not(price = 5499);
	select * from order_goods where price <> 5499;
</pre>
		
######is运算符，空值和布尔值的判断(需要注意0，0.0和null是不一样的)
	
	有四种情况可以使用:
	xx is null:摸某个字段是null值，就是没有值
	xx is not null:判断某个字段不是null值
	xx is true：判断某个字段为真（true）
	xx is false:判断某个字段为假(false):0,0.0,null
	
	在mysql中，并没有存在布尔值的内容，所谓的布尔值，其实是，tinyint(1)这个类型的一个别名，本质上只能判断一个数据中是否为0

<pre>
	is true / is false ：判断的是0，0.0，或者是null
	select * from tab_int2 where f2 is false;
</pre>

######between运行符:范围判断
	用于判断某个字段的数据值是否在某个给定的范围--使用于数字类型

	语法: XX between 值1 and 值2；
	含义:XX字段的值在给定的"值1"和"值2"之间，其实相当于 XX>=值1 and XX<=值2
<pre>
	select * from product where price between 4000 and 5999;
</pre>

######in运算符,给定确定数据的范围判断
	语法:XX in (值1，值2，值3......);
	含义:表示字段XX的值为值所列出的值中的一个，就算满足了条件，都是零散无规律的

	注:如果所罗列的数据是具有一定的规律的，那么其实可以使用between...and...配合其他运算符来替代
	
<pre>
select * from order_gooods where pro_id in (1,4); --只有满足其中的pro_id的值等于1或者4，那么既满足要求
</pre>

######like运算符:对字符串进行模糊查找
	语法: XX like '需要查找的内容'
	含义:实现对字符串的某种的特征信息的进行模糊查找，它其实依赖以下两个的特殊符号：
	第一个是:% ,它代表"任何个数的任何字符" （字体数量不限）
	第二个是:_，它代表的是"一个任何字符"    (字体数量为1)
<pre>
	select * from product where pro_name like '%lenovo%';
	select * from product where pro_name like '%联想%';	

	常见还有以下的形式:
	name  like  ‘%罗%’:		表示nam中“罗”这一个字的所有数据行；
	name  like  ‘罗%’:		表示nam中以“罗”开头的所有数据行；比如：罗兰，
	name  like  ‘%罗’:		表示nam中以“罗”结尾的所有数据行；比如：C罗，魂斗罗
	name  like  ‘罗_’:		表示nam中以“罗”开头并只有2个字符的所有数据行；比如：罗兰
	name  like  ‘_罗’:		表示nam中以“罗”结尾并只有2个字符的所有数据行；比如：C罗

	如果在寻找的字段中含有符号"%"的话，那么我们可以使用转义字符来进行的解决"_\%",或者"%\%%"
</pre>

######group by 子句:分组
	需要注意一个点，就是使用group by 字段名1，字段名2的时候，只有分组的字段名获得的内容不是脏数据，其余的都是脏数据，都是没有用的，所以带group by的select语句，有效的，不是脏数据的内容仅仅有分组的字段名（即分组的组名，group by 多个字段，就多个有效组名）和五个聚合函数方法的内容有效（count，avg，max，min，sum）


	形式:group by 字段1[asc/desc],字段2[asc/desc] 
	
	说明：
	1，分组是对“前述”已经找出的数据（即where已经筛选过了）进行某种指定标准（依据）的分组。
	2，同时，该分组结果，可以同时指定其“排序方式”：desc（倒序），asc（顺序）；
	3，通常，分组就一个字段（依据），2个以上很少。

<pre>
什么叫做分组？
分组：就是将多行数据，以某种标准（就是指定的字段）来进行“分类”存放。
特别注意：
分组之后的结果，一定要理解为：只有一个一个组了

应用中，分组之后，通常只有如下几种可用的“组信息”了（即可以出现在select中）：
1，分组依据本身的信息，其实就是该分组依据的字段名；
2，每一组的“数量”信息：就是用count（*）获得；
3，原来数据中的“数值类型字段的聚合信息”，统计的是一组一组的内容，包括如下几个：
最大值：  max(字段名)
最小值：  min(字段名)
平均值：  avg(字段名)
总和值：  sum(字段名)
上述其实是4个系统内部函数,记住啊一定要字段名，不能是通配符(*)；


如果使用group by的语句使用了select * ，请注意一点就是我们的的其他数据实际上是没有用的，有用的部分仅仅是group by字段名的分组字段是有效的其他是没有效的，注意，聚合函数除外
</pre>

<pre>
select * from product group by pinpai; --此时会出现所有字段，但是品牌仅仅会出现一次，不会重复，其余的字段都是随意摘抄的，并不代表该组的一个信息，所以这些数据都是脏数据，所以使用下面这种写法较好，因为这数据的获取才有用
select pinpai as 品牌 from product group by pinpai desc; --以倒序呈现品牌的内容
select pinpai as 品牌 ,count(*) as 数量 , max(price) as 最高价,min(price) as 最低价,sum(price) as 总价 , avg(price) as 平均价 from product group by pinpai;
</pre>

######having子句
	having的作用跟where完全一样，但其只是对"分组的结果数据"进行筛选：
	
	where对原始数据进行筛选
	having对分组之后的数据进行筛选
<pre>
示例1：找出平均价大于5000的品牌信息：
select pinpai as 品牌 ,count(*) as 数量 , max(price) as 最高价,min(price) as 最低价,sum(price) as 总价 , avg(price) as 平均价 from product group by pinpai having 平均价 >5000;

示例2：找出商品数超过2个的品牌信息：
select pinpai as 品牌 ,count(*) as 数量 , max(price) as 最高价,min(price) as 最低价,sum(price) as 总价 , avg(price) as 平均价 from product group by pinpai having 数量>2;

还有一种写法:
select pinpai as 品牌 ,count(*) as 数量 , max(price) as 最高价,min(price) as 最低价,sum(price) as 总价 , avg(price) as 平均价 from product group by pinpai having avg(price) >5000;
select pinpai as 品牌 ,count(*) as 数量 , max(price) as 最高价,min(price) as 最低价,sum(price) as 总价 , avg(price) as 平均价 from product group by pinpai having count(*) >2;
</pre>

######MySQL导入数据的第二种方式
	方法二，在成功登录mysql后
	source "备份数据文件的完整路径";


	方法一，在没有登录的时候
	mysql -u root -p "文件的路径" > 数据库的名字（千万不能存在分号）
	
	备份数据库 
	mysqldump -uroot -p 数据库 > "文件路径"(千万不能存在分号)
	
######order by 子句
	形式：
	order  by  字段1  【asc|desc】， 字段2  【asc|desc】，......

	说明：
	1，对前面的结果数据以指定的一个或多个字段排序；
	2，排序可以谁定正序（asc，默认值）或倒序（desc）；
	3，多个字段的排序，都是在前一个字段排序基础上，如果还有“相等值”，才继续以后续字段排序；
######注意一点是就是，每个order by的字段都可以使用desc/asc进行排序，排序规则，为字段1遇到相同的时候再进行字段2的比较，这样才能排序显示好
<pre>
例子1：
select * from product order by protype_id;
例子2:
select * from product order by protype_id desc ,price desc;
</pre>

######limit子句(注意mysql没有top这个关键字)
	含义：
	它用于将“前述取得的数据”，按指定的行取出来：从第几行开始取出多少行；
	形式：
	limit  起始行号， 要取出的行数；
	说明：
	1，起始行号都是从0开始算起的；
	2，起始行号跟数据中的任何一个字段（比如id）没有关系；
	3，要取出的行数也是一个数字，自然应该是大于0的；
	4，有一个简略形式：limit  行数；  表示直接从第0行开始取出指定的行数，它相当于limit  0, 行数;
<pre>
	1.原始取出的数据为：
	select * from product where price > 3000;

	2.从中取出“部分数据”：
	select * from product where price > 3000 limit 2,2; 
	select * from product where price > 3000 limit 3,1;

	select * from product order by price desc limit 0,1;	
</pre>

###对整个select语句的一些总结
	1，虽然在形式上，select的很多子句都是可以省略的，但他们的顺序（如果出现），就不能打乱的：必须仍然按照给出的顺序写出；
	2，where子句依赖于from子句：即没有from，就不能有where；
	3，having子句依赖于groupby子句：即没有groupby，就不能有having；
	4，select中的“字段”也是依赖于ｆｒｏｍ子句；
	5，上述各子句的“内部执行过程”，基本上也都是按照该顺序进行的：
	
	即从from的数据源中获得“所有数据”，然后使用where对这些数据进行“筛选”，之后再使用groupby子句对筛选出来的数据进行“分组”，接下来才可以使用having对这些分组的数据进行筛选，然后才可以orderby 和limit。