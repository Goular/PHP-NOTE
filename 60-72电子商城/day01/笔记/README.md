# 电子商城项目开发

### 字母方法
<pre>
	I()方法：过滤输入变量
	D()方法：根据Model文件创建模型对象，找不到与M方法一致
	M()方法：根据数据库的表创建对象
	C()方法：读取/设置配置量的方法
</pre>

### 安装和配置
<pre>	
	使用框架：ThinkPHP3.2.3
	开发周期：12天
	使用环境及工具：git、PhpStorm、xampp等
	
	过程:
		1.搭建GIT
		2.配置虚拟主机和修改host访问地址
		3.开启Apache即可
</pre>

### 前端资源文件的配置
<pre>
	在各自的模块下，添加下面的配置文件，然后通过C("配置文件的名称")进行获取并显示
	配置Admin/conf/conf.php
	return array(
    //前台管理页面的CSS访问路径
    'HOME_CSS_URL' => __ROOT__ . '/Public/Home/Styles',
    //前台管理页面的Js访问路径
    'HOME_JS_URL' => __ROOT__ . '/Public/Home/Js',
    //前台管理页面的Images访问路径
    'HOME_IMG_URL' => __ROOT__ . '/Public/Home/Images'
);
</pre>

### 建商品表
<pre>
	说明：大文本字段需要使用全文索引，但是MYSQL中全文索引不支持中文 ，我们以后会学习SPHINX【全文索引引擎】来优化根据大文本字段查询数据的速度。
	扩展：推荐使用InnoDB有很好的故障恢复功能。
	MyISAM ：只有插入和查询操作、性能更快、故障恢复能力较差，容易丢失数据。
</pre>

### view调用
<pre>
	$this -> display();   		//模板名称与当前操作方法的名称一致
	$this -> display(模板名称);  		//调用当前控制器对应目录指定名称的模板
	$this -> display(控制器/模板名称);  //调用其他控制器下的具体模板文件
</pre>

### 获得当前请求的全部常量信息
<pre>
	http://网址/shop/index.php/分组/控制器/操作方法/名称1/值/名称2/值
	__MODULE__: 路由地址分组信息 （/shop/index.php/分组）
	__CONTROLLER__: 路由地址控制器信息  （/shop/index.php/分组/控制器）
	__ACTION__:路由地址操作方法信息 （/shop/index.php/分组/控制器/操作方法）
	__SELF__: 路由地址的全部信息(/shop/index.php/分组/控制器/操作方法/名称1/值/名称2/值）
	MODULE_NAME:  分组名称
	CONTROLLER_NAME：控制器名称
	ACTION_NAME: 操作方法名称
	
	获取当前全部的常量:get_defined_constants(true);
</pre>

### 配置文件
<pre>
	① ThinkPHP/Conf/convention.php  系统主要配置文件
	② shop/Common/Conf/config.php   当前shop项目的配置文件
								针对各个分组起作用
	③ shop/Home/Conf/config.php      当前shop项目Home分组的配置文件
	以上三个配置文件，如果存在同名的配置变量，后者会覆盖前者。



	系统里边并不是全部的配置变量都有在convention.php里边定义
	A. 大部分在convention.php有定义
	B. 在Behavior行为文件里边有定义一部分(例如：SHOW_PAGE_TRACE)
	C. 在框架的代码角落里边有零星的一点配置变量(例如：MODULE_ALLOW_LIST)
</pre>

### 数据添加操作
<pre>
	调用方法：model对象->add()  
	具体两种方式使用：
	① 	数组方式
		$数组 = array(
			元素(键名=>值)，
			元素(键名=>值)，
			。。。。
		)
		$model(普通对象) -> add(数组);

		注意：数组的元素键名与数据表字段的名称必须一致

	② 	AR(Active Record活跃记录)方式
		$model -> 属性 = 值;   
		$model -> 属性 = 值;
		$model ->add();

		注意：属性值 与 数据表字段一致，否则不给写入数据

	AR规范要求：
	A.一个model模型类与一个具体的数据表对应
	B.model模型类实例化的对象 与 数据表的一条记录对应
	C.model对象的属性 与 记录的字段对应
	TP框架的AR是仿真产品,因为在每个业务/普通Model模型类里边并不存在对应数据表的字段信息。

	add()方法返回新记录的主键id值
</pre>

### 数据修改操作
<pre>
	调用方法：model对象->save()
	与add添加一致具体两种方式使用：
	① 	数组方式
		$model -> save(数组);
		
	② 	AR方式
		$model -> 属性(字段) = 值;
		$model -> 属性(字段) = 值;
		$model ->save();

	注意：数组的元素下标(属性字段)必须与数据表字段保持一致
	save()方法返回受影响的记录条数

	mysql本身的语法规则允许一次性修改一个表的全部记录结果
	在实际的项目里边，一般禁止修改数据表的全部数据


	注意：数据修改必须设置条件，主键id 或 where()方法，二选一即可，否则执行失败。
	在父类Model的save方法可以看到上述要的原理
</pre>

### 使用TP完成添加商品的功能
<pre>
	扩展：控制器中的代码都很少，具体的业务代码都写到 模型中，然后以后会发现所有的控制器其他crud的代码基本相同，区别就是生成不同的模型。
</pre>

### 2.创建商品模型【M】
<pre>
	定义表单验证规则
	创建一个添加商品的表单
	4.修改配置文件添加上DB的配置[最好采用PDO或者是mysqli方法会比较好，mysql太旧了]
		PDO的用法：
</pre>

### 所有的Action都包含展示和逻辑管理的内容，不要将其分开

### U方法
<pre>
	U方法用于完成对URL地址的组装，特点在于可以自动根据当前的URL模式和设置生成对应的URL地址，格式为：
	U('地址','参数','伪静态','是否跳转','显示域名');
	在模板中使用U方法而不是固定写死URL地址的好处在于，一旦你的环境变化或者参数设置改变，你不需要更改模板中的任何代码。
	在模板中的调用格式需要采用 {:U('地址', '参数'…)} 的方式
	
	
</pre>

###  D方法与M方法的区别
<pre>
	D为加载当前\MODEL文件夹的Model文件，生成对象，若没有文件，那么和M方法的作用一致
	M为创建一个基于当前数据表文件名的模型对象
</pre>

### I方法过滤的配置方法
<pre>
    'DEFAULT_FILTER'         => 'htmlspecialchars', // 默认参数过滤方法 用于I函数...
	
	但是我们不建议直接使用传统方式获取，因为没有统一的安全处理机制，后期如果调整的话，改起来会比较麻烦。所以，更好的方式是在框架中统一使用I函数进行变量获取和过滤。
	I方法是ThinkPHP用于更加方便和安全的获取系统输入变量，可以用于任何地方，用法格式如下：
	I('变量类型.变量名/修饰符',['默认值'],['过滤方法'],['额外数据源'])
	
	执行了I方法的内容会直接在html页面可以显示出'<p>'这样的大于号和小于号证明已经转义了。
</pre>

### 钩子函数
<pre>
	在添加、修改、删除之前或者之后有时要执行一些代码，这些代码应该写到哪？----->使用钩子函数
	比如：数据在添加到数据之前先获取当前系统时间添加到表单中
	
	总结：以后我们所有的代码基本都写在模型中，还有其他的钩子方法：
	_before_insert(&$data, $option)
	_after_insert($data, $option)
	_before_update(&$data, $option)
	_after_update($data, $option)
	_before_delete($option)
	_after_delete($option)
	以后还有哪些代码：比如上传图片的代码等等。
</pre>

### 使用百度UEditor来处理负载文本的提交
<pre>
	http://ueditor.baidu.com/website/
	
</pre>

### 在线编辑器中的HTML内容会TP过滤转义，这样效果就失效了：不转义会被攻击。
<pre>
	有选择性的过滤：只过滤掉危险的JS脚本代码、保留HTML。可以使用htmlpurifier这个开源包来做这个事儿。
	实际操作：
	1.下载
	2.压缩出library目录中的代码到项目根目录 并改名
	
	HTMLPurifer采用白名单机制
	总结：如果项目中使用了在线编辑器需要配合使用HTMLPurifer实现有选择性的过滤XSS！！
</pre>

