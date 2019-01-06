-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: laravel-shop
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.18.04.1

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
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'首页','fa-bar-chart','/',NULL,'2018-12-26 10:39:36'),(2,0,6,'系统管理','fa-tasks',NULL,NULL,'2019-01-03 22:31:53'),(3,2,7,'管理员','fa-users','auth/users',NULL,'2019-01-03 22:31:53'),(4,2,8,'角色','fa-user','auth/roles',NULL,'2019-01-03 22:31:53'),(5,2,9,'权限','fa-ban','auth/permissions',NULL,'2019-01-03 22:31:53'),(6,2,10,'菜单','fa-bars','auth/menu',NULL,'2019-01-03 22:31:53'),(7,2,11,'操作日志','fa-history','auth/logs',NULL,'2019-01-03 22:31:53'),(8,0,2,'用户管理','fa-user','/users','2018-12-26 11:27:32','2018-12-26 11:28:17'),(9,0,3,'商品管理','fa-cubes','/products','2018-12-26 15:26:37','2018-12-26 15:27:00'),(10,0,4,'订单管理','fa-rmb','/orders','2019-01-02 16:22:55','2019-01-02 16:23:09'),(11,0,5,'优惠券管理','fa-tags','/coupon_codes','2019-01-03 22:30:20','2019-01-03 22:31:53');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL),(6,'用户管理','users','','/users*','2018-12-26 11:46:04','2018-12-26 11:46:04'),(7,'商品管理','products','','/products*','2019-01-06 17:18:37','2019-01-06 17:18:37'),(8,'订单管理','orders','','/orders*','2019-01-06 17:19:23','2019-01-06 17:19:23'),(9,'优惠券管理','coupon_codes','','/coupon_codes*','2019-01-06 17:20:02','2019-01-06 17:20:02');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL),(2,3,NULL,NULL),(2,4,NULL,NULL),(2,6,NULL,NULL),(2,7,NULL,NULL),(2,8,NULL,NULL),(2,9,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2018-12-26 10:10:36','2018-12-26 10:10:36'),(2,'运营','operator','2018-12-26 11:53:44','2018-12-26 11:53:44');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$R5aZLd2Yg.i28LDMjoryp.oFjUFJ9gwV779iWxmE8cmoa2q4ntUOm','Administrator',NULL,'M982WC9GqB00XxjmgNUUc9lkA7Se26LBA5SIHjm2BpA2Xc1ADoaNukBeusAN','2018-12-26 10:10:36','2018-12-26 10:10:36'),(2,'operator','$2y$10$Ljl8KVYA7mYeT/8sSVslJuF2M2F07S.2az.hZ0hgTHVpeOEGPRpym','运营',NULL,'woOCKyT1g9cgnS2sxCk1WZpruVeBy3favOwpi1GoGDbnQpC6miTxxx2sI8IJ','2018-12-26 11:55:43','2018-12-26 11:55:43');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-06 11:52:09
