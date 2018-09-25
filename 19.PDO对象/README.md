#十九天笔记
###MVC部分只需要看mvc-demo15即可


###PDO
<pre>
PDO是别人写的“数据库操作工具类”！
具有跨数据库平台的特点，只需要一个对象，即可访问多种数据库，而且不用改代码，类似JDBC

使用它，类似这样：
$pdo  = new PDO(连接信息);
$sql = “select * from .....”;
$result = $pdo->query($sql);	//返回一个“pdo结果集”；
$sql = “delete / update / insert  ........ ”;
$result2 = $pdo->exec($sql);	//返回一个真假值；

手册可以找到：
函数参考》数据库扩展》数据库抽象层》PDO；

要操作某种数据，就得去“打开”对应的pdo引擎。
pdo引擎，在哪里打开？
——在php.ini的配置文件中，无非就是一个“模块”而已

使用pdo连接mysql数据库
$DSN = "mysql：host=服务器地址/名称；port=端口号；dbname=数据库名";
$Opt = array(PDO::MYSQL_ATTR_INIT_COMMAND=>’set names 连接编码’);
$pdo = new pdo($DSN, "用户名", "密码", $Opt);


使用pdo连接mysql数据库
$DSN = "mysql：host=服务器地址/名称；port=端口号；dbname=数据库名";
//下面的这个编码能够防止SQL注入，因为可以解决字符在不同字符集下的转义
$Opt = array
(PDO::MYSQL_ATTR_INIT_COMMAND=>’set names 连接编码’);
$pdo = new pdo($DSN, "用户名", "密码", $Opt);

可见，返回来的就是一个pdo类的对象。

pdo对象的使用（常见方法,但这个不能防止SQL注入）
$result = $pdo->query(“返回结果集的sql语句”);		//对比最原始的函数： mysql_query(“select ..... “)
结果：
成功：就是一个pdo结果集对象（后续马上学习）；
失败：false；

$result = $pdo->exec(“增删改的sql语句”);
结果： true（表示成功），false（表示失败）；

$pdo = null;		//销毁该对象；

其他操作：
$pdo->lastInsertId();
o获取最后添加的id值；
$pdo->beginTransaction();：
o开启一个事务
$pdo->commit()
o提交一个事务
$pdo->rollBack();
o回滚一个事务；
$pdo->inTransaction();
o判断当前行是否在事务中，返回true/false
$pdo->setAttribute(属性名，属性值）;
o设置pdo对象的属性值；
o举例：$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)

$pdo->begintrsaction();
$pdo->exec(“insert ....”);
$pdo->exec(“delete ....”);
$v1 =  $pdo->intransaction();	//结果是true



pdo的错误处理
静默模式
默认情况下，pdo采用“静默模式”处理错误：
就是发生了错误后，并不提示，而只是返回false。我们需要在程序中去判断返回是否为fale，然后，如果是false，再去“主动”获取错误信息。——跟mysql一样！
对比mysql：
$sql  = “updateeeee  tab  set  name = ‘abc’  ； ”;
$result  =  mysql_query($sql);		//这里，执行该sql语句，肯定出错
if( $result  ===  false){
echo “发生错误：”  .  mysql_error();
}
else{......}
则对pdo来说，大致如此：
$sql  = “updateeeee  tab  set  name = ‘abc’  ； ”;
$result  =  $pdo->exec ($sql);		//这里，执行该sql语句，肯定出错
if( $result  ===  false){
echo “发生错误：”  .  $pdo->errorInfo();		//这里只是示意；
//实际情况是：$pdo->errorInfo（）返回的是一个“数组”，其中的下标为3的项，才是错误提示内容
}
else{......}


异常模式

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)

可以简单理解为：适应面向对象语法的处理错误的一种语法结构。如下所示：

try{
在这里，可以执行“可能出错”的语句（多条也可以）；
一旦发生错误，就会终止当前范围的后续程序执行，
而立即跳转到catch部分——处理错误！
}
catch( Exception  $e ){
//一旦发生错误，就会进入这里，此时，并会生成一个“错误对象”；
//该错误对象，就是系统类Exception的一个实例：它包含了错误信息。
}

pdo要使用异常模式，就得专门设置（因为其默认是静默模式）：



</pre>


###PDO结果集对象
<pre>
pdo的结果集对象（PDOStatement）
pdo的结果集对象从哪里来？
——来自pdo对象执行“返回数据集的sql语句”并成功的时候，得到的就是pdo的结果集对象。

$stmt  =  $pdo->query(“select ..... “);		//如果执行成功，则$stmt就是pdo的结果集对象


pdo结果集对象的常用方法
$stmt = $pdo->query(“select ...... ”);//这是获得结果集
$stmt->rowCount() ;	//得到结果集的行数
$stmt->columnCount() ;	//得到结果集的列数
$stmt->fetch( [返回类型] ); //从结果集中取出“一行”数据；
取出的结果，由其中的“返回类型”来决定，常用的有：
PDO::FETCH_ASSOC：表示关联数组
PDO::FETCH_NUM：表示索引数组
PDO::FETCH_BOTH：表示前二者皆有，这是默认值
PDO::FETCH_OBJ：表示对象
$stmt->fetchAll([返回类型]);一次性获取结果集中的所有数据，返回的是一个二维数组，相当于我们自己写的GetRows()
$stmt->fetchColumn( [$i] );获取结果集中的“下一行”数据的第$i个字段的值，结果是一个“标量数据”，相当于我们自己的写的：GetOneData()
$stmt->fetchObject();
$stmt->errorCode();：pdo结果集的错误代号
$stmt->errorInfo();  pdo结果集的错误信息（是一个数组）
$stmt->closeCursor(); 关闭结果集（相当于mysql_close()  )


pdo中的预处理语法
什么叫预处理语法
就是，为了“重复执行”多条结构类似的sql语句，而将该sql语句的形式“进行预先处理”（编译）；
该sql语句的“形式”中，含有“未给定的数据项”。

然后，到正式执行的时候，只要给定相应的形式上的“数据项”，就可以更快速方便执行。

比如（有两种预定义语法）：

语法1：
$sql = “select  *  from  tab   where  id = ? “;	//这里这个“？”就是未给定的数据项；这里通常叫做“占位符”
//也可以是多个问好。

语法2：
$sql = “select  *  from  tab   where  id = :v1  and  name  =  :v2 “;	//这里这个“:v1”和 “:v2” 就是未给定的数据项；通常这里叫做“命名参数”；
怎么使用？
分3步：

1，对含预处理语法的sql语句进行“预处理”：
$stmt = $pdo->prepare( $sql );	//
2， 对上述预处理的结果对象（$stmt)的未赋值数据，进行赋值：
$stmt->bindValue( 数据项1， 值1）；
$stmt->bindValue( 数据项2， 值2）；
。。。。。。
3， 执行执行：
$stmt->execute();
这样之后，该sql语句就算正式完成！
</pre>
