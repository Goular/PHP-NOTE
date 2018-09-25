# Nginx学习笔记

### 什么是Nginx?
<pre>
	Nginx的功能
		Nginx是一种服务器软件,也是一种高性能的HTTP和反向代理服务器，同时也是一个代理邮件服务器。
		最为特出的功能那就是负载均衡了。
	
	Nginx与其他服务器的性能比较
		IIS:Windows服务器性能不如Linux服务器稳定
		Tomcat:面向Java语言，重量级的服务器
		Nginx:轻量级服务器，能支持处理百万级的TCP连接，10万以上的并发连接，同样支持跨平台服务器
		Apache：稳定，开源，跨平台，但是缺点就是Apache不支持高并发
		
	Nginx优缺点总结
		优点:是可以实现高并发，部署简单，内存消耗少，成本低
		缺点:rewrite功能不够强大，模块没有Apache的多
</pre>

### Nginx环境搭建
<pre>
	Linux下使用
		默认配置下，直接运行./configure 会报错，报错内容为没有安装g++,gc++
		yum -y install gcc gcc-c++ autoconf automake  ---y为安装的时候，要选择y/n的时候全部自动选择为y
		
		安装Nginx(安装路径可以进行配置)
			./configure 
			
		注意:上面安装完成后,会报以下错误:	./configure: error: the HTTP rewrite module requires the PCRE library.	
		解决方法: 在root下,		yum -y install pcre pcre-devel	
		
		因为上面的pcre库缺失，./configure安装不成功，我们重新安装: ./configure
		
		注意:上面安装完成后,会报以下错误:	./configure: error: the HTTP gzip module requires the zlib library.
		解决方法: 在root下,		yum -y install zlib zlib-devel	
		
		因为上面的zlib库缺失，./configure安装不成功，我们重新安装: ./configure
		Configuration summary
		  + using system PCRE library
		  + OpenSSL library is not used
		  + using system zlib library

		  nginx path prefix: "/usr/local/nginx"
		  nginx binary file: "/usr/local/nginx/sbin/nginx"
		  nginx modules path: "/usr/local/nginx/modules"
		  nginx configuration prefix: "/usr/local/nginx/conf"
		  nginx configuration file: "/usr/local/nginx/conf/nginx.conf"
		  nginx pid file: "/usr/local/nginx/logs/nginx.pid"
		  nginx error log file: "/usr/local/nginx/logs/error.log"
		  nginx http access log file: "/usr/local/nginx/logs/access.log"
		  nginx http client request body temporary files: "client_body_temp"
		  nginx http proxy temporary files: "proxy_temp"
		  nginx http fastcgi temporary files: "fastcgi_temp"
		  nginx http uwsgi temporary files: "uwsgi_temp"
		  nginx http scgi temporary files: "scgi_temp"
		
		说明配置已经完成，可以进行编译:	
		
		接着make，然后进行make install 
			出现:make[1]: 离开目录“/home/goular/下载/nginx-1.13.0”,说明安装成功.

		判断是否安装好Nginx的标识:
			查看 /usr/local/ 文件夹下是否存在nginx的文件夹即可
	
	
	
	Nginx搭建过程中常见问题:
		在Linux操作系统下搭建Nginx服务器，很多时候会出现不同的错误，在此，我们对搭建过程中出现的错误进行一些总结，
		主要的问题类型有:
				防火墙问题，缺少gc++，缺少pcre，zlib等库
</pre>

### Nginx目录结构
<pre>
	conf: 配置文件夹
	html：放置显示的页面
	logs：日志记录
	sbin:nginx运行的二进制文件夹
</pre>

### Nginx简单使用
<pre>
	Windows下: 
		直接双击 nginx.exe即可开启nginx的80监听     打开localhost有停顿才开出来
		
	Linux下:
		输入指令  /usr/local/nginx/sbin/nginx -c /usr/local/nginx/conf/nginx.conf   打开localhost，秒开
		
	综合来说，适合Nginx服务器的操作系统是Linux	
</pre>

### Nginx的启动与停止(Linux服务器下)
<pre>
	Nginx的启动:
		nginx应用程序的地址 -c Nginx的配置文件所在地址
		
	Nginx的停止:
		停止nginx有三种模式:
			1.从容停止:
				ps -ef |grep nginx 查看含有"nginx"的活动进程 [与ps -A效果差不多]
				查看到进程号后，进行从容停止:
				kill -QUIT 进程号
				
			2.快速停止:
				ps -ef |grep nginx 查看含有"nginx"的活动进程 [与ps -A效果差不多]
				查看到进程号后，进行从容停止:
				kill -TERM 进程号
				kill -INT 进程号	
				(二者作用几乎一样)
				
			3.强制停止:
				ps -ef |grep nginx 查看含有"nginx"的活动进程 [与ps -A效果差不多]
				查看到进程号后，进行从容停止:
				kill -9 进程号			
	
	Nginx的重启:
			
			方法一,sbin目录下:
				./nginx -s reload   [在停止后执行会报错，因为reload是重启]
			
			方法二,	
				ps -ef |grep nginx 查看含有"nginx"的活动进程 [与ps -A效果差不多]
				查看到进程号后，进行重启:
					kill -HUP 端口号 
					
	kill -HUP pid 
		pid 是进程标识。如果想要更改配置而不需停止并重新启动服务，请使用该命令。在对配置文件作必要的更改后，发出该命令以动态更新服务配置。				
</pre>

### 验证Nginx配置文件
<pre>
	方法1 [跟Apache相似,httpd -t]：
		[root@localhost sbin]# ./nginx -t
			nginx: the configuration file /usr/local/nginx/conf/nginx.conf syntax is ok
			nginx: configuration file /usr/local/nginx/conf/nginx.conf test is successful
	
	方法2[检测成功不会启动nginx]：
		nginx应用程序的地址 -t -c Nginx的配置文件所在地址	
</pre>

### Nginx常见的信号控制实战
<pre>
	Linux服务器下:
	kill HUP:重启
	kill QUIT:从容关闭
	kill TERM:快速关闭
	kill INT:从容关闭
	kill USR1：切换日志文件 通常被用来告知应用程序重载配置文件,日志文件切割要求,
	kill USR2：平滑升级可执行程序
	kill WINCH:从容关闭工作进程
</pre>

### Nginx 日志文件切割---------kill -usr1
<pre>
	Nginx 是一个非常轻量的 Web 服务器，体积小、性能高、速度快等诸多优点。但不足的是也存在缺点，比如其产生的访问日志文件一直就是一个，不会自动地进行切割，如果访问量很大的话，将导致日志文件容量非常大，不便于管理。当然了，我们也不希望看到这么庞大的一个访问日志文件，那需要手动对这个文件进行切割。
	在 Linux 平台上 Shell 脚本丰富，使用 Shell 脚本加 crontab 命令能非常方便地进行切割，但在 Windows 平台上就麻烦一些了，刚才弄了好长时间，就在这里记录整理一下。
	日志文件切割要求

	由于 Nginx 的日志都是写在一个文件当中的，因此，我们需要每天零点将前一天的日志存为另外一个文件，这里我们就将 Nginx 位于 logs 目录中的 access.log 存为 access_[yyyy-MM-dd].log 的文件。其实 logs 目录中还有个 error.log 的错误日志文件，这个文件也需要每天切割一个，在这里就说 access.log 了，error.log 的切割方法类似。

	Linux 平台切割

	在 Linux 平台上进行切割，需要使用 date 命令以获得昨天的日期、使用 kill 命令向 Nginx 进程发送重新打开日志文件的信号，以及 crontab 设置执行任务周期。

	先创建一个 Shell 脚本，如下：

	#!/bin/bash  
	## 零点执行该脚本  
	  
	## Nginx 日志文件所在的目录  
	LOGS_PATH=/usr/local/nginx/logs  
	  
	## 获取昨天的 yyyy-MM-dd  
	YESTERDAY=$(date -d "yesterday" +%Y-%m-%d)  
	  
	## 移动文件  
	mv ${LOGS_PATH}/access.log ${LOGS_PATH}/access_${YESTERDAY}.log  
	  
	## 向 Nginx 主进程发送 USR1 信号。USR1 信号是重新打开日志文件  
	kill -USR1 $(cat /usr/local/nginx/nginx.pid)  
	上面这个脚本中的最后一行必须向 Nginx 的进程发送 USR1 信号以重新打开日志文件，如果不写的话，Nginx 会继续将日志信息写入 access_[yyyy-MM-dd].log 的那个文件中，这显然是不正确的。

	脚本完成后将其存入 Nginx 安装目录的 sbin 中，取名为 cut-log.sh，之后使用 crontab -e 新增一个定时任务，在其中增加执行这个脚本：

	0 0 * * * /bin/bash /usr/local/nginx/sbin/cut-log.sh  
	到这里 Linux 下切割 Nginx 日志就完成了，可以将 crontab 设置为距当前时较近的时间测试一下，否则在零点出问题就不好了
</pre>

### Nginx 平滑升级---------kill -usr2
<pre>
	有时，我们需要对我们的服务器进行升级更高版本。此时，如果我们强行将服务器停止然后直接升级，这样原来在服务器上运行着的进程就会被影响。
	如何解决这个问题呢？可以通过平滑升级的方式来解决。平滑升级时，不会停掉在运行着的进程，这些进程会继续处理请求，但不会再接受新请求，
	在这些老进程在处理完还在处理的请求后，停止。此平滑升级的过程中，新开的进程会处理新请求。这就是平滑升级的简要说明

	当需要将正运行的Nginx升级，可以在不中断服务的情况下进行，具体步骤如下：
		1、使用新的可执行程序替换旧的可执行程序。下载新的Nginx,重新编译到旧版本的安装路径中。重编译之前，先备份一下旧的可执行文件。
		 
		2、执行以下指令，他将存储有旧版本主进程ID的文件重命名为.oldbin：
		kill -USR2 旧版本的Nginx主进程号
		一般情况下是这样的：kill -USR2 `cat /usr/local/nginx/nginx.pid`
		 可以用 ls /usr/local/nginx/logs来查看是否改名
		3、执行新版本的Nginx可执行程序。
		ulimit -SHn 65535
		/usr/local/nginx/sbin/nginx
		 
		4、此时新旧版本的Nginx会同时运行，共同处理请求。要逐步停止旧版本的Nginx，必须发送WINCH信号给旧的主进程。然后，他的工作进程将从容关闭。
		kill -WINCH 旧版本的Nginx主进程号
		 
		5、一段时间后，旧的工作进程处理完了所有的请求后退出，仅由新的进程来处理输入请求了。可用下面的命令查看：
		ps -ef | grep nginx
		 
		6、现在可以决定使用新版本还是恢复到旧版本：
		kill -HUP 旧的主进程号 ：Nginx在不重载配置文件的情况下启动他的工作进程
		kill -QUIT 新的主进程号  ：从容关闭其工作进程
		kill -TERM 新的主进程号 ：强制退出
		kill 新的主进程号或旧的主进程号：如果因为某些原因新的工作进程不能退出，则向其发送kill信号
		 
		新的主进程退出后，旧的主进程会移除.oldbin后缀，恢复为他的.pid文件，这样，一切就都恢复为升级之前了。
		如果尝试升级成功，而自己又希望保留新版本时，可发送QUIT信号给旧的主进程，使其退出而只留下新的进程运行：kill -QUIT 旧主进程号	
</pre>

### nginx的平滑升级，不间断服务
<pre>
Nginx更新真的很快，最近nginx的1.0.5稳定版，nginx的0.8.55和nginx的0.7.69旧的稳定版本已经发布。我一项比较喜欢使用新版本的软件，于是把原来的nginx-1.0.2平滑升级至nginx-1.0.5稳定版。并记录这一过程，参照这一过程也适用其他版本的升级，都是照葫芦画瓢的事情。希望对有需要的朋友有点帮助。

	1. 开始之前先查看一下当前使用的版本。

		# /usr/local/webserver/nginx/sbin/nginx -V
		nginx: nginx version: nginx/1.0.5
		nginx: built by gcc 4.1.2 20080704 (Red Hat 4.1.2-50)
		nginx: TLS SNI support disabled
		nginx: configure arguments: --user=www --group=www --prefix=/usr/local/webserver/nginx --with-http_stub_status_module --with-http_ssl_module --with-http_flv_module --with-cc-opt=-O3 --with-cpu-opt=opteron --with-http_gzip_static_module
		※ 注意红色区域，这是以前编译的参数。马上编辑新版本需要用到。

	2.下载新版本：http://nginx.org/en/download.html

		然后：解压 > 便以前的准备 > 编译

		# tar zxvf nginx-1.0.5.tar.gz
		# cd nginx-1.0.5
		# ./configure 
		--user=www 
		--group=www 
		--prefix=/usr/local/webserver/nginx 
		--with-http_stub_status_module 
		--with-http_ssl_module 
		--with-http_flv_module 
		--with-cc-opt='-O3' 
		--with-cpu-opt=opteron 
		--with-http_gzip_static_module
		# make
	3. 执行完后，这里不用在 make install 了，接下来重名/sbin/nginx为nginx.old [用于备份]

		# mv /usr/local/webserver/nginx/sbin/nginx /usr/local/webserver/nginx/sbin/nginx.old
	4. 复制编译后objs目录下的nginx文件到nginx的安装目录sbin/下

		# cp objs/nginx /usr/local/webserver/nginx/sbin/
	5. 测试一下新复制过来文件生效情况：

		# /usr/local/webserver/nginx/sbin/nginx -t
		nginx: the configuration file /usr/local/webserver/nginx/conf/nginx.conf syntax is ok
		nginx: configuration file /usr/local/webserver/nginx/conf/nginx.conf test is successful
	6. 让nginx把nginx.pid文件修改成nginx.pid.oldbin，随即启动nginx，实现不间断

		# kill -USR2 `cat /usr/local/webserver/nginx/nginx.pid`  更新配置文件
		# kill -QUIT `cat /usr/local/webserver/nginx/nginx.pid.oldbin` 优雅的关闭
	7. 升级完成了，最后在看一下升级后的版本

		# /usr/local/webserver/nginx/sbin/nginx -v
		nginx: nginx version: nginx/1.0.5
</pre>

### Nginx配置文件解析
<pre>
	nginx.conf,位置:/usr/local/nginx/conf/nginx.conf

	'#'号注释符
	注释的时候启用默认状态
	
	#设置用户，一般是root，nobody是最低级，说明任何人都可以开启，默认的时候为nobody
	#user  nobody;

	#工作衍生进程数，设定值得范围为当前服务器CPU的1倍~2倍之间，这样会比较合适
	worker_processes  1;	
	
	#设置错误文件存放路径
	#error_log  logs/error.log;
	#error_log  logs/error.log  notice;
	#error_log  logs/error.log  info;
	
	#设置pid存放路径（pid是控制系统中重要文件，用于Linux为控制nginx的重要文件）
	#pid        logs/nginx.pid;
	
	#设置最大连接数 (HTTP并发数)
	events {
		worker_connections  1024;
	}

	http配置项:
		#开启gzip压缩(开启后传输的内容能压缩30%，不开启的话仅仅只能原文传输)
		#gzip  on;
		
		server配置项:
			#设置字符
			#charset koi8-r;    #charset gb2312
</pre>

### Nginx最低的配置文件的要求
<pre>
	user nobody;
	worker_processes 4;
	events{
		worker_connections 1024;
	}
http{
	server{
		listen 192.168.1.2:80;
		server_name 192.168.1.2;
		access_log logs/server1.access.log combined;
		location /
		{
		index index.html index.htm;
		root html/server1;
		}
		}
	server{
		listen 192.168.1.3:80;
		server_name 192.168.1.3;
		access_log logs/server2.access.log combined;
		location /
		{
		index index.html index.htm;
		root html/server2;
		}
		}	
}
</pre>

### Nginx的虚拟主机配置
<pre>
	Nginx的虚拟主机配置步骤
		通常情况下，为了使每个服务器可以供更多用户使用，可以将一个服务器分为很多虚拟的子服务器，每个子服务器都是互相独立的。这些服务器是根据虚拟化技术分出来的，这样，一台服务器就可以虚拟成很多台子服务器。我们把子服务器叫做虚拟主机。
		我们搭建好Nginx服务器之后，此时只有一台Nginx服务器，这时如果我们对这台服务器进行虚拟主机配置，就可以将一台Nginx服务器分割为多台独立的子服务器。Nginx中配置虚拟主机的步骤主要有两个，第一步是配置IP地址，第二步是绑定IP地址与虚拟主机。
		
	Linux单网卡多IP地址的配置[eth0位当前自己自己的网卡名，不固定]，需要在root状态下进行处理
		ifconfig eth0:1 192.168.1.7 broadcast 192.168.1.255 netmask 255.255.255.0
		ifconfig eth0:2 192.168.1.8 broadcast 192.168.1.255 netmask 255.255.255.0 	
	
		利用ifconfig命令进行查看:
		enp0s3:1: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
				  inet 192.168.5.155  netmask 255.255.255.0  broadcast 192.168.5.255
				  ether 08:00:27:45:63:e0  txqueuelen 1000  (Ethernet)
	
	Nginx的虚拟主机的配置
		nginx.conf : /usr/local/nginx/conf/nginx.conf 文件为核心内容，所以最好不要进行改动
		最好是另起一个文件，例如：goular.conf文件可以引导到nginx.conf进行引用，这样就可以减少出错
		
		虚拟主机的基本配置:
		# another virtual host using mix of IP-, name-, and port-based configuration
		#
		#server {
		#    listen       8000;				[仅能使用其中一个，这里是当前默认IP地址的端口监听]
		#    listen       somename:8080; 	[仅能使用其中一个，这里是指定IP地址端口监听]
		#    server_name  somename  alias  another.alias;
		#	 access_log  logs/server1.log  combined;  [log文件名为自建]
		
		#    location / {      						[虚拟主机的文档]
		#        root   html;						[目录路径]
		#        index  index.html index.htm;		[默认寻找的首页]
		#    }
		#}
		
	自己配置了一个简单的配置文件:goular.conf
	#user nobody;
	worker_processes 4;
	events{
	worker_connections 1024;
	}
	http{
		server{
			listen 8080;
			server_name localhost;
			access_log logs/server1.access.log combined;
			location /
			{
			index index.html index.htm;
			root html/server1;
			}
			}
		server{
			listen 8081;
			server_name localhost;
			access_log logs/server2.access.log combined;
			location /
			{
			index index.html index.htm;
			root html/server2;
			}
			}	
	}
	./nginx -c .conf/goular.conf 运行即可

</pre>

### Nginx的日志文件配置
<pre>
	Nginx日志文件格式配置
		Nginx服务器在运行的时候，会有各种操作，这些关键的操作信息会记录到文件中，这些文件叫做日志文件。日志文件的记录是有格式的，我们可以按系统默认的格式去记录，也可以按我们自定义的格式去记录。我们可以使用log_format指令来设置Nginx服务器的日志文件的记录格式。下面我们通过实例来讲解一下Nginx日志文件的格式的配置。
		
		在nginx.conf的http模块中进行设置:
				
			原来的格式
			    #log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
				#                  '$status $body_bytes_sent "$http_referer" '
				#                  '"$http_user_agent" "$http_x_forwarded_for"';

				
	
			自定义的使用格式，一般这样用比较好，注意combined为nginx默认日志状态的标识
			下面的$变量名，为nginx服务器在处理请求的时候自动携带过来的信息的处理变量名
				log_format  combined  '$remote_addr - $remote_user [$time_local] "$request" '
				                  '$status $body_bytes_sent "$http_referer" '
				                  '"$http_user_agent" "$http_x_forwarded_for"';

				
			
	Nginx日志文件存储路径配置
		原来的格式
		#access_log  logs/access.log  main;
		
		
		自定义的使用格式
		access_log  logs/access.log  combined;
		
		不使用日志的设置
			为了使Nginx的日志文件存储更合理、有序，我们需要将日志文件进行分开存储，比如我们可以按时间来分开，今天的日志文件存储到一个文件中，明天的日志文件则存储到另一个新的文件中等等。这个时候，我们就会用到日志文件的切割操作。下面我们通过实例来讲解一下Nginx日志文件的切割。

		access_log off;
	
	Nginx日志文件的切割
		
		参考Nginx 日志文件切割即可，都是使用Linux的ctrontab来作为自动日志文件切割的手段
</pre>

### Nginx的缓存配置
<pre>
	当我们在浏览器中浏览某网页时，我们会把该网页上的一些信息（比如这个网页上的图片）存储到本地，当我们第二次浏览该网页的时候，这个网页上的某些信息就可以从本地加载，这样速度就会快很多。
	存储到本地的这些信息我们把其称为缓存。但是缓存过多的时候，缓存文件就会非常大，影响我们正常的上网活动。故而缓存需要定期清理。
	
	由于是属于不同虚拟主机的配置，所以缓存设置应该在虚拟主机的内容保存
	location ~.*\.(jpg|png|swf|gif)${      [这里的配置是任意的jps/png/swf/gif文件都执行相关的缓存]
		expires 30d;    [缓存时间为30天]
	}
	location ~.*\.(css|js)?${			   [这里的配置是任意的css/js文件都执行相关的缓存]
		expires 1h;						   [有效时间为1个小时]
	}
</pre>

### Nginx的其他配置-压缩功能配置[gzip压缩配置]
<pre>
	gzip_vary on;
		# 和http头有关系，加个vary头，给代理服务器用的，有的浏览器支持压缩，有的不支持，所以避免浪费不支持的也压缩，所以根据客户端的HTTP头来判断，是否需要压缩
	gzip on;
		#启动gzip压缩,off为关闭，如果使用gzip on那么必须使用gzip_vary on;
	gzip_min_lenth 1k;
		#低于1k的设定值那么不用gzip压缩
	gzip_buffers 4 16k;
		# 默认值: gzip_buffers 4 4k/8k 
		# 设置系统获取几个单位的缓存用于存储gzip的压缩结果数据流。 例如 4 4k 代表以4k为单位，按照原始数据大小以4k为单位的4倍申请内存。 4 8k 代表以8k为单位，按照原始数据大小以8k为单位的4倍申请内存。
		# 如果没有设置，默认值是申请跟原始数据相同大小的内存空间去存储gzip压缩结果。
	gzip_http_version 1.1;
		# 默认值: gzip_http_version 1.1(就是说对HTTP/1.1协议的请求才会进行gzip压缩)
		# 识别http的协议版本。由于早期的一些浏览器或者http客户端，可能不支持gzip自解压，用户就会看到乱码，所以做一些判断还是有必要的。 
		# 注：99.99%的浏览器基本上都支持gzip解压了，所以可以不用设这个值,保持系统默认即可。
		# 假设我们使用的是默认值1.1，如果我们使用了proxy_pass进行反向代理，那么nginx和后端的upstream server之间是用HTTP/1.0协议通信的，如果我们使用nginx通过反向代理做Cache Server，而且前端的nginx没有开启gzip，同时，我们后端的nginx上没有设置gzip_http_version为1.0，那么Cache的url将不会进行gzip压缩
</pre>

### Nginx的其他配置-自动列目录配置
<pre>
	server模块下设置自动列目录，与apache服务器那个很像的:
		autoindex on;
		autoindex_exact_size on;  
		autoindex_localtime on;  
		
	例子:
		location /
		{
			index index.html index.htm;
			autoindex on;  
			autoindex_exact_size on;  
			autoindex_localtime on;  
			root html/server1;
		}
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