# 第六天 电子商城

### 如果商品属性为唯一属性，那么就不用为其设定价格时显示，原因是，怎么定的价格都是由于不同的属性才能产生的
<pre>
	根据数列的内容，有三种属性，每种属性有三个选项的，就有3*3，即9个价格
</pre>

### 分类属性必须进行排序，这样搜索的时候才不会搜索不到

### 一个人可以存在多种角色

### 如果更新的时候没有密码的修改的内容，那么我们只需要将password进行unset即可，那么activerecord就不会进行强制修改了

### JQUERY中prop和attr的区别
<pre>
	对于HTML元素本身就带有固有属性的，在处理的时候，我们使用prop方法
	对于HTML元素是我们自己自定义的DOM属性，在处理的时候，使用attr方法
</pre>

### 通过网络加载的图片包含验证码，如果点击刷新的时候不加Math.Random(),那么就会出现浏览器缓存现象，即304，不会服务器发送更新验证码请求