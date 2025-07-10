-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mini_blog
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (5,'Designing Accesibility','2025-07-22','uploads/686f68a8b68a0_923c1d7f3c90b081e1086b24f678c301dc405038.png','Design'),(6,'Exploring The Future Of AI','2025-08-01','uploads/686f80b0d943b_beb656e54feab4e6131d9580aa8c1e488236f303.png','Tech'),(7,'The Rise Of Javascript Frameworks','2025-07-22','uploads/686f68b6efdb5_e7f93c43797b2f99612c1adb3aba61c02f9997be.png','Development'),(8,'Effective Digital Marketing Strategies','2025-06-30','uploads/686f68fe80a4e_a51e7aabf9f21f3e1229340b312f4215ccc42fbf.png','Marketing'),(9,'Mastering Personal Finance ','2025-06-01','uploads/686f6f3591ce2_960x0.webp','Lifestyle'),(11,'Top Destinations for 2025','2025-06-13','uploads/686f6a4c555ba_7f428b4fa597ec8a2b7fca4a4e4b8143c06de752.png','Travel'),(12,'Entrepreneurship in the Modern Age','2025-06-30','uploads/686f698a769d8_4586390f671711c602a99d0cfb90f2c37b3dd960.png','Business'),(13,'Building Scalable Web Applications','2025-06-10','uploads/686f6e1dbb9c9_1_-ROMDdYeb3OHXQHbep8wfg.jpg','Development'),(14,'UX Trends to Watch in 2025','2025-06-10','uploads/686f6e744a29a_65cccff9a49aaeeddb958e07_hombre-tiro-medio-disenando-sitios-web 800.png','Design'),(15,'The Evolution of Remote Work','2025-06-02','uploads/686f6ec7dac0c_home_office_aprueban_ley_01.jpg','Business'),(16,'Balancing Work and Life','2025-06-18','uploads/686f69d9ab375_acb111c878af6ec5f560c81b65f6a8b8445d8496.png','Lifestyle'),(17,'The Importance of Mental Health','2025-06-18','uploads/686f6a011d123_cbeba41109217412de3c945d05b063c52f1de56f.png','Health');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-10  3:41:01
