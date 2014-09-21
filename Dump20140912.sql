CREATE DATABASE  IF NOT EXISTS `info` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `info`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: 127.0.0.1    Database: info
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `info_category`
--

DROP TABLE IF EXISTS `info_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_category`
--

LOCK TABLES `info_category` WRITE;
/*!40000 ALTER TABLE `info_category` DISABLE KEYS */;
INSERT INTO `info_category` VALUES (1,0,'优惠打折'),(2,0,'酒店信息'),(3,0,'娱乐天地'),(4,0,'生活社区'),(5,0,'批发动态'),(6,2,'星级酒店'),(7,2,'华人旅社'),(8,3,'K歌天地'),(9,3,'桑拿按摩'),(10,4,'拼车'),(11,4,'旅游'),(12,4,'招聘'),(13,4,'房产'),(14,4,'二手'),(15,4,'留学'),(16,4,'同城'),(17,4,'住宿'),(18,5,'服装批发'),(19,5,'箱包'),(20,5,'小商品'),(21,5,'电子产品'),(22,5,'首饰'),(23,5,'其他'),(24,1,'服装'),(25,1,'美食'),(26,1,'婚纱摄影'),(27,1,'数码电子'),(28,1,'机票'),(29,1,'卖场');
/*!40000 ALTER TABLE `info_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_kv`
--

DROP TABLE IF EXISTS `info_kv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_kv` (
  `key` varchar(64) NOT NULL,
  `value` varchar(256) DEFAULT NULL,
  KEY `idx_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_kv`
--

LOCK TABLES `info_kv` WRITE;
/*!40000 ALTER TABLE `info_kv` DISABLE KEYS */;
INSERT INTO `info_kv` VALUES ('publish:20','11'),('publish:12','8'),('publish:11','30'),('publish:23','21'),('publish:24','60'),('publish:25','19'),('publish:','0');
/*!40000 ALTER TABLE `info_kv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_mail`
--

DROP TABLE IF EXISTS `info_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_mail` (
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `content` varchar(512) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `idx_from` (`from`),
  KEY `idx_to` (`to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_mail`
--

LOCK TABLES `info_mail` WRITE;
/*!40000 ALTER TABLE `info_mail` DISABLE KEYS */;
INSERT INTO `info_mail` VALUES (2,41,'test mess','2014-09-06 13:22:24'),(33,2,'mess2','2014-09-06 14:08:31'),(41,2,'re mess','2014-09-06 14:08:31'),(41,32,'aaaa','2014-09-06 14:08:31'),(41,32,'bbbb','2014-09-06 14:32:01'),(41,32,'123123','2014-09-07 02:09:21'),(41,32,'123123123123','2014-09-07 02:10:06'),(41,32,'ffffff','2014-09-07 02:11:49'),(41,2,'aaaaa','2014-09-07 02:11:58'),(41,32,'qqqqq','2014-09-07 02:48:16'),(41,41,'测试发送','2014-09-07 03:43:23'),(41,41,'4444','2014-09-14 07:16:00');
/*!40000 ALTER TABLE `info_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_photo`
--

DROP TABLE IF EXISTS `info_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_photo` (
  `id` varchar(128) NOT NULL,
  `ext` varchar(256) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_photo`
--

LOCK TABLES `info_photo` WRITE;
/*!40000 ALTER TABLE `info_photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_publish`
--

DROP TABLE IF EXISTS `info_publish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_publish` (
  `id` int(8) unsigned NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `pay` int(8) DEFAULT NULL COMMENT '招聘专用字段',
  `content` text COLLATE utf8_bin NOT NULL,
  `company` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '招聘专用字段',
  `region` int(32) NOT NULL,
  `address` varchar(40) COLLATE utf8_bin NOT NULL,
  `phone` varchar(45) COLLATE utf8_bin NOT NULL,
  `category` int(11) NOT NULL,
  `contract` varchar(256) CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(3) unsigned zerofill NOT NULL DEFAULT '000',
  `uid` int(11) NOT NULL,
  `photo` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `map_type` tinyint(4) DEFAULT '0',
  `ip` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_publish`
--

LOCK TABLES `info_publish` WRITE;
/*!40000 ALTER TABLE `info_publish` DISABLE KEYS */;
INSERT INTO `info_publish` VALUES (11,'adfadfadf',123,'ffff','adfadf',3,'dfdafd','adf',24,'admin','2014-08-29 10:14:09',000,2,'54005270df654.jpg,54005270e9a60.jpg,54005270f2ba7.jpg',NULL,NULL,0,NULL),(12,'123123',1232,'                        123','aaa',2,'bbb','12388888888888',24,'sss','2014-08-29 12:18:01',000,2,'54006f791316f.jpg',NULL,NULL,0,NULL),(13,'1111',0,'asdf','fff',19,'gfgfdg','dfg',24,'fdgdfg','2014-08-29 12:48:30',000,0,NULL,NULL,NULL,0,NULL),(14,'1111',0,'asdf','fff',19,'gfgfdg','1234124124',24,'fdgdfg','2014-08-29 12:48:52',000,0,NULL,NULL,NULL,0,NULL),(15,'fff',123,'af','ffff',5,'gfgdfg','18011412049',24,'fdgdfg','2014-08-29 13:11:57',000,0,NULL,NULL,NULL,0,NULL),(16,'fff',123,'af','ffff',5,'gfgdfg','18011412049',24,'fdgdfg','2014-08-29 13:23:09',000,0,NULL,NULL,NULL,0,NULL),(17,'fff',123,'af','ffff',5,'gfgdfg','18011412049',24,'fdgdfg','2014-08-29 13:23:30',000,0,NULL,NULL,NULL,0,NULL),(18,'fff',123,'af','ffff',5,'gfgdfg','18011412049',24,'fdgdfg','2014-09-04 10:17:42',001,41,NULL,NULL,NULL,0,NULL),(19,'fff',NULL,'af','ffff',5,'gfgdfg','18011412049',24,'fdgdfg','2014-09-04 11:03:49',001,41,NULL,NULL,NULL,0,NULL),(20,'abccccccccccc',0,'是打发地方地方fsdfffff','weiruan',3,'tiananmen road','13823432434',12,'billagtesadsfadfdsf','2014-09-11 10:33:21',000,41,NULL,NULL,NULL,0,NULL),(21,'sdkjfl',12312,'sdfadsf','ffffff',1,'123123','12388888888888',24,'1111','2014-09-04 08:54:30',000,41,NULL,NULL,NULL,0,NULL),(22,'6666',6,'kjlj','kkkk',1,'656865','18011412049',24,'7567','2014-09-04 08:54:16',000,41,NULL,NULL,NULL,0,NULL),(23,'PHP memcache扩展连接MOA服务的问题',0,'213123','',1,'南营房头条, 朝阳区, 北京市','13823432434',24,'gfdgfg','2014-09-12 06:25:07',000,41,NULL,0,0,0,NULL),(24,'gfg',0,'fdgdfg','',2,'光华路, 朝阳区, 北京市','324324',27,'34324','2014-09-01 14:06:59',000,41,NULL,39.9198,116.444,0,NULL),(25,'1412412',0,'12412441','',2,'个梵蒂冈的风格','235235',6,'324','2014-09-11 14:06:35',000,41,NULL,0,0,0,'127.0.0.1'),(0,'jiudian2',0,'123123','',2,'333','4444444',7,'3333','2014-09-20 12:16:19',000,41,NULL,0,0,0,'127.0.0.1');
/*!40000 ALTER TABLE `info_publish` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_region`
--

DROP TABLE IF EXISTS `info_region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_region`
--

LOCK TABLES `info_region` WRITE;
/*!40000 ALTER TABLE `info_region` DISABLE KEYS */;
INSERT INTO `info_region` VALUES (1,'acoruña'),(2,'Alava'),(3,'Albacete'),(4,'Alicante'),(5,'Almería'),(6,'asturias'),(7,'avila'),(8,'badajoz'),(9,'Barcelona'),(10,'Bilbao'),(11,'burgos'),(12,'Cádiz'),(13,'CANTABRIA'),(14,'caseres'),(15,'Castellón'),(16,'CEUTA'),(17,'CiudadReal'),(18,'Córdoba'),(19,'Cuenca'),(20,'FUENLANBRADA'),(21,'GIRONA'),(22,'Granada'),(23,'Guadalajara'),(24,'Guipúzcoa'),(25,'Huelva'),(26,'Huesca'),(27,'ISLASBALEARES'),(28,'Jaén'),(29,'LARIOJA'),(30,'Lanzarote'),(31,'LasPalmas'),(32,'leon'),(33,'Lleida'),(34,'LOGROЙO'),(35,'Madrid'),(36,'Málaga'),(37,'Mallorca'),(38,'MURCIA'),(39,'NAVARRA'),(40,'orense'),(41,'oviedo'),(42,'palencia'),(43,'pamplona'),(44,'salamanca'),(45,'sansebastian'),(46,'santader'),(47,'segovia'),(48,'Sevilla'),(49,'Soria'),(50,'TARRAGONA'),(51,'Tenerife'),(52,'Teruel'),(53,'Toledo'),(54,'Valencia'),(55,'valladolid'),(56,'VIZCAYA'),(57,'zamora'),(58,'Zaragoza'),(59,'北部'),(60,'海边'),(61,'海岛'),(62,'南部'),(63,'全国');
/*!40000 ALTER TABLE `info_region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_user`
--

DROP TABLE IF EXISTS `info_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_user` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(30) COLLATE utf8_bin NOT NULL,
  `permission` int(2) NOT NULL DEFAULT '0',
  `jifen` int(4) NOT NULL DEFAULT '10',
  `signtime` date DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_user`
--

LOCK TABLES `info_user` WRITE;
/*!40000 ALTER TABLE `info_user` DISABLE KEYS */;
INSERT INTO `info_user` VALUES (2,'admin','admin',1,891,'2014-09-13','2014-09-13 02:41:12'),(3,'user1','123',0,10,'0000-00-00','2013-08-20 15:48:17'),(4,'asd','asd',1,1,'2013-08-26','2013-08-25 17:44:25'),(6,'admin1','1234',1,8,'2013-08-26','2013-08-25 18:17:03'),(7,'user','user',0,100,NULL,'2013-08-26 00:21:36'),(8,'qyqx','111',1,10,NULL,'2013-08-26 15:53:18'),(9,'xx','xx',2,-1,'2013-08-27','2013-08-26 16:13:28'),(10,'zz','zz',2,8,'2013-08-27','2013-08-26 16:25:34'),(11,'i5280you','shenkaihua',2,11,'2013-09-05','2013-09-05 05:18:05'),(12,'you5280i','shenkaihua',1,10,NULL,'2013-09-05 05:19:12'),(13,'13611846120','562119987@qq.com',2,6,NULL,'2013-09-05 08:20:15'),(14,'123','123',2,8,'2013-11-16','2013-11-16 04:05:11'),(15,'ll','ll',2,10,'2013-12-23','2013-12-23 09:45:24'),(16,'fyh123','fyh123',2,10,'2014-03-21','2014-03-21 07:45:23'),(17,'qazwsx','111111',1,9,NULL,'2014-04-26 05:55:19'),(18,'123456','123456',2,7,'2014-04-26','2014-04-26 07:25:50'),(19,'testtest','testtest',2,11,'2014-04-26','2014-04-26 12:46:51'),(20,'qq123','123',2,10,NULL,'2014-04-27 08:19:09'),(21,'mmckasuo','123456',2,8,NULL,'2014-04-27 13:00:53'),(22,'ccuu','ccuu,123',1,10,NULL,'2014-04-28 12:43:06'),(23,'myiszgm','19870406',2,10,NULL,'2014-04-29 09:25:21'),(24,'slhaohao','3319652',2,9,'2014-04-30','2014-04-30 05:39:44'),(25,'des0718','admin123',1,7,NULL,'2014-04-30 19:09:36'),(26,'125555','125555',1,10,NULL,'2014-05-01 07:51:52'),(27,'xuelong','6641197',2,8,NULL,'2014-05-02 13:46:07'),(28,'23456','23456',1,9,NULL,'2014-05-03 08:51:20'),(29,'yanpjie','yanpjie',2,8,'2014-05-04','2014-05-04 09:08:37'),(30,'hxxy2003','123456',1,10,NULL,'2014-05-05 03:20:50'),(31,'love94me','love94me',1,9,NULL,'2014-05-06 21:01:56'),(32,'test','111',1,10,NULL,'2014-05-07 08:36:19'),(33,'下雨啦','yinhao',2,10,NULL,'2014-05-09 12:45:47'),(34,'phpstar','2009w46',2,-1,'2014-05-11','2014-05-10 18:51:20'),(35,'gogo333','147258',2,-1,'2014-05-11','2014-05-11 00:48:29'),(36,'test0303','test',1,1,NULL,'2014-05-11 05:37:50'),(37,'nanqing','nanqing',1,8,NULL,'2014-05-11 04:27:21'),(38,'tangchuanyang','tang1112',2,9,NULL,'2014-05-12 07:55:29'),(39,'demo','08565658733',2,10,'2014-05-13','2014-05-12 16:24:28'),(40,'ceshi','ceshi',2,0,'2014-08-29','2014-08-29 13:24:38'),(41,'abc','ac',0,0,'2014-09-20','2014-09-20 12:16:19'),(42,'abcc','ac',0,10,NULL,'2014-09-01 03:37:10');
/*!40000 ALTER TABLE `info_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_zding`
--

DROP TABLE IF EXISTS `info_zding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_zding` (
  `id` int(11) NOT NULL,
  `zding_begin` timestamp NULL DEFAULT NULL,
  `zding_end` timestamp NULL DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_zding`
--

LOCK TABLES `info_zding` WRITE;
/*!40000 ALTER TABLE `info_zding` DISABLE KEYS */;
INSERT INTO `info_zding` VALUES (23,'2014-09-20 15:52:07','2014-09-21 15:52:07',-1),(24,'2014-09-21 06:42:57','2014-09-22 06:42:57',1),(25,'2014-09-20 12:09:56','2014-09-21 12:09:56',2);
/*!40000 ALTER TABLE `info_zding` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-21 15:28:04
