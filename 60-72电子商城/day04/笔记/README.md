## 电子商城学习第四天

### 使用apache服务器可以使用自带的ab.exe做压力测试.

###　商品分类修改注意
<pre>
<tr >
                < td class="label">商品分类名称:</td >
                < td >
                    <!--这个位置需要注意的是，自己下属的子分类和自己是不能显示的，不然就会出现死循环，自己闭环，然后没有形成分类的树状形式,会内存溢出-->
                    <select name="parent_id">
                        <option value="0">顶级分类</option><!--这个可以不做IF判定，原因是这是第一个必定会显示出来，在没有任何被选择的情况下 -->
                        < ?php
                            foreach($catData as $key => $value):
                                if($catObj['id']==$value['id']||in_array($catObj['id'],$catIdDatas)) //防止自己绑定自己，或者是当前的下级绑定父节点是你，你的父节点是你的下级，这样会造成脱离顶级树状根节点的问题，这样就会死循环，找不到相关的分类内容
                                    continue;
                                if($catObj['parent_id']==$value['id'])
                                    $selected = "selected=\'selected\'\;";
                                else
                                    $selected = '';

                        ?>
                        < option value="<?php echo $value['id']?>"
                        < ?php echo $selected;?>>
                        < ?php echo str_repeat('-',8*$value['level']).$value['cat_name'];?>
                        < /option>
                        < ?php endforeach;?>
                    < /select>
                < /td>
            < /tr>
</pre>

### 商品添加主分类的时候是不存在顶级分类的，因为顶级分类仅仅是子分类才能使用，用于构建一颗树

### 在商品列表中再添加一列：“扩展分类名称”,gtoup_concat方法 大小写敏感，可以采用 group_contact(e.cat_name separator '<br/>'）分隔符进行分隔.
<pre>

	如果在处理一对多（左连接）的时候，出现了多个重复显示的相同条数，此时，显示的列表就会出现重复，我们可以使用分组，即group by 来进行处理，这样我们的就仅仅会出现一条记录，但是一条记录也是不对，因为拓展商品属性还是没有获取出来，
	此时我们需要使用MySQL的自带方法（group_concat）来绑定相关group by 字段的内容，同时拼接分组后多出来的拓展商品属性名称的字符串，这样，既可以解决重复的问题，也可以解决拓展商品内容内容显示不全的问题
	


	group_concat()函数总结 

	group_concat()，手册上说明:该函数返回带有来自一个组的连接的非NULL值的字符串结果。
	比较抽象，难以理解。

	通俗点理解，其实是这样的：group_concat()会计算哪些行属于同一组，将属于同一组的列显示出来。要返回哪些列，由函

	数参数(就是字段名)决定。分组必须有个标准，就是根据group by指定的列进行分组。

	group_concat函数应该是在内部执行了group by语句，这是我的猜测。

	1.测试语句：SELECT group_concat(town) FROM `players` group by town

	结果去查找town中去查找哪些值是一样的，如果相等，就全部列出来，以逗号分割进行列出，如下：

	group_concat(town)
	 
	北京,北京
	长沙


	2.测试：SELECT group_concat( town )
	FROM players
	结果：
	group_concat(town)
	长沙,北京,北京,

	上面是否可以证明，group_concat只有与group by语句同时使用才能产生效果? 下面进行了实际测验


	3.测试常量对group_concat()的配置影响：
	SET @@GROUP_CONCAT_MAX_LEN=4
	手册中提到设置的语法是这样的：
	SET [SESSION | GLOBAL] group_concat_max_len = val;

	两种有什么区别？

	SET @@global.GROUP_CONCAT_MAX_LEN=4;
	global可以省略，那么就变成了：SET @@GROUP_CONCAT_MAX_LEN=4;


	4.使用语句 SELECT group_concat(town) FROM `players`。结果得到：
	group_concat(town)
	长沙,北京,长沙,北京
	结论：group_concat()函数需要与group by语句在一起使用，才能得到需要的效果。
	原因可以这样理解：group_concat()得到是属于x组的所有成员(函数里面列参数指定需要显示哪些字段)。x组从哪里来？如

	果没有group by进行指定，那么根本不知道group_concat()根据哪个分组进行显示出成员。 所以，像上面没有group by子句

	的时候，就显示了长沙和北京。
</pre>

### MYSQL中的锁和PHP中的锁
<pre>
	MySQL的锁包含行锁(InnoDB)和表锁(MyIsam)
	
	MYSQL中的表：
	语法 ：
		LOCK TABLE 表名1 READ|WRITE, 表名2 READ|WRITE ..................
		UNLOCK TABLES

	Read:读锁|共享锁 ： 所有的客户端只能读这个表不能写这个表
	Write:写锁|排它锁： 所有当前锁定客户端可以操作这个表，其他客户端只能阻塞

	注意：在锁表的过程中只能操作被锁定的表，如果要操作其他表，必须把所有要操作的表都锁定起来！！
	
	
	PHP中的文件锁:
		创建一个文件作为锁，若锁没有打开，就直接返回不操作，锁打开了就操作，这样能够防止因并发问题产生的脏读现象.
	
		flock($fp,LOCK_EX); //ex为写锁
			操作代码...
		flock($fp,LOCK_UN);
		fclose($fp);
		
	总结：项目中应该只使用PHP中的文件锁，尽量避免锁表，因为如果表被锁定了，那么整个网站中所有和这个表相关的功能都被拖慢了。

	应用场景：
	1.高并发下单时，减库存量时要加锁
	2.高并发抢单、抢票时要使用

	如何模拟高并发访问一个脚本：可以使用APACHE中的ab.exe软件：	
</pre>

### 模拟MySQL高并发的访问请求
<pre>
	使用的是Apache文件夹自带的ab.exe做压力测试,可以模仿多人同时并发的效果，可以查看并发时，数据丢失或脏数据的问题.

	apache\bin\ab.exe -c 10 -n 20 http://localhost/text/index.php 其中-c为模拟并发量为20 -n为共请求的次数	

	如果没有加锁，那么会出现一种情况就是，脏读与幻读，在变更的update的时候就已经是99，但由于之前你获取的数为100，所以执行后还是99，出现脏读修改数据后没有变化的现象	
</pre>