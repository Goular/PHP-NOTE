<?php
//模板类
class Template{
    //保存变量的数组变量
    private $tpl_vars = array();
    //模板目录
    public $template_dir = "templates";
    //编译目录
    public $compile_dir = "templates_c";
    //缓存目录
    public $cache_dir = "cache";
    //是否开启缓存
    public $caching = false;//默认不开启缓存

    //构造方法
    public function __construct()
    {
        ob_start();
    }

    //分配变量方法
    public function assign($name,$value){
        if(!empty($name)){
            $this->tpl_vars[$name] = $value;
        }else{
            exit('请设置变量名');
        }
    }

    //载入模板方法
    public function display($file){
        $tplFile = $this->template_dir . "/{$file}"; // 模板文件名
        $compileFile = $this->compile_dir . "/" . md5($file) . ".{$file}.php"; //编译文件名
        $cacheFile = $this->cache_dir ."/" . md5($file) . ".{$file}.html"; //缓存文件名
        //如果缓存文件存在，并且有效，直接访问缓存文件
        if (file_exists($cacheFile) && file_exists($compileFile) && filemtime($tplFile) <= filemtime($compileFile)) {
            echo "走缓存了";
            include $cacheFile;
            return;
        }
        //如果编译文件不存在，或者模板文件被修改，则需要重新编译
        if (!file_exists($compileFile) || filemtime($tplFile) > filemtime($compileFile)) {
            //编译
            // echo "走编译了...";
            $content = file_get_contents($tplFile);
            //做替换处理.....
            //引入parse类
            include "Parse.class.php";
            //实例化对象
            $parse = new Parse($content);
            //调用解析方法完成解析
            $content = $parse->parse();
            file_put_contents($compileFile, $content);
        }
        //载入编译文件
        include $compileFile;
        //判断是否开启了缓存
        if ($this->caching) {
            //读取缓冲区的内容
            $data = ob_get_contents();
            //生成缓存文件
            file_put_contents($cacheFile, $data);
            ob_end_clean(); //清空并关闭缓冲区
            include $cacheFile;
        }
    }
}