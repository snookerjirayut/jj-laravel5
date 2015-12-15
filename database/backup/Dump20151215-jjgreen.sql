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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookingDetail`
--

LOCK TABLES `bookingDetail` WRITE;
/*!40000 ALTER TABLE `bookingDetail` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES (1,1,'D','ของเก่าอะไหล่รถยนต์',34,2,34,200,150,1,'2015-12-12','2015-12-11 17:15:24','2015-12-11 17:15:24'),(2,2,'E','ของเก่าอะไหล่รถยนต์',34,2,34,200,150,1,'2015-12-12','2015-12-11 17:15:24','2015-12-11 17:15:24'),(3,3,'I','ของเก่าอะไหล่รถยนต์',34,2,34,200,150,1,'2015-12-12','2015-12-11 17:15:24','2015-12-11 17:15:24'),(4,4,'A','สินค้าแฟชั่น',34,2,34,250,200,1,'2015-12-12','2015-12-11 17:15:24','2015-12-11 17:15:24');
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
INSERT INTO `users` VALUES (1,'20151209165324','Snooker Koleng','ker.koleng@hotmail.co.th','$2y$10$fLhe5Y1XcSPT5exlQJeA7.tfTBzRlwRUDhOLhvKxZZIxK6tC6.MUq','Jirayut','Khantavee',1,NULL,'0874652849','1350100240034',99,NULL,NULL,'rpwSxi3iK1yLZuw4Um79YuO6yxymzFbp65SdYcZl0NIf72lHRCq8W2yQA9Fy','2015-12-09 09:53:24','2015-12-11 06:01:39',1),(2,'20151209165325','Snooker Koleng','ker13530018@gmail.com','$2y$10$fLhe5Y1XcSPT5exlQJeA7.tfTBzRlwRUDhOLhvKxZZIxK6tC6.MUq','Jirayut','Khantavee',1,'427 หมู่7 ศาลาธรรมสพน์ ทวีวัฒนา กรุงเทพฯ 10170','0874652849','1350100240035',2,NULL,NULL,NULL,'2015-12-13 09:53:24','2015-12-13 06:01:39',0);
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

-- Dump completed on 2015-12-15 13:51:51
