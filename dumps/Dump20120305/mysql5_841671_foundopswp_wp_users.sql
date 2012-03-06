CREATE DATABASE  IF NOT EXISTS `mysql5_841671_foundopswp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mysql5_841671_foundopswp`;
-- MySQL dump 10.13  Distrib 5.5.15, for Win32 (x86)
--
-- Host: mysql501.discountasp.net    Database: mysql5_841671_foundopswp
-- ------------------------------------------------------
-- Server version	5.1.50-community

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
-- Table structure for table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_users`
--

LOCK TABLES `wp_users` WRITE;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;
INSERT INTO `wp_users` VALUES (1,'foundops','$P$BnvkAUQYHzKtBs2A4sghCRFmRlESQr.','foundops','marketing@foundops.com','http://www.foundops.com','2011-09-06 18:19:04','',0,'FoundOPS'),(2,'apohl','$P$BmlmauMbXtML.RcwL1DXAOnr8IxH560','apohl','apohl@foundops.com','http://www.foundops.com/apohl','2011-09-14 21:15:30','',0,'Andrew'),(3,'jperl','$P$BbJ6pas/JwVhLzYiS1AMtJNfDr9opw1','jperl','jperl@foundops.com','http://www.foundops.com/jperl','2011-09-14 21:16:33','',0,'Jon'),(4,'oshatken','$P$BkLYJ4x9rtChTCverM9OwS0CpIxdaV.','oshatken','oshatken@foundops.com','http://www.foundops.com/oshatken','2011-09-14 21:17:30','',0,'Oren'),(5,'zbright','$P$BtdYAIqGR.rBWTeO8pv1c2ajTKsX4O/','zbright','zbright@foundops.com','http://www.foundops.com/zbright','2011-09-14 21:18:25','',0,'Zach'),(6,'cmcpherson','$P$Bly0em1sv/QnalZYuLk5tmW/n95H6q0','cmcpherson','cmcpherson@foundops.com','http://www.foundops.com/cmcpherson','2011-11-02 14:00:33','',0,'Caitlin'),(7,'jmahoney','$P$BkxOKet6eOpdmk2e.DrGYUAy7K0glr1','jmahoney','jmahoney@foundops.com','http://www.foundops.com/jmahoney','2012-02-24 06:25:53','',0,'John'),(8,'pbrown','$P$B5cM4fneoCni1YjBFk6my/AURmgJUV0','pbrown','pbrown@foundops.com','http://www.foundops.com/pbrown','2012-02-24 06:29:26','',0,'Patrick');
/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-03-05 15:51:54
