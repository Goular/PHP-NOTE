#第十四天笔记
###继承
<pre>
继承：一个类从另一个已有的类获得其特性，称为继承。
派生：从一个已有的类产生一个新的类，称为派生。
父类/子类：已有类为父类，新建类为子类。父类又可以称为“基类”，上级类，子类又称为派生类，下级类，
单继承：一个类只能从一个上级类继承其特性信息。PHP和大多数面向对象的语言都是单继承模式。C++是多继承。
扩展：在子类中再来定义自己的一些新的特有的特性信息（属性，方法和常量）。没有扩展，继承也就没有意义了。
</pre>

###访问修饰符
<pre>
形式：
class  类名{
访问控制修饰符  属性或方法定义；
}

public公共的：在所有位置都可访问（使用）。
protected受保护的：只能再该类内部和该类的子类或父类中访问（使用）。
private私有的：只能在该类内部访问（使用）。

他们的作用是：用来“限制”其所修饰的成员的“可访问性”；

可访问性表
			类内部	继承关系类内部	类外部
public	  	 Yes		Yes			 Yes
protected	 Yes		Yes			 No
private		 Yes		No			 No

总结说明：
1，public修饰的成员，哪里都能访问；
2，类的内部，可以访问任何级别的成员；
3，public具有最宽泛的可访问性；private具有最狭小的可访问性；protecte则居中；
</pre>

###parent关键字
<pre>
parent表示“父母”的意思，在面向对象语法中，代表“父类”
——本质上就是代表父类这个“类”，而不是父类的“对象”；
其使用方式为：
parent：：属性或方法；	//通常是静态属性或静态方法，但有时候可能是实例属性或实例方法；

关键字		含义					 使用位置：			使用示例
parent：		代表父类（这个类）		 肯定在一个方法中		parent：：属性或方法；
self：		代表当前其所在的类		 肯定在一个方法中		self：：静态属性或方法；
$this：		代表调用当前方法的对象	 肯定在一个方法中		$this->实例属性或方法；
</pre>

###构造方法和析构方法调用上级同类方法的问题
<pre>
1，如果一个类 有 构造方法，则实例化这个类的时候，就 不会 调用父类的构造方法（如果有）；
2，如果一个类没有构造方法，则实例化这个类的时候，就会自动调用父类的构造方法（如果有）；
3，如果一个类 有 析构方法，则销毁这个类的时候，就 不会 调用父类的析构方法（如果有）；
4，如果一个类没有析构方法，则销毁这个类的时候，就会自动调用父类的析构方法（如果有）；
5，如果一个类中有构造方法或析构方法，则就可以去“手动”调用父类的同类方法（如果有）；
手动调用的语法形式总是这样：
parent：：构造方法或析构方法()

则，第5种情况，parent在构造方法中的一个典型代码（写法）：
（在子类的构造方法中，常常需要去调用父类的构造方法，以简化对象的初始化工作。）
</pre>

###覆盖（override）
<pre>
基本概念
覆盖，又叫“重写”：
含义：
将一个类从父类中继承过来的属性和方法“重新定义”——此时相当于子类不想用父类的该属性或方法，而是想要定义。

覆盖的现实需要：
对于一个父类，或许其属性的现有数据（值），子类觉得不合适，而需要有自己的新的描述；
或许其方法，子类觉得也不合适，需要自己来重新定义该方法中要做到事。
此时就可以使用覆盖。

重写的基本要求：
访问控制权限：
子类覆盖的属性或方法的访问控制权限，不能“低于”父类的被覆盖的属性或方法的访问控制权限：
具体来说：
父类： public		子类：只能是public
父类： protected	子类：可以说protected和public
父类： private	子类：不能覆盖！——既父类的私有成员，不存在被子类覆盖的可能。

方法的参数形式：
子类覆盖父类的同名方法的时候，参数要求跟父类保持一致；
特例：
构造方法重写的时候参数可以不一致

注意（重点记住）：
虽然父类的私有属性不能被覆盖，但子类却可以定义自己的跟父类同名的属性；
虽然父类的私有方法不能被覆盖，但子类也不能定义自己的同名方法；
</pre>

###最终类
<pre>
最终类，其实就是一种特殊要求的类：要求该类不允许往下继承下去。

形式：
final  class  类名{
//类的成员定义。。。跟一般类的定义一样！
}

最终方法
最终方法，就是一个不允许下级类去覆盖的方法！！

形式：
class  类名{
final  function  方法名(形参列表...){ 。。。。。 }
}
</pre>

###设计模式
<pre>
什么叫设计模式？
简单来说，设计模式就是解决某个问题的一般性代码的经验性总结。
类比来说：
它类似之前所学的“算法”：针对某种问题，使用某种特定的语法逻辑就可以完成该任务。

工厂模式
所谓工厂模式，就是这样一个类（就是所谓的工厂类）：
它可以根据“传递”给他的类名，而去生产出对应的类的对象。

单例模式：
例，就是实例（Instance），其实就是对象（object）
单例：就是一个对象；
单例模式：就是设计这样一个类，这个类只能“创造”出它的一个对象（实例）；
</pre>