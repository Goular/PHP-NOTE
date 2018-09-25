<?php

class GoodsController extends PlatformController
{
    public function addAction()
    {
        require(VIEW_PATH . 'goods_add.html');
    }
}