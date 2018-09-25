<?php

/**
 * 商品分类的控制器
 */
class CategoryController extends BaseController
{
    public function indexAction()
    {
        //获取所有的分类信息
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->getCats();
        //载入页面内容
        include CUR_VIEW_PATH . 'cat_list.html';
    }

    //显示添加分类表单
    public function addAction()
    {
        //获取当前所有的分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->getCats();//结果是二维数组
        //载入表单的页面
        include CUR_VIEW_PATH . "cat_add.html";
    }

    //完成商品分类入库动作
    public function insertAction()
    {
        //1.收集表单数据，以关联数组的形式
        $data['cat_name'] = trim($_POST['cat_name']);
        $data['unit'] = trim($_POST['unit']);
        $data['sort_order'] = trim($_POST['sort_order']);
        $data['cat_desc'] = trim($_POST['cat_desc']);
        $data['parent_id'] = trim($_POST['parent_id']);
        $data['is_show'] = trim($_POST['is_show']);

        $this->helper('input');
        $data = deepspecialchars($data);

        //2.做相应的验证和处理
        if ($data['cat_name'] == '') {
            $this->jump('index.php?p=admin&c=category&a=add', '分类名称不能为空');
        }
        //3.调用模型完成入库并给出提示
        $categoryModel = new CategoryModel('category');
        if ($categoryModel->insert($data)) {
            $this->jump('index.php?p=admin&c=category&a=index', '添加分类成功', 2);
        } else {
            $this->jump('index.php?p=admin&c=category&a=add', '添加分类失败');
        }
    }

    //显示修改分类的表单
    public function editAction()
    {
        //获取cat_id
        $cat_id = intval($_GET['cat_id']);//?
        //得到当前的这条记录
        $categoryModel = new CategoryModel('category');
        $cat = $categoryModel->selectByPk($cat_id);
        //获取所有分类的信息
        $cats = $categoryModel->getCats();
        include CUR_VIEW_PATH . "cat_edit.html";
    }

    public function updateAction()
    {
        //1.收集表单数据
        $data['cat_name'] = trim($_POST['cat_name']);
        $data['unit'] = trim($_POST['unit']);
        $data['sort_order'] = trim($_POST['sort_order']);
        $data['cat_desc'] = trim($_POST['cat_desc']);
        $data['parent_id'] = $_POST['parent_id'];
        $data['is_show'] = $_POST['is_show'];
        $data['cat_id'] = $_POST['cat_id']; //一定不能少

        $this->helper('input');
        $data = deepspecialchars($data);


        //2.验证及处理
        if ($data['cat_name'] == '') {
            $this->jump('index.php?p=admin&c=category&a=add', '分类名称不能为空');
        }
        //不能将当前分类的后代或者自己作为其上级分类
        $categoryModel = new CategoryModel('category');
        $ids = $categoryModel->getSubIds($data['cat_id']);
        if (in_array($data['parent_id'], $ids)) {
            $this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}",
                '不能将当前分类的后代或者自己作为其上级分类');
        }
        //3.调用模型完成更新并给出提示

        if ($categoryModel->update($data)) {
            $this->jump('index.php?p=admin&c=category&a=index', '修改分类成功', 2);
        } else {
            $this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}", '修改分类失败');
        }
    }

    public function deleteAction()
    {
        //1.获取cat_id
        $cat_id = $_GET['cat_id'] + 0;
        //判断是否存在子节点
        $categoryModel = new CategoryModel('category');
        $ids = $categoryModel->getSubIds($cat_id);
        if (count($ids) > 1) {
            $this->jump('index.php?p=admin&c=category&a=index', '当前分类有后代分类，不能删除，请先删除后代分类');
        }
//3.调用模型完成删除并给出提示
        if ($categoryModel->update($cat_id)) {
            $this->jump('index.php?p=admin&c=category&a=index', '删除成功', 2);
        } else {
            $this->jump("index.php?p=admin&c=category&a=index", '删除失败');
        }
    }
}