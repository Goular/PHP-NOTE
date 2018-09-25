<?php

/**
 * 商品相关功能控制器
 */
class GoodsController extends PlatformController
{

    /**
     * 展示添加表单页面功能
     */
    public function addAction()
    {

        //
        require VIEW_PATH . 'goods_add.html';
    }


    /**
     * 处理商品数据的添加
     */
    public function InsertAction()
    {
        //收集表单数据
        $data['goods_name'] = $_POST['goods_name'];
        $data['shop_price'] = $_POST['shop_price'];
        $data['goods_desc'] = $_POST['goods_desc'];
        $data['goods_number'] = $_POST['goods_number'];

        //0为非，1为是
        $data['is_best'] = isset($_POST['is_best']) ? '1' : '0';
        $data['is_new'] = isset($_POST['is_new']) ? '1' : '0';
        $data['is_hot'] = isset($_POST['is_hot']) ? '1' : '0';
        $data['is_on_sale'] = isset($_POST['is_on_sale']) ? '1' : '0';

        //上传文件
        //设置属性
        $t_upload = new Upload();
        $t_upload->setUploadPath(ROOT . 'upload/goods/');
        $t_upload->setPrefix('goods_ori_');
        //执行
        if ($result = $t_upload->uploadFile($_FILES['goods_image_ori'])) {
            $data['image_ori'] = $result;
        } else {
            $this->GotoUrl('文件上传失败,原因是:' . $t_upload->getError());
            die();
        }

        //-----------------上面的代码为获取表单内容，只有表单全部正常获取，我们才进行操作，否则直接返回后退----------------

        //----获取的数据----
        $data['admin_id'] = $_SESSION['admin_info']['id'];
        $data['create_time'] = time();//获取的是时间戳

        // 利用模型插入数据表
        $m_goods = ModelFactory::M('GoodsModel');
        $result = $m_goods->insertGoods($data);
        //转跳到列表的页面
        if ($result) {
            // 插入成功，商品列表
            header('Location: index.php?p=back&c=Goods&a=list');
            die;
        } else {
            $this->GotoUrl('失败，失败的原因', 'index.php?p=back&c=Goods&a=add');
            die;
        }
    }


    /**
     * 商品列表
     */
    public function ListAction()
    {
        echo 'Goods::Lists;';
    }
}