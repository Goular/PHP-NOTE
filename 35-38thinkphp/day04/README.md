#ThinkPHP 第四天学习
#RBAC系统的构建

###RBAC
<pre>
RBAC: role  base  access  control  基于角色的用户访问权限控制
</pre>

###四．管理员登录系统显示对应权限
<pre>
操作位置：Admin/Index控制器/left方法
管理员登录系统，在session里边存放管理员的id信息：$_SESSION[‘admin_id’]
通过$_SESSION[‘admin_id’]可以获得角色的role_id信息
通过role_id就可以获得权限的ids信息，进而获得需要显示的全部权限
	1.普通用户显示本身拥有的权限
</pre>

###五．角色数据维护
<pre>
给操作权限设置请求的路由地址
1 展示角色列表
控制器： RoleController
操作方法：showlist
模板：View/Role/showlist.html

2.给角色分配权限
2.1表单展示
在Role/showlist.html页面设置“分配权限”的超链接按钮，并把被分配权限的角色id传递过去：
在RoleController/fenpei操作方法里边获得被分配权限的角色信息 和 所有的权限信息，并传递给模板显示：

2.2收集表单
给Role/fenpei.html模板做细节处理：

</pre>

###总结：
<pre>
1.数据表设计、数据模拟
2.管理员登录系统，左侧显示对应权限(admin_id--->role_id---->auth_info)
admin超级管理员显示全部的权限
IndexController/left
3.角色维护
a)列表展示(RoleController/showlist    模板showlist.html)
b)为角色分配权限
表单展示(RoleController/fenpei   在模板里边显示全部可以分配的权限fenpei.html)
收集表单信息（数据不能直接更新，需要二期制作saveAuth()）
</pre>

###六．权限数据维护
<pre>
1. 列表展示
控制器：AuthController
操作方法：showlist
模板页面：Auth/showlist.html

字符串排序规则：字符串左边开始 每位每位 按照ascII码顺序排序

2.添加权限操作
步骤：
① 控制器和操作方法  AuthController/tianjia
② 制作添加(模板)表单页面  Auth/tianjia.html
③ 收集表单信息
	AuthController/tianjia
④ 实现数据入库
2.1展示添加权限的表单
添加权限展示表单控制器方法部分
添加权限表单展示

</pre>

###总结：
<pre>
1.给角色分配权限，收集表单权限信息
其中两个字段role_auth_ids和role_auth_ac需要在RoleModel的saveAuth()方法里边实现二期制作
2.权限维护：
a)列表展示
b)添加权限：四个字段可以直接写入数据库，path和level字段需要二期制作
    AuthModel的saveData()方法实现path和level的制作
3.给shop项目的后台控制器制作一个父类控制器AdminController
在该AdminController的构造方法里边实现：
① 用户访问权限控制过滤效果(a/b/c三方面控制)
② 未登录系统用户禁止访问后台，并使其跳转到登录页面去
</pre>

###八．登录验证
<pre>
没有登录系统用户访问后台，要禁止其操作，并是其自动跳转到登录页面去。

在AdminController的构造方法实现未登录系统用户跳转到登录页面去：


</pre>

###九．管理员的列表、添加、修改自行维护
<pre>

</pre>