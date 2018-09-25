# Linux学习笔记Day03

### 网络配置 （VirtualBox网络配置，在使用静态IP的时候，需要将网络设置为仅主机（Host-Only））
<pre>
1. 配置ip地址和子网掩码
    编辑配置文件：
    > cd  /etc/sysconfig/network-scripts
    > cp  ifcfg-eth0  ./ifcfg-eth0.bak			//修改前先备份,在ifconfig的第一张网卡，可能ifcfg-eth0的名字不一定都一样的
    
    首先切换到配置ip地址的配置文件所在目录：
        ifcfg-eth0代表第一块以太网卡
        
    配置文件修改前先做备份ifcfg-eth0.bak：
    
    vim ifcfg-eth0打开配置文件做具体网络相关配置信息：
        ip地址最后一个段的信息不要超过210.
        
2.启动linux网络
     ifcfg-eth0文件配置网络后，需要重启网络：
     >service network  restart/stop/start   
</pre>

### 虚拟主机(CentOS)与Windows10主机的联通(相互ping)
<pre>
    1.关闭Windows 和 Linux 主机的防火墙
    2.配置 Linux主机的ip内容
        vim /etc/sysconfig/network-scripts/网卡的名字   (网卡根据ifconfig第一调数据来找，lo网卡为回环网卡)
        配置以下内容:
            ONBOOT=yes
            BOOTPROTO="static"
            IPADDR=192.168.3.107     //IP地址
            NETMASK=255.255.255.0    //子网掩码
            NETWORK=192.168.3.1      //网关
            DNS1=114.114.114.114     //DNS服务器
            DNS2=101.226.4.6         //DNS服务器
    3.此时可能仅仅能ping同一网段的内容,对于网卡设置的IP地址，首先要确认IP是否是一个正确的网络地址。除此之外有没有设置网关,如果设置了ping一下网关看看能否正常连通
        对于网卡设置网关之外，没有设置网关的网卡。还需要检查系统默认的网关，找到 /etc/sysconfig/network 配置文件如下图 (如果没有需要添加一个默认网关上去)
            /etc/sysconfig/network文件配置的内容:
                NETWORKING=yes
                HOSTNAME=localhost.localdomain
                GATEWAY=192.168.3.1
        测试网络连通性：
            设置好网关之后，可以通过测试ping 一个公网地址，看看能否正常连接
         
    具体解决方法:
         Linux不能上网ping:unknown host问题怎么解决？   
         http://jingyan.baidu.com/article/4d58d54137d2a19dd5e9c050.html

    
    这个在换了无线路由器后就会不一样的，因为网关的填写就是路由器，所以路由器变更需要更换网关和IP地址
</pre>

### 光驱挂载 
<pre>
    创建一个目录(windows系统的G盘符目录)(用于与光驱硬件设备进行联系)：
    光驱使用，其挂载是手动的
    ① 创建一个“普通目录/home/jinnan/rom”
    ② 找到光驱硬件设备(/dev/cdrom)
    ③ 使得普通目录 与 光驱硬件设备 进行联系(挂载)
    
    具体挂载操作：
      mount  硬件   挂载点目录(普通目录)   	//挂载动作
    > mount  /dev/cdrom  /home/jinnan/rom   	//把光驱挂载到rom目录
      umount  硬件或挂载点         			//卸载(断开目录与硬件的联系)动作
    > umount  /dev/cdrom        				//(硬件)卸载光驱
    > umount  /home/jinnan/rom   				//(挂载点)卸载光驱
    > eject                      				//弹出光盘
</pre>

### linux系统软件安装(yum /rpm 存在依赖问题)
<pre>
    1. 二进制码软件安装
    	其软件安装与windows软件安装原理一致，把从网络下载的“二进制码”软件从安装包复制到系统指定目录的过程。
    	二进制码软件文件----(复制)----》系统指定目录
    (windows系统软件默认被复制到C://Program Files目录)
        1.1 rpm方式
        	优点：软件安装非常方便、快速
        	缺点：软件的各个组成部分非常固定，不灵活。需要手动解决依赖关系。
        1.2 yum智能方式
        	该方式类似360软件管家里边的“一键安装”，较智能
        	该方式条件：① 可以上网。② 通过配置把(二进制码)软件放到指定位置
        	好处：方便，一键安装，无需考虑软件依赖。
            > yum  install php
            
    2. 源码编译方式安装软件
        该软件安装本质：从网络下载下来的软件，内部文件内容都是源码内容。
        	源码文件---(编译工具)--->二进制码文件---(复制)-->系统指定目录
        	软件安装的时候：
        	① 把“源码内容”文件 编译为“二进制代码”文件。
        	② 再把编译后的二进制代码文件复制到系统指定目录。
        	优点：
        		该方式安装的软件整体运行速度、效率要非常高
        		软件内部各个组成部分可以灵活做配置(例如php里边有gd/xml/jpeg/png等各个部分组成，都可以灵活选取)
        	缺点：安装稍麻烦
</pre>

### RPM方式安装软件
<pre>
    rpm方式安装(vsftpd)软件：
        > rpm  -ivh  软件包全名      	//安装软件
        > rpm  -q   软件包名(完整)   	//query查看软件是否有安装
        > rpm  -e   软件包名 (完整)      //卸载软件
        > rpm  -qa   					//query all  查看系统里边全部rpm方式安装的软件
        > rpm  -qa  |  grep ftpd(部分名字)			//模糊查找指定软件ftpd是否有安装
        
        软件包全名 = 软件包名+软件版本+支持的系统+支持cpu型号+文件后缀 
</pre>

### 小总结
<pre>
    1.配置网络(配置ip和子网掩码、启动网络、桥接网卡设置、本机和linux互相ping同)
    2.SecureCRT终端操作linux系统(多用户、多任务系统体会)
    3.软件安装的两种方式(二进制码软件安装【rpm/yum】、源码编译安装)
    4.通过rpm方式进行软件安装
    rpm  -ivh  软件包全名  //安装软件
    rpm  -q    软件包名    //查看软件是否有安装
    rpm  -e    软件包名    //卸载软件
    rpm  -qa            //查看系统全部rpm方式安装的软件
    rpm  -qa  |  grep  部分名称   //模糊方式查找一个软件是否有安装
    5.通过rpm方式安装ftp
    service  vsftpd  start/stop/restart    //控制ftp软件服务
</pre>

### gcc安装
<pre>
    二进制码软件安装和源码编译方式安装的取舍：
    ① 软件安装后使用的用户非常少(公司内部人使用ftp、root管理员使用gcc),就采取二进制码方式安装。
    ② 软件安装完毕使用者非常多、非常巨大(php、apache、mysql等)，就采取源码编译方式安装。
    
    作者开发一个A软件，需要一个函数库，这个函数库已经在作者当时机器的B软件里边存在，这样A软件就不用重复开发，直接调用B软件对应的函数库即可。如果其他人购买了A软件，那么其在安装的时候就会提示需要先安装B软件(此时购买者的机器还没有B软件)，B软件安装后才可以安装该A软件。
    安装A软件必须先安装B软件的过程，就称为A对B形成依赖。
    以后A软件在任何机器上安装对B软件都会形成依赖。
    【A依赖B依赖C依赖D】
    ① 	A软件安装前需要先安装BCD等依赖软件：
    	A------>B------->C-------->D   （D->C->B->A是安装顺序）
    ② 	卸载C软件也需要先卸载AB等软件：
    	C------->B-------->A   (A->B->C是卸载顺序)
</pre>

### 源码编译方式安装软件
<pre>
    1. zlib软件安装
    该zlib可以对许多其他软件的编译代码起着优化、压缩的作用
    
    解压压缩包：
    .tar.gz------------> tar  zxvf  压缩包.tar.gz
    .tar.bz2-----------> tar  jxvf  压缩包.tar.bz2
    
    1.1 源码编译方式安装软件
    源码状态------------>二进制码状态----------------->复制到系统指定目录
    ① ./configure         //在解压软件目录内部执行
    相关参数配置：软件安装位置，依赖软件设置，软件依赖检查等
    例如--prefix是设置软件的安装位置
    	>./configure  --help   //查看当前软件可以设置的各种参数
    ② make               //编译，根据configure的配置信息生成“二进制文件”
    ③ make  install        //把生成的二进制文件复制到系统指定目录(本质与rpm安装软件一致)
</pre>

### ./configure配置项解析
<pre>
    [--prefix=PREFIX] 软件的安装位置
</pre>

### 软件安装错误、需要重新安装
<pre>
    3.1 已经执行configure操作
    》根据正确的参数重新configure即可
    3.2 已经执行configure、make操作
        》删除解压后的文件目录，重新解压、configure、make
        
    3.3 已经执行configure、make、make install
    ①删除安装后的文件(有指定安装目录情况/usr/local/http2)
    ②删除解压后的目录
    ③重新解压、重新configure、重新make、重新make install
</pre>

### 安装php 
<pre>
    首先安装php依赖软件:xml、gd、jpeg、png、freetype
    其次再安装php软件：php
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

### 
<pre>

</pre>