### AJax跨域访问(默认)  
### 默认静态的图片，脚本css，js等内容在静态页中地址不对也能访问，原因是第一次加载有一个同源策略，但是使用ajax时，为了防止利用脚本攻击的入侵等问题，所以我们会设置阻隔，禁止跨域，第一次默认加载，就不会产生影响。
###jsonp就是利用同源策略弄出来的用于解决跨域问题的解决办法之一。

### 跨域会产生下面的报错
<pre>
    XMLHttpRequest cannot load localhost:8081. Cross origin requests are only supported for protocol schemes: http, data, chrome, chrome-extension, https, chrome-extension-resource.
</pre>

<pre>
    1.JSONP
        限制:只能发送GET请求
        JSON请求你的服务器必须配合你
        
        跨域返回最主要就是不能返回json格式的内容，但是可以返回字符串，
        只要服务器和客户端，两边定义同样的访问规则，直接返回字符串的JS方法脚本，那么就可以返回内容.
        
    2.PHP代理
        使用file_get_content方法即可
</pre>