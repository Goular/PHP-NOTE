<?php


class BaseProcess
{

    private $process;

    public function __construct()
    {
        $this->process = new swoole_process(array($this, 'run'), false, true);
        //this->process->daemon(true,true);
        $this->process->start();

        swoole_event_add($this->process->pipe, function ($pipe) {
            $data = $this->process->read();
            echo "RECV:" . $data . PHP_EOL;
        });
    }

    public function run($worker)
    {
        swoole_timer_tick(1000, function ($timer_id) {
            static $index = 0;
            $index += 1;
            $this->process->write('Hello');
            var_dump($index);
            if ($index == 0) {
                swoole_timer_clear($timer_id);
            }
        });
    }
}

new BaseProcess;
swoole_process::signal(SIGCHLD, function ($sig) {
    //必须设置为false，非阻塞模式
    while ($ret = swoole_process::wait(false)) {
        echo "PID={$ret['pid']}" . PHP_EOL;
    }
});
