#Composer学习笔记

###PHP-FIG
<pre>
PHP-FIG：PHP Framework Interop Group（PHP通用性框架小组）
作  用：制定了一系列PHP开发的规范，这些规范是未来PHP框架所要遵循的规范

PSR-0 : 自动加载规范（弃用，原因是类名包含文件夹增次，这个是不好的。T1_T2_Class）
PSR-1 : 编码规范
PSR-2 : 代码风格规范
PSR-3 : 代码风格补充规范
PSR-4 : 自动加载规范

</pre>

###Composer
<pre>
2.1 说明（Composer和Packagist）
Composer： 是PHP用来管理项目依赖的工具
依赖关系：指项目中所需要使用的外部工具库或者叫组件（ps. 组件是一组打包的代码，是一系列相关的类或接口，用于帮助我们解决PHP应用中某个具体问题）
Packagist：是composer的组件仓库

官方网址：https://getcomposer.org       （安装下载composer用） 
中文网站：http://www.phpcomposer.com/ （学习，切换镜像）
仓库地址：https://packagist.org/  		 （需翻墙）

2.2 Composer安装
安装前提条件
-   PHP版本5.3.2+ 
-   开启openssl扩展
-   安装composer需要明确php.exe的文件路径  

检查是否可用
输入【php  composer.phar】命令出现下图，composer即代表可以使用,windows的傻瓜式安装可以直接使用composer命令即可使用
说明：很多文档用 composer install 这里将 composer 换成 php composer.phar 

2.3 使用composer铺垫
情景：虚拟主机下新建class目录，目录下有两个文件 class1.php  和 class2.php ，在虚拟主机下新建test.php 实例化这两个类并打印

</pre>

###需要composer的原因
<pre>
发现：上述案例有瑕疵每次都需要外部文件麻烦
解决：通过composer 类的自动加载规避
</pre>

###2.4 Composer初体验（autoload类的自动加载）
<pre>
1）新建composer.json文件
说明：在项目根目录新建composer.json文件，主要品用于声明组件依赖关系，类的自动加载  来协助composer管理
2）配置composer.json文件
{
"autoload": {
    "psr-4": {"":"目录/"}
}
}
3）建立关系
通过composer指定指令/命令安装依赖关系所需组件，并初始化自动加载信息
php composer.phar install
切换国内镜像加快下载速度,不然会很慢
4）自动加载
对于库的自动加载信息，composer会生成一个autoload.php的文件，只需简单引入这个文件，就可以得到自动加载支持
5）代码

</pre>

#2.5 PSR-0和PSR-4规范实现自动加载
<pre>
PSR-4
在composer初体验基础上新建T1目录，新建class3.php
class Class3 {}

解决：添加命名空间

PSR-0
1、  删除class3.php 中的命名空间
2、 修改配置文件，将psr-4修改为psr-0 并重新初始化自动加载信息，通过【php composer.phar install】
</pre>

#2.6 依赖管理（require）
<pre>
1）新建composer.json文件
填入require配置项：{库的完整名称:版本号}

2）配置composer.json文件
{
"require": {
    "库的完整名称": "版本号",
    "库的完整名称": "版本号"
}
}
多学一招
1、多个require里用逗号隔开“，”
2、查找composer仓库已存在的组件，输入网址：https://packagist.org

3）下载的组件

脚下留心：
1、下载资源需要翻墙或者切换国内镜像否则非常慢
2、下载的组件位于vendor目录下
3、使用下载资源需要引入autoload.php文件，然后直接使用命名空间调用类的信息

4）使用组件
<?php 

// 引入autoload.php文件
require './vendor/autoload.php';


$data = [
    'name' => 'zs',
    'age' => 18
];

// 调用 Json的encode静态方法   序列化数据
$jsondata = \phptestsoft\Json::encode($data);

print_r($jsondata);


// 调用 Json的encode静态方法   反序列化数据
$data2 = \phptestsoft\Json::decode($jsondata);

print_r($data2);
</pre>

#2.7 PHP Composer库的意义
<pre>
提供项目组件依赖管理 并 提供下载和共享外部组件 还提供类的自动加载
</pre>

#3.composer创建自己的包
<pre>
1）本地化实现组件功能
	虚拟主机目录新建composer.json文件填入一下信息
脚下留心：“name”指包名必须唯一，也就是在composer仓库不存在https://packagist.org

 虚拟主机新建src目录（一般组件代码都放在这个目录）
 在src目录新建Json.php文件填入一下代码，即可（组件包开发完毕，等待上传）

2）上传github
新建仓库存放组件包

 发布版本（重要）(项目点击release，不然packigst不能自动更新版本)

脚下留心：如果不发布版本将导致无法提交到composer仓库
︴【多学一招】在github发行版本将在composer仓库显示

3）.提交到composer仓库packagis中
 打开composer仓库网址，通过github注册账号

脚下留心
1、使用composer的组件版本必须是1.0以上（默认提交到github上没有版本）
2、由于缓存和服务器响应问题，新增的包需要等待2小时或者隔天才可以正常下载
</pre>