#第十一天笔记
###连接查询
就是将两个或两个以上的表，“连接起来”，当做一个数据源，并从中去取得所需要的数据；
<pre>
select * from join1;
select * from join2;
select * from join1,join2; #其实这种没有任何的关键字的连接其实是无筛选条件的全连接,即笛卡尔积
同时需要注意，笛卡尔积的表述写法可以写成下面的形式

下面的连接语句统称为交叉连接
select * from join1,join2;
select * from join1 join join2;
select * from join1 cross join join2;
</pre>

###连接的基本形式
在代码级别，连接的基本形式为：
表1  【连接形式】 join  表2  【on  连接条件】；

如果是3个表，则进一步扩展为：
表1  【连接形式】 join  表2  【on  连接条件】 【连接形式】 join  表3  【on  连接条件】
更多表，依次类推；

###连接的分类


- 交叉连接（cross join）:
<pre>
其实就是刚才讲连接的基本概念的时候的连接形式（结果）——它没有条件，只是按连接的基本概念，将所有数据行都连接起来的结果。它又叫做“笛卡尔积”；

笛卡尔积的特点是，行的数量是 (表1的数量)*(表2的数量)；列的数量是（表1的列数量）+（表2的列数量）
	
下面的是获取两张表的笛卡尔积的写法
select * from t1 , t2;
select * from t1 join t2;
select * from t1 cross join t2;
</pre>


- 内连接（inner join）
<pre>
重要的点是，内连接是带连接条件的交叉连接，与交叉连接的区别就是多了连接条件(即 [on 连接连接条件])，没有[on 连接条件]的语句与交叉连接的效果是一样的

形式:
select * from t1 [inner] join t2 on 连接条件

例子源码:
select * from product inner join product_type;#查看全部数据
select * from product as t1 inner join product_type as t2 on t1.protype_id = t2.protype_id;

数据表也可以使用“as 别名”的形式来取别名；

其中 product.protype_id = product_type.protype_id 被称为“连接条件”，它基本上就是我们之前所学的“外键关系”的一个描述。
注意：
这种的表跟表之间的内连接查询，虽然可以体现为表跟表之间的“关系”——通常就是外键关系——但并不是有外键关系才能使用这种连接。
</pre>



- 左外连接（left 【outer】 join） 
<pre>
形式：
表1（左表）  left  【outer】 join  表2（右表）  on  连接条件

含义：
其实就是将两个表的内连接的结果，再加上左边表的不符合内连接所设定的条件的那些数据的结果,没有右表结果的行数据使用null填充；

例子源码:
select * from product as p left outer join product_type as t on p.protype_id = t.protype_id;

左连接的结果，左边表的数据，一定都会“全部取出”；
</pre>

- 右外连接（right 【outer】join）
<pre>
形式：
表1（左表）  right  【outer】 join  表2（右表）  on  连接条件
含义：
其实就是将两个表的内连接的结果，再加上右边表的不符合内连接所设定的条件的那些数据的结果；

在内连接的基础上，添加右表不符合连接条件的全部数据，左边多出来的项使用null填充

例子源码:
select * from product as p right outer join product_type as t on p.protype_id = t.protype_id;

</pre>

- 全外连接(full outer join)
<pre>
形式：
没有形式，因为mysql不支持全连接的语法；

含义：
其实就是将两个表的内连接的结果，再加上左边表的不符合内连接所设定的条件的那些数据的结果，以及再加上右边表的不符合内连接所设定的条件的那些数据的结果；
</pre>

- 连接查询的例子源码
<pre>
例1：对商品表：
查出每个品种各有多少个商品：
select protype_name,count(*) as 数量 from product as p inner join product_type as t on p.protype_id = t.protype_id group by protype_name;

例2:查出"计算机系"的所有学生的信息
select stu.学生ID,stu.学生,stu.性别,stu.籍贯,college.院系名称 from 学生表 as stu inner join 院系 as college on stu.院系ID = college.院系ID where college.院系名称 = '计算机系';
</pre>

###子查询

##子查询作为数据源的时候，即（from （select...））的时候子查询必须添加别名，即（from （select ...） as t ）,否则就会报错
<pre>
源码例子:
普通查询:
select pro_id,price*0.9 ,5 as 买就送 from product;
select pro_id,price from product where price >5000;
select pro_id,price from product where price > (select 5000); #其实这就是使用了子查询，只不过这样的子查询内容看起来有点多余

使用子查询:
select pro_id,price from product where price > (select avg(price) from product);#查询大于平均价格的商品

所谓子查询，就是在一个查询语句（select语句）中的内部，某些位置，又出现的“查询语句”。
则有两个概念：
主查询：
子查询：
通常，子查询是为主查询服务的，而，通常，都是子查询获得一定的结果数据之后，才去执行主查询；

在形式上，可以有如下表达：
selelct 字段或表达式或子查询 [as 别名] from 表名或链接结果或子查询 where  字段或表达式或子查询的条件判断
即可以在这几个位置出现子查询（其中having其实也可以，因为它跟where是一样含义）；


按子查询结果，分为：
表子查询 ： 
	一个子查询返回的结果理论上是“多行多列”的时候。此时可以当做一个“表”来使用，通常是放在from后面。
行子查询 ： 
	一个子查询返回的结果理论上是“一行多列”的时候。此时可以当做一个“行”来使用，通常放在“行比较语法”中；
	行比较语法类似这样：where  row(字段1，字段2) = (select 行子查询)
列子查询 ： 
	一个子查询返回的结果理论上是“多行一列”的时候。此时可以当做“多个值”使用，类似这种：(5, 17, 8, 22)。
标量子查询：
	一个子查询返回的结果理论上是“一行一列”的时候。此时可以当做“一个单个值”使用，类似这种：select 5 as c1; 或select ...where a = 17，或select ... where b > 8;即上述“单个数据值”，可以用标量子查询来代替；


子查询，按位置（场合）分：
作为主查询的结果数据：
	select c1,(select f1 from tab2) as f11 from tab1; #这里子查询应该只有一个数据（一行一列，标量子查询）
作为主查询的条件数据：
	select c1 from tab1 where c1 in (select f1 from tab2); #这里子查询可以是多个数据（多行一列，列子查询）
作为主查询的来源数据：
	select c1 from (select f1 as c1, f2 from tab2) as t2; #这里子查询可以是任意查询结果（表子查询）。
</pre>

###常见子查询
<pre>
1.比较运算符中的子查询
形式：
操作数 比较运算符 (标量子查询)；
说明：
操作数，其实就是比较运算符的2个数据之一而已，通常就是一个字段名；
select ....  from XXX where  id > 5;

例子:找出最高价的商品
select * from product where price = (select max(price) from product);

2.使用in的子查询
以前用的in的用法：
XX  in  (值1，值2，值3，....）；
则in子查询为：
XX  in  (列子查询)

找出所有类别名称中带“电”这个字的所有商品；
select * from product where protype_id in (select protype_id from product_type where protype_name like '%电%');

3.使用any的子查询
形式：
操作数 比较运算符 any  (列子查询)；
含义：
当某个操作数（字段） 对于该列子查询的其中任意一个值，满足该比较运算符，则就算是满足了条件；
即：只要有一个值满足，就算是满足；
进一步解释：
假设表1(tab1)有数据为：
id,   name
1	‘aa’,
5	‘bb’
11	‘cc’
假设表2(tab2)有数据为：
f1		f2
3		‘x1’
6		‘x2’
12		‘x3’
则：
select  *  from  tab1  where  id >  any  (select  f1  from  tab2);
则可以取出的结果数据有：
5	‘bb’
11	‘cc’


4.使用all的子查询
形式：
操作数  比较运算符 all   (列子查询)；
含义：
当某个操作数（字段） 对于该列子查询的所有数据值，都满足该比较运算符，才算满足了条件；
即：要求全部都满足，才算是满足；
进一步解释：
假设表1(tab1)有数据为：
id,   name
1	‘aa’,
5	‘bb’
11	‘cc’
假设表2(tab2)有数据为：
f1		f2
3		‘x1’
6		‘x2’
12		‘x3’
则：
select  *  from  tab2  where  f1  >  all  ( select  id  from   tab1 );
结果是：
12		‘x3’

例子源码:
(1)查询出所有非最高价的商品:
select * from product where price < any(select price from  product);
select * from product where price < some(select price from  product);

(2)查询出所有最高价的商品:
select * from product where price >= all(select price from  product);


5.使用some的子查询
some与any是同义词，作用相同


6.使用exists来进行查询
形式：
where  exists( 子查询 )
含义：
该子查询如果“有数据”，则exists的结果是true，否则就是false

说明：
因为，exists子查询的该含义，造成主查询往往出现这样的情形：要么全都取出，要么都不取出。
如果局限于这个含义（使用情形），其基本就失去了它的现实使用意义。
但：
实际应用中，该子查询，往往都不是独立的子查询，而是会需要跟“主查询”的数据源（表），建立某种关系——通常就是连接关系。建立的方式是“隐式的”，即没有在代码上体现关系，但却在内部有其连接的“实质”。
此隐式连接方式，通常就体现在子查询中的ｗｈｅｒｅ条件语句中，使用了主查询表中的数据（字段）；

例子源码:
查询商品表中其类别名称中带“电”这个字的所有商品；
select * from product where exists (select * from product_type where protype_name like '%电%' and protype_id  = product.protype_id);

注意：
１，这种子查询语句，没法“独立存在（独立运行）”，而是必须跟主查询一起使用；
２，其他子查询，是可以独立运行的，而且会得到一个运行的结果。
３，该子查询中的条件，应该设定为跟主查询的某个字段有一定的关联性判断，通常该判断就是这两个表的“本来该有的连接条件”

</pre>

######(重点)最后一个结论：
如果一个查询需求，可以使用连接查询的，也可以使用子查询得到，则通常推荐使用连接插叙，效率归更高。

###联合查询
<pre>
基本概念:将两个具有相同字段数量的查询语句的结果，以“上下堆叠”的方式，合并为一个查询结果。

源码例子:
select * from join1
union
select * from join2;

可见：
１，两个ｓｅｌｅｃｔ语句的查询结果的“字段数”必须一致；
２，通常，也应该让两个查询语句的字段类型具有一致性；
３，也可以联合更多的查询结果；

联合查询（union）的语法形式:
ｓｅｌｅｃｔ　语句１
ｕｎｉｏｎ　【ａｌｌ　｜　ｄｉｓｔｉｎｃｔ】
ｓｅｌｅｃｔ　语句２；

此联合查询语句，默认会“自动消除重复行”，即默认是ｄｉｓｔｉｎｃｔ
如果想要将所有数据都显示（允许重复行），就使用ａｌｌ
即，这里，写ａｌｌ才有意义；
对比普通ｓｅｌｅｃｔ语句：
ｓｅｌｅｃｔ　【ａｌｌ　｜　ｄｉｓｔｉｎｃｔ】　。。。。
对于ｓｅｌｅｃｔ语句，写ｄｉｓｔｉｎｃｔ才有意义；
</pre>

### all | distinct 
1.在select all | distinct 的写法，默认是all，即重复数据默认是显示的,需要使用取消重复数据的功能，select distinct；
2.在union中，union all | distinct 的默认是使用distinct，若想要显示重复数据，需要显式使用 union all; 

细节：
应该将这个联合查询的结果理解为最终也是一个“表格数据”，且默认使用第一个select语句中的字段名；
<pre>
select * from join1 union select * from join2;
select * from join2 union select * from join1;
</pre>

######重点，默认情况下，order by子句和limit子句只能对整个联合之后的结果进行排序和数量限定：select... union select... order by XXX limit m,n; 就是说只有这个联合查询主要语句写完后，才能在后天添加order by内容和limit内容


###由于Mysql不能直接使用全外连接，所以我们需要使用别的查询来实现全外连接，所以使用union实现全外连接
左外连接 + union [distinct,可写，默认值为distinct] + 右外连接 
<pre>
select * from product as p left outer join product_type as t on t.protype_id = p.protype_id 
union 
select * from product as p right outer join product_type as t on t.protype_id = p.protype_id ;
</pre>