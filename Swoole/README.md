# Swoole学习

### 进程
<pre>
	进程包含内存和上下文环境

</pre>

### 同一进程间的线程究竟共享哪些资源呢，而又各自独享哪些资源呢？
<pre>
	共享的资源有
		a. 堆  由于堆是在进程空间中开辟出来的，所以它是理所当然地被共享的；因此new出来的都是共享的（16位平台上分全局堆和局部堆，局部堆是独享的）
		b. 全局变量 它是与具体某一函数无关的，所以也与特定线程无关；因此也是共享的
		c. 静态变量 虽然对于局部变量来说，它在代码中是“放”在某一函数中的，但是其存放位置和全局变量一样，存于堆中开辟的.bss和.data段，是共享的
		d. 文件等公用资源  这个是共享的，使用这些公共资源的线程必须同步。Win32 提供了几种同步资源的方式，包括信号、临界区、事件和互斥体。

	独享的资源有
		a. 栈 栈是独享的
		b. 寄存器  这个可能会误解，因为电脑的寄存器是物理的，每个线程去取值难道不一样吗？其实线程里存放的是副本，包括程序计数器PC

</pre>

### 父进程创建子进程
<pre>
	子进程会复制父进程的内存空间和上下文环境
	修改某个子进程的内存空间，不会修改父进程或其他子进程中的内存空间（父进程和子进程是独立的）
	
	复制的时候如果父进程的变量存在，那么子进程也存在，但是父进程变量修改，子进程变量不会产生变化,保持自身独立
</pre>

### Swoole是多进程模型，自身具有多个Worker进程和Master进程，多个Worker进程变量是不会相互通用的

### 共享内存 [查看共享内存操作:ipcs -m]
<pre>
	共享内存不属于任何一个进程
	在共享内存中分配的内存空间可以被任何进程访问
	即使进程关闭，共享内存仍然可以继续保留
</pre>

### Swoole结构
<pre>
	见文件夹图
	
	结构解析:
	
	Master进程
		包含若干的Reactor线程，用于事件响应与事件处理。
		每个Reactor都运行这个epoll函数的子实例，swoole所有对于事件的监听，都会在这些线程中实现。比如来自客户端的连接，本地通讯用的管道，以及异步操作用的文件。

	Manger进程	
		管理进程 用于管理下一级的TASK进程和WORKER进程，不运行任何的业务逻辑，仅仅只做进程的管理与分配
		
	Worker进程
		主逻辑进程，用于处理客户端的请求
		
	TaskWorker进程
		Swoole提供的异步工作进程，用于处理耗时较长的同步任务.
		
		
		
	在Swoole中，进程与进程间通讯是基于管道来进行实现的。Master主进程与worker进程和task worker进程是通过管道来进行通讯，当Worker进程有任务投递到TaskWorker进程时也是通过管道来进行数据投递	
	当然我们也是可以设置Swoole配置来使Worker和TaskWorker进程间通讯使用消息队列，而非管道。
</pre>

### Swoole工作流程
<pre>
	当一个新的客户端连接来到时，首先会被Master中的Main Reactor线程接收到，然后将这个连接的读写监听注册到对应的Reactor线程当中，并通知Worker进程处理对应的接收到连接对应的回调，当客户端发送数据后，由Reactor收到数据并通过管道发送到Worker进程去进行处理。
	Worker进程如果需要投递任务，也会通过管道投递到TaskWorker进程，Task Worker处理完成后，返回给Worker，Worker通知Reactor线程将数据交回给客户端。完成了整个的请求。
	当Worker进程出现意外，或者处理一定的请求次数关闭之后，Manager会重新拉起一个新的Worker进程。以保证真个系统中，Worker进程的数目是固定的。
	
	上面的讲述就是整个Swoole拓展的结构。

</pre>

###  Task Worker进程详解
<pre>
	是独立于Worker进程的工作进程，用于梳理耗时较长的逻辑。不会影响Worker进程处理客户端的请求，大大提高并发能力

	Worker进程通过task()方法，将任务投递到TaskWorker进程的onTask()方法，Task Worker完成处理后，通过直接return或者finish()方法返回给worker进程的onFinish()方法。
	
	Task进程和Worker进程间通讯通过Unix Sock管道来进行通讯的(也可以配置通过消息队列来通信)
</pre>

###  Task-常见问题
<pre>
	Task传递数据大小
		数据小于8K:直接通过管道传递，数据大于8k会存在/tmp的文件夹下已文件保存，写入的时候临时文件传递

	Task传递对象
		可以通过序列化传递一个对象的拷贝
		Task中对象的改变不会反映到Worker进程当中，
		数据库连接，网络连接对象是不能够进行传递的
</pre>

### Task的onFinish回调
<pre>
	Task的onFinish回调会发回调用task方法的worker进程

</pre>

### onWorkerStart
<pre>
	此事件在worker进程/task进程启动时发生。这里创建的对象可以在进程生命周期内使用。原型：
	function onWorkerStart(swoole_server $server, int $worker_id);

	
	•低于1.8.0版本task进程不能使用tick/after定时器，所以需要使用$serv->taskworker进行判断 
	•task进程可以使用addtimer间隔定时器 
	function onWorkerStart(swoole_server $serv, $worker_id)
	{
		if (!$serv->taskworker) {
			$serv->tick(1000, function ($id) {
				var_dump($id);
			});
		}
		else
		{
			$serv->addtimer(1000);
		}
	}


</pre>

### Timer介绍
<pre>
	基于Reactor线程（在Task Worker中使用系统定时器）
	基于epoll的timeout机制来进行实现
	使用堆存放timer，提高检索效率
</pre>

### Timer-使用
<pre>
	int swoole_timer_tick(int $ms,mixed $callback,mixed $params = null); //类似JS的setInterval
	int swoole_timer_after(int $ms,mixed $callback);
	
	Tick方法添加的定时器会永久执行，After方法添加的定时器值会执行一次
	After的回调函数不允许传递参数，因此只能通过闭包（use）的形式来进行传递
	定时器回调只会在当前进程内执行
	
	Timer传递参数
		可以通过tick方法的第三个参数传递，也可以使用use闭包
	Timer传递对象
		onTimer是在调用tick方法的进程中回调，因此可以直接使用在Worker进程中声明对象（局部变量无法访问）
	Timer的清除
		Tick方法会返回timer_id,可以使用swoole_timer_clear清除指定的定时器
	
</pre>

### 进程
<pre>
	子进程会复制父进程的IO句柄（fd描述符），此时可能存在父进程复制子进程时，已经含有数据库，文件等资源对象，此时就会出现并发，占用等问题，这时我们应该存在锁的机制。
	这也是多进程的机制。

</pre>

### 进程间通信（IPC）
<pre>
	1.管道（两个通路，互相通信，对每一边来说都是都是一读一写）
		管道是一组（2个）特殊的描述符
		需要在fork函数调用前创建
		如果某一端主动关闭管道，另一端的读取操作会直接返回0

	2.消息队列
		通过指定key创建一个消息队列，相同的key就能通信
		在消息队列中传递的数据有大小的限制
		消息队列会一直保留直到被主动关闭
		
	3.IO多路复用(epll-fd，阻塞监听，响应回调，并不是真正的异步监听,本质是底层在阻塞，但是上层是异步响应处理)
		epoll函数会监听注册在自己名下所有的socket描述符
		当有socket感兴趣的事件发生时，epoll函数才会进行响应，并返回有事件发生的socket集合
		epoll的本质是阻塞IO，他的优点是能同时处理大量的socket连接。
		因为他是使用了有事件触发才响应处理的，没有的话仅保持底层阻塞连接，事件异步处理，所以能进行高并发

		C10k，c1000k，这些问题都是需要基于多路复用进行实现的，只有多路复用才能解决万级的socket连接，如果每个链接都是用开进程，开线程的处理方法，服务器是处理不了那个多的链接的。
		epoll函数最大的优点是允许在同一个进程中，同时处理那么多的socket连接	
		epoll函数是目前大多数网络高并发，高性能服务器的本质.
</pre>

### Event Loop（事件循环）
<pre>
	有局限，现在很少再用，因为只能在cli界面中使用.
	Event Loop是一个Reactor线程，其中运行了一个epoll实例
	可通过接口添加socket描述符到epoll监听中，并指定事件响应的回调函数
	EventLoop不可用于FPM环境，因为FPM在做完任务后，会直接退出进程,而EventLoop是线程，所以会被连庄关闭，此时socket的监听也会关闭。
</pre>

### Swoole-Process详解
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