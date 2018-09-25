
create table goods (
	goods_id int unsigned not null AUTO_INCREMENT,
	goods_name varchar(64) not null default '',
	shop_price decimal(10, 2) not null default 0,
	goods_desc text,
	goods_number int not null default 0,
	is_best tinyint not null default 0,
	is_new tinyint not null default 1,
	is_hot tinyint not null default 0,
	is_on_sale tinyint not null default 1,

	admin_id int unsigned not null default 0 comment '谁哪个管理员添加的该商品',
	create_time int not null default 0 comment '添加时间，时间戳，整型',

	primary key (goods_id)
) engine=myisam charset=utf8;


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