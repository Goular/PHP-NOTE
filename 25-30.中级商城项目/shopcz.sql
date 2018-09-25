-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-10-10 10:04:52
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopcz`
--

-- --------------------------------------------------------

--
-- 表的结构 `cz_address`
--

CREATE TABLE `cz_address` (
  `address_id` int(10) UNSIGNED NOT NULL COMMENT '地址编号',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '地址所属用户ID',
  `consignee` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `province` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '省份，保存是ID',
  `city` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '市',
  `district` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '区',
  `street` varchar(100) NOT NULL DEFAULT '' COMMENT '街道地址',
  `zipcode` varchar(10) NOT NULL DEFAULT '' COMMENT '邮政编码',
  `telephone` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '移动电话'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cz_admin`
--

CREATE TABLE `cz_admin` (
  `admin_id` smallint(5) UNSIGNED NOT NULL COMMENT '管理员编号',
  `admin_name` varchar(30) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `add_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cz_admin`
--

INSERT INTO `cz_admin` (`admin_id`, `admin_name`, `password`, `email`, `add_time`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@itcast.cn', 0);

-- --------------------------------------------------------

--
-- 表的结构 `cz_attribute`
--

CREATE TABLE `cz_attribute` (
  `attr_id` smallint(5) UNSIGNED NOT NULL COMMENT '商品属性ID',
  `attr_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品属性名称',
  `type_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '商品属性所属类型ID',
  `attr_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性是否可选 0 为唯一，1为单选，2为多选',
  `attr_input_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性录入方式 0为手工录入，1为从列表中选择，2为文本域',
  `attr_value` text COMMENT '属性的值',
  `sort_order` tinyint(4) NOT NULL DEFAULT '50' COMMENT '属性排序依据'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cz_attribute`
--

INSERT INTO `cz_attribute` (`attr_id`, `attr_name`, `type_id`, `attr_type`, `attr_input_type`, `attr_value`, `sort_order`) VALUES
(1, '颜色', 1, 2, 1, '红色\r\n绿色', 50),
(2, '尺寸', 1, 1, 0, '', 50),
(3, '产地', 2, 1, 0, '', 50),
(4, '性质', 4, 2, 1, '黄欢\r\n李欢', 50),
(5, '体坛', 1, 0, 0, '', 50),
(6, '成本', 1, 0, 2, '', 50);

-- --------------------------------------------------------

--
-- 表的结构 `cz_brand`
--

CREATE TABLE `cz_brand` (
  `brand_id` smallint(5) UNSIGNED NOT NULL COMMENT '商品品牌ID',
  `brand_name` varchar(30) NOT NULL DEFAULT '' COMMENT '商品品牌名称',
  `brand_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '商品品牌描述',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '商品品牌网址',
  `logo` varchar(50) NOT NULL DEFAULT '' COMMENT '品牌logo',
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT '50' COMMENT '商品品牌排序依据',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示，默认显示'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cz_brand`
--

INSERT INTO `cz_brand` (`brand_id`, `brand_name`, `brand_desc`, `url`, `logo`, `sort_order`, `is_show`) VALUES
(1, 'NIKE', 'Nike112', 'http://www.nike.com', '20161008/2016100817433057f9142263ea5.jpg', 50, 1);

-- --------------------------------------------------------

--
-- 表的结构 `cz_cart`
--

CREATE TABLE `cz_cart` (
  `cart_id` int(10) UNSIGNED NOT NULL COMMENT '购物车ID',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
  `goods_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_img` varchar(50) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_attr` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性',
  `goods_number` smallint(5) UNSIGNED NOT NULL DEFAULT '1' COMMENT '商品数量',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成交价格',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '小计'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cz_category`
--

CREATE TABLE `cz_category` (
  `cat_id` smallint(5) UNSIGNED NOT NULL COMMENT '商品类别ID',
  `cat_name` varchar(30) NOT NULL DEFAULT '' COMMENT '商品类别名称',
  `parent_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品类别父ID',
  `cat_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '商品类别描述',
  `sort_order` tinyint(4) NOT NULL DEFAULT '50' COMMENT '排序依据',
  `unit` varchar(15) NOT NULL DEFAULT '' COMMENT '单位',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示，默认显示'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cz_category`
--

INSERT INTO `cz_category` (`cat_id`, `cat_name`, `parent_id`, `cat_desc`, `sort_order`, `unit`, `is_show`) VALUES
(6, '男装', 4, '&lt;script&gt;', 50, '', 1),
(5, '家用电器', 0, '&lt;script&gt;', 50, '', 1),
(4, '服装', 0, '', 50, '', 1),
(7, '女装', 4, '', 50, '45', 1),
(8, '吊带', 6, 'dsafg', 50, '', 1),
(10, '彩电', 9, '', 50, '3', 1),
(11, '饮水机', 9, '', 50, '34', 1),
(13, '测试2', 0, '', 50, '466', 1),
(12, '测试1', 0, '是', 50, '34', 1),
(14, '测试3', 0, '', 50, '433', 1),
(15, '测试4', 0, '', 50, '65', 1),
(16, '测试5', 0, '但是', 50, '43', 1),
(17, '测试6', 0, '发送二', 50, '66', 1),
(18, '英雄联盟', 0, '', 50, '23', 1);

-- --------------------------------------------------------

--
-- 表的结构 `cz_galary`
--

CREATE TABLE `cz_galary` (
  `img_id` int(10) UNSIGNED NOT NULL COMMENT '图片编号',
  `goods_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品ID',
  `img_url` varchar(50) NOT NULL DEFAULT '' COMMENT '图片URL',
  `thumb_url` varchar(50) NOT NULL DEFAULT '' COMMENT '缩略图URL',
  `img_desc` varchar(50) NOT NULL DEFAULT '' COMMENT '图片描述'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cz_goods`
--

CREATE TABLE `cz_goods` (
  `goods_id` int(10) UNSIGNED NOT NULL COMMENT '商品ID',
  `goods_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '商品货号',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_brief` varchar(255) NOT NULL DEFAULT '' COMMENT '商品简单描述',
  `goods_desc` text COMMENT '商品详情',
  `cat_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品所属类别ID',
  `brand_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品所属品牌ID',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价格',
  `promote_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价格',
  `promote_start_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '促销起始时间',
  `promote_end_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '促销截止时间',
  `goods_img` varchar(50) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_thumb` varchar(50) NOT NULL DEFAULT '' COMMENT '商品缩略图',
  `goods_number` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品库存',
  `click_count` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '点击次数',
  `type_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品类型ID',
  `is_promote` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否促销，默认为0不促销',
  `is_best` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否精品,默认为0',
  `is_new` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否新品，默认为0',
  `is_hot` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否热卖,默认为0',
  `is_onsale` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否上架,默认为1',
  `add_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cz_goods`
--

INSERT INTO `cz_goods` (`goods_id`, `goods_sn`, `goods_name`, `goods_brief`, `goods_desc`, `cat_id`, `brand_id`, `market_price`, `shop_price`, `promote_price`, `promote_start_time`, `promote_end_time`, `goods_img`, `goods_thumb`, `goods_number`, `click_count`, `type_id`, `is_promote`, `is_best`, `is_new`, `is_hot`, `is_onsale`, `add_time`) VALUES
(1, 'ECS000032', '诺基亚N852', '', '', 4, 1, '3612.00', '3010.00', '0.00', 1243807200, 1417302000, '20161010/2016101007512657fb2c5e81460.jpg', '', 4, 0, 1, 0, 1, 1, 0, 1, 1476078686);

-- --------------------------------------------------------

--
-- 表的结构 `cz_goods_attr`
--

CREATE TABLE `cz_goods_attr` (
  `goods_attr_id` int(10) UNSIGNED NOT NULL COMMENT '编号ID',
  `goods_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品ID',
  `attr_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '属性ID',
  `attr_value` varchar(255) NOT NULL DEFAULT '' COMMENT '属性值',
  `attr_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '属性价格'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cz_goods_attr`
--

INSERT INTO `cz_goods_attr` (`goods_attr_id`, `goods_id`, `attr_id`, `attr_value`, `attr_price`) VALUES
(1, 1, 1, '红色', '0.00'),
(2, 1, 2, '但是', '0.00'),
(3, 1, 5, '我的', '0.00'),
(4, 1, 6, '32', '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `cz_goods_type`
--

CREATE TABLE `cz_goods_type` (
  `type_id` smallint(5) UNSIGNED NOT NULL COMMENT '商品类型ID',
  `type_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品类型名称'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cz_goods_type`
--

INSERT INTO `cz_goods_type` (`type_id`, `type_name`) VALUES
(1, '酱油'),
(2, '辣椒'),
(3, '狗屎'),
(4, '天梯');

-- --------------------------------------------------------

--
-- 表的结构 `cz_order`
--

CREATE TABLE `cz_order` (
  `order_id` int(10) UNSIGNED NOT NULL COMMENT '订单ID',
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
  `address_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '收货地址id',
  `order_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单状态 1 待付款 2 待发货 3 已发货 4 已完成',
  `postscripts` varchar(255) NOT NULL DEFAULT '' COMMENT '订单附言',
  `shipping_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '送货方式ID',
  `pay_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付方式ID',
  `goods_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品总金额',
  `order_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `order_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '下单时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cz_order_goods`
--

CREATE TABLE `cz_order_goods` (
  `rec_id` int(10) UNSIGNED NOT NULL COMMENT '编号',
  `order_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单ID',
  `goods_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_img` varchar(50) NOT NULL DEFAULT '' COMMENT '商品图片',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成交价格',
  `goods_number` smallint(5) UNSIGNED NOT NULL DEFAULT '1' COMMENT '购买数量',
  `goods_attr` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品小计'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cz_payment`
--

CREATE TABLE `cz_payment` (
  `pay_id` tinyint(3) UNSIGNED NOT NULL COMMENT '支付方式ID',
  `pay_name` varchar(30) NOT NULL DEFAULT '' COMMENT '支付方式名称',
  `pay_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '支付方式描述',
  `enabled` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否启用，默认启用'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cz_region`
--

CREATE TABLE `cz_region` (
  `region_id` smallint(5) UNSIGNED NOT NULL COMMENT '地区ID',
  `parent_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父ID',
  `region_name` varchar(30) NOT NULL DEFAULT '' COMMENT '地区名称',
  `region_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '地区类型 1 省份 2 市 3 区(县)'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cz_shipping`
--

CREATE TABLE `cz_shipping` (
  `shipping_id` tinyint(3) UNSIGNED NOT NULL COMMENT '编号',
  `shipping_name` varchar(30) NOT NULL DEFAULT '' COMMENT '送货方式名称',
  `shipping_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '送货方式描述',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '送货费用',
  `enabled` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否启用，默认启用'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cz_user`
--

CREATE TABLE `cz_user` (
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '用户编号',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户密码,md5加密',
  `reg_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户注册时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cz_address`
--
ALTER TABLE `cz_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cz_admin`
--
ALTER TABLE `cz_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cz_attribute`
--
ALTER TABLE `cz_attribute`
  ADD PRIMARY KEY (`attr_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `cz_brand`
--
ALTER TABLE `cz_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cz_cart`
--
ALTER TABLE `cz_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cz_category`
--
ALTER TABLE `cz_category`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `pid` (`parent_id`);

--
-- Indexes for table `cz_galary`
--
ALTER TABLE `cz_galary`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `goods_id` (`goods_id`);

--
-- Indexes for table `cz_goods`
--
ALTER TABLE `cz_goods`
  ADD PRIMARY KEY (`goods_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `cz_goods_attr`
--
ALTER TABLE `cz_goods_attr`
  ADD PRIMARY KEY (`goods_attr_id`),
  ADD KEY `goods_id` (`goods_id`),
  ADD KEY `attr_id` (`attr_id`);

--
-- Indexes for table `cz_goods_type`
--
ALTER TABLE `cz_goods_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `cz_order`
--
ALTER TABLE `cz_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `pay_id` (`pay_id`),
  ADD KEY `shipping_id` (`shipping_id`);

--
-- Indexes for table `cz_order_goods`
--
ALTER TABLE `cz_order_goods`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indexes for table `cz_payment`
--
ALTER TABLE `cz_payment`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `cz_region`
--
ALTER TABLE `cz_region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `cz_shipping`
--
ALTER TABLE `cz_shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `cz_user`
--
ALTER TABLE `cz_user`
  ADD PRIMARY KEY (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cz_address`
--
ALTER TABLE `cz_address`
  MODIFY `address_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '地址编号';
--
-- 使用表AUTO_INCREMENT `cz_admin`
--
ALTER TABLE `cz_admin`
  MODIFY `admin_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理员编号', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cz_attribute`
--
ALTER TABLE `cz_attribute`
  MODIFY `attr_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品属性ID', AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `cz_brand`
--
ALTER TABLE `cz_brand`
  MODIFY `brand_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品品牌ID', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cz_cart`
--
ALTER TABLE `cz_cart`
  MODIFY `cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '购物车ID';
--
-- 使用表AUTO_INCREMENT `cz_category`
--
ALTER TABLE `cz_category`
  MODIFY `cat_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品类别ID', AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `cz_galary`
--
ALTER TABLE `cz_galary`
  MODIFY `img_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '图片编号';
--
-- 使用表AUTO_INCREMENT `cz_goods`
--
ALTER TABLE `cz_goods`
  MODIFY `goods_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品ID', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cz_goods_attr`
--
ALTER TABLE `cz_goods_attr`
  MODIFY `goods_attr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号ID', AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `cz_goods_type`
--
ALTER TABLE `cz_goods_type`
  MODIFY `type_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '商品类型ID', AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `cz_order`
--
ALTER TABLE `cz_order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '订单ID';
--
-- 使用表AUTO_INCREMENT `cz_order_goods`
--
ALTER TABLE `cz_order_goods`
  MODIFY `rec_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号';
--
-- 使用表AUTO_INCREMENT `cz_payment`
--
ALTER TABLE `cz_payment`
  MODIFY `pay_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '支付方式ID';
--
-- 使用表AUTO_INCREMENT `cz_region`
--
ALTER TABLE `cz_region`
  MODIFY `region_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '地区ID';
--
-- 使用表AUTO_INCREMENT `cz_shipping`
--
ALTER TABLE `cz_shipping`
  MODIFY `shipping_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号';
--
-- 使用表AUTO_INCREMENT `cz_user`
--
ALTER TABLE `cz_user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户编号';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
