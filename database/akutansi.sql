-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: akutansi
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `overtime_hours` int(11) NOT NULL DEFAULT 0,
  `check_in_time` varchar(255) NOT NULL DEFAULT '08:00',
  `check_out_time` varchar(255) NOT NULL DEFAULT '17:00',
  `image_path` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendances_employee_id_date_unique` (`employee_id`,`date`),
  CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (1,1,'2026-09-01','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(2,1,'2026-09-02','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(3,1,'2026-09-03','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(4,1,'2026-09-04','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(5,1,'2026-09-05','present','2026-08-13 10:06:39','2026-08-13 10:06:39',2,'08:00','19:00',NULL,NULL,NULL),(6,1,'2026-09-06','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(7,1,'2026-09-07','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(8,1,'2026-09-08','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(9,1,'2026-09-09','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(10,1,'2026-09-10','present','2026-08-13 10:06:39','2026-08-13 10:06:39',2,'08:00','19:00',NULL,NULL,NULL),(11,1,'2026-09-11','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(12,1,'2026-09-12','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(13,1,'2026-09-13','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(14,1,'2026-09-14','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(15,1,'2026-09-15','present','2026-08-13 10:06:39','2026-08-13 10:06:39',2,'08:00','19:00',NULL,NULL,NULL),(16,1,'2026-09-16','absent','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'','',NULL,NULL,NULL),(17,1,'2026-09-17','absent','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'','',NULL,NULL,NULL),(18,1,'2026-09-18','absent','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'','',NULL,NULL,NULL),(19,2,'2026-09-01','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(20,2,'2026-09-02','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(21,2,'2026-09-03','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(22,2,'2026-09-04','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(23,2,'2026-09-05','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(24,2,'2026-09-06','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(25,2,'2026-09-07','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(26,2,'2026-09-08','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(27,2,'2026-09-09','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(28,2,'2026-09-10','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(29,2,'2026-09-11','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(30,2,'2026-09-12','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(31,2,'2026-09-13','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(32,2,'2026-09-14','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(33,2,'2026-09-15','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(34,2,'2026-09-16','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(35,2,'2026-09-17','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(36,2,'2026-09-18','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(37,3,'2026-09-01','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(38,3,'2026-09-02','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(39,3,'2026-09-03','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(40,3,'2026-09-04','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(41,3,'2026-09-05','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(42,3,'2026-09-06','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(43,3,'2026-09-07','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(44,3,'2026-09-08','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(45,3,'2026-09-09','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(46,3,'2026-09-10','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(47,3,'2026-09-11','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(48,3,'2026-09-12','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(49,3,'2026-09-13','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(50,3,'2026-09-14','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(51,3,'2026-09-15','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(52,3,'2026-09-16','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(53,3,'2026-09-17','absent','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'','',NULL,NULL,NULL),(54,3,'2026-09-18','absent','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'','',NULL,NULL,NULL),(55,4,'2026-09-01','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(56,4,'2026-09-02','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(57,4,'2026-09-03','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(58,4,'2026-09-04','present','2026-08-13 10:06:39','2026-08-13 10:06:39',0,'08:00','17:00',NULL,NULL,NULL),(59,4,'2026-09-05','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(60,4,'2026-09-06','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(61,4,'2026-09-07','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(62,4,'2026-09-08','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(63,4,'2026-09-09','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(64,4,'2026-09-10','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(65,4,'2026-09-11','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(66,4,'2026-09-12','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(67,4,'2026-09-13','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(68,4,'2026-09-14','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(69,4,'2026-09-15','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(70,4,'2026-09-16','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(71,4,'2026-09-17','absent','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'','',NULL,NULL,NULL),(72,4,'2026-09-18','absent','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'','',NULL,NULL,NULL),(73,5,'2026-09-01','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(74,5,'2026-09-02','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(75,5,'2026-09-03','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(76,5,'2026-09-04','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(77,5,'2026-09-05','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(78,5,'2026-09-06','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(79,5,'2026-09-07','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(80,5,'2026-09-08','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(81,5,'2026-09-09','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(82,5,'2026-09-10','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(83,5,'2026-09-11','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(84,5,'2026-09-12','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(85,5,'2026-09-13','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(86,5,'2026-09-14','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(87,5,'2026-09-15','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(88,5,'2026-09-16','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(89,5,'2026-09-17','absent','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'','',NULL,NULL,NULL),(90,5,'2026-09-18','absent','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'','',NULL,NULL,NULL),(91,6,'2026-09-01','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(92,6,'2026-09-02','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(93,6,'2026-09-03','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(94,6,'2026-09-04','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(95,6,'2026-09-05','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(96,6,'2026-09-06','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(97,6,'2026-09-07','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(98,6,'2026-09-08','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(99,6,'2026-09-09','present','2026-08-13 10:06:40','2026-08-13 10:06:40',0,'08:00','17:00',NULL,NULL,NULL),(100,6,'2026-09-10','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(101,6,'2026-09-11','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(102,6,'2026-09-12','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(103,6,'2026-09-13','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(104,6,'2026-09-14','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(105,6,'2026-09-15','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(106,6,'2026-09-16','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(107,6,'2026-09-17','absent','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'','',NULL,NULL,NULL),(108,6,'2026-09-18','absent','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'','',NULL,NULL,NULL),(109,7,'2026-09-01','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(110,7,'2026-09-02','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(111,7,'2026-09-03','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(112,7,'2026-09-04','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(113,7,'2026-09-05','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(114,7,'2026-09-06','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(115,7,'2026-09-07','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(116,7,'2026-09-08','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(117,7,'2026-09-09','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(118,7,'2026-09-10','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(119,7,'2026-09-11','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(120,7,'2026-09-12','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(121,7,'2026-09-13','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(122,7,'2026-09-14','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(123,7,'2026-09-15','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(124,7,'2026-09-16','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(125,7,'2026-09-17','absent','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'','',NULL,NULL,NULL),(126,7,'2026-09-18','absent','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'','',NULL,NULL,NULL),(127,8,'2026-09-01','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(128,8,'2026-09-02','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(129,8,'2026-09-03','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(130,8,'2026-09-04','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(131,8,'2026-09-05','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(132,8,'2026-09-06','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(133,8,'2026-09-07','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(134,8,'2026-09-08','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(135,8,'2026-09-09','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(136,8,'2026-09-10','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(137,8,'2026-09-11','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(138,8,'2026-09-12','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(139,8,'2026-09-13','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(140,8,'2026-09-14','present','2026-08-13 10:06:41','2026-08-13 10:06:41',0,'08:00','17:00',NULL,NULL,NULL),(141,8,'2026-09-15','present','2026-08-13 10:06:42','2026-08-13 10:06:42',0,'08:00','17:00',NULL,NULL,NULL),(142,8,'2026-09-16','present','2026-08-13 10:06:42','2026-08-13 10:06:42',0,'08:00','17:00',NULL,NULL,NULL),(143,8,'2026-09-17','absent','2026-08-13 10:06:42','2026-08-13 10:06:42',0,'','',NULL,NULL,NULL),(144,8,'2026-09-18','absent','2026-08-13 10:06:42','2026-08-13 10:06:42',0,'','',NULL,NULL,NULL),(145,1,'2026-08-13','present','2026-08-13 10:15:49','2026-08-13 10:21:01',0,'17:15','17:21','uploads/attendance/1786616149_alur_konsinyasi_umkm.png','-6.943726957290473','107.72730350914635'),(146,1,'2026-08-14','present','2026-08-14 02:55:24','2026-08-14 02:55:24',0,'09:55','','uploads/attendance/1786676124_alur_konsinyasi_umkm.png','-6.93874','107.60724');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (1,1,'Login','Budi (Owner) logged into the system.','2026-08-13 10:07:12','2026-08-13 10:07:12'),(2,1,'Logout','Budi (Owner) logged out.','2026-08-13 10:07:34','2026-08-13 10:07:34'),(3,2,'Login','Siti (Finance Staff) logged into the system.','2026-08-13 10:07:43','2026-08-13 10:07:43'),(4,2,'Generate Payslips','Generated payslips for month 2026-08 with deduction rate Rp 100.000','2026-08-13 10:08:51','2026-08-13 10:08:51'),(5,2,'Pay Payslip','Paid salary to Fikri for month 2026-08 of Rp 6.600.000','2026-08-13 10:09:01','2026-08-13 10:09:01'),(6,2,'Logout','Siti (Finance Staff) logged out.','2026-08-13 10:10:59','2026-08-13 10:10:59'),(7,1,'Login','Budi (Owner) logged into the system.','2026-08-13 10:11:12','2026-08-13 10:11:12'),(8,1,'Logout','Budi (Owner) logged out.','2026-08-13 10:13:03','2026-08-13 10:13:03'),(9,2,'Login','Siti (Finance Staff) logged into the system.','2026-08-13 10:13:22','2026-08-13 10:13:22'),(10,2,'Logout','Siti (Finance Staff) logged out.','2026-08-13 10:14:21','2026-08-13 10:14:21'),(11,1,'Login','Budi (Owner) logged into the system.','2026-08-13 10:15:13','2026-08-13 10:15:13'),(12,1,'Logout','Budi (Owner) logged out.','2026-08-13 10:15:30','2026-08-13 10:15:30'),(13,3,'Login','Andi (Karyawan) logged into the system.','2026-08-13 10:15:37','2026-08-13 10:15:37'),(14,3,'Employee Check-in','Andi Karyawan checked in for work at 17:15','2026-08-13 10:15:49','2026-08-13 10:15:49'),(15,3,'Logout','Andi (Karyawan) logged out.','2026-08-13 10:16:44','2026-08-13 10:16:44'),(16,1,'Login','Budi (Owner) logged into the system.','2026-08-13 10:16:51','2026-08-13 10:16:51'),(17,1,'Logout','Budi (Owner) logged out.','2026-08-13 10:17:03','2026-08-13 10:17:03'),(18,2,'Login','Siti (Finance Staff) logged into the system.','2026-08-13 10:17:09','2026-08-13 10:17:09'),(19,2,'Logout','Siti (Finance Staff) logged out.','2026-08-13 10:17:23','2026-08-13 10:17:23'),(20,3,'Login','Andi (Karyawan) logged into the system.','2026-08-13 10:17:33','2026-08-13 10:17:33'),(21,3,'Employee Check-out','Andi Karyawan checked out from work at 17:21 (Overtime: -0.35046442555556 hours)','2026-08-13 10:21:01','2026-08-13 10:21:01'),(22,3,'Logout','Andi (Karyawan) logged out.','2026-08-13 10:23:19','2026-08-13 10:23:19'),(23,2,'Login','Siti (Finance Staff) logged into the system.','2026-08-13 10:23:27','2026-08-13 10:23:27'),(24,2,'Logout','Siti (Finance Staff) logged out.','2026-08-13 10:23:51','2026-08-13 10:23:51'),(25,1,'Login','Budi (Owner) logged into the system.','2026-08-13 10:23:58','2026-08-13 10:23:58'),(26,1,'Logout','Budi (Owner) logged out.','2026-08-13 10:26:18','2026-08-13 10:26:18'),(27,2,'Login','Siti (Finance Staff) logged into the system.','2026-08-13 10:26:27','2026-08-13 10:26:27'),(28,2,'Logout','Siti (Finance Staff) logged out.','2026-08-13 10:27:16','2026-08-13 10:27:16'),(29,2,'Login','Siti (Finance Staff) logged into the system.','2026-08-13 10:28:58','2026-08-13 10:28:58'),(30,2,'Create Employee','Created employee profile for Belvan (CEO)','2026-08-13 10:41:23','2026-08-13 10:41:23'),(31,2,'Logout','Siti (Finance Staff) logged out.','2026-08-13 10:44:34','2026-08-13 10:44:34'),(32,2,'Login','Siti (Finance Staff) logged into the system.','2026-08-13 10:46:02','2026-08-13 10:46:02'),(33,2,'Logout','Siti (Finance Staff) logged out.','2026-08-13 10:54:29','2026-08-13 10:54:29'),(34,1,'Login','Budi (Owner) logged into the system.','2026-08-13 10:54:40','2026-08-13 10:54:40'),(35,1,'Logout','Budi (Owner) logged out.','2026-08-13 10:59:10','2026-08-13 10:59:10'),(36,3,'Login','Andi (Karyawan) logged into the system.','2026-08-13 10:59:19','2026-08-13 10:59:19'),(37,3,'Logout','Andi (Karyawan) logged out.','2026-08-13 11:01:07','2026-08-13 11:01:07'),(38,2,'Login','Siti (Finance Staff) logged into the system.','2026-08-13 11:04:29','2026-08-13 11:04:29'),(39,2,'Purchase Request Created','Created request: makanan MBG for Rp 1.000.000.000','2026-08-13 11:05:51','2026-08-13 11:05:51'),(40,2,'Purchase Request Approved','Approved request \"makanan MBG\" by Siti (Finance Staff). Generated transaction ID: 5','2026-08-13 11:05:55','2026-08-13 11:05:55'),(41,2,'Login','Siti (Finance Staff) logged into the system.','2026-08-14 02:53:38','2026-08-14 02:53:38'),(42,2,'Logout','Siti (Finance Staff) logged out.','2026-08-14 02:54:56','2026-08-14 02:54:56'),(43,3,'Login','Andi (Karyawan) logged into the system.','2026-08-14 02:55:02','2026-08-14 02:55:02'),(44,3,'Employee Check-in','Andi Karyawan checked in for work at 09:55','2026-08-14 02:55:25','2026-08-14 02:55:25'),(45,2,'Login','Siti (Finance Staff) logged into the system.','2026-08-14 13:12:03','2026-08-14 13:12:03');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Penjualan Produk','income','2026-08-13 10:06:38','2026-08-13 10:06:38'),(2,'Pendapatan Jasa','income','2026-08-13 10:06:38','2026-08-13 10:06:38'),(3,'Suntikan Dana','income','2026-08-13 10:06:38','2026-08-13 10:06:38'),(4,'Biaya Operasional (Listrik/Internet)','expense','2026-08-13 10:06:38','2026-08-13 10:06:38'),(5,'Gaji Karyawan','expense','2026-08-13 10:06:38','2026-08-13 10:06:38'),(6,'Pembelian Aset','expense','2026-08-13 10:06:38','2026-08-13 10:06:38');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `base_salary` decimal(15,2) NOT NULL,
  `allowance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_user_id_foreign` (`user_id`),
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,3,'Andi Karyawan','Developer',8000000.00,1000000.00,'2026-08-13 10:06:38','2026-08-13 10:06:38'),(2,4,'Bambang Karyawan','UI/UX Designer',6000000.00,500000.00,'2026-08-13 10:06:38','2026-08-13 10:06:38'),(3,5,'Dzaki','Senior Developer',9500000.00,1200000.00,'2026-08-13 10:06:38','2026-08-13 10:06:38'),(4,6,'Afifah','Lead Designer',8500000.00,1000000.00,'2026-08-13 10:06:38','2026-08-13 10:06:38'),(5,7,'Raka','Content Writer',5500000.00,500000.00,'2026-08-13 10:06:38','2026-08-13 10:06:38'),(6,8,'Fikri','Marketing Specialist',6000000.00,600000.00,'2026-08-13 10:06:38','2026-08-13 10:06:38'),(7,9,'Satria','Customer Support',5000000.00,400000.00,'2026-08-13 10:06:38','2026-08-13 10:06:38'),(8,10,'Fajar','SEO Specialist',5800000.00,500000.00,'2026-08-13 10:06:38','2026-08-13 10:06:38'),(9,11,'Belvan','CEO',2000000000.00,1200000000.00,'2026-08-13 10:41:23','2026-08-13 10:41:23');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_08_13_000001_create_categories_table',1),(5,'2026_08_13_000002_create_transactions_table',1),(6,'2026_08_13_000003_create_employees_table',1),(7,'2026_08_13_000004_create_attendances_table',1),(8,'2026_08_13_000005_create_purchase_requests_table',1),(9,'2026_08_13_000006_create_payslips_table',1),(10,'2026_08_13_000007_create_audit_logs_table',1),(11,'2026_08_13_000008_add_role_to_users_table',1),(12,'2026_08_13_000009_add_overtime_to_tables',1),(13,'2026_08_13_000010_add_gps_and_photo_to_attendances_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payslips`
--

DROP TABLE IF EXISTS `payslips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payslips` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `month` varchar(255) NOT NULL,
  `base_salary` decimal(15,2) NOT NULL,
  `allowance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `deductions` decimal(15,2) NOT NULL DEFAULT 0.00,
  `net_salary` decimal(15,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `overtime_bonus` decimal(15,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payslips_employee_id_month_unique` (`employee_id`,`month`),
  CONSTRAINT `payslips_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payslips`
--

LOCK TABLES `payslips` WRITE;
/*!40000 ALTER TABLE `payslips` DISABLE KEYS */;
INSERT INTO `payslips` VALUES (1,6,'2026-08',6000000.00,600000.00,0.00,6600000.00,'paid','2026-08-13 10:08:51','2026-08-13 10:09:01',0.00);
/*!40000 ALTER TABLE `payslips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_requests`
--

DROP TABLE IF EXISTS `purchase_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `user_id` bigint(20) unsigned NOT NULL,
  `approved_by` bigint(20) unsigned DEFAULT NULL,
  `transaction_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_requests_user_id_foreign` (`user_id`),
  KEY `purchase_requests_approved_by_foreign` (`approved_by`),
  KEY `purchase_requests_transaction_id_foreign` (`transaction_id`),
  CONSTRAINT `purchase_requests_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `purchase_requests_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `purchase_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_requests`
--

LOCK TABLES `purchase_requests` WRITE;
/*!40000 ALTER TABLE `purchase_requests` DISABLE KEYS */;
INSERT INTO `purchase_requests` VALUES (1,'Lisensi Figma Pro',450000.00,'Request lisensi Figma untuk Bambang UI/UX','pending',4,NULL,NULL,'2026-08-13 10:06:42','2026-08-13 10:06:42'),(2,'RAM Upgrade 16GB',800000.00,'Upgrade RAM laptop Developer Andi','approved',3,1,NULL,'2026-08-13 10:06:42','2026-08-13 10:06:42'),(3,'makanan MBG',1000000000.00,NULL,'approved',2,2,5,'2026-08-13 11:05:51','2026-08-13 11:05:55');
/*!40000 ALTER TABLE `purchase_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('2rdfVHZBsQxUoilOpb2KV8W4heqpuxluip9FdvKi',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYnVLdzZkNnBianNSSENYWUl1cm9tZERhVWpYRFRTSjRRd0ExdWJZOCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjY0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkL2V4cG9ydC1yZXBvcnQ/dHlwZT1jb21wYW55X2Z1bmRzIjtzOjU6InJvdXRlIjtzOjE2OiJkYXNoYm9hcmQuZXhwb3J0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1786713130),('bLrey4Yyp3VPDVptbnQLbLlGce7F8eCcvqTCpq9F',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoia3A5U2hqMG51eU16eThRTmxjMXAwS2JiZWxjNkJ2TzdhcTV1a25CNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=',1786676125),('qzbxOe9UZNT2KRW7yxno79jRDLxjXyFjP7Btajc5',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT1BINVdDbXI0eENwRnhjOEF2WmdlOFFqY0Q4TGk1V1RReXpHbXpmZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvZXhwb3J0LXJlcG9ydD90eXBlPWV4cGVuc2UiO3M6NToicm91dGUiO3M6MTY6ImRhc2hib2FyZC5leHBvcnQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=',1786619161);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_category_id_foreign` (`category_id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `transactions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,'income',25000000.00,'Penjualan Batch A','2026-08-08',2,'2026-08-13 10:06:39','2026-08-13 10:06:39'),(2,2,'income',12000000.00,'Jasa maintenance sistem client XYZ','2026-08-11',2,'2026-08-13 10:06:39','2026-08-13 10:06:39'),(3,4,'expense',1500000.00,'Bayar internet & listrik kantor','2026-08-03',2,'2026-08-13 10:06:39','2026-08-13 10:06:39'),(4,5,'expense',6600000.00,'Pembayaran Gaji Fikri - Bulan 2026-08','2026-08-13',2,'2026-08-13 10:09:01','2026-08-13 10:09:01'),(5,4,'expense',1000000000.00,'Persetujuan Pembelian: makanan MBG (Diajukan oleh Siti (Finance Staff))','2026-08-13',2,'2026-08-13 11:05:55','2026-08-13 11:05:55');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'karyawan',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Budi (Owner)','owner@example.com',NULL,'$2y$12$tIZkoPTwxX4XBp4NUfBj1e7Va/0oXJJZGSjREvsE1fe0TMQyXIY4i',NULL,'2026-08-13 10:06:35','2026-08-13 10:06:35','owner'),(2,'Siti (Finance Staff)','finance@example.com',NULL,'$2y$12$xQ0/ckKdgsfuDaWaMFEEzuYFvXGxc9nlh49disdRwexbB0zoHVKZy',NULL,'2026-08-13 10:06:35','2026-08-13 10:06:35','finance'),(3,'Andi (Karyawan)','andi@example.com',NULL,'$2y$12$M6gvWgGpFF2jACZ1/ndFaOqOvs7d48AIYQqnb/uWRL2OkR0.XPq3y',NULL,'2026-08-13 10:06:36','2026-08-13 10:06:36','karyawan'),(4,'Bambang (Karyawan)','bambang@example.com',NULL,'$2y$12$9zH7vSYuV0e3IVJqrsvIGehBqgufg1eVrvO9vM9X8z9RL3GiIsLqW',NULL,'2026-08-13 10:06:36','2026-08-13 10:06:36','karyawan'),(5,'Dzaki (Karyawan)','dzaki@example.com',NULL,'$2y$12$vW/3YnoWnywj5dno9t0ddu2IkOOccJqTJJ5QNk4ZwSJyEUMeG2Fhu',NULL,'2026-08-13 10:06:36','2026-08-13 10:06:36','karyawan'),(6,'Afifah (Karyawan)','afifah@example.com',NULL,'$2y$12$fcRww6foYRSLRfPugZ8eCOHcbhMJuDwSCrFwEOPizCYzuiDuGBDii',NULL,'2026-08-13 10:06:37','2026-08-13 10:06:37','karyawan'),(7,'Raka (Karyawan)','raka@example.com',NULL,'$2y$12$ugBKKBQeC.skUt0b5SEuR.fF8CP3tbVpPEuGqb8uSHKUS84KUpeMS',NULL,'2026-08-13 10:06:37','2026-08-13 10:06:37','karyawan'),(8,'Fikri (Karyawan)','fikri@example.com',NULL,'$2y$12$KaNVS2N2WqPbptuHt8FZ2.Z1RKoRFN8Aoy8StSrN9V2hoLvdIx/F2',NULL,'2026-08-13 10:06:38','2026-08-13 10:06:38','karyawan'),(9,'Satria (Karyawan)','satria@example.com',NULL,'$2y$12$A4ZQtslbkBqqOJerB0A6a.CPH05rm1xXBTRCdrYsG8sHIXl.wcNpq',NULL,'2026-08-13 10:06:38','2026-08-13 10:06:38','karyawan'),(10,'Fajar (Karyawan)','fajar@example.com',NULL,'$2y$12$/V6UdVYr/ryVYMmzM5Aqe.3uSm2eu4yyotdQLzKXpLHchjGvS.h16',NULL,'2026-08-13 10:06:38','2026-08-13 10:06:38','karyawan'),(11,'Belvan','belvan@example.com',NULL,'$2y$12$HPI5xUVuG0JRgXqMxHPrjerFPdvD9K/58wJ7LHXaLPuamurgxjTMG',NULL,'2026-08-13 10:41:23','2026-08-13 10:41:23','karyawan');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-14 20:14:02
