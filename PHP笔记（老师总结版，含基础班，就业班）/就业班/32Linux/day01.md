# Linux学习笔记Day01

### Linux
<pre>
    什么时候使用linux操作系统？
    答：作为网站的服务器系统使用,apache、php、mysql等服务软件需要安装在此系统里边。
       该系统特点：稳定、免费、网络功能丰富(apache/redis/memcache/邮箱/mysql等等)、安全
       网站服务器运行的操作系统就是linux
</pre>

### Linux安装分区
<pre>
    1.Swap
        创建第一个swap交换分区，其把硬盘的一部分空间拿出来当做内存使用，物理内存中很长时间也不使用的数据就放到该swap交换分区里边。
        swap交换分区大小建议是内存 的2倍。
        有的linux系统要求必须安装该swap交换分区。
    2.Boot(安装好之后，一般不要动这个内容，不然系统会崩溃)
        给系统启动文件目录(/boot)单独创建一个分区,大小为200M
        对该空间进行保护，不要使用该空间，可以确保在其他分区没有可用空间的情况下，服务器可以正常的关机、开机。
    3./ ("/"为根目录)
        把剩余不到8G的空间给创建一个单独的分区，该分区的挂载点是“/斜杠”，就是系统的根目录。
</pre>

### 二.操作系统分区原理
<pre>
    1.Windows系统分区原理
        类似一个倒着的“森林”，每个目录的盘符都是一个独立的个体，可以单独的访问和操作
        每个盘符都是一个根目录，所以存在多个根目录，而且是自动挂载
    2.Linux系统分区原理
       类似一个倒着的“大树” ，只存在一个根目录
       在安装系统的时候，盘符是自动挂载到根目录，但是其余的情况都是手动挂载到根目录(这个是最大的区别)
    
    区别点:Linux为多用户，多任务，单一根目录
          Windows为单用户，多任务，多根目录
</pre>

### 简单的基本命令
<pre>
    ls(查看当前目录的内容),pwd(Print Work Directory 打印当前工作的目录),whoami(打印当前使用终端的用户)
    cd(change Directory 切换目录),init(需要root权限，用户设定打开linux开启方式，init 3为终端开启linux，init 5为xWindow开启系统)
</pre>

### 根目录介绍和使用
<pre>
    根目录为"/",从任意地方切换根目录的指令是:cd /
    根目录的列表
    1.  /boot (尽量不要变动，变更容易崩溃)
            系统启动核心目录，用于存储系统启动文件
    
    2.  /etc
            系统主要配置文件目录
            例如：
            /etc/passwd  用于存储用户信息的文件
            /etc/group   用于存储组别信息的文件
    
    3.  /lib
            library 
            系统资源文件类库目录
    
    4.  /media
    
    5.  /opt
    
    6.  /root (需要root后才能访问当前的文件夹)
            该目录是root管理员的家目录，root用户登录系统后首先进入该目录
    
    7.  /sbin (root用户才可以调用)
            super  binary  超级的 二进制
            许多“指令”对应的可“执行程序文件”目录
            该目录文件对应指令都是"root"用户可以执行的指令
            usermod   init等等
    
    8.  /sys
    
    9.  /usr
            unix  system  resource (unix系统资源文件目录)
            该目录类似win系统的 C:/Program  files 目录
            该目录经常用于安装各种软件
            里面包含bin文件夹，里面有echo,ping,npm等指令存在在此
            
            /usr/bin
                许多“指令”对应的可“执行程序文件”目录
            /usr/sbin
                root用户执行的指令 对应的 可“执行程序文件”目录
    
    10. /bin
            binary  二进制
            许多“指令”对应的可“执行程序文件”目录
            ls   pwd等等
    
    11. /dev
        device  系统硬件设备目录(linux系统所有的硬件都通过文件表示)
        例如：/dev/cdrom是光驱
              /dev/sda  是第一块scsi硬盘
        文件夹中：
             /dev/cdrom : 光驱硬件
             /dev/sda  : 硬盘硬件
             /dev/sda1,/dev/sda2,/dev/sda3 ... : 硬盘的三个分区
            
    12. /home
        普通用户的"家目录"
        给系统每增加一个“普通用户”的同时，都会在该目录为该用户设置一个文件目录
        代表该用户的“家目录”，用户后期使用系统的时候会首先“进入”其家目录
        家目录名字默认与当前用户名字一致
        用户对家目录拥有绝对最高的权限。(即777)
    
    13. /lib64
    
    14. /mnt
        挂接光驱、USB设备的目录，加载后，会在mnt里多出相应设备的目录。mnt是mount的缩写。
    
    15. /proc
        内存映射目录，该目录可以查看系统的相关硬件信息
    
    16. /run
        里面的东西是系统运行时需要的, 不能随便删除. 但是重启的时候应该抛弃. 下次系统运行时重新生成
    
    17. /srv
    
    18. /tmp
    
    19. /var (一般作为项目的部署的目录)
        variable  可变的、易变的
        该目录存储的文件经常会发生变动(增加、修改、删除)
        经常用于部署项目程序(php)文件
        /var/www/shop
        /var/www/book
    
    20. /selinux       
        secure enhanced  linux 安全增强型linux
        对系统形成保护
        会对给系统安装软件时有干扰作用
</pre>

### 重点需要记住的目录
<pre>
    /dev    系统硬件设备目录
    /home   用户home目录
    /var    项目部署目录
    /etc    主要配置文件目录
    /usr    软件安装目录
</pre>

### 在终端中"~"解析
<pre>   
    其实，一般来说，只有进入了所在用户的/home的二级文件或文件夹中才会出现"~",
    即波浪线代表用户正在操作自己的/home/自己用户名/的目录
</pre>

### 内核文件与发行版
<pre>
    发行版：指的是由软件发行公司，把一定的Linux内核版本、应用程序和相应的系统管理软件和安装程序，组装成一个发行套件。
    发行版：内核版本文件 + 外围软件(图形化界面、安装程序、办公软件、记事本、编译器、解释器等等)
</pre>

# Linux常用指令

### whoami 获取当前使用Linux的使用用户

### 用户操作 (su - 命令可以直接切换到root)
<pre>
        su  用户名
        > su  -         //切换到root用户
        > su  -  root   //同上
          su  root      //root用户切换，在有的linux系统效果是：用户是root，权限是普通的
        > su  普通用户  //没有"横线" ,这个为切换用户，普通用户/root用户/等用户的切换
        > exit          //退回到上一个用户
    
        //su和exit要配对使用，如果使用多个su，会造成用户叠加
        jinnan-->root-->jinnan-->root-->jinnan
</pre>

### 绝对路径与相对路径
<pre>
    相对路径:以引用文件之所在为参考基础，而建立出的目录路径
    绝对路径:以WEB站点根目录为参考基础的目录路径
    
    . 或 ./      :当前目录
    ../ 或 ..    :上级目录
    ../../ 或 ../.. 上两级目录(以此类推) ../../../..
    /   :系统根目录
    
    在Linux系统里面到达一个地方或者获得一个文件，绝对路径和相对路径做出选择性的使用
</pre>

### 目录操作
<pre>
    1.查看目录下有什么文件
            > ls                 //list查看"当前"目录下有什么文件
            > ls  目录           //查看指定目录下文件信息
            > ls -a 目录         //-a ,即all，显示目录当前所有的文件，包含隐藏的文件
            > ls -l              //以"详细列表"形式查看文件内容
			> ls -al			 //查看当前目录下"全部文件"(包含隐藏文件)，并以"详细列表"形式展示出来	
			> ls -i				 //index查看文件索引号码
		    > ls -li             //以"详细列表"形式查看文件索引号码				
			
    2.目录切换
            cd  目录名称
            >cd  ..         //上级目录切换
            > cd ~          //回到用户的家目录
    3. 获得当前操作的目录位置
            > pwd
            
    4. 创建目录 make  directory
        > mkdir  dirname
        > mkdir  dir/newdir                 //在dir下创建一个newdir
        创建多级目录，如果"新目录"个数大于1个数量，就要设置"-p"参数
        > mkdir -p  newdir/newdir/newdir    //创建多级递归目录
        > mkdir -p  dir/newdir/newdir    //创建多级递归目录
        > mkdir -p dir/newdir/newdir/newdir
        
    5. (文件/目录)移动-改名字 操作  move
        > mv  dir1  dir2                //dir1移动到dir2目录下，并改名字为“原名”
        > mv  dir1  dir2/newdir         //dir1移动到dir2目录下，并改名字为“newdir”
        > mv  dir1  newdir              //dir1移动到当前目录下，并改名字为“newdir”
        > mv  dir1/dir2  dir3/dir4      //dir2移动到dir4目录下，并改名字为“原名”
        > mv  dir1/dir2  dir3/dir4/newdir      //dir2移动到dir4目录下，并改名字为“newdir”
    
    6. (文件/目录)复制-改名字 操作  copy
        文件复制
        > cp  file1  dir1                   //file1被复制到dir1下，并改名字为“原名”
        > cp  file1  dir1/newfile           //file1被复制到dir1下，并改名字为“newfile”
        > cp  dir1/file1  dir2/dir3         //file1被复制到dir3下，并改名字为“原名”
        > cp  dir1/file1  dir2/dir3/newfile //file1被复制到dir3下，并改名字为“newfile”
        
        目录复制,统一设置-r参数 recursive递归地 (无视目录层次)
        > cp -r dir1  dir2              //dir1被复制到dir2下，并改名字为“原名”
        > cp -r dir1  dir2/newdir       //dir1被复制到dir2下，并改名字为“newdir”
        > cp -r dir1/dir2  dir3/dir4    //dir2被复制到dir4下，并改名字为“原名”
        > cp -r dir1/dir2  dir3/dir4/newdir    //dir2被复制到dir4下，并改名字为“newdir”
        > cp -r dir1/dir2  newdir       //dir2被复制到当前目录下，并改名字为“newdir”
    
    7. 删除(文件/目录)
        > rm  file          //删除文件
        > rm -r dir         //删除目录
        > rm -rf  filename  //recursive force 递归、强制 删除文件
                            //-f  force  避免 “进入目录、删除隐藏文件” 的提示
        > rm -rf  /         //kill you by your self        
</pre>

### init 方法
<pre>
    init 0:关机 
    init 1:单用户模式 
    init 3:完全多用户模式，标准的运行级 
    init 5:启动可进入X-window系统
    init 6:重启
</pre>

### 简单文件操作
<pre>
    1.查看文件内容
          > cat  filename   //把文件内容输出到终端查看
    2.查看文件占据磁盘空间大小  du(disk usage)命令可以计算文件或目录所占的磁盘空间
        -h：以人类可读的方式显示
        　　-a：显示目录占用的磁盘空间大小，还要显示其下目录和文件占用磁盘空间的大小
        　　-s：显示目录占用的磁盘空间大小，不要显示其下子目录和文件占用的磁盘空间大小
        　　-c：显示几个目录或文件占用的磁盘空间大小，还要统计它们的总和
        　　--apparent-size：显示目录或文件自身的大小
        　　-l ：统计硬链接占用磁盘空间的大小
        　　-L：统计符号链接所指向的文件占用的磁盘空间大小
    
    
        > du -h  文件   
              
    3. 查看文件
    > cp  /etc/passwd   ./      //复制passwd文件到当前目录
    > cat  filename             //输出文件内容到终端
    > more  filename            //敲回车，逐行查看文件的内容
                                //不支持回看
                                //q键，退出查看
    > less  filename            //通过"上 下 左 右"键的方式，查看文档的各个部分内容
                                //支持回看,q键退出查看
    > head -n  filename         //查看文档的前n行内容(重点)
    > tail -n  filename         //查看文档的末尾n行内容(重点)
    
    > wc  filename              //计算文件行数  (返回的内容为: 48   97  2531 password 行数、字数、字节数，文件名等内容)

    4. 创建文件
    > touch  filename           //创建一个文件

    5. 给文件追加内容
       echo 内容 >/>> 文件
    > echo dog  >  animal.txt   //把dog内容以"覆盖写"方式追加到animal.txt文件中
                                //如果animal.txt文件不存在会"自动创建"
    
    > echo htc  >> order.txt    //把htc内容以"纯追加"方式设置到order.txt文件中
                                //order.txt文件不存在，会自动创建          
</pre>

### 用户和组的操作
<pre>
    1. 用户操作(root)
        用户：user
        增加：add   修改：mod(ify)  删除：del(ete)
        配置文件：/etc/passwd
        1) 增加用户 useradd
        > useradd xiaogang      //增加一个xiaogang用户，会创建一个同名的组
                                //没有设置用户的组别，就会创建同名组
        > useradd -g 组别编号  liming    //创建liming用户，并设置其组别(避免创建同名组)
        > useradd -u 用户编号  -g 组编号  -d  家目录  用户名
    
        2) 修改用户 usermod
        > usermod  -u 用户编号 -g 组编号 -d 家目录  -l 新名字  用户名
        //如果修改家目录，需要手动创建(不同于增加用户)
    
        3) 删除用户 userdel
        > userdel  用户名       // /etc/passwd的配置用户信息会删除(保留家目录，可以手动删除)
        > userdel  -r  用户名   // 用户信息 和 其家目录 都删除
    
    2. 组别操作(root)
        组别：group
        配置文件：/etc/group
        1) 增加组别 groupadd
        > groupadd music          //创建一个music组别
    
        2) 修改组别 groupmod
        > groupmod -g 组编号  -n 新名字 组名
    
        3) 删除组别 groupdel
        > groupdel  组名 
        //组下存在对应的用户信息，禁止删除
</pre>

### 给用户设置密码，使其登录系统
<pre>
    在root模式下，直接 passwd 用户名，并输入新密码
    可以 su 用户名 即可以登录相关用户
</pre>