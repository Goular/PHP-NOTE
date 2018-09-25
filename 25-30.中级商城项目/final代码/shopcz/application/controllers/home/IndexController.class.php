<?php

//首页控制器
class IndexController extends Controller
{
    //index方法
    public function indexAction()
    {
        //获取所有的商品分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->frontCats();

        //获取推荐的商品
        $goodsModel = new GoodsModel('goods');
        $bestGoods = $goodsModel->getBestGoods();

        include CUR_VIEW_PATH . "index.html";
    }
}