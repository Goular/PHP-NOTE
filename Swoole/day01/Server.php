<?php

/**
 * $fd：客户端描述符
 * $task()仅能发送一个字符串
 */
class Server
{
    private $serv;

    public function __construct()
    {
        $this->serv = new swoole_server('0.0.0.0', 9501);
        $this->serv->set(array(
            'worker_num' => 8,
            'daemonize' => false,
            'max_request' => 10000,
            'dispatch_mode' => 2,
            'task_worker_num' => 8
        ));
        $this->serv->on('Start', array($this, 'onStart'));
        $this->serv->on('Connect', array($this, 'onConnect'));
        $this->serv->on('Receive', array($this, 'onReceive'));
        $this->serv->on('Close', array($this, 'onClose'));

        //绑定回调
        $this->serv->on('Task', array($this, 'onTask'));
        $this->serv->on('Finish', array($this, 'onFinish'));
        $this->serv->start();
    }

    public function onStart($serv)
    {
        echo "Start\n";
    }

    public function onConnect($serv, $fd, $from_id)
    {
        echo "Client {$fd} connect\n";
    }

    public function onClose($serv, $fd, $from_id)
    {
        echo "Client {$fd} close connection\n";
    }

    public function onReceive(swoole_server $serv, $fd, $from_id, $data)
    {
        echo "Get Message From Client {$fd}:{$data}\n";

        $serv->send($fd, 'Hello Client!' . $fd);

        //组织数据发送到Task进程
        $datas = array(
            'task' => 'task_1',
            'params' => $data,
            'fd' => $fd
        );
        //task()仅能发送一条字符串
        $serv->task(json_encode($datas));
    }

    public function onTask($serv, $task_id, $from_id, $data)
    {
        echo "This Task {$task_id} from Worker {$from_id}\n";
        echo "Data:{$data}\n";

        //Task进程接收到异步任务的资料
        $datas = json_decode($data, true);

        echo "Receive Task:{$datas['task']}";
        var_dump($datas['params']);

        //任务完成，返回数据给客户端和worker进程
        $serv->send($datas['fd'], 'Hello Task!');//fd为客户标识，返回给指定的客户
        return "Finished";
    }

    public function onFinish($serv, $task_id, $data)
    {
        echo "Task {$task_id} finish\n";
        echo "Result:{$data}\n";
    }
}

$server = new Server();
