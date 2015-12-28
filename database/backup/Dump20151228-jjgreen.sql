-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: jjgreen
-- ------------------------------------------------------
-- Server version	5.6.25

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
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `productName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(11) NOT NULL,
  `userCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `status` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'BK',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `checkin_at` datetime DEFAULT NULL,
  `sale_at` datetime DEFAULT NULL,
  `payment` int(11) DEFAULT '0',
  `picture` text COLLATE utf8_unicode_ci,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,'20151222-0956022','snooker',2,'20151209165325',3,450,'BK','2015-12-22 09:56:02','2015-12-22 09:56:02',NULL,'2015-12-26 00:00:00',0,NULL,NULL),(2,'20151222-1523582','aaaa',2,'20151209165325',3,450,'CN','2015-12-22 15:23:58','2015-12-23 19:55:58','2015-12-23 19:55:58','2015-12-26 00:00:00',0,NULL,NULL),(3,'20151224-1220562','111',2,'20151209165325',2,300,'BK','2015-12-24 12:20:56','2015-12-24 12:20:56',NULL,'2015-12-26 00:00:00',0,NULL,NULL),(4,'20151224-2045522','aaa',2,'20151209165325',2,300,'BK','2015-12-24 20:45:52','2015-12-24 20:45:52',NULL,'2015-12-26 00:00:00',0,NULL,NULL),(5,'20151224-2046182','aaa',2,'20151209165325',3,450,'BK','2015-12-24 20:46:18','2015-12-24 20:46:18',NULL,'2015-12-26 00:00:00',0,NULL,NULL),(6,'20151224-2047082','aaaa',2,'20151209165325',3,450,'BK','2015-12-24 20:47:08','2015-12-24 20:47:08',NULL,'2015-12-26 00:00:00',0,NULL,NULL),(7,'20151224-2047332','aaa',2,'20151209165325',3,600,'BK','2015-12-24 20:47:33','2015-12-24 20:47:33',NULL,'2015-12-26 00:00:00',0,NULL,NULL),(8,'20151224-2048052','aaaa',2,'20151209165325',3,450,'BK','2015-12-24 20:48:05','2015-12-24 20:48:05',NULL,'2015-12-26 00:00:00',0,NULL,NULL),(9,'20151224-2053012','aaa',2,'20151209165325',2,400,'BK','2015-12-24 20:53:01','2015-12-24 20:53:01',NULL,'2015-12-26 00:00:00',0,NULL,'2'),(10,'20151224-2056012','aaa',2,'20151209165325',2,300,'BK','2015-12-24 20:56:01','2015-12-24 20:56:01',NULL,'2015-12-26 00:00:00',0,NULL,'2'),(11,'20151225-1318072','zaaa',2,'20151209165325',3,450,'BK','2015-12-25 13:18:07','2015-12-25 13:18:07',NULL,'2015-12-26 00:00:00',0,NULL,'1'),(12,'20151225-1711572','aaaa',2,'20151209165325',3,600,'BK','2015-12-25 17:11:57','2015-12-25 17:11:57',NULL,'2015-12-26 00:00:00',0,NULL,'1');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookingDetail`
--

DROP TABLE IF EXISTS `bookingDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookingDetail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `checkin_at` datetime DEFAULT NULL,
  `bookingID` int(11) NOT NULL,
  `bookingCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zoneID` int(11) NOT NULL,
  `zoneCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zoneNumber` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'BK',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `sale_at` datetime NOT NULL,
  PRIMARY KEY (`id`,`zoneNumber`,`sale_at`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookingDetail`
--

LOCK TABLES `bookingDetail` WRITE;
/*!40000 ALTER TABLE `bookingDetail` DISABLE KEYS */;
INSERT INTO `bookingDetail` VALUES (1,'20151222-095602-2-1','2015-12-23 19:44:56',1,'20151222-0956022',1,'D','D-15',150,'BK','2015-12-22 09:56:02','2015-12-23 19:44:56','2015-12-26 00:00:00'),(2,'20151222-095602-2-2',NULL,1,'20151222-0956022',1,'D','D-14',150,'BK','2015-12-22 09:56:02','2015-12-22 09:56:02','2015-12-26 00:00:00'),(3,'20151222-095602-2-3',NULL,1,'20151222-0956022',1,'D','D-13',150,'BK','2015-12-22 09:56:02','2015-12-22 09:56:02','2015-12-26 00:00:00'),(4,'20151222-152358-2-1','2015-12-23 19:55:58',2,'20151222-1523582',1,'D','D-3',150,'CN','2015-12-22 15:23:58','2015-12-23 19:55:58','2015-12-26 00:00:00'),(5,'20151222-152358-2-2','2015-12-23 19:55:58',2,'20151222-1523582',1,'D','D-4',150,'CN','2015-12-22 15:23:58','2015-12-23 19:55:58','2015-12-26 00:00:00'),(6,'20151222-152358-2-3','2015-12-23 19:55:58',2,'20151222-1523582',1,'D','D-5',150,'CN','2015-12-22 15:23:58','2015-12-23 19:55:58','2015-12-26 00:00:00'),(7,'20151224-122056-2-1',NULL,3,'20151224-1220562',1,'D','D-10',150,'BK','2015-12-24 12:20:56','2015-12-24 12:20:56','2015-12-26 00:00:00'),(8,'20151224-122056-2-2',NULL,3,'20151224-1220562',1,'D','D-11',150,'BK','2015-12-24 12:20:56','2015-12-24 12:20:56','2015-12-26 00:00:00'),(9,'20151224-204552-2-1',NULL,4,'20151224-2045522',1,'D','D-32',150,'BK','2015-12-24 20:45:52','2015-12-24 20:45:52','2015-12-26 00:00:00'),(10,'20151224-204552-2-2',NULL,4,'20151224-2045522',1,'D','D-31',150,'BK','2015-12-24 20:45:52','2015-12-24 20:45:52','2015-12-26 00:00:00'),(11,'20151224-204618-2-1',NULL,5,'20151224-2046182',1,'D','D-22',150,'BK','2015-12-24 20:46:18','2015-12-24 20:46:18','2015-12-26 00:00:00'),(12,'20151224-204618-2-2',NULL,5,'20151224-2046182',1,'D','D-21',150,'BK','2015-12-24 20:46:18','2015-12-24 20:46:18','2015-12-26 00:00:00'),(13,'20151224-204618-2-3',NULL,5,'20151224-2046182',1,'D','D-20',150,'BK','2015-12-24 20:46:18','2015-12-24 20:46:18','2015-12-26 00:00:00'),(14,'20151224-204708-2-1',NULL,6,'20151224-2047082',1,'D','D-28',150,'BK','2015-12-24 20:47:08','2015-12-24 20:47:08','2015-12-26 00:00:00'),(15,'20151224-204708-2-2',NULL,6,'20151224-2047082',1,'D','D-27',150,'BK','2015-12-24 20:47:08','2015-12-24 20:47:08','2015-12-26 00:00:00'),(16,'20151224-204708-2-3',NULL,6,'20151224-2047082',1,'D','D-26',150,'BK','2015-12-24 20:47:08','2015-12-24 20:47:08','2015-12-26 00:00:00'),(17,'20151224-204733-2-1',NULL,7,'20151224-2047332',4,'A','A-33',200,'BK','2015-12-24 20:47:33','2015-12-24 20:47:33','2015-12-26 00:00:00'),(18,'20151224-204733-2-2',NULL,7,'20151224-2047332',4,'A','A-32',200,'BK','2015-12-24 20:47:33','2015-12-24 20:47:33','2015-12-26 00:00:00'),(19,'20151224-204733-2-3',NULL,7,'20151224-2047332',4,'A','A-31',200,'BK','2015-12-24 20:47:33','2015-12-24 20:47:33','2015-12-26 00:00:00'),(20,'20151224-204805-2-1',NULL,8,'20151224-2048052',2,'E','E-10',150,'BK','2015-12-24 20:48:05','2015-12-24 20:48:05','2015-12-26 00:00:00'),(21,'20151224-204805-2-2',NULL,8,'20151224-2048052',2,'E','E-9',150,'BK','2015-12-24 20:48:05','2015-12-24 20:48:05','2015-12-26 00:00:00'),(22,'20151224-204805-2-3',NULL,8,'20151224-2048052',2,'E','E-8',150,'BK','2015-12-24 20:48:05','2015-12-24 20:48:05','2015-12-26 00:00:00'),(23,'20151224-205301-2-1',NULL,9,'20151224-2053012',4,'A','A-6',200,'BK','2015-12-24 20:53:01','2015-12-24 20:53:01','2015-12-26 00:00:00'),(24,'20151224-205301-2-2',NULL,9,'20151224-2053012',4,'A','A-7',200,'BK','2015-12-24 20:53:01','2015-12-24 20:53:01','2015-12-26 00:00:00'),(25,'20151224-205601-2-1',NULL,10,'20151224-2056012',2,'E','E-11',150,'BK','2015-12-24 20:56:01','2015-12-24 20:56:01','2015-12-26 00:00:00'),(26,'20151224-205601-2-2',NULL,10,'20151224-2056012',2,'E','E-22',150,'BK','2015-12-24 20:56:01','2015-12-24 20:56:01','2015-12-26 00:00:00'),(27,'20151225-131807-2-1',NULL,11,'20151225-1318072',2,'E','E-33',150,'BK','2015-12-25 13:18:07','2015-12-25 13:18:07','2015-12-26 00:00:00'),(28,'20151225-131807-2-2',NULL,11,'20151225-1318072',2,'E','E-32',150,'BK','2015-12-25 13:18:07','2015-12-25 13:18:07','2015-12-26 00:00:00'),(29,'20151225-131807-2-3',NULL,11,'20151225-1318072',2,'E','E-31',150,'BK','2015-12-25 13:18:07','2015-12-25 13:18:07','2015-12-26 00:00:00'),(30,'20151225-171157-2-1',NULL,12,'20151225-1711572',4,'A','A-29',200,'BK','2015-12-25 17:11:57','2015-12-25 17:11:57','2015-12-26 00:00:00'),(31,'20151225-171157-2-2',NULL,12,'20151225-1711572',4,'A','A-28',200,'BK','2015-12-25 17:11:57','2015-12-25 17:11:57','2015-12-26 00:00:00'),(32,'20151225-171157-2-3',NULL,12,'20151225-1711572',4,'A','A-27',200,'BK','2015-12-25 17:11:57','2015-12-25 17:11:57','2015-12-26 00:00:00');
/*!40000 ALTER TABLE `bookingDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zoneID` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maxLock` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `availableLock` int(11) NOT NULL,
  `price_type1` int(11) NOT NULL,
  `price_type2` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `opened_at` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES (1,1,'D','ของเก่าอะไหล่รถยนต์',34,2,34,200,150,1,'2015-12-26','2015-12-11 17:15:24','2015-12-11 17:15:24'),(2,2,'E','ของเก่าอะไหล่รถยนต์',34,2,34,200,150,1,'2015-12-26','2015-12-11 17:15:24','2015-12-11 17:15:24'),(3,3,'I','ของเก่าอะไหล่รถยนต์',34,2,34,200,150,1,'2015-12-26','2015-12-11 17:15:24','2015-12-11 17:15:24'),(4,4,'A','สินค้าแฟชั่น',34,2,34,250,200,1,'2015-12-26','2015-12-11 17:15:24','2015-12-11 17:15:24');
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2015_12_09_021544_create_user_table',1),('2015_12_09_021606_create_password_reset_table',1),('2015_12_09_091756_create_zone_table',1),('2015_12_09_100553_create_calendar_table',2),('2015_12_09_102230_create_booking_table',3),('2015_12_09_102240_create_booking_detail_table',3),('2015_12_10_065818_alter_user_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cardID` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `favorite` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isAdmin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'20151209165324','Snooker Koleng','ker.koleng@hotmail.co.th','$2y$10$fLhe5Y1XcSPT5exlQJeA7.tfTBzRlwRUDhOLhvKxZZIxK6tC6.MUq','Jirayut','Khantavee',1,'427 หมู่7 ศาลาธรรมสพน์ ทวีวัฒนา กรุงเทพฯ 10170','0874652849','1350100240034',99,NULL,NULL,'rpwSxi3iK1yLZuw4Um79YuO6yxymzFbp65SdYcZl0NIf72lHRCq8W2yQA9Fy','2015-12-09 09:53:24','2015-12-11 06:01:39',1),(2,'20151209165325','Snooker Koleng','ker13530018@gmail.com','$2y$10$fLhe5Y1XcSPT5exlQJeA7.tfTBzRlwRUDhOLhvKxZZIxK6tC6.MUq','Jirayut','Khantavee',1,'427 หมู่7 ศาลาธรรมสพน์ ทวีวัฒนา กรุงเทพฯ 10170','0874652849','1350100240035',2,NULL,NULL,'CSiUZvJQ8gA6BdcHtuCzfbbtABUEDmhRO0bJuXkILhsh4ql0kwcdUmWK7qbA','2015-12-13 09:53:24','2015-12-25 10:42:11',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maxLock` int(11) NOT NULL,
  `row` int(11) NOT NULL DEFAULT '4',
  `availableLock` int(11) NOT NULL,
  `price_type1` int(11) NOT NULL,
  `price_type2` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zone`
--

LOCK TABLES `zone` WRITE;
/*!40000 ALTER TABLE `zone` DISABLE KEYS */;
INSERT INTO `zone` VALUES (1,'D','ของเก่าอะไหล่รถยนต์',34,2,34,200,150,1,'2015-12-10 14:01:54','2015-12-10 14:02:29'),(2,'E','ของเก่าอะไหล่รถยนต์',34,2,34,200,150,1,'2015-12-10 14:01:54','2015-12-10 14:02:29'),(3,'I','ของเก่าอะไหล่รถยนต์',34,2,34,200,150,1,'2015-12-10 14:01:54','2015-12-10 14:02:29'),(4,'A','สินค้าแฟชั่น',34,2,34,250,200,1,'2015-12-10 14:01:54','2015-12-10 14:02:29'),(5,'B','สินค้าแฟชั่น',34,2,34,250,200,1,'2015-12-10 14:01:54','2015-12-10 14:02:29'),(6,'C','สินค้าแฟชั่น',34,2,34,250,200,1,'2015-12-10 14:01:54','2015-12-10 14:02:29'),(7,'F','สินค้า Handmake',34,2,34,250,200,1,'2015-12-10 14:01:54','2015-12-10 14:02:29'),(8,'H','สินค้า Handmake',34,2,34,250,200,1,'2015-12-10 14:01:54','2015-12-10 14:02:29'),(9,'G','อาหารและเครื่องดื่ม',34,2,34,300,250,1,'2015-12-10 14:01:54','2015-12-10 14:02:29'),(10,'ALL','วันพฤหัสทุกโซน',34,2,34,50,50,0,'2015-12-10 14:01:54','2015-12-10 14:02:29');
/*!40000 ALTER TABLE `zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'jjgreen'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-28 22:13:12
