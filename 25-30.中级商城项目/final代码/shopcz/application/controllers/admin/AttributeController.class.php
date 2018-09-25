<?php

class AttributeController extends BaseController
{

    public function indexAction()
    {
        //获取所有的商品类型
        $typeModel = new TypeModel('goods_type');
        $types = $typeModel->getTypes();
        //获取type_id
        $type_id = $_GET['type_id'];
        //获取当前的页数
        $current = isset($_GET['page']) ? $_GET['page'] : 1;
        $pagesize = 2;
        $offset = ($current - 1) * $pagesize;
        //获取当前指定类型下的所有属性
        $attrModel = new AttributeModel('attribute');
        $attrs = $attrModel->getAttrs($type_id, $offset, $pagesize);
        //载入分页类
        $this->library('Page');
        //获取总的记录数
        $where = "type_id = $type_id";
        $total = $attrModel->total($where);
        $page = new Page($total, $pagesize, $current, 'index.php',
            array('p' => 'admin', 'c' => 'attribute', 'a' => 'index', 'type_id' => $type_id));
        $pageinfo = $page->showPage();
        //载入模板页面
        include CUR_VIEW_PATH . "attribute_list.html";
    }

    //显示添加表单的页面
    public function addAction()
    {
        //获取商品类型
        $typeModel = new TypeModel('goods_type');
        $types = $typeModel->getTypes();
        //载入模板
        include CUR_VIEW_PATH . "attribute_add.html";
    }

    public function insertAction()
    {
        //1.收集表单数据
        $data['attr_name'] = trim($_POST['attr_name']);
        $data['type_id'] = $_POST['type_id'];
        $data['attr_type'] = $_POST['attr_type'];
        $data['attr_input_type'] = $_POST['attr_input_type'];
        $data['attr_value'] = isset($_POST['attr_value']) ? $_POST['attr_value'] : '';
        //2.验证和处理
        if ($data['attr_name'] == '') {
            $this->jump('index.php?p=admin&c=attribute&a=add', '属性名称不能为空');
        }
        $this->helper('input');
        $data = deepspecialchars($data);
        $data = deepslashes($data);
        //3.调用模型完成入库并给出提示
        $attrModel = new AttributeModel('attribute');
        if ($attrModel->insert($data)) {
            $this->jump('index.php?p=admin&c=attribute&a=index&type_id=' . $data['type_id'], '添加成功', 2);
        } else {
            $this->jump('index.php?p=admin&c=attribute&a=add', '添加失败');
        }
    }

    public function editAction()
    {
        include CUR_VIEW_PATH . "attribute_edit.html";
    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }

    //动态获取指定类型下的所有的属性
    public function getAttrsAction()
    {
        //获取type_id
        $type_id = $_GET['type_id'] + 0;
        //调用模型获取表单该类型下所有属性的构成
        $attrModel = new AttributeModel('attribute');
        $attrs = $attrModel->getAttrsForm($type_id);
        echo <<< STR
        <script>
            window.parent.document.getElementById("tbody-goodsAttr").innerHTML="$attrs";
        </script>
STR;

    }

}