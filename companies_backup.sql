-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ascom
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
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `province_id` bigint(20) unsigned NOT NULL,
  `district_id` bigint(20) unsigned NOT NULL,
  `sector_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companies_province_id_foreign` (`province_id`),
  KEY `companies_district_id_foreign` (`district_id`),
  KEY `companies_sector_id_foreign` (`sector_id`),
  KEY `companies_category_id_foreign` (`category_id`),
  CONSTRAINT `companies_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `job_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `companies_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `companies_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE,
  CONSTRAINT `companies_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Rwanda Tech Solutions','logos/arldZE1axKNc2jYtOxqKazUNCj5j4VPGBMtnogtU.png','A leading tech company in Rwanda.lll','Kigali City Gasabo Remera',1,1,12,3,'2025-06-21 15:53:44','2025-07-01 04:49:40'),(2,'Kigali Health Group','logos/Pq0SVloZBtgYwBRsQmZYgnLc6d1f7Zy97xovsEZ0.png','Healthcare services provider.','Kigali City Gasabo Kimironko',1,1,22,5,'2025-06-21 15:53:44','2025-06-27 09:07:43'),(3,'EduRwanda','logos/17pgIx5Qe8BX3PZMLdXbypvZwhbzYlCiRM708HC2.png','Education consultancy firm.','Southern Province Nyaruguru Matare',2,7,18,10,'2025-06-21 15:53:44','2025-06-27 09:08:29'),(4,'FinanceCorp Rwanda','logos/financecorp.png','Financial services provider.','Musanze',3,4,4,4,'2025-06-21 15:53:44','2025-06-21 15:53:44'),(5,'EngiBuild Rwanda','logos/ALofpw5s9kRvIGpFv8THHvAihZcgnWPTaApG9KUa.png','Engineering and construction firm.','Western Province Rubavu Gisenyi',4,4,4,5,'2025-06-21 15:53:44','2025-06-27 09:09:06'),(6,'TechTrend Innovations','logos/0FvJHs3aoMIJ8PCEWpPezRbe5VQuZhZcyIVfvIuw.png','Innovative tech solutions.','Kigali City Gasabo Remera',1,1,12,1,'2025-06-21 15:53:44','2025-06-27 09:09:54'),(7,'MediCare Rwanda','logos/medicare.png','Medical care services.','Huye',2,3,3,2,'2025-06-21 15:53:45','2025-06-21 15:53:45'),(8,'LearnEasy Academy','logos/learneasy.png','Educational services.','Musanze',3,4,4,3,'2025-06-21 15:53:45','2025-06-21 15:53:45'),(9,'BankPro Rwanda','logos/24sR2OMqlU9Wfh0X7hZaGMycy8d3Tj58607XXXIJ.png','Banking services.','Northern Province Musanze Cyinzuzi',3,3,14,4,'2025-06-21 15:53:45','2025-06-27 09:10:28'),(10,'ConstructElite','logos/B2kl8VBsDf6gAErTYZntuZ8plaXqt3Pa0FtJWFTS.png','Construction services.','Kigali City Kicukiro Gatenga',1,6,17,5,'2025-06-21 15:53:45','2025-06-27 09:11:22'),(11,'SoftDev Rwanda','logos/PERX509Pw9yBzsKAvLlIEShGJkk7DDaGalPOG4xX.png','Software development firm.','Southern Province Huye Ngoma',2,2,13,1,'2025-06-21 15:53:45','2025-06-27 09:12:05'),(12,'HealthPlus Clinic','logos/yzhZGva3UlMb5murhUoLUtPEuS8Iva6aetFrl8Cc.png','Health clinic.','Northern Province Burera Kagano',3,8,19,2,'2025-06-21 15:53:45','2025-06-27 09:14:09'),(13,'EduFuture Rwanda','logos/yV23DZ1rh80BR6s85fB3k2AlRZrQJK9mPvbaKgCv.png','Future education solutions.','Western Province Rubavu Kanombe',4,4,15,3,'2025-06-21 15:53:46','2025-06-27 09:14:36'),(14,'MoneyWise Bank','logos/B0pU83UYoSB2IgQFmgu6hLMMAUdPphf5b7h3PrQX.png','Banking and finance.','Kigali City Kicukiro Gatenga',1,6,17,4,'2025-06-21 15:53:46','2025-06-27 09:15:05'),(15,'BuildTech Rwanda','logos/HQrIRv9O2Gm1ggX8XZOX5CWXQb0tIPjMV28IE0c0.png','Tech-driven construction.','Southern Province Huye Ngoma',2,2,13,5,'2025-06-21 15:53:46','2025-06-27 09:15:32');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-04 14:22:09
