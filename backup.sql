-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: rajawali_motor_db
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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) unsigned NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `action_type` enum('add','edit','delete') NOT NULL,
  `description` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_admin_id_foreign` (`admin_id`),
  CONSTRAINT `activity_logs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,1,'spare_part_types','add','menambahkan  test pada tabel spare_part_types',0,'2025-01-02 06:15:11','2025-01-02 06:15:11',NULL),(2,1,'spare_part_types','edit','mengubah  test 1 menjadi test 12 pada tabel spare_part_types',0,'2025-01-04 10:59:42','2025-01-04 10:59:42',NULL),(3,1,'spare_part_types','edit','mengubah  test 12 menjadi test 1 pada tabel spare_part_types',0,'2025-01-04 11:08:00','2025-01-04 11:08:00',NULL),(4,1,'spare_part_types','edit','mengubah  test 1 menjadi Ttipe pada tabel spare_part_types',0,'2025-01-04 11:11:19','2025-01-04 11:11:19',NULL),(5,1,'spare_part_types','delete','menghapus  Ttipe pada tabel spare_part_types',0,'2025-01-04 11:11:37','2025-01-04 11:11:37',NULL),(6,1,'spare_part_types','add','menambahkan  Aksesoris pada tabel spare_part_types',0,'2025-01-05 07:53:55','2025-01-05 07:53:55',NULL),(7,1,'spare_part_types','edit','mengubah  Aksesoris menjadi Aksesoris pada tabel spare_part_types',0,'2025-01-16 09:54:01','2025-01-16 09:54:01',NULL),(8,1,'suppliers','edit','mengubah  hendra menjadi hendra pada tabel suppliers',0,'2025-01-16 10:01:07','2025-01-16 10:01:07',NULL),(9,1,'customers','add','menambahkan  Suhendra pada tabel customers',0,'2025-01-16 11:26:14','2025-01-16 11:26:14',NULL),(10,1,'spare_parts','add','menambahkan  test 2 pada tabel spare_parts',0,'2025-01-29 10:21:30','2025-01-29 10:21:30',NULL),(11,1,'spare_parts','add','menambahkan  fferf pada tabel spare_parts',0,'2025-02-01 17:53:46','2025-02-01 17:53:46',NULL),(12,1,'spare_part_types','edit','mengubah  Ban menjadi Ban pada tabel spare_part_types',0,'2025-02-04 11:39:44','2025-02-04 11:39:44',NULL),(13,1,'spare_part_types','add','menambahkan  fff pada tabel spare_part_types',0,'2025-02-04 11:40:07','2025-02-04 11:40:07',NULL),(14,1,'spare_part_types','delete','menghapus  fff pada tabel spare_part_types',0,'2025-02-04 11:40:11','2025-02-04 11:40:11',NULL),(15,1,'customers','add','menambahkan  Meldi Latifah Saraswati pada tabel customers',0,'2025-02-04 13:16:41','2025-02-04 13:16:41',NULL),(16,1,'customers','add','menambahkan  amos pada tabel customers',0,'2025-02-04 13:19:54','2025-02-04 13:19:54',NULL),(17,1,'customers','add','menambahkan  tyyy pada tabel customers',0,'2025-02-04 13:47:40','2025-02-04 13:47:40',NULL),(18,1,'spare_part_types','edit','mengubah  Ban menjadi Ban pada tabel spare_part_types',0,'2025-02-04 14:39:30','2025-02-04 14:39:30',NULL),(19,1,'sales','add','menambahkan  2025-02-07 09:10:55 pada tabel sales',0,'2025-02-07 09:11:13','2025-02-07 09:11:13',NULL),(20,1,'sales','add','menambahkan  2025-02-07 09:20:00 pada tabel sales',0,'2025-02-07 09:20:25','2025-02-07 09:20:25',NULL),(21,1,'sales','add','menambahkan  2025-02-07 17:31:35 pada tabel sales',0,'2025-02-07 17:31:47','2025-02-07 17:31:47',NULL),(22,1,'sales','add','menambahkan  2025-02-07 17:46:54 pada tabel sales',0,'2025-02-07 17:47:05','2025-02-07 17:47:05',NULL),(23,1,'sales','add','menambahkan  2025-02-07 17:46:54 pada tabel sales',0,'2025-02-07 17:47:13','2025-02-07 17:47:13',NULL),(24,1,'spare_parts','add','menambahkan  sddd pada tabel spare_parts',0,'2025-02-17 16:43:26','2025-02-17 16:43:26',NULL),(25,1,'spare_parts','edit','mengubah  test 2 menjadi test 2 pada tabel spare_parts',0,'2025-03-09 00:30:55','2025-03-09 00:30:55',NULL),(26,1,'sales','edit','mengubah  {\"id\":\"3\",\"sale_number\":\"20250207092000\",\"customer_id\":\"2\",\"motorcycle_id\":\"5\",\"total\":\"300540.00\",\"discount\":\"0\",\"description\":\"vbbb\",\"status\":\"pending\",\"admin_id\":\"1\",\"sale_date\":\"2025-02-07 09:20:00\",\"created_at\":\"2025-02-07 09:20:25\",\"updated_at\":\"2025-02-07 09:20:25\",\"deleted_at\":null} menjadi {\"id\":\"3\",\"status\":\"process\",\"discount\":\"0\",\"description\":\"vbbb\"} pada tabel sales',0,'2025-03-09 00:41:03','2025-03-09 00:41:03',NULL),(27,1,'sale_payment_details','add','menambahkan  {\"sale_payment_id\":1,\"payment_method\":\"cash\",\"amount\":\"100000\",\"payment_date\":\"2025-03-09\",\"status\":\"completed\",\"description\":\"dp\",\"proof\":\"default.jpg\"} pada tabel sale_payment_details',0,'2025-03-09 00:41:26','2025-03-09 00:41:26',NULL),(28,1,'sales','edit','mengubah  {\"id\":\"3\",\"sale_number\":\"20250207092000\",\"customer_id\":\"2\",\"motorcycle_id\":\"5\",\"total\":\"300540.00\",\"discount\":\"0\",\"description\":\"vbbb\",\"status\":\"process\",\"admin_id\":\"1\",\"sale_date\":\"2025-02-07 09:20:00\",\"created_at\":\"2025-02-07 09:20:25\",\"updated_at\":\"2025-03-09 00:41:26\",\"deleted_at\":null} menjadi {\"id\":\"3\",\"status\":\"process\",\"discount\":\"0\",\"description\":\"vbbb\"} pada tabel sales',0,'2025-03-09 00:41:29','2025-03-09 00:41:29',NULL),(29,1,'sales','add','menambahkan  2025-03-09 15:30:11 pada tabel sales',0,'2025-03-09 15:30:29','2025-03-09 15:30:29',NULL),(30,1,'sale_payment_details','add','menambahkan  {\"sale_payment_id\":2,\"payment_method\":\"cash\",\"amount\":\"100000\",\"payment_date\":\"2025-03-09\",\"status\":\"completed\",\"description\":\"dp\",\"proof\":\"default.jpg\"} pada tabel sale_payment_details',0,'2025-03-09 15:35:39','2025-03-09 15:35:39',NULL),(31,1,'sales','edit','mengubah  {\"id\":\"7\",\"sale_number\":\"20250309153011\",\"customer_id\":\"1\",\"motorcycle_id\":\"4\",\"total\":\"216000.00\",\"discount\":\"0\",\"description\":\"\",\"status\":\"process\",\"admin_id\":\"1\",\"sale_date\":\"2025-03-09 15:30:11\",\"created_at\":\"2025-03-09 15:30:29\",\"updated_at\":\"2025-03-09 15:35:39\",\"deleted_at\":null} menjadi {\"id\":\"7\",\"status\":\"process\",\"discount\":\"0\",\"description\":\"\"} pada tabel sales',0,'2025-03-09 15:35:45','2025-03-09 15:35:45',NULL),(32,1,'spare_parts','add','menambahkan  hendra pada tabel spare_parts',0,'2025-03-10 23:59:29','2025-03-10 23:59:29',NULL),(33,1,'spare_parts','edit','mengubah  test 2 menjadi test 2 pada tabel spare_parts',0,'2025-03-10 23:59:51','2025-03-10 23:59:51',NULL),(34,1,'spare_parts','add','menambahkan  fff pada tabel spare_parts',0,'2025-03-11 00:00:36','2025-03-11 00:00:36',NULL),(35,1,'sale_payment_details','add','menambahkan  {\"sale_payment_id\":\"1\",\"payment_method\":\"cash\",\"amount\":\"200540\",\"payment_date\":\"2025-03-11\",\"status\":\"completed\",\"description\":\"\",\"proof\":\"default.jpg\"} pada tabel sale_payment_details',0,'2025-03-11 00:19:03','2025-03-11 00:19:03',NULL),(36,1,'sales','edit','mengubah  {\"id\":\"3\",\"sale_number\":\"20250207092000\",\"customer_id\":\"2\",\"motorcycle_id\":\"5\",\"total\":\"300540.00\",\"discount\":\"0\",\"description\":\"vbbb\",\"status\":\"completed\",\"admin_id\":\"1\",\"sale_date\":\"2025-02-07 09:20:00\",\"created_at\":\"2025-02-07 09:20:25\",\"updated_at\":\"2025-03-11 00:19:03\",\"deleted_at\":null} menjadi {\"id\":\"3\",\"status\":\"completed\",\"discount\":\"0\",\"description\":\"vbbb\"} pada tabel sales',0,'2025-03-11 00:19:10','2025-03-11 00:19:10',NULL),(37,1,'spare_parts','edit','mengubah  test 2 menjadi test 2 pada tabel spare_parts',0,'2025-03-15 12:18:49','2025-03-15 12:18:49',NULL),(38,1,'spare_parts','add','menambahkan  Federal matic ultratec 30 pada tabel spare_parts',0,'2025-03-15 12:23:55','2025-03-15 12:23:55',NULL),(39,1,'sales','add','menambahkan  2025-03-15 12:40:32 pada tabel sales',0,'2025-03-15 12:41:58','2025-03-15 12:41:58',NULL),(40,1,'sales','add','menambahkan  2025-03-15 12:40:32 pada tabel sales',0,'2025-03-15 12:42:29','2025-03-15 12:42:29',NULL),(41,1,'sales','add','menambahkan  2025-03-15 12:49:28 pada tabel sales',0,'2025-03-15 12:49:41','2025-03-15 12:49:41',NULL),(42,1,'sales','add','menambahkan  2025-03-15 12:52:31 pada tabel sales',0,'2025-03-15 12:52:41','2025-03-15 12:52:41',NULL),(43,1,'sales','add','menambahkan  2025-03-15 12:52:57 pada tabel sales',0,'2025-03-15 12:53:11','2025-03-15 12:53:11',NULL),(44,1,'sales','add','menambahkan  2025-03-15 13:00:10 pada tabel sales',0,'2025-03-15 13:00:37','2025-03-15 13:00:37',NULL),(45,1,'sale_payment_details','add','menambahkan  {\"sale_payment_id\":3,\"payment_method\":\"cash\",\"amount\":\"50000\",\"payment_date\":\"2025-03-15\",\"status\":\"completed\",\"description\":\"\",\"proof\":\"default.jpg\"} pada tabel sale_payment_details',0,'2025-03-15 13:02:35','2025-03-15 13:02:35',NULL),(46,1,'sales','edit','mengubah  {\"id\":\"13\",\"sale_number\":\"20250315130010\",\"customer_id\":\"2\",\"motorcycle_id\":\"6\",\"total\":\"165000.00\",\"discount\":\"0\",\"description\":\"rr\",\"status\":\"process\",\"admin_id\":\"1\",\"sale_date\":\"2025-03-15 13:00:10\",\"created_at\":\"2025-03-15 13:00:37\",\"updated_at\":\"2025-03-15 13:02:35\",\"deleted_at\":null} menjadi {\"id\":\"13\",\"status\":\"process\",\"discount\":\"0\",\"description\":\"rr\"} pada tabel sales',0,'2025-03-15 13:02:37','2025-03-15 13:02:37',NULL),(47,1,'sale_payment_details','add','menambahkan  {\"sale_payment_id\":\"3\",\"payment_method\":\"cash\",\"amount\":\"115000\",\"payment_date\":\"2025-03-15\",\"status\":\"completed\",\"description\":\"\",\"proof\":\"default.jpg\"} pada tabel sale_payment_details',0,'2025-03-15 13:02:54','2025-03-15 13:02:54',NULL),(48,1,'sales','edit','mengubah  {\"id\":\"13\",\"sale_number\":\"20250315130010\",\"customer_id\":\"2\",\"motorcycle_id\":\"6\",\"total\":\"165000.00\",\"discount\":\"0\",\"description\":\"rr\",\"status\":\"completed\",\"admin_id\":\"1\",\"sale_date\":\"2025-03-15 13:00:10\",\"created_at\":\"2025-03-15 13:00:37\",\"updated_at\":\"2025-03-15 13:02:54\",\"deleted_at\":null} menjadi {\"id\":\"13\",\"status\":\"completed\",\"discount\":\"0\",\"description\":\"rr\"} pada tabel sales',0,'2025-03-15 13:02:57','2025-03-15 13:02:57',NULL),(49,1,'suppliers','add','menambahkan  Meldi Latifah Saraswati pada tabel suppliers',0,'2025-03-15 14:21:44','2025-03-15 14:21:44',NULL),(50,1,'suppliers','add','menambahkan  suma malang pada tabel suppliers',0,'2025-03-15 14:24:04','2025-03-15 14:24:04',NULL),(51,1,'spare_parts','delete','menghapus  sddd pada tabel spare_parts',0,'2025-03-25 22:43:12','2025-03-25 22:43:12',NULL),(52,1,'spare_parts','delete','menghapus  test 2 pada tabel spare_parts',0,'2025-03-25 22:45:03','2025-03-25 22:45:03',NULL),(53,1,'spare_parts','delete','menghapus  fff pada tabel spare_parts',0,'2025-03-25 22:45:08','2025-03-25 22:45:08',NULL);
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'owner','owner@example.com','$2y$10$pk/kaoLFwsU05ekKtD9N5ebXOKaTZJqQi6cjc/LiKEVO0ZVDrNGny',1,1,'2024-12-04 14:00:05','2024-12-04 14:00:05',NULL),(2,'kasir','kasir@example.com','$2y$10$tOxmXB7tX/fRI5ggRlBDT.64sZTWuuK1uurwz.SIamwHOiN5xdOIW',2,1,'2024-12-04 14:00:05','2024-12-04 14:00:05',NULL),(3,'gudang','gudang@example.com','$2y$10$TucBPyP3asiqOf6GR7.Fd.C0hf8SpMcqueyuXpEC0Yo7OqX7tI34m',3,1,'2024-12-04 14:00:05','2024-12-04 14:00:05',NULL),(4,'hendra','hendra@email.com','$2y$10$2vHvvKL705fyUKe0KqbLVOOd90cpbk4aGDNqxH6GQoFv1YcUP63bq',2,1,'2025-01-01 14:47:12','2025-01-01 14:47:12',NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'Bengkel Rajawali Motor','Jl. Mertojoyo Sel. No.4, Merjosari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65144','085645523234','2025-01-23 20:12:50','2025-01-23 20:12:50',NULL);
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'John Doe','08123456789','Jl. Raya No. 123','2025-01-16 10:32:29','2025-02-04 21:34:54',NULL),(2,'Suhendra','081350204469','Jl. Candi Kalasan IV No. 7 Blimbing\r\nBlimbing','2025-01-16 11:26:13','2025-01-16 11:26:13',NULL),(3,'Meldi Latifah Saraswati','435535357575','Jln. Candi 3E No. 142 Karang Besuki','2025-02-04 13:16:41','2025-02-04 13:16:41',NULL),(4,'amos','23425553435','Jln. Candi 3E No. 142 Karang Besuki','2025-02-04 13:19:54','2025-02-04 13:19:54',NULL),(5,'tyyy','54545656464','66ffgfg','2025-02-04 13:47:40','2025-02-04 13:47:40',NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mechanic_salary_settings`
--

DROP TABLE IF EXISTS `mechanic_salary_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mechanic_salary_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mechanic_id` int(11) unsigned NOT NULL,
  `percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mechanic_salary_settings_mechanic_id_foreign` (`mechanic_id`),
  CONSTRAINT `mechanic_salary_settings_mechanic_id_foreign` FOREIGN KEY (`mechanic_id`) REFERENCES `mechanics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mechanic_salary_settings`
--

LOCK TABLES `mechanic_salary_settings` WRITE;
/*!40000 ALTER TABLE `mechanic_salary_settings` DISABLE KEYS */;
INSERT INTO `mechanic_salary_settings` VALUES (1,1,65.00,'active','dd','2025-03-09 16:06:05','2025-03-09 16:06:05',NULL);
/*!40000 ALTER TABLE `mechanic_salary_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mechanics`
--

DROP TABLE IF EXISTS `mechanics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mechanics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mechanics`
--

LOCK TABLES `mechanics` WRITE;
/*!40000 ALTER TABLE `mechanics` DISABLE KEYS */;
INSERT INTO `mechanics` VALUES (1,'Mechanic 1','08123456789','2025-01-16 11:30:35','2025-01-16 11:30:35',NULL);
/*!40000 ALTER TABLE `mechanics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `order_position` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,NULL,'Dashboard','fa-tachometer-alt','dashboard',1,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(2,NULL,'Transaksi','fa-cash-register','#',2,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(3,NULL,'Master Data','fa-database','master-data',3,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(4,NULL,'Notifikasi & Aktivitas Admin','fa-bell','#',4,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(5,NULL,'Laporan','fa-file-alt','reports',5,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(6,NULL,'Pengaturan & Akses','fa-cogs','#',6,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(7,2,'Penjualan','fa-shopping-cart','transactions/sales',1,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(8,2,'Pembelian Spare Part','fa-truck','transactions/purchases',2,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(9,2,'Return Spare Part','fa-undo','transactions/returns',3,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(10,3,'Spare Part','fa-tools','master-data/spare-parts',1,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(11,3,'Supplier','fa-truck','master-data/suppliers',2,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(12,3,'Servis','fa-wrench','master-data/services',3,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(13,3,'Mekanik','fa-user','master-data/mechanics',4,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(14,3,'Pelanggan','fa-users','master-data/customers',5,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(15,3,'Motor','fa-motorcycle','master-data/motorcycles',6,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(16,4,'Notifikasi','fa-bell','notifications',1,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(17,4,'Aktivitas Admin','fa-history','activity-logs',2,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(18,5,'Laporan Gaji Mekanik','fa-file-alt','reports/mechanic-salaries',1,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(19,6,'Pengaturan Website','fa-globe','settings',1,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(20,6,'Pengaturan Gaji Mekanik','fa-money-bill-wave','settings/mechanic-salaries',2,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(21,6,'Admin','fa-user-shield','settings/admins',3,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(22,6,'Menu','fa-bars','menus',4,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(23,6,'Roles','fa-user-tag','roles',5,'2024-12-28 15:08:42','2024-12-28 15:08:42',NULL),(24,3,'Tipe Spare Part','fa-cogs','master-data/spare-part-types',7,'2025-01-02 04:43:54','2025-01-02 04:43:54',NULL);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2024-12-28-155349','App\\Database\\Migrations\\CreateSparePartTable','default','App',1735401257,1),(2,'2025-01-02-040740','App\\Database\\Migrations\\SparePartTypes','default','App',1735791008,2),(3,'2025-01-02-041316','App\\Database\\Migrations\\AddTypeSpartPart','default','App',1735791260,3),(4,'2025-01-02-051418','App\\Database\\Migrations\\ActivityLogs','default','App',1735794987,4),(5,'2025-01-16-102907','App\\Database\\Migrations\\Customers','default','App',1737023449,5),(6,'2025-01-16-112729','App\\Database\\Migrations\\Mechanics','default','App',1737027033,6),(7,'2025-01-16-122325','App\\Database\\Migrations\\Services','default','App',1737030309,7),(8,'2025-01-16-125314','App\\Database\\Migrations\\Motorcycles','default','App',1737032123,8),(9,'2025-01-16-183248','App\\Database\\Migrations\\RemoveServicePrice','default','App',1737052552,9),(10,'2025-01-16-183343','App\\Database\\Migrations\\ServicePrices','default','App',1737052552,9),(11,'2025-01-21-141224','App\\Database\\Migrations\\AddMerkSparePart','default','App',1737468818,10),(12,'2025-01-22-083912','App\\Database\\Migrations\\SparePartDetails','default','App',1737535586,11),(13,'2025-01-22-084025','App\\Database\\Migrations\\SparePartPriceHistory','default','App',1737535586,11),(14,'2025-01-22-091847','App\\Database\\Migrations\\AddTypeSparePart','default','App',1737537545,12),(15,'2024-12-28-155349','App\\Database\\Migrations\\SparePartTypes','default','App',1737634194,13),(16,'2025-01-02-040740','App\\Database\\Migrations\\CreateSparePartTable','default','App',1737634215,14),(17,'2025-01-23-120323','App\\Database\\Migrations\\Branches','default','App',1737634215,14),(18,'2025-01-02-040740','App\\Database\\Migrations\\SpareParts','default','App',1737634243,15),(19,'2025-01-23-122932','App\\Database\\Migrations\\PurchaseTransactions','default','App',1737636209,16),(20,'2025-01-23-123308','App\\Database\\Migrations\\PurchaseTransactionDetails','default','App',1737636209,16),(21,'2025-01-23-125551','App\\Database\\Migrations\\RenamePurchases','default','App',1737637105,17),(22,'2025-01-29-112213','App\\Database\\Migrations\\PurchasePayments','default','App',1738151604,18),(23,'2025-01-29-112701','App\\Database\\Migrations\\PurchasePaymentDetails','default','App',1738151604,18),(24,'2025-01-30-072514','App\\Database\\Migrations\\Sales','default','App',1738223503,19),(25,'2025-01-30-073031','App\\Database\\Migrations\\SparePartSales','default','App',1738223503,19),(26,'2025-01-30-073440','App\\Database\\Migrations\\SparePartSaleDetails','default','App',1738223503,19),(27,'2025-01-30-073906','App\\Database\\Migrations\\ServiceSales','default','App',1738223503,19),(28,'2025-01-30-074004','App\\Database\\Migrations\\ServiceSaleDetails','default','App',1738223503,19),(29,'2025-01-30-074625','App\\Database\\Migrations\\SalePayments','default','App',1738223503,19),(30,'2025-01-30-074744','App\\Database\\Migrations\\SalePaymentDetails','default','App',1738223503,19),(31,'2025-01-30-075728','App\\Database\\Migrations\\SvcSaleDetails','default','App',1738223866,20),(32,'2025-01-30-075822','App\\Database\\Migrations\\SlPaymentDetails','default','App',1738223916,21),(33,'2025-02-01-103000','App\\Database\\Migrations\\MechanicSalarySettings','default','App',1741509594,22);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motorcycles`
--

DROP TABLE IF EXISTS `motorcycles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `motorcycles` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(5) unsigned NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `license_number` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `motorcycles_customer_id_foreign` (`customer_id`),
  CONSTRAINT `motorcycles_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motorcycles`
--

LOCK TABLES `motorcycles` WRITE;
/*!40000 ALTER TABLE `motorcycles` DISABLE KEYS */;
INSERT INTO `motorcycles` VALUES (4,1,'Honda','CBR1000RR','B 1234 ABC','2025-01-16 12:57:52','2025-01-16 12:57:52',NULL),(5,2,'Yamaha','YZF-R1','B 5678 DEF','2025-01-16 12:57:52','2025-01-16 12:57:52',NULL),(6,2,'Suzuki','GSX-R1000','B 9101 GHI','2025-01-16 12:57:52','2025-01-16 12:57:52',NULL),(7,4,'yamaha','vega','2344','2025-02-04 13:46:35','2025-02-04 13:46:35',NULL),(8,5,'ffdfd','fggd','gdr','2025-02-04 13:47:50','2025-02-04 13:47:50',NULL);
/*!40000 ALTER TABLE `motorcycles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_details`
--

DROP TABLE IF EXISTS `purchase_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) unsigned NOT NULL,
  `spare_part_id` int(11) unsigned NOT NULL,
  `quantity` int(11) unsigned NOT NULL,
  `buy_price` decimal(15,2) DEFAULT NULL,
  `sell_price` decimal(15,2) DEFAULT NULL,
  `sub_total` decimal(15,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_transaction_details_purchase_transaction_id_foreign` (`purchase_id`),
  KEY `purchase_transaction_details_spare_part_id_foreign` (`spare_part_id`),
  CONSTRAINT `purchase_transaction_details_purchase_transaction_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchase_transaction_details_spare_part_id_foreign` FOREIGN KEY (`spare_part_id`) REFERENCES `spare_parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_details`
--

LOCK TABLES `purchase_details` WRITE;
/*!40000 ALTER TABLE `purchase_details` DISABLE KEYS */;
INSERT INTO `purchase_details` VALUES (1,1,1,2,1.00,2.00,2.00,'2025-01-29 12:09:54','2025-01-29 12:09:54',NULL),(2,2,1,10,2500.00,3000.00,25000.00,'2025-03-09 15:22:40','2025-03-09 15:22:40',NULL),(3,2,5,3,1500.00,4000.00,4500.00,'2025-03-09 15:22:40','2025-03-09 15:22:40',NULL);
/*!40000 ALTER TABLE `purchase_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_payment_details`
--

DROP TABLE IF EXISTS `purchase_payment_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_payment_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_payment_id` int(11) unsigned NOT NULL,
  `payment_type` enum('cash','transfer') NOT NULL DEFAULT 'cash',
  `status` enum('unpaid','paid') NOT NULL DEFAULT 'paid',
  `proof` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `payment_date` date NOT NULL,
  `sub_total` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_payment_details_purchase_payment_id_foreign` (`purchase_payment_id`),
  CONSTRAINT `purchase_payment_details_purchase_payment_id_foreign` FOREIGN KEY (`purchase_payment_id`) REFERENCES `purchase_payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_payment_details`
--

LOCK TABLES `purchase_payment_details` WRITE;
/*!40000 ALTER TABLE `purchase_payment_details` DISABLE KEYS */;
INSERT INTO `purchase_payment_details` VALUES (1,1,'cash','paid','default.jpg','2025-01-30',34.00,'tt','2025-01-30 15:11:48','2025-01-30 15:11:48',NULL);
/*!40000 ALTER TABLE `purchase_payment_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_payments`
--

DROP TABLE IF EXISTS `purchase_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) unsigned NOT NULL,
  `status` enum('paid','unpaid') NOT NULL DEFAULT 'paid',
  `total` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_payments_purchase_id_foreign` (`purchase_id`),
  CONSTRAINT `purchase_payments_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_payments`
--

LOCK TABLES `purchase_payments` WRITE;
/*!40000 ALTER TABLE `purchase_payments` DISABLE KEYS */;
INSERT INTO `purchase_payments` VALUES (1,1,'paid',34.00,'der','2025-01-30 15:11:16','2025-01-30 15:11:16',NULL),(2,2,'paid',29500.00,'bayat','2025-03-09 15:22:40','2025-03-09 15:22:40',NULL);
/*!40000 ALTER TABLE `purchase_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) unsigned NOT NULL,
  `description` text DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `admin_id` int(11) unsigned NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `purchase_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_transactions_supplier_id_foreign` (`supplier_id`),
  KEY `purchase_transactions_admin_id_foreign` (`admin_id`),
  CONSTRAINT `purchase_transactions_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchase_transactions_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` VALUES (1,2,'ddd',34.00,1,0,'2025-01-28 00:00:00','2025-01-29 12:09:54','2025-01-29 12:09:54',NULL),(2,1,'tes',29500.00,1,1,'2025-03-09 00:00:00','2025-03-09 15:22:40','2025-03-09 15:22:40',NULL);
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_menu_items`
--

DROP TABLE IF EXISTS `role_menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_menu_items` (
  `role_id` int(11) unsigned NOT NULL,
  `menu_item_id` int(11) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`,`menu_item_id`),
  KEY `menu_item_id` (`menu_item_id`),
  CONSTRAINT `role_menu_items_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_menu_items_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_menu_items`
--

LOCK TABLES `role_menu_items` WRITE;
/*!40000 ALTER TABLE `role_menu_items` DISABLE KEYS */;
INSERT INTO `role_menu_items` VALUES (1,1,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,2,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,3,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,4,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,5,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,6,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,7,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,8,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,9,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,10,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,11,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,12,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,13,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,14,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,15,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,16,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,17,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,18,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,19,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,20,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,21,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,22,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,23,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(1,24,'2025-01-02 04:43:57','2025-01-02 04:43:57',NULL),(2,1,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(2,2,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(2,7,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(2,8,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(2,9,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(3,1,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(3,2,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(3,8,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(3,9,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(3,10,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL),(3,11,'2024-12-28 15:10:51','2024-12-28 15:10:51',NULL);
/*!40000 ALTER TABLE `role_menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Owner','2024-12-04 14:00:05','2024-12-04 14:00:05',NULL),(2,'Kasir','2024-12-04 14:00:05','2024-12-04 14:00:05',NULL),(3,'Gudang','2024-12-04 14:00:05','2024-12-04 14:00:05',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_payment_details`
--

DROP TABLE IF EXISTS `sale_payment_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale_payment_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_payment_id` int(11) unsigned NOT NULL,
  `payment_method` enum('cash','card','transfer') NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `proof` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `payment_date` date NOT NULL,
  `status` enum('pending','completed','canceled') NOT NULL DEFAULT 'pending',
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_payment_details_sale_payment_id_foreign` (`sale_payment_id`),
  CONSTRAINT `sale_payment_details_sale_payment_id_foreign` FOREIGN KEY (`sale_payment_id`) REFERENCES `sale_payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_payment_details`
--

LOCK TABLES `sale_payment_details` WRITE;
/*!40000 ALTER TABLE `sale_payment_details` DISABLE KEYS */;
INSERT INTO `sale_payment_details` VALUES (1,1,'cash',100000.00,'default.jpg','2025-03-09','completed','dp','2025-03-09 00:41:26','2025-03-09 00:41:26',NULL),(2,2,'cash',100000.00,'default.jpg','2025-03-09','completed','dp','2025-03-09 15:35:39','2025-03-09 15:35:39',NULL),(3,1,'cash',200540.00,'default.jpg','2025-03-11','completed','','2025-03-11 00:19:03','2025-03-11 00:19:03',NULL),(4,3,'cash',50000.00,'default.jpg','2025-03-15','completed','','2025-03-15 13:02:35','2025-03-15 13:02:35',NULL),(5,3,'cash',115000.00,'default.jpg','2025-03-15','completed','','2025-03-15 13:02:54','2025-03-15 13:02:54',NULL);
/*!40000 ALTER TABLE `sale_payment_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_payments`
--

DROP TABLE IF EXISTS `sale_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale_payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) unsigned NOT NULL,
  `status` enum('pending','completed','canceled') NOT NULL DEFAULT 'pending',
  `total` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_payments_sale_id_foreign` (`sale_id`),
  CONSTRAINT `sale_payments_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_payments`
--

LOCK TABLES `sale_payments` WRITE;
/*!40000 ALTER TABLE `sale_payments` DISABLE KEYS */;
INSERT INTO `sale_payments` VALUES (1,3,'completed',300540.00,NULL,'2025-03-09 00:41:26','2025-03-11 00:19:03',NULL),(2,7,'pending',100000.00,NULL,'2025-03-09 15:35:39','2025-03-09 15:35:39',NULL),(3,13,'completed',165000.00,NULL,'2025-03-15 13:02:35','2025-03-15 13:02:54',NULL);
/*!40000 ALTER TABLE `sale_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_number` varchar(100) NOT NULL,
  `customer_id` int(11) unsigned DEFAULT NULL,
  `motorcycle_id` int(11) unsigned DEFAULT NULL,
  `total` decimal(15,2) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','process','completed','canceled') NOT NULL DEFAULT 'pending',
  `admin_id` int(11) unsigned NOT NULL,
  `sale_date` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_customer_id_foreign` (`customer_id`),
  KEY `sales_motorcycle_id_foreign` (`motorcycle_id`),
  KEY `sales_admin_id_foreign` (`admin_id`),
  CONSTRAINT `sales_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_motorcycle_id_foreign` FOREIGN KEY (`motorcycle_id`) REFERENCES `motorcycles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (3,'20250207092000',2,5,300540.00,0,'vbbb','completed',1,'2025-02-07 09:20:00','2025-02-07 09:20:25','2025-03-11 00:19:10',NULL),(4,'20250207173135',NULL,NULL,12.00,0,'','pending',1,'2025-02-07 17:31:35','2025-02-07 17:31:47','2025-02-07 17:31:47',NULL),(5,'20250207174654',NULL,NULL,12.00,0,'vbb','pending',1,'2025-02-07 17:46:54','2025-02-07 17:47:05','2025-02-07 17:47:05',NULL),(6,'20250207174654',NULL,NULL,12.00,0,'vbb','pending',1,'2025-02-07 17:46:54','2025-02-07 17:47:13','2025-02-07 17:47:13',NULL),(7,'20250309153011',1,4,216000.00,0,'','process',1,'2025-03-09 15:30:11','2025-03-09 15:30:29','2025-03-09 15:35:45',NULL),(8,'20250315124032',NULL,NULL,45000.00,0,'','pending',1,'2025-03-15 12:40:32','2025-03-15 12:41:57','2025-03-15 12:41:57',NULL),(9,'20250315124032',NULL,NULL,45000.00,0,'','pending',1,'2025-03-15 12:40:32','2025-03-15 12:42:29','2025-03-15 12:42:29',NULL),(10,'20250315124928',NULL,NULL,50.00,0,'','pending',1,'2025-03-15 12:49:28','2025-03-15 12:49:41','2025-03-15 12:49:41',NULL),(11,'20250315125231',NULL,NULL,11.00,0,'','pending',1,'2025-03-15 12:52:31','2025-03-15 12:52:40','2025-03-15 12:52:40',NULL),(12,'20250315125257',NULL,NULL,333.00,0,'','pending',1,'2025-03-15 12:52:57','2025-03-15 12:53:11','2025-03-15 12:53:11',NULL),(13,'20250315130010',2,6,165000.00,0,'rr','completed',1,'2025-03-15 13:00:10','2025-03-15 13:00:37','2025-03-15 13:02:57',NULL);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_prices`
--

DROP TABLE IF EXISTS `service_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_prices` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(5) unsigned NOT NULL,
  `price` int(11) NOT NULL,
  `effective_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_prices_service_id_foreign` (`service_id`),
  CONSTRAINT `service_prices_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_prices`
--

LOCK TABLES `service_prices` WRITE;
/*!40000 ALTER TABLE `service_prices` DISABLE KEYS */;
INSERT INTO `service_prices` VALUES (1,1,100000,'2025-01-14','2025-01-16 18:39:28','2025-01-16 18:39:28',NULL),(2,2,200000,'2025-01-16','2025-01-16 18:39:28','2025-01-16 18:39:28',NULL),(3,3,300000,'2025-01-16','2025-01-16 18:39:28','2025-01-16 18:39:28',NULL),(5,1,120000,'2025-01-16','2025-01-16 18:39:28','2025-01-16 18:39:28',NULL);
/*!40000 ALTER TABLE `service_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_sale_details`
--

DROP TABLE IF EXISTS `service_sale_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_sale_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `service_sale_id` int(11) unsigned NOT NULL,
  `service_id` int(11) unsigned NOT NULL,
  `mechanic_id` int(11) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `sub_total` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_sale_details_service_sale_id_foreign` (`service_sale_id`),
  KEY `service_sale_details_service_id_foreign` (`service_id`),
  KEY `service_sale_details_mechanic_id_foreign` (`mechanic_id`),
  CONSTRAINT `service_sale_details_mechanic_id_foreign` FOREIGN KEY (`mechanic_id`) REFERENCES `mechanics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_sale_details_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `service_sale_details_service_sale_id_foreign` FOREIGN KEY (`service_sale_id`) REFERENCES `service_sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_sale_details`
--

LOCK TABLES `service_sale_details` WRITE;
/*!40000 ALTER TABLE `service_sale_details` DISABLE KEYS */;
INSERT INTO `service_sale_details` VALUES (2,2,3,1,1,300000.00,300000.00,' bvbbc','2025-02-07 09:20:25','2025-02-07 09:20:25',NULL),(3,3,2,1,1,200000.00,200000.00,'-','2025-03-09 15:30:29','2025-03-09 15:30:29',NULL),(4,4,1,1,1,120000.00,120000.00,'-','2025-03-15 13:00:37','2025-03-15 13:00:37',NULL);
/*!40000 ALTER TABLE `service_sale_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_sales`
--

DROP TABLE IF EXISTS `service_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) unsigned NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_sales_sale_id_foreign` (`sale_id`),
  CONSTRAINT `service_sales_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_sales`
--

LOCK TABLES `service_sales` WRITE;
/*!40000 ALTER TABLE `service_sales` DISABLE KEYS */;
INSERT INTO `service_sales` VALUES (2,3,300000.00,'-','2025-02-07 09:20:25','2025-02-07 09:20:25',NULL),(3,7,200000.00,'-','2025-03-09 15:30:29','2025-03-09 15:30:29',NULL),(4,13,120000.00,'-','2025-03-15 13:00:37','2025-03-15 13:00:37',NULL);
/*!40000 ALTER TABLE `service_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `difficulty` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Service A','Service A description',1,'2025-01-16 12:25:53','2025-01-16 12:25:53',NULL),(2,'Service B','Service B description',2,'2025-01-16 12:25:53','2025-01-16 12:25:53',NULL),(3,'Service C','Service C description',3,'2025-01-16 12:25:53','2025-01-16 12:25:53',NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spare_part_details`
--

DROP TABLE IF EXISTS `spare_part_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spare_part_details` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `spare_part_id` int(5) unsigned NOT NULL,
  `current_stock` int(5) DEFAULT NULL,
  `current_sell_price` decimal(10,2) DEFAULT NULL,
  `current_buy_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spare_part_details_spare_part_id_foreign` (`spare_part_id`),
  CONSTRAINT `spare_part_details_spare_part_id_foreign` FOREIGN KEY (`spare_part_id`) REFERENCES `spare_parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spare_part_details`
--

LOCK TABLES `spare_part_details` WRITE;
/*!40000 ALTER TABLE `spare_part_details` DISABLE KEYS */;
INSERT INTO `spare_part_details` VALUES (1,1,7,4000.00,2500.00,'2025-01-22 09:24:22','2025-03-09 07:30:29',NULL),(2,2,99,50.00,11.00,'2025-01-29 02:21:30','2025-03-15 05:49:41',NULL),(4,5,225,4000.00,1500.00,'2025-02-17 08:43:26','2025-03-09 07:22:40',NULL),(5,6,10,11.00,22.00,'2025-03-10 15:59:29','2025-03-15 05:52:41',NULL),(6,7,43,333.00,232.00,'2025-03-10 16:00:36','2025-03-15 05:53:11',NULL),(7,8,17,45000.00,38000.00,'2025-03-15 05:23:55','2025-03-15 06:00:37',NULL);
/*!40000 ALTER TABLE `spare_part_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spare_part_price_history`
--

DROP TABLE IF EXISTS `spare_part_price_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spare_part_price_history` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `spare_part_id` int(5) unsigned NOT NULL,
  `old_sell_price` decimal(10,2) DEFAULT NULL,
  `new_sell_price` decimal(10,2) DEFAULT NULL,
  `old_buy_price` decimal(10,2) DEFAULT NULL,
  `new_buy_price` decimal(10,2) DEFAULT NULL,
  `change_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spare_part_price_history_spare_part_id_foreign` (`spare_part_id`),
  CONSTRAINT `spare_part_price_history_spare_part_id_foreign` FOREIGN KEY (`spare_part_id`) REFERENCES `spare_parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spare_part_price_history`
--

LOCK TABLES `spare_part_price_history` WRITE;
/*!40000 ALTER TABLE `spare_part_price_history` DISABLE KEYS */;
INSERT INTO `spare_part_price_history` VALUES (3,1,0.00,12.00,0.00,1.00,'2025-01-29','2025-01-29 15:17:56','2025-01-29 15:17:56',NULL),(4,2,0.00,12.00,0.00,11.00,'2025-01-29','2025-01-29 15:19:39','2025-01-29 15:19:39',NULL),(7,5,0.00,222.00,0.00,111.00,'2025-02-17','2025-02-17 08:43:26','2025-02-17 08:43:26',NULL),(8,2,12.00,50.00,11.00,11.00,'2025-03-09','2025-03-08 16:30:55','2025-03-08 16:30:55',NULL),(9,1,12.00,4000.00,1.00,2500.00,'2025-03-09','2025-03-09 07:22:40','2025-03-09 07:22:40',NULL),(10,5,222.00,4000.00,111.00,1500.00,'2025-03-09','2025-03-09 07:22:40','2025-03-09 07:22:40',NULL),(11,6,0.00,11.00,0.00,22.00,'2025-03-10','2025-03-10 15:59:29','2025-03-10 15:59:29',NULL),(12,7,0.00,333.00,0.00,232.00,'2025-03-11','2025-03-10 16:00:36','2025-03-10 16:00:36',NULL),(13,8,0.00,45000.00,0.00,38000.00,'2025-03-15','2025-03-15 05:23:55','2025-03-15 05:23:55',NULL);
/*!40000 ALTER TABLE `spare_part_price_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spare_part_sale_details`
--

DROP TABLE IF EXISTS `spare_part_sale_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spare_part_sale_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `spare_part_sale_id` int(11) unsigned NOT NULL,
  `spare_part_id` int(11) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `sub_total` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spare_part_sale_details_spare_part_sale_id_foreign` (`spare_part_sale_id`),
  KEY `spare_part_sale_details_spare_part_id_foreign` (`spare_part_id`),
  CONSTRAINT `spare_part_sale_details_spare_part_id_foreign` FOREIGN KEY (`spare_part_id`) REFERENCES `spare_parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spare_part_sale_details_spare_part_sale_id_foreign` FOREIGN KEY (`spare_part_sale_id`) REFERENCES `spare_part_sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spare_part_sale_details`
--

LOCK TABLES `spare_part_sale_details` WRITE;
/*!40000 ALTER TABLE `spare_part_sale_details` DISABLE KEYS */;
INSERT INTO `spare_part_sale_details` VALUES (3,3,1,1,12.00,12.00,'ffeffrgrbb tr','2025-02-07 09:20:25','2025-02-07 09:20:25',NULL),(4,7,1,1,12.00,12.00,'ddd','2025-02-07 17:31:47','2025-02-07 17:31:47',NULL),(5,8,2,1,12.00,12.00,'fcvccg','2025-02-07 17:47:05','2025-02-07 17:47:05',NULL),(6,9,2,1,12.00,12.00,'fcvccg','2025-02-07 17:47:13','2025-02-07 17:47:13',NULL),(7,10,1,4,4000.00,16000.00,'-','2025-03-09 15:30:29','2025-03-09 15:30:29',NULL),(8,11,8,1,45000.00,45000.00,'-','2025-03-15 12:41:58','2025-03-15 12:41:58',NULL),(9,12,8,1,45000.00,45000.00,'-','2025-03-15 12:42:29','2025-03-15 12:42:29',NULL),(10,13,2,1,50.00,50.00,'-','2025-03-15 12:49:41','2025-03-15 12:49:41',NULL),(11,14,6,1,11.00,11.00,'-','2025-03-15 12:52:41','2025-03-15 12:52:41',NULL),(12,15,7,1,333.00,333.00,'-','2025-03-15 12:53:11','2025-03-15 12:53:11',NULL),(13,16,8,1,45000.00,45000.00,'-','2025-03-15 13:00:37','2025-03-15 13:00:37',NULL);
/*!40000 ALTER TABLE `spare_part_sale_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spare_part_sales`
--

DROP TABLE IF EXISTS `spare_part_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spare_part_sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) unsigned NOT NULL,
  `description` text DEFAULT NULL,
  `total` decimal(15,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spare_part_sales_sale_id_foreign` (`sale_id`),
  CONSTRAINT `spare_part_sales_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spare_part_sales`
--

LOCK TABLES `spare_part_sales` WRITE;
/*!40000 ALTER TABLE `spare_part_sales` DISABLE KEYS */;
INSERT INTO `spare_part_sales` VALUES (3,3,'-',540.00,'2025-02-07 09:20:25','2025-02-07 09:20:25',NULL),(7,4,'-',12.00,'2025-02-07 17:31:47','2025-02-07 17:31:47',NULL),(8,5,'-',12.00,'2025-02-07 17:47:05','2025-02-07 17:47:05',NULL),(9,6,'-',12.00,'2025-02-07 17:47:13','2025-02-07 17:47:13',NULL),(10,7,'-',16000.00,'2025-03-09 15:30:29','2025-03-09 15:30:29',NULL),(11,8,'-',45000.00,'2025-03-15 12:41:58','2025-03-15 12:41:58',NULL),(12,9,'-',45000.00,'2025-03-15 12:42:29','2025-03-15 12:42:29',NULL),(13,10,'-',50.00,'2025-03-15 12:49:41','2025-03-15 12:49:41',NULL),(14,11,'-',11.00,'2025-03-15 12:52:41','2025-03-15 12:52:41',NULL),(15,12,'-',333.00,'2025-03-15 12:53:11','2025-03-15 12:53:11',NULL),(16,13,'-',45000.00,'2025-03-15 13:00:37','2025-03-15 13:00:37',NULL);
/*!40000 ALTER TABLE `spare_part_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spare_part_types`
--

DROP TABLE IF EXISTS `spare_part_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spare_part_types` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spare_part_types`
--

LOCK TABLES `spare_part_types` WRITE;
/*!40000 ALTER TABLE `spare_part_types` DISABLE KEYS */;
INSERT INTO `spare_part_types` VALUES (1,'Ban','Spare Part Ban 5','2025-01-02 04:11:10','2025-02-04 14:39:30',NULL),(2,'Oli','Spare Part Oli','2025-01-02 04:11:10','2025-01-02 04:11:10',NULL),(3,'Ttipe','test 1','2025-01-02 06:15:11','2025-01-04 11:11:37','2025-01-04 11:11:37'),(4,'Aksesoris','Tipe Aksesoris baru','2025-01-05 07:53:55','2025-01-16 09:54:00',NULL),(5,'fff','grgr','2025-02-04 11:40:07','2025-02-04 11:40:11','2025-02-04 11:40:11');
/*!40000 ALTER TABLE `spare_part_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spare_parts`
--

DROP TABLE IF EXISTS `spare_parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spare_parts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `spare_part_type_id` int(5) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'default.jpg',
  `code_number` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `fk_spare_part_type` (`spare_part_type_id`),
  CONSTRAINT `fk_spare_part_type` FOREIGN KEY (`spare_part_type_id`) REFERENCES `spare_part_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spare_parts`
--

LOCK TABLES `spare_parts` WRITE;
/*!40000 ALTER TABLE `spare_parts` DISABLE KEYS */;
INSERT INTO `spare_parts` VALUES (1,1,'test','tst','test','default.jpg','rfdf34','2025-01-22 17:23:46','2025-01-22 17:23:46',NULL),(2,2,'test 2','tee','ee','1741625991_096552cc52e156359da9.jpg','MFUBLRO96O','2025-01-29 10:21:30','2025-03-25 22:45:03','2025-03-25 22:45:03'),(5,1,'sddd','fff','ff','default.jpg','UN2H8HSX7D','2025-02-17 16:43:26','2025-03-25 22:43:12','2025-03-25 22:43:12'),(6,1,'hendra','ggg','dd','1741625969_6cb8eb6d523889d5e78c.jpg','KHHQW34HS6','2025-03-10 23:59:29','2025-03-10 23:59:29',NULL),(7,2,'fff','gggg','ffff','67cf1ab1c9591.png','FF6QORCFZ9','2025-03-11 00:00:36','2025-03-25 22:45:08','2025-03-25 22:45:08'),(8,2,'Federal matic ultratec 30','federal ','-','67d50ee9e0ad8.png','8997208770199','2025-03-15 12:23:55','2025-03-15 12:23:55',NULL);
/*!40000 ALTER TABLE `spare_parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'hendra','efefv','334','2024-12-24 10:41:51','2025-01-16 10:01:07',NULL),(2,'test','test','3424','2025-01-26 20:25:15','2025-01-26 20:25:15',NULL),(3,'Meldi Latifah Saraswati','Jln. Candi 3E No. 142 Karang Besuki','081350204469','2025-03-15 14:21:44','2025-03-15 14:21:44',NULL),(4,'suma malang','malang','0867588896342','2025-03-15 14:24:04','2025-03-15 14:24:04',NULL);
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-25 22:52:09
