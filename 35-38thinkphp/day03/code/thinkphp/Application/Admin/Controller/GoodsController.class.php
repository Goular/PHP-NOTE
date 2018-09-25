<?php
namespace Admin\Controller;

use \Think\Controller;
use Think\Think;

class GoodsController extends Controller
{
    //列表展示
    function showList1()
    {
        //创建Model对象

        //①使用普通的方法进行Model对象的实例化
        //$goods = new \Model\GoodsModel();
        //dump($goods);

        //$english = new \Model\EnglishModel();
        //dump($english);

        //②实例化基类Model对象
        //$obj = D();

        $obj = D("User");
        dump($obj);

        $this->display();
    }

    function showList2()
    {
        //数据查询操作
        $goods = new \Model\GoodsModel();
        $info = $goods->select();
        //$info = $goods->select(17);//SELECT * FROM `sw_goods` WHERE `goods_id` = 17
        //$info = $goods->select("21,24,29,30");//SELECT * FROM `sw_goods` WHERE `goods_id` IN ('21','24','29','30')

        //dump($info);
        //var_dump(get_defined_constants());
        $this->assign('info', $info);
        $this->display();
    }

    function showList3()
    {
        $goods = D("Goods");
        //① where() 设置查询的条件
        //$goods -> where(把sql语句where后边的信息当做"参数"传递进来即可);
        //$goods->where("goods_name like '诺%' and goods_price > 1000");
        //SELECT * FROM `sw_goods` WHERE ( goods_name like '诺%' and goods_price > 1000 )

        //② limit([偏移量,]长度)限制查询条数
        //$goods->limit(5);
        //SELECT * FROM `sw_goods` LIMIT 5
        //limit  偏移量，长度
        //偏移量：(当前页码-1)*长度
        //SELECT * FROM `sw_goods` WHERE ( goods_name like '诺%' and goods_price > 1000 ) LIMIT 21,7
        //$goods->limit(21, 7);

        //③ field() 限制查询的字段
        //SELECT `goods_name`,`goods_price` FROM `sw_goods` WHERE ( goods_name like '诺%' and goods_price > 1000 ) LIMIT 21,7
        //$goods->field('goods_name,goods_price');

        //④ order() 排序查询
        //SELECT `goods_brand_id`,count(*) FROM `sw_goods` WHERE ( goods_name like '诺%' and goods_price > 1000 ) GROUP BY goods_brand_id LIMIT 21,7
        $goods->order("goods_price desc");

        //⑤ group() 分组查询，group by
        //获得每个品牌下商品的总数量
        //SELECT `goods_brand_id`,count(*) FROM `sw_goods` WHERE ( goods_name like '诺%' and goods_price > 1000 ) GROUP BY goods_brand_id ORDER BY goods_price desc LIMIT 21,7
        $goods->group('goods_brand_id');
        //$goods->field('goods_brand_id,count(*)');

        //⑥ having()条件方法使用
        $goods->having('goods_price > 1000');

        $info = $goods->select();

        $this->assign('info', $info);
        $this->display();
    }

    function showList4()
    {
        //连贯操作
        //获得每个品牌下商品的总数量
        $goods = new \Model\GoodsModel();
        $info = $goods->group('goods_brand_id')->field('goods_brand_id,count(*)')->select();

        dump($goods);

        $this->assign('info', $info);
        $this->display();
    }

    function showList()
    {
        //echo Applica
        //exit;

        //实现数据分页效果
        $goods = D('Goods');
        //① 获得数据的总记录条数
        $total = $goods -> count();//select count(*) from sw_goods;
        $per = 7;

        //② 实例化分页类对象
        $page_obj = new \Tools\Page($total,$per);
        //③ 拼装sql语句获得每页信息
        $sql = "select * from sw_goods order by goods_id desc ".$page_obj->limit;
        $info = $goods->query($sql);
        //④ 获得页码列表
        $pagelist = $page_obj->fpage([3,4,5,6,7,8]);

        //dump($pagelist);

        $this->assign('pagelist',$pagelist);
        $this->assign('info',$info);
        $this->display();

//        $info = D("Goods")->order("goods_id asc")->select();
//        $this->assign("info", $info);
//        $this->display();
    }

    //添加商品
    function add1()
    {
        //① 数组方式数据添加

//        $goods = D('Goods');
//
//        $arr = array(
//            'goods_name' => 'iPhone7',
//            'goods_price' => 6500,
//            'goods_weight' => 115,
//            'goods_number' => 15
//
//        );
//        $z = $goods->add($arr);
//        dump($z);

        //②AR方式数据添加
        //以下是对象给本身不存在(私有成员属性)的成员属性赋值，会自动调用__set()
        //__set()魔术方法会把如下4个成员都放到data成员里边，再传递给add()使用

        $goods = D("Goods");
        $goods->goods_name = "samsung7";
        $goods->goods_price = 4600;
        $goods->goods_number = 16;
        $goods->goods_weight = 116;

        $z = $goods->add();//使用AR方式进行添加数据的方式
        dump($z);


        $this->display();
    }

    /**
     * $_FILES['file']['error']
    其值为 0，没有错误发生，文件上传成功。

    其值为 1，上传的文件超过了 PHP.ini 中 upload_max_filesize 选项限制的值。

    其值为 2，上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。

    其值为 3，文件只有部分被上传。

    其值为 4，没有文件被上传。

    其值为 6，找不到临时文件夹。PHP 4.3.10 和 PHP 5.0.3 引进。

    其值为 7，文件写入失败。PHP 5.1.0 引进。
     */

    //添加商品的内容
    function add()
    {
        $goods = D('Goods');
        //同一个功能，进行两个处理
        //1.展示的是add的页面
        //2.执行表单提交
        if (!empty($_POST)) {
            //dump($_FILES);
            //exit();
            //处理文件上传商品
            if($_FILES['goods_image']['error']===0){
                //1.实现图片上传
                $cfg = array(
                    'rootPath'=>'APP_PATH'.'/Uploads/'//保存根路径
                );
                $up = new \Think\Upload($cfg);
                $z = $up->uploadOne($_FILES['goods_image']);

                //把上传好的图片保存到数据表记录里边
                $bigpathname = $up->rootPath.$z['savepath'].$z['savename'];//图片的路径名
                $_POST['goods_big_img'] = ltrim($bigpathname,'.');

                //2) 给上传好的图片制作缩略图
                $im = new \Think\Image();//① 实例化Image类对象
                $im -> open($bigpathname);//② 打开被处理的图片
                $im -> thumb(125,125,6);//③ 制作缩略图（默认有自适应效果）
                $smallpathname = $up -> rootPath.$z['savepath']."small_".$z['savename'];
                $im -> save($smallpathname);//④ 保存缩略图到服务器
                //把制作好的缩略图保存到数据表记录里边
                $_POST['goods_small_img'] = ltrim($smallpathname,'.');
            }

            //收集表单信息
            $info = $goods->create();//校验数据,返回成功的返回的数据集
            $z = $goods->add($info);
            if ($z) {
                //如果创建成功
                //进行页面转跳
                $this->redirect('showList', array('name' => 'Tom', 'pwd' => '123456'), 2, '数据添加成功!');
            } else {
                $this->redirect('add', [], 2, '数据添加失败');
            }
        } else {
            //数据展示
            $this->display();
        }
    }

    //修改商品
    function update1()
    {
        //①数据修改，写好goods_id主键后，就可以直接使用save()
//        $goods = new \Model\GoodsModel();
//        $goods->goods_id = 24;
//        $goods->goods_name = "nokia8890";
//        $goods->goods_price = 3200;
//        $goods->goods_number = 23;
//        $z = $goods->save();
//        dump($z);

        //②使用注册好的model内容，同时写好where的内容，不然没有where获取主键信息的话tp框架是不会执行，但是mysql是可以全部修改的，tp框架却不会接收
        $goods = new \Model\GoodsModel();
        $goods->goods_name = "nokia333";
        $goods->goods_price = 3200;
        $goods->goods_number = 23;
        $z = $goods->where("goods_id>165 and goods_id<170")->save();
        $z = $goods->save();
        dump($z);

        $this->display();
    }

    //添加传递到参数的update方法
    function update($goods_id)
    {
        //获得被修改的商品信息
        //find() 获得数据表记录信息，每次通过"一维数组"返回一个记录结果
        //model对象->find();  获得第一个记录结果
        //model对象->find(数字);  获得"主键id值"等于数字条件的记录结果
        $goods = D('Goods');
        //两个逻辑：展示，收集
        if (!empty($_POST)) {
            //dump($_POST);
            //提交数据
            $z = $goods->save($_POST);
            if ($z) {
                $this->redirect('showList', array(), 2, '数据修改成功!');
            } else {
                $this->redirect('update', ['goods_id' => $goods_id], 2, "数据修改失败!");
            }
        } else {
            //展示内容
            $info = $goods->find($goods_id);
            $this->assign('info', $info);
            $this->display();
        }
    }

    function delete($goods_id)
    {
        //如果$goods_id为空，就不执行
        if (!empty($goods_id)) {
            $goods = D('Goods');
            //写法1
            //$z = $goods->delete($goods_id);
            //写法2
            $goods->goods_id = $goods_id;
            if ($goods->delete()) {
                $this->redirect('showList', [], 2, "删除商品成功!");
            } else {
                $this->redirect('delete', ["goods_id" => $goods_id], 2, "删除商品失败!");
            }
        }
    }

    //ThinkPHP执行原生SQL语句
    function test()
    {
        //原生查询
//        $goods = D();//创建空的model对象
//        $sql = "select * from sw_goods;";
//        //执行查询语句
//        $goods = $goods->query($sql);
//        dump($goods);

        //原生 添加/修改/删除语句
        $goods = D();
        $sql = "update `sw_goods` set goods_name='sony 999' where goods_id = 166;";
        $z = $goods->execute($sql);
        dump($z);
    }
}