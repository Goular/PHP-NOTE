# 电商第五天

### （重点）新添加商品属性，在编辑上是不会呈现的，因为商品属性是按照存在的的进行主查询，我们需要改变思路，从属性表作为主查询，商品属性表进行left join
<pre>
	因为修改时，我们是把这件商品原来设置过的值拿出来显示的，但添加这件商品时还没有那个新属性，所以表中就没有那个属性的值，所以在这就取不出来！
	解决办法：以类型为主，先不考虑商品，只考虑当前类型：修改控制器中取商品属性值的代码：
</pre>

### 3.提交表单时把修改的商品属性数据更新到商品属性表
<pre>
	我们以前的思路都是直接清空原数据把修改的当新的重新添加，但是！这个功能不能这样做！
	因为之后做的库存量的功能需要用到 商品属性的ID，如果清空商品属性重新添加的话，ID就都变了，导致库存量的数据就不对了，最终会现出效果：每次修改商品后，库存量的数据就都失效了需要重新添加。

	现在只能只为三种情况分别处理：
	A.  添加了新属性 insert
	B.	修改了原属性 update
	C.	删除一个属性       ： 直接做成AJAX删除
	
	难点：提交表单时如何判断一个属性是被修改了还是新添加出来的？
	思路：如果是原数据肯定有个ID，新添加出来的肯定没有ID。所以我们在循环属性时判断如果这个属性有一个ID就更新、否则就添加。
</pre>

### FIND_IN_SET (mysql函数)
<pre>
	find_in_set 函数使用方法   

	个例子来说：

	有个文章表里面有个type字段，它存储的是文章类型，有 1头条、2推荐、3热点、4图文...1,12,13 等等 。

	现在有篇文章他(www.111cn.net)既是 头条，又是热点，还是图文，

	type中以 1,3,4 的格式存储。

	那我们如何用sql查找所有type中有4图文标准的文章呢？？

	这就要我们的 find_in_set 出马的时候到了。
from:http://www.111cn.net/database/mysql/50190.htm


重点，值得注意:但是：这个函数是全表扫描，无法优化！！所以如果表中数据量非常大，并且这个查询使用的非常频繁就不要用这个函数！
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