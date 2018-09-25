# Nginxѧϰ�ʼ�

### ʲô��Nginx?
<pre>
	Nginx�Ĺ���
		Nginx��һ�ַ��������,Ҳ��һ�ָ����ܵ�HTTP�ͷ�������������ͬʱҲ��һ�������ʼ���������
		��Ϊ�س��Ĺ����Ǿ��Ǹ��ؾ����ˡ�
	
	Nginx�����������������ܱȽ�
		IIS:Windows���������ܲ���Linux�������ȶ�
		Tomcat:����Java���ԣ��������ķ�����
		Nginx:����������������֧�ִ�����򼶵�TCP���ӣ�10�����ϵĲ������ӣ�ͬ��֧�ֿ�ƽ̨������
		Apache���ȶ�����Դ����ƽ̨������ȱ�����Apache��֧�ָ߲���
		
	Nginx��ȱ���ܽ�
		�ŵ�:�ǿ���ʵ�ָ߲���������򵥣��ڴ������٣��ɱ���
		ȱ��:rewrite���ܲ���ǿ��ģ��û��Apache�Ķ�
</pre>

### Nginx�����
<pre>
	Linux��ʹ��
		Ĭ�������£�ֱ������./configure �ᱨ����������Ϊû�а�װg++,gc++
		yum -y install gcc gcc-c++ autoconf automake  ---yΪ��װ��ʱ��Ҫѡ��y/n��ʱ��ȫ���Զ�ѡ��Ϊy
		
		��װNginx(��װ·�����Խ�������)
			./configure 
			
		ע��:���氲װ��ɺ�,�ᱨ���´���:	./configure: error: the HTTP rewrite module requires the PCRE library.	
		�������: ��root��,		yum -y install pcre pcre-devel	
		
		��Ϊ�����pcre��ȱʧ��./configure��װ���ɹ����������°�װ: ./configure
		
		ע��:���氲װ��ɺ�,�ᱨ���´���:	./configure: error: the HTTP gzip module requires the zlib library.
		�������: ��root��,		yum -y install zlib zlib-devel	
		
		��Ϊ�����zlib��ȱʧ��./configure��װ���ɹ����������°�װ: ./configure
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
		
		˵�������Ѿ���ɣ����Խ��б���:	
		
		����make��Ȼ�����make install 
			����:make[1]: �뿪Ŀ¼��/home/goular/����/nginx-1.13.0��,˵����װ�ɹ�.

		�ж��Ƿ�װ��Nginx�ı�ʶ:
			�鿴 /usr/local/ �ļ������Ƿ����nginx���ļ��м���
	
	
	
	Nginx������г�������:
		��Linux����ϵͳ�´Nginx���������ܶ�ʱ�����ֲ�ͬ�Ĵ����ڴˣ����ǶԴ�����г��ֵĴ������һЩ�ܽᣬ
		��Ҫ������������:
				����ǽ���⣬ȱ��gc++��ȱ��pcre��zlib�ȿ�
</pre>

### NginxĿ¼�ṹ
<pre>
	conf: �����ļ���
	html��������ʾ��ҳ��
	logs����־��¼
	sbin:nginx���еĶ������ļ���
</pre>

### Nginx��ʹ��
<pre>
	Windows��: 
		ֱ��˫�� nginx.exe���ɿ���nginx��80����     ��localhost��ͣ�ٲſ�����
		
	Linux��:
		����ָ��  /usr/local/nginx/sbin/nginx -c /usr/local/nginx/conf/nginx.conf   ��localhost���뿪
		
	�ۺ���˵���ʺ�Nginx�������Ĳ���ϵͳ��Linux	
</pre>

### Nginx��������ֹͣ(Linux��������)
<pre>
	Nginx������:
		nginxӦ�ó���ĵ�ַ -c Nginx�������ļ����ڵ�ַ
		
	Nginx��ֹͣ:
		ֹͣnginx������ģʽ:
			1.����ֹͣ:
				ps -ef |grep nginx �鿴����"nginx"�Ļ���� [��ps -AЧ�����]
				�鿴�����̺ź󣬽��д���ֹͣ:
				kill -QUIT ���̺�
				
			2.����ֹͣ:
				ps -ef |grep nginx �鿴����"nginx"�Ļ���� [��ps -AЧ�����]
				�鿴�����̺ź󣬽��д���ֹͣ:
				kill -TERM ���̺�
				kill -INT ���̺�	
				(�������ü���һ��)
				
			3.ǿ��ֹͣ:
				ps -ef |grep nginx �鿴����"nginx"�Ļ���� [��ps -AЧ�����]
				�鿴�����̺ź󣬽��д���ֹͣ:
				kill -9 ���̺�			
	
	Nginx������:
			
			����һ,sbinĿ¼��:
				./nginx -s reload   [��ֹͣ��ִ�лᱨ����Ϊreload������]
			
			������,	
				ps -ef |grep nginx �鿴����"nginx"�Ļ���� [��ps -AЧ�����]
				�鿴�����̺ź󣬽�������:
					kill -HUP �˿ں� 
					
	kill -HUP pid 
		pid �ǽ��̱�ʶ�������Ҫ�������ö�����ֹͣ����������������ʹ�ø�����ڶ������ļ�����Ҫ�ĸ��ĺ󣬷����������Զ�̬���·������á�				
</pre>

### ��֤Nginx�����ļ�
<pre>
	����1 [��Apache����,httpd -t]��
		[root@localhost sbin]# ./nginx -t
			nginx: the configuration file /usr/local/nginx/conf/nginx.conf syntax is ok
			nginx: configuration file /usr/local/nginx/conf/nginx.conf test is successful
	
	����2[���ɹ���������nginx]��
		nginxӦ�ó���ĵ�ַ -t -c Nginx�������ļ����ڵ�ַ	
</pre>

### Nginx�������źſ���ʵս
<pre>
	Linux��������:
	kill HUP:����
	kill QUIT:���ݹر�
	kill TERM:���ٹر�
	kill INT:���ݹر�
	kill USR1���л���־�ļ� ͨ����������֪Ӧ�ó������������ļ�,��־�ļ��и�Ҫ��,
	kill USR2��ƽ��������ִ�г���
	kill WINCH:���ݹرչ�������
</pre>

### Nginx ��־�ļ��и�---------kill -usr1
<pre>
	Nginx ��һ���ǳ������� Web �����������С�����ܸߡ��ٶȿ������ŵ㡣���������Ҳ����ȱ�㣬����������ķ�����־�ļ�һֱ����һ���������Զ��ؽ����и����������ܴ�Ļ�����������־�ļ������ǳ��󣬲����ڹ�����Ȼ�ˣ�����Ҳ��ϣ��������ô�Ӵ��һ��������־�ļ�������Ҫ�ֶ�������ļ������и
	�� Linux ƽ̨�� Shell �ű��ḻ��ʹ�� Shell �ű��� crontab �����ܷǳ�����ؽ����и���� Windows ƽ̨�Ͼ��鷳һЩ�ˣ��ղ�Ū�˺ó�ʱ�䣬���������¼����һ�¡�
	��־�ļ��и�Ҫ��

	���� Nginx ����־����д��һ���ļ����еģ���ˣ�������Ҫÿ����㽫ǰһ�����־��Ϊ����һ���ļ����������Ǿͽ� Nginx λ�� logs Ŀ¼�е� access.log ��Ϊ access_[yyyy-MM-dd].log ���ļ�����ʵ logs Ŀ¼�л��и� error.log �Ĵ�����־�ļ�������ļ�Ҳ��Ҫÿ���и�һ�����������˵ access.log �ˣ�error.log ���и�����ơ�

	Linux ƽ̨�и�

	�� Linux ƽ̨�Ͻ����и��Ҫʹ�� date �����Ի����������ڡ�ʹ�� kill ������ Nginx ���̷������´���־�ļ����źţ��Լ� crontab ����ִ���������ڡ�

	�ȴ���һ�� Shell �ű������£�

	#!/bin/bash  
	## ���ִ�иýű�  
	  
	## Nginx ��־�ļ����ڵ�Ŀ¼  
	LOGS_PATH=/usr/local/nginx/logs  
	  
	## ��ȡ����� yyyy-MM-dd  
	YESTERDAY=$(date -d "yesterday" +%Y-%m-%d)  
	  
	## �ƶ��ļ�  
	mv ${LOGS_PATH}/access.log ${LOGS_PATH}/access_${YESTERDAY}.log  
	  
	## �� Nginx �����̷��� USR1 �źš�USR1 �ź������´���־�ļ�  
	kill -USR1 $(cat /usr/local/nginx/nginx.pid)  
	��������ű��е����һ�б����� Nginx �Ľ��̷��� USR1 �ź������´���־�ļ��������д�Ļ���Nginx ���������־��Ϣд�� access_[yyyy-MM-dd].log ���Ǹ��ļ��У�����Ȼ�ǲ���ȷ�ġ�

	�ű���ɺ������ Nginx ��װĿ¼�� sbin �У�ȡ��Ϊ cut-log.sh��֮��ʹ�� crontab -e ����һ����ʱ��������������ִ������ű���

	0 0 * * * /bin/bash /usr/local/nginx/sbin/cut-log.sh  
	������ Linux ���и� Nginx ��־������ˣ����Խ� crontab ����Ϊ�൱ǰʱ�Ͻ���ʱ�����һ�£���������������Ͳ�����
</pre>

### Nginx ƽ������---------kill -usr2
<pre>
	��ʱ��������Ҫ�����ǵķ����������������߰汾����ʱ���������ǿ�н�������ֹͣȻ��ֱ������������ԭ���ڷ������������ŵĽ��̾ͻᱻӰ�졣
	��ν����������أ�����ͨ��ƽ�������ķ�ʽ�������ƽ������ʱ������ͣ���������ŵĽ��̣���Щ���̻�����������󣬵������ٽ���������
	����Щ�Ͻ����ڴ����껹�ڴ���������ֹͣ����ƽ�������Ĺ����У��¿��Ľ��̻ᴦ�������������ƽ�������ļ�Ҫ˵��

	����Ҫ�������е�Nginx�����������ڲ��жϷ��������½��У����岽�����£�
		1��ʹ���µĿ�ִ�г����滻�ɵĿ�ִ�г��������µ�Nginx,���±��뵽�ɰ汾�İ�װ·���С��ر���֮ǰ���ȱ���һ�¾ɵĿ�ִ���ļ���
		 
		2��ִ������ָ������洢�оɰ汾������ID���ļ�������Ϊ.oldbin��
		kill -USR2 �ɰ汾��Nginx�����̺�
		һ��������������ģ�kill -USR2 `cat /usr/local/nginx/nginx.pid`
		 ������ ls /usr/local/nginx/logs���鿴�Ƿ����
		3��ִ���°汾��Nginx��ִ�г���
		ulimit -SHn 65535
		/usr/local/nginx/sbin/nginx
		 
		4����ʱ�¾ɰ汾��Nginx��ͬʱ���У���ͬ��������Ҫ��ֹͣ�ɰ汾��Nginx�����뷢��WINCH�źŸ��ɵ������̡�Ȼ�����Ĺ������̽����ݹرա�
		kill -WINCH �ɰ汾��Nginx�����̺�
		 
		5��һ��ʱ��󣬾ɵĹ������̴����������е�������˳��������µĽ������������������ˡ��������������鿴��
		ps -ef | grep nginx
		 
		6�����ڿ��Ծ���ʹ���°汾���ǻָ����ɰ汾��
		kill -HUP �ɵ������̺� ��Nginx�ڲ����������ļ���������������Ĺ�������
		kill -QUIT �µ������̺�  �����ݹر��乤������
		kill -TERM �µ������̺� ��ǿ���˳�
		kill �µ������̺Ż�ɵ������̺ţ������ΪĳЩԭ���µĹ������̲����˳��������䷢��kill�ź�
		 
		�µ��������˳��󣬾ɵ������̻��Ƴ�.oldbin��׺���ָ�Ϊ����.pid�ļ���������һ�оͶ��ָ�Ϊ����֮ǰ�ˡ�
		������������ɹ������Լ���ϣ�������°汾ʱ���ɷ���QUIT�źŸ��ɵ������̣�ʹ���˳���ֻ�����µĽ������У�kill -QUIT �������̺�	
</pre>

### nginx��ƽ������������Ϸ���
<pre>
Nginx������ĺܿ죬���nginx��1.0.5�ȶ��棬nginx��0.8.55��nginx��0.7.69�ɵ��ȶ��汾�Ѿ���������һ��Ƚ�ϲ��ʹ���°汾����������ǰ�ԭ����nginx-1.0.2ƽ��������nginx-1.0.5�ȶ��档����¼��һ���̣�������һ����Ҳ���������汾�������������պ�«��ư�����顣ϣ��������Ҫ�������е������

	1. ��ʼ֮ǰ�Ȳ鿴һ�µ�ǰʹ�õİ汾��

		# /usr/local/webserver/nginx/sbin/nginx -V
		nginx: nginx version: nginx/1.0.5
		nginx: built by gcc 4.1.2 20080704 (Red Hat 4.1.2-50)
		nginx: TLS SNI support disabled
		nginx: configure arguments: --user=www --group=www --prefix=/usr/local/webserver/nginx --with-http_stub_status_module --with-http_ssl_module --with-http_flv_module --with-cc-opt=-O3 --with-cpu-opt=opteron --with-http_gzip_static_module
		�� ע���ɫ����������ǰ����Ĳ��������ϱ༭�°汾��Ҫ�õ���

	2.�����°汾��http://nginx.org/en/download.html

		Ȼ�󣺽�ѹ > ����ǰ��׼�� > ����

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
	3. ִ��������ﲻ���� make install �ˣ�����������/sbin/nginxΪnginx.old [���ڱ���]

		# mv /usr/local/webserver/nginx/sbin/nginx /usr/local/webserver/nginx/sbin/nginx.old
	4. ���Ʊ����objsĿ¼�µ�nginx�ļ���nginx�İ�װĿ¼sbin/��

		# cp objs/nginx /usr/local/webserver/nginx/sbin/
	5. ����һ���¸��ƹ����ļ���Ч�����

		# /usr/local/webserver/nginx/sbin/nginx -t
		nginx: the configuration file /usr/local/webserver/nginx/conf/nginx.conf syntax is ok
		nginx: configuration file /usr/local/webserver/nginx/conf/nginx.conf test is successful
	6. ��nginx��nginx.pid�ļ��޸ĳ�nginx.pid.oldbin���漴����nginx��ʵ�ֲ����

		# kill -USR2 `cat /usr/local/webserver/nginx/nginx.pid`  ���������ļ�
		# kill -QUIT `cat /usr/local/webserver/nginx/nginx.pid.oldbin` ���ŵĹر�
	7. ��������ˣ�����ڿ�һ��������İ汾

		# /usr/local/webserver/nginx/sbin/nginx -v
		nginx: nginx version: nginx/1.0.5
</pre>

### Nginx�����ļ�����
<pre>
	nginx.conf,λ��:/usr/local/nginx/conf/nginx.conf

	'#'��ע�ͷ�
	ע�͵�ʱ������Ĭ��״̬
	
	#�����û���һ����root��nobody����ͼ���˵���κ��˶����Կ�����Ĭ�ϵ�ʱ��Ϊnobody
	#user  nobody;

	#�����������������趨ֵ�÷�ΧΪ��ǰ������CPU��1��~2��֮�䣬������ȽϺ���
	worker_processes  1;	
	
	#���ô����ļ����·��
	#error_log  logs/error.log;
	#error_log  logs/error.log  notice;
	#error_log  logs/error.log  info;
	
	#����pid���·����pid�ǿ���ϵͳ����Ҫ�ļ�������LinuxΪ����nginx����Ҫ�ļ���
	#pid        logs/nginx.pid;
	
	#������������� (HTTP������)
	events {
		worker_connections  1024;
	}

	http������:
		#����gzipѹ��(���������������ѹ��30%���������Ļ�����ֻ��ԭ�Ĵ���)
		#gzip  on;
		
		server������:
			#�����ַ�
			#charset koi8-r;    #charset gb2312
</pre>

### Nginx��͵������ļ���Ҫ��
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

### Nginx��������������
<pre>
	Nginx�������������ò���
		ͨ������£�Ϊ��ʹÿ�����������Թ������û�ʹ�ã����Խ�һ����������Ϊ�ܶ�������ӷ�������ÿ���ӷ��������ǻ�������ġ���Щ�������Ǹ������⻯�����ֳ����ģ�������һ̨�������Ϳ�������ɺܶ�̨�ӷ����������ǰ��ӷ�������������������
		���Ǵ��Nginx������֮�󣬴�ʱֻ��һ̨Nginx����������ʱ������Ƕ���̨���������������������ã��Ϳ��Խ�һ̨Nginx�������ָ�Ϊ��̨�������ӷ�������Nginx���������������Ĳ�����Ҫ����������һ��������IP��ַ���ڶ����ǰ�IP��ַ������������
		
	Linux��������IP��ַ������[eth0λ��ǰ�Լ��Լ��������������̶�]����Ҫ��root״̬�½��д���
		ifconfig eth0:1 192.168.1.7 broadcast 192.168.1.255 netmask 255.255.255.0
		ifconfig eth0:2 192.168.1.8 broadcast 192.168.1.255 netmask 255.255.255.0 	
	
		����ifconfig������в鿴:
		enp0s3:1: flags=4163<UP,BROADCAST,RUNNING,MULTICAST>  mtu 1500
				  inet 192.168.5.155  netmask 255.255.255.0  broadcast 192.168.5.255
				  ether 08:00:27:45:63:e0  txqueuelen 1000  (Ethernet)
	
	Nginx����������������
		nginx.conf : /usr/local/nginx/conf/nginx.conf �ļ�Ϊ�������ݣ�������ò�Ҫ���иĶ�
		���������һ���ļ������磺goular.conf�ļ�����������nginx.conf�������ã������Ϳ��Լ��ٳ���
		
		���������Ļ�������:
		# another virtual host using mix of IP-, name-, and port-based configuration
		#
		#server {
		#    listen       8000;				[����ʹ������һ���������ǵ�ǰĬ��IP��ַ�Ķ˿ڼ���]
		#    listen       somename:8080; 	[����ʹ������һ����������ָ��IP��ַ�˿ڼ���]
		#    server_name  somename  alias  another.alias;
		#	 access_log  logs/server1.log  combined;  [log�ļ���Ϊ�Խ�]
		
		#    location / {      						[�����������ĵ�]
		#        root   html;						[Ŀ¼·��]
		#        index  index.html index.htm;		[Ĭ��Ѱ�ҵ���ҳ]
		#    }
		#}
		
	�Լ�������һ���򵥵������ļ�:goular.conf
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
	./nginx -c .conf/goular.conf ���м���

</pre>

### Nginx����־�ļ�����
<pre>
	Nginx��־�ļ���ʽ����
		Nginx�����������е�ʱ�򣬻��и��ֲ�������Щ�ؼ��Ĳ�����Ϣ���¼���ļ��У���Щ�ļ�������־�ļ�����־�ļ��ļ�¼���и�ʽ�ģ����ǿ��԰�ϵͳĬ�ϵĸ�ʽȥ��¼��Ҳ���԰������Զ���ĸ�ʽȥ��¼�����ǿ���ʹ��log_formatָ��������Nginx����������־�ļ��ļ�¼��ʽ����������ͨ��ʵ��������һ��Nginx��־�ļ��ĸ�ʽ�����á�
		
		��nginx.conf��httpģ���н�������:
				
			ԭ���ĸ�ʽ
			    #log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
				#                  '$status $body_bytes_sent "$http_referer" '
				#                  '"$http_user_agent" "$http_x_forwarded_for"';

				
	
			�Զ����ʹ�ø�ʽ��һ�������ñȽϺã�ע��combinedΪnginxĬ����־״̬�ı�ʶ
			�����$��������Ϊnginx�������ڴ��������ʱ���Զ�Я����������Ϣ�Ĵ��������
				log_format  combined  '$remote_addr - $remote_user [$time_local] "$request" '
				                  '$status $body_bytes_sent "$http_referer" '
				                  '"$http_user_agent" "$http_x_forwarded_for"';

				
			
	Nginx��־�ļ��洢·������
		ԭ���ĸ�ʽ
		#access_log  logs/access.log  main;
		
		
		�Զ����ʹ�ø�ʽ
		access_log  logs/access.log  combined;
		
		��ʹ����־������
			Ϊ��ʹNginx����־�ļ��洢����������������Ҫ����־�ļ����зֿ��洢���������ǿ��԰�ʱ�����ֿ����������־�ļ��洢��һ���ļ��У��������־�ļ���洢����һ���µ��ļ��еȵȡ����ʱ�����Ǿͻ��õ���־�ļ����и��������������ͨ��ʵ��������һ��Nginx��־�ļ����и

		access_log off;
	
	Nginx��־�ļ����и�
		
		�ο�Nginx ��־�ļ��и�ɣ�����ʹ��Linux��ctrontab����Ϊ�Զ���־�ļ��и���ֶ�
</pre>

### Nginx�Ļ�������
<pre>
	������������������ĳ��ҳʱ�����ǻ�Ѹ���ҳ�ϵ�һЩ��Ϣ�����������ҳ�ϵ�ͼƬ���洢�����أ������ǵڶ����������ҳ��ʱ�������ҳ�ϵ�ĳЩ��Ϣ�Ϳ��Դӱ��ؼ��أ������ٶȾͻ��ܶࡣ
	�洢�����ص���Щ��Ϣ���ǰ����Ϊ���档���ǻ�������ʱ�򣬻����ļ��ͻ�ǳ���Ӱ��������������������ʶ�������Ҫ��������
	
	���������ڲ�ͬ�������������ã����Ի�������Ӧ�����������������ݱ���
	location ~.*\.(jpg|png|swf|gif)${      [����������������jps/png/swf/gif�ļ���ִ����صĻ���]
		expires 30d;    [����ʱ��Ϊ30��]
	}
	location ~.*\.(css|js)?${			   [����������������css/js�ļ���ִ����صĻ���]
		expires 1h;						   [��Чʱ��Ϊ1��Сʱ]
	}
</pre>

### Nginx����������-ѹ����������[gzipѹ������]
<pre>
	gzip_vary on;
		# ��httpͷ�й�ϵ���Ӹ�varyͷ��������������õģ��е������֧��ѹ�����еĲ�֧�֣����Ա����˷Ѳ�֧�ֵ�Ҳѹ�������Ը��ݿͻ��˵�HTTPͷ���жϣ��Ƿ���Ҫѹ��
	gzip on;
		#����gzipѹ��,offΪ�رգ����ʹ��gzip on��ô����ʹ��gzip_vary on;
	gzip_min_lenth 1k;
		#����1k���趨ֵ��ô����gzipѹ��
	gzip_buffers 4 16k;
		# Ĭ��ֵ: gzip_buffers 4 4k/8k 
		# ����ϵͳ��ȡ������λ�Ļ������ڴ洢gzip��ѹ������������� ���� 4 4k ������4kΪ��λ������ԭʼ���ݴ�С��4kΪ��λ��4�������ڴ档 4 8k ������8kΪ��λ������ԭʼ���ݴ�С��8kΪ��λ��4�������ڴ档
		# ���û�����ã�Ĭ��ֵ�������ԭʼ������ͬ��С���ڴ�ռ�ȥ�洢gzipѹ�������
	gzip_http_version 1.1;
		# Ĭ��ֵ: gzip_http_version 1.1(����˵��HTTP/1.1Э�������Ż����gzipѹ��)
		# ʶ��http��Э��汾���������ڵ�һЩ���������http�ͻ��ˣ����ܲ�֧��gzip�Խ�ѹ���û��ͻῴ�����룬������һЩ�жϻ����б�Ҫ�ġ� 
		# ע��99.99%������������϶�֧��gzip��ѹ�ˣ����Կ��Բ��������ֵ,����ϵͳĬ�ϼ��ɡ�
		# ��������ʹ�õ���Ĭ��ֵ1.1���������ʹ����proxy_pass���з��������ônginx�ͺ�˵�upstream server֮������HTTP/1.0Э��ͨ�ŵģ��������ʹ��nginxͨ�����������Cache Server������ǰ�˵�nginxû�п���gzip��ͬʱ�����Ǻ�˵�nginx��û������gzip_http_versionΪ1.0����ôCache��url���������gzipѹ��
</pre>

### Nginx����������-�Զ���Ŀ¼����
<pre>
	serverģ���������Զ���Ŀ¼����apache�������Ǹ������:
		autoindex on;
		autoindex_exact_size on;  
		autoindex_localtime on;  
		
	����:
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