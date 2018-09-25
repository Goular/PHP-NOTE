<?php

class BrandController extends BaseController
{

    //显示品牌列表
    public function indexAction()
    {
        //先获取品牌信息
        $brandModel = new BrandModel("brand");
        // $brands = $brandModel->getBrands();
        //载入分页类
        $where = ""; //查询条件
        $this->library("Page");
        //获取brand总的记录数
        $total = $brandModel->total($where);
        //指定分页数，每一页显示的记录数
        $pagesize = 2;
        // $pagesize = $GLOBALS['config']['pagesize'];
        //获取当前页数，默认是1
        $current = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($current - 1) * $pagesize;
        //使用模型完成数据的查询
        $brands = $brandModel->getPageBrands($offset, $pagesize);
        //使用分页类获取分页信息
        $page = new Page($total, $pagesize, $current, "index.php", array("p" => "admin", "c" => "brand", "a" => "index"));
        $pageinfo = $page->showPage();
        include CUR_VIEW_PATH . "brand_list.html";
    }

    public function addAction()
    {
        include CUR_VIEW_PATH . "brand_add.html";
    }

    public function editAction()
    {
        $brandModel = new BrandModel('brand');
        //条件
        $brand_id = $_GET['brand_id'] + 0;
        //使用模型获取
        $brand = $brandModel->selectByPk($brand_id);
        include CUR_VIEW_PATH . "brand_edit.html";
    }

    public function insertAction()
    {
        //接受表单提交过来的数据
        $data['brand_name'] = trim($_POST['brand_name']);
        $data['url'] = trim($_POST['url']);
        $data['brand_desc'] = trim($_POST['brand_desc']);
        $data['sort_order'] = trim($_POST['sort_order']);
        $data['is_show'] = trim($_POST['is_show']);
        //对提交过来的数据需要做一些验证、过滤等一些处理(此处忽略)
        $this->helper('input');
        $data = deepspecialchars($data);
        $this->library('Upload');
        $upload = new Upload();
        if ($filename = $upload->up($_FILES["logo"])){
            //成功
            $data['logo'] = $filename;
            //调用模型完成入库操作，并给出相应的提示
            $brandModel = new BrandModel("brand");
            if ($brandModel->insert($data)){//添加成功
                $this->jump("index.php?p=admin&c=brand&a=index","添加商品品牌成功",2);
            }else {//添加失败
                $this->jump("index.php?p=admin&c=brand&a=add","添加商品品牌失败",3);
            }
        }else{//失败
            $this->jump("index.php?p=admin&c=brand&a=add",$upload->error(),3);
        }
    }

    public function updateAction()
    {
        //获取条件及数据
        $data['brand_id'] = $_POST['brand_id'];
        $data['brand_name'] = trim($_POST['brand_name']);
        $data['brand_desc'] = trim($_POST['brand_desc']);
        $data['sort_order'] = trim($_POST['sort_order']);
        $data['url'] = trim($_POST['url']);
        $data['is_show'] = $_POST['is_show'];

        //图片怎么办，需要判断是否有上传，如何判断
        if ($_POST['logo']['name']) {
            //有上传,完成上传操作
        }
        //调用模型完成更新
        $brandModel = new BrandModel("brand");
        if ($brandModel->update($data)) {
            $this->jump("index.php?p=admin&c=brand&a=index", "更新成功", 2);
        } else {
            $this->jump("index.php?p=admin&c=brand&a=edit&brand_id=" . $data['brand_id'], "更新失败", 2);
        }
    }

    public function deleteAction()
    {
        //获取brand_id
        $brand_id = $_GET['brand_id'] + 0;
        $brandModel = new BrandModel('brand');
        $brand = $brandModel->selectByPk($brand_id);
        //得到图片的全路径
        $img = UPLOAD_PATH . $brand['logo'];
        if ($brandModel->delete($brand_id)) {
            //删除文件
            @unlink($img);
            $this->jump("index.php?p=admin&c=brand&a=index", "删除成功", 2);
        } else {
            $this->jump("index.php?p=admin&c=brand&a=index", "删除失败", 3);
        }
    }
}