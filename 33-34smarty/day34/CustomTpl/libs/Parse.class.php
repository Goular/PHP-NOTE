<?php
//用于翻译的内容,定义Parse类
class Parse{
    //解析内容
    private $content;
    //构造方法
    public function __construct($content){
        $this->content = $content;
    }

    //解析方法
    public function parse(){
        $this->parseVar();
        $this->parseIf();
        $this->parseFor();
        return $this->content;
    }

    //解析普通变量
    public function parseVar(){
        $pattern = '/\{\$(\w+)\s*\}/';
        if(preg_match($pattern,$this->content)){
            $this->content = preg_replace($pattern,"<?php echo \$this->tpl_vars['\\1']?>",$this->content);
        }
    }

    //解析if语句
    public function parseIf(){
        $patternIf = '/\{if\s+\$(\w+)\s*\}/';
        $patternEnd = '/\{\/if\s*\}/';
        $patternElse = '/\{else\s*\}/';
        if (preg_match($patternIf, $this->content)) {
            if (preg_match($patternEnd, $this->content)) {
                $this->content = preg_replace($patternIf,
                    "<?php if (\$this->tpl_vars['\\1']):?>", $this->content);
                $this->content = preg_replace($patternEnd, "<?php endif;?>", $this->content);
                //看看还有没有else
                if (preg_match($patternElse, $this->content)) {
                    $this->content = preg_replace($patternElse,"<?php else:?>", $this->content);
                }
            } else {
                exit('模板语法错误');
            }
        }
    }

    //解析foreach语句
    public function parseFor(){
        $patternFor = '/\{foreach\s+\$(\w+)\s+as\s+\$(\w+)\s*=>\s*\$(\w+)\s*\}/';
        $patternEnd = '/\{\/foreach\s*\}/';
        $patternVar = '/\{@(\w+)\}/';
        if (preg_match($patternFor, $this->content)) {
            if (preg_match($patternEnd, $this->content)) {
                $this->content = preg_replace($patternFor,
                    "<?php foreach (\$this->tpl_vars['\\1'] as \$\\2 => \$\\3):?>", $this->content);
                $this->content = preg_replace($patternEnd, "<?php endforeach;?>", $this->content);
                if (preg_match($patternVar, $this->content)) {
                    $this->content = preg_replace($patternVar, "<?php echo \$\\1;?>", $this->content);
                }
            } else {
                exit('模板语法错误');
            }
        }
    }
}