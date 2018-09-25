### 翻页
<pre>
	通常在数据查询后都会对数据集进行分页操作，ThinkPHP也提供了分页类来对数据分页提供支持。 下面是数据分页的两种示例。
	第一种：利用Page类和limit方法
	$User = M('User'); // 实例化User对象
	$count      = $User->where('status=1')->count();// 查询满足要求的总记录数
	$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
	$show       = $Page->show();// 分页显示输出
	// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
	$list = $User->where('status=1')->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
	$this->assign('list',$list);// 赋值数据集
	$this->assign('page',$show);// 赋值分页输出
	$this->display(); // 输出模板
	第二种：分页类和page方法的实现
	$User = M('User'); // 实例化User对象
	// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
	$list = $User->where('status=1')->order('create_time')->page($_GET['p'].',25')->select();
	$this->assign('list',$list);// 赋值数据集
	$count      = $User->where('status=1')->count();// 查询满足要求的总记录数
	$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
	$show       = $Page->show();// 分页显示输出
	$this->assign('page',$show);// 赋值分页输出
	$this->display(); // 输出模板
	
	
	(重点)3.2.3版分页类不显示总记录数？
	的确是不显示，看了下源文件发现
	theme的默认值是 "%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%"，其中就没有显示header的地方，所以重新设置theme值
	$Page -> setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

</pre>

### 三种为页面赋值的方法
<pre>
		//以下三种assign效果一样 ：
		// 第一种：
		$this->assign($data);
		
		// 第二种：
		//$this->assign('data', $data['data']);
		//$this->assign('page', $data['page']);
		
		// 第三种：
		//$this->assign(array(
		//	'data' => $data['data'],
		//	'page' => $data['page'],
		//));
</pre>

### UMEditor图片保存配置
<pre>
	需要自己配合，不然会自动把图片上传到umeditor/php/upload文件夹下
	
</pre>

### 搜索
<pre>
	1.先修改lst.html页面，在上面添加一个搜索的表单
	
	2.修改商品模型根据提交的条件来取数据
	
	三、排序
	1.搜索的表单中添加几个排序的按钮
	2.修改商品模型根据odby变量排序
</pre>

### 添加时间选择器插件
<pre>
	添加到前端的库的文件夹
</pre>

### 对象属性的更新操作
<pre> 
	记得要在表单中填写<input type="hidden" name="id" value="<?php echo $data['id']?>"/>
	这样才能让D()方法找到相关ID的所属列
</pre>

### 使用布局规划页面
<pre>
	制作页面时，应该把页面中公共的部分单独做成一个文件【TP中提供了模板布局】
	为什么要使用布局文件？
	维护方便将来要修改这种公共部分时只需要修改一个而已文件并不需要一个一个页面改了。
	
	
	1.创建一个布局文件【保存页头、页脚的HTML】
	2. 在所有的页面中使用LAYOUT标签引入布局文件 
	3.需要在每个页面的控制器中传三个变量设置页头信息
	
	项目中图片的两个优化【扩展和维护方式】
	1.图片的相关配置写配置文件中
	2.图片的路径不要在项目中写错，也写到配置文件中
	3.把上传图片和生成缩略图的代码封装成一个函数，这样项目中再上传图片直接调函数即可
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