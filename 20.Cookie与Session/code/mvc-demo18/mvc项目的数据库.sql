-- MySQL dump 10.13  Distrib 5.5.27, for Win32 (x86)
--
-- Host: localhost    Database: php39
-- ------------------------------------------------------
-- Server version	5.5.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `user_list`
--

DROP TABLE IF EXISTS `user_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_list` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(10) DEFAULT NULL,
  `user_pass` char(32) DEFAULT NULL,
  `age` tinyint(3) unsigned DEFAULT NULL,
  `edu` enum('小学','中学','大学','硕士','博士') DEFAULT NULL,
  `xingqu` set('排球','篮球','足球','中国足球','地球') DEFAULT NULL,
  `from` enum('东北','华北','西北','华东','华南','华西') DEFAULT NULL,
  `reg_time` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_list`
--

LOCK TABLES `user_list` WRITE;
/*!40000 ALTER TABLE `user_list` DISABLE KEYS */;
INSERT INTO `user_list` VALUES (6,'user2','b6d767d2f8ed5d21a44b0e5886680cb9',22,'硕士','排球,篮球,足球,中国足球,地球','华北','2015-07-26 11:10:45'),(12,'user66','c74d97b01eae257e44aa9d5bade97baf',66,'大学','排球,篮球','东北','2015-08-02 10:49:56'),(17,'user12','c20ad4d76fe97759aa27a0c99bff6710',12,'博士','排球,篮球,足球','西北','2015-08-05 11:39:59'),(19,'user14','aab3238922bcc25a6f606eb525ffdc56',14,'小学','足球,中国足球','华东','2015-08-05 16:51:10'),(20,'user15','9bf31c7ff062936a96d3c8bd1f8f2ff3',15,'大学','篮球,足球','华北','2015-08-07 11:48:59'),(21,'郝老二','202cb962ac59075b964b07152d234b70',23,'大学','足球,中国足球','西北','2015-08-07 11:52:31'),(22,'','d41d8cd98f00b204e9800998ecf8427e',55,'小学','篮球','华北','2015-08-07 12:06:46'),(24,'高玲','202cb962ac59075b964b07152d234b70',23,'大学','排球,篮球,足球','华东','2015-08-07 12:41:43'),(25,'黄璐瑶','202cb962ac59075b964b07152d234b70',23,'大学','排球,篮球,足球','西北','2015-08-07 12:42:13'),(26,'张佳琪','202cb962ac59075b964b07152d234b70',23,'大学','篮球,足球,中国足球','华北','2015-08-07 12:42:34'),(27,'宋老二','c20ad4d76fe97759aa27a0c99bff6710',18,'博士','排球,篮球,足球,中国足球,地球','东北','2015-08-07 12:44:10'),(28,'李克强','b53b3a3d6ab90ce0268229151c9bde11',55,'大学','中国足球','华东','2015-08-07 14:34:41');
/*!40000 ALTER TABLE `user_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(100) NOT NULL,
  `protype_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `pinpai` varchar(25) NOT NULL,
  `chandi` varchar(25) NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `pro_name` (`pro_name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='商品信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'康佳（KONKA）42英寸全高清液晶电视',1,1999.00,'康佳','深圳'),(2,'索尼（SONY）4G手机（黑色）',2,3238.00,'索尼','深圳'),(3,'海信（Hisense）55英寸智能电视',1,4199.00,'海信','青岛'),(5,'索尼（SONY）13.3英寸触控超极本',3,11499.00,'索尼','天津'),(12,'联想（Lenovo）14.0英寸笔记本电脑',3,2999.00,'联想','北京'),(13,'联想 双卡双待3G手机',2,988.00,'联想','北京'),(15,'惠普（HP）黑白激光打印机',3,1169.00,'惠普','天津'),(17,'test商品',15,1111.00,'传智','北京');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_type` (
  `protype_id` int(11) NOT NULL AUTO_INCREMENT,
  `protype_name` varchar(50) NOT NULL,
  PRIMARY KEY (`protype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='产品类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_type`
--

LOCK TABLES `product_type` WRITE;
/*!40000 ALTER TABLE `product_type` DISABLE KEYS */;
INSERT INTO `product_type` VALUES (1,'家用电器'),(2,'手机数码'),(3,'电脑办公'),(4,'图书音像'),(5,'家居家具'),(6,'服装配饰'),(7,'个护化妆'),(8,'运动户外'),(9,'汽车用品'),(10,'食品酒水'),(11,'营养保健');
/*!40000 ALTER TABLE `product_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(20) DEFAULT NULL,
  `admin_pass` varchar(48) NOT NULL,
  `login_times` int(11) DEFAULT NULL COMMENT '登录次数',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_name` (`admin_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user`
--

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` VALUES (1,'admin1','202cb962ac59075b964b07152d234b70',1,'2015-08-07 16:26:26'),(2,'admin2','202cb962ac59075b964b07152d234b70',0,'2015-08-07 16:24:33');
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-07 18:38:27
