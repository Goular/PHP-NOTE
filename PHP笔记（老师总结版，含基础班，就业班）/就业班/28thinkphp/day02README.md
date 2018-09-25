#ThinkPHP第二天笔记

###默认的Think模板是不能使用短标签的PHP的代码，只能完整的进行编写php标签，默认模板下，值从controller是需要传递到view中的具体方法与smarty相似，也是使用controller下的assign('','')方法即可


#数据库操作Model模型
###1.连接配置数据库
<pre>
在shop/Common/Conf/config.php里边做数据库配置
</pre>

###2.创建model模型类
<pre>
原则：每个数据表 都对应一个Model模型类
      具体与创建Controller控制器相似，就是把Controller字样换成Model即可

为sw_goods数据表创建一个Model模型类文件

为了避免在实例化model模型类的时候 该english与主流前缀sw_做结合，就可以在EnglishModel模型类里边重写父类属性定义操作的真实数据表名即可

在Model的继承类中，覆盖一个变量
protected $trueTableName = "english";//这种写法就会忽略前缀
</pre>

###两种方式实例化model对象
<pre>
3.1实例化普通model对象
	$model = new \Model\XXXModel();
	该方式实例化对象可以调用父类Model的一些方法
	也可以在本身类制作相关方法并调用
3.2 实例化基类Model对象
	可以实现对数据库的基本操作
	$model = D();    		//实例化基类Model，没有关联任何表
	$model = D(‘Goods’);   //实例化基类Model对象,并操作xx_goods业务数据表
	(该方式允许我们即使不创建具体的model模型类文件，也可以对数据表的数据进行操作)
如果一个数据表没有特殊方法要求，就可以通过D(XXX)进行操作。
如果数据表有特殊方法要求(例如用户名和密码判断需要一个特殊方法)，就需要在普通model模型类里边定义好，通过new  \Model\XXXModel()形式实例化对象，进而操作特殊方法。
</pre>

#三. 数据基本操作
###1. 数据查询操作
<pre>
调用方法：model对象->select()
具体使用：
	$model -> select();      //查询并返回数据表的全部记录信息
	$model -> select(主键id值);   //查询主键信息等于条件id值的记录
	$model -> select(‘id1,id2,id3...’);  //查询主键信息在条件范围内的记录
	(使用select()方法会始终返回一个二维数组信息)

数据查询select()方法的具体使用
商品信息在模板中被foreach遍历展示
</pre>

###1.1 具体数据操作方法使用
<pre>
①where()条件
$model -> where(条件值);  //条件值就是sql语句where后边的条件信息
②limit()限制条数
$model -> limit(数字);  //严格查询数字条数的记录
③field ()限制查询字段
$model -> field(字段1，字段2，字段3);
④order() 排序
$model -> order(‘排序条件字段asc/desc’);
⑤group() 分组查询group by
$model -> group(分组条件);
group by 分组查询的具体应用
⑥having()条件设置方法
having设置查询条件的效果 与 where使用效果类似
区别：
where：语句条件字段，必须是“数据表中存在的”字段
having：语句条件字段  必须是查询结果集中存在的字段


where()/limit()/field() 三个方法直接存在于父类Model里边
having()/order()/group() 三个方法存在于Model的魔术方法__call()里边
一个对象调用本身类不存在的方法，会自动执行__call()魔术方法
</pre>

###1.2连贯操作
<pre>
以上具体方法在使用的时候可以一并使用多个，形成连贯操作,并且没有顺序要求
例如：
$obj  ->  limit() -> order() -> field() -> having() -> group()->select()
每个方法执行完毕都把参数信息传递给成员options，该options形成一个数组
系统最后就是依次把options数组的各个元素拼装到基本结构sql语句里边

连贯操作的关键是每个方法要return $this

各个辅助方法可以连贯操作，并且没有顺序要求，它们在Think/Db/Driver.class.php里边被依次替换为基本结构sql语句的各个组成部分
</pre>

###总结
<pre>
1.数据库连接配置
2.2 数据模型类创建(Model/GoodsModel)
3.3 model模型对象创建
a)① 创建普通model对象  new  \Model\XXXModel();
b)b② 创建父类Model对象   D([‘表名字’])
4.数据查询操作
a)select()  select(数字)  select(“n1,n2,n3..”)
该方法始终返回一个二维数组结果
5.辅助方法
where()/limit()/field()/order()/group()/having()
6.连贯操作
$obj -> where()->limit() -> field()->order() -> group() -> select()
</pre>

###2. 数据添加操作(操作完成后会返回新创建的id的值)
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

###3. 数据修改操作（数据修改必须设置条件，主键id 或 where()方法，二选一即可，否则执行失败。）
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

#4.在后台实现商品添加逻辑
###1)制作添加表单
<pre>
添加商品表单展示
</pre>

###收集表单信息实现数据写入数据库
<pre>
在控制器操作方法里边收集表单信息
(tianjia()操作方法通过分支语句体现两个逻辑：展示表单和收集表单信息)
</pre>

#在后台实现数据修改操作
###5.1 get参数的传递和接收
<pre>
pathinfo路由解析方式传递get参数信息格式：
http:网址/index.php/分组/控制器/操作方法/名称/值/名称/值
控制器操作方法接收get参数：
并不是直接使用$_GET接收信息，而是通过方法的形式参数接收。
function  方法名称($名称,$名称){}
传递的get变量名称与方法形参变量的名称必须一致
(形参参数在没有默认值的情况下，每次请求必须传递)

例如：
http://网址/index.php/Admin/Goods/upd/goods_id/171/goods_name/htc_two 
上述url通过pathinfo路由传递了两个get参数信息，在upd操作方法里边要定义形参接收：
function  upd($goods_id,$goods_name){
}
</pre>

###5.2 数据修改的实现步骤
<pre>
1)通过pathinfo方式传递get参数信息，传递被修改的商品id信息
2)在操作方法里边通过定义形参接收传递的get参数信息
3)在update.html模板里边展示被修改商品信息
	upd方法有两个处理逻辑：展示表单、收集表单
	在修改数据的form表单里边制作一个goods_id的隐藏域，以便接收该信息，
	满足数据修改二选一条件设置(where()方法 或 主键id值)
4) 接收表单传递的数据、保存到数据库、页面跳转
upd方法有两个处理逻辑：展示表单、收集表单

在修改数据的form表单里边制作一个goods_id的隐藏域，以便接收该信息，
满足数据修改二选一条件设置(where()方法 或 主键id值)
</pre>

###6.数据删除操作delete（一般不要直接删除，只需要修改表状态就代表删除，这是生产方式常用的内容）
<pre>
模型model删除数据
$z = $model->where("password='2345'")->delete();
或者使用
$model->user_id=8;
$z=$model->delete();
或者
$z=$model->delete(10);
$z=$model->delete("10,21");
</pre>

###7.执行原生sql语句(直接返回的是Model对象，不是mysql返回的内容，而是ThinkPHP的Model对象)
<pre>
$sql = “insert   select  update  delete ......”;
① 查询语句：  			$model对象 -> query($sql);    返回一个二维数组结果  
② 添加/修改/删除语句：  $model对象 -> execute($sql);   返回受影响记录条数
</pre>

#四. 实现表单自动验证
###1. 实现前台用户注册的功能
<pre>
控制器：Home/Controller/UserController
操作方法： function register(){}
		该方法两个逻辑：表单展示、收集表单
注册表单制作
收集的用户注册信息
收集注册信息并存储数据库逻辑

</pre>

###2. 实现表单自动验证（create()方法的使用，默认执行create方法的时候触发字段的提交验证，需要注意的是，D方法创建的内容是不能够使用验证规则，因为规则，都在继承Model方法中来写）
###数据验证有两种方式：静态方式：在模型类里面通过$_validate属性定义验证规则。动态方式：使用模型类的validate方法动态创建自动验证规则。 

###验证规则可以累加
<pre>
create()方法收集表单信息同时的，也可以进行表单自动验证等功能。

convertion.php中配置
'DEFAULT_FILTER'=>'htmlspecialchars'//默认参数过滤的方法， 用于配置I方法的内容，htmlspecialchars:吧特殊符号变为符号实体

I()函数默认的过滤原理：

array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),

表单自动验证的控制处理逻辑

在UserModel重复父类成员$_validate定义验证规则

把验证的错误信息在模板中给展示出来
</pre>

###总结：
<pre>
1.数据添加add()方法，返回新记录主键id值
数组、AR方式
2.数据修改save()方法，返回受影响的记录条数
数组、AR方式
注意：两个条件必须二选一：where()  或 主键id值
3.在后台实现数据的添加、修改操作
数据添加：表单页面、收集表单信息
数据修改：
① pathinfo方式传递get参数信息  分组/控制器/操作方法/名称/值/名称/值
② 接收get参数 function  方法($名称，$名称)
③ 在form表单里边设置商品的主键id值，确保数据修改成功
4.删除信息delete()、执行原生sql语句 query()/execute()
5.表单自动验证
create() 方法触发自动验证
在普通model模型类UserModel里边定义验证规则
</pre>
