## 电子商城第三天
###
<pre> 修改内容
	取商品时连表取出品牌名称【* 连表操作是做项目的基础，一定要熟练掌握！！！！！】
	修改商品模型中的search方法中取数据的代码
</pre>

### 扩展：内连和外连的区别？
<pre>
	外链：

	特点：主表的数据一定能取出来，无论有没有关联的数据。
	主表：LEFT JOIN就是指左边的表是主表。
	
	内连：
	特点：办查询出两个表有关联的数据
</pre>

### 控制器的名称首字母必须小写，后面可以单词可以大写

### MySQL自带外键
<pre>
	扩展：如何不使用代码删除，当删除商品时会员价格表中的记录自动被删除？
	可以使用MYSQL中自带外键约束来实现【前提：只有InnoDB引擎支持】
	
	foreignkey key (goods_id) references p39_goods(id) on delete cascade;
</pre>

### 上传文本的时候执行时间较少
<pre>
	脚本执行时间【默认PHP一个脚本只能执行30秒】
	可以在上传图片之前调用
	
	在执行前添加下面的语句:
	set_time_limit(0);
</pre>

### 扩展：PHP中的U函数
<pre>
	php中的大U函数三个参数：
		U('ajaxDelPic')                    ==>   /index.php/Admin/Goods/ajaxDelPic.html
		U('ajaxDelPic?id=1')                  ==>   /index.php/Admin/Goods/ajaxDelPic/id/1.html
		U('ajaxDelPic', array('id'=>1))      ==>   /index.php/Admin/Goods/ajaxDelPic/id/1.html
		U('ajaxDelPic', array('id'=>1), FALSE)      ==>   /index.php/Admin/Goods/ajaxDelPic/id/1
</pre>

### 如果需要特殊的变量，但是标签没有位置可以放置，此时可以自定义属性，使用Jquery的attr方法即可获取复杂内容.
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