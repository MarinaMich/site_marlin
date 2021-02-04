-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: site_marlin
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf32;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'a@mail.com','123456'),(2,'s@y.ru','123456'),(3,'zero@ddd.ru','123456'),(4,'sav@ddd.com','123456'),(5,'hel@xx.com','123456'),(6,'12@kkk.ru','123456'),(7,'as@ddd.ru','7c4a8d09ca3762af61e59520943dc26494f8941b'),(8,'a@mail.ru','7c4a8d09ca3762af61e59520943dc26494f8941b'),(9,'a@mail.com','7c4a8d09ca3762af61e59520943dc26494f8941b'),(10,'er@ggg.ru','7c4a8d09ca3762af61e59520943dc26494f8941b'),(11,'dfc@jjj.cm','7c4a8d09ca3762af61e59520943dc26494f8941b'),(12,'word@jjj.ru','7c4a8d09ca3762af61e59520943dc26494f8941b'),(13,'e@m.ru','7c4a8d09ca3762af61e59520943dc26494f8941b'),(14,'nasty@mail.com','f18f057ea44a945a083a00e6fcc11637d186042d'),(15,'sacha@ff.ru','069a82c261b7de5834442e8d0f6d5d76add10158'),(16,'mar@dd.ru','b2ee60370ad57d9bc3877e9024c507ab99303a64'),(17,'zxc@yui.vvm','7c4a8d09ca3762af61e59520943dc26494f8941b'),(21,'test@test.ri','b2ee60370ad57d9bc3877e9024c507ab99303a64'),(22,'lkj@jkl.ru','b2ee60370ad57d9bc3877e9024c507ab99303a64'),(23,'poi@jkl.ur','b2ee60370ad57d9bc3877e9024c507ab99303a64'),(24,'u@u.r','b2ee60370ad57d9bc3877e9024c507ab99303a64'),(25,'d@y.c','b2ee60370ad57d9bc3877e9024c507ab99303a64'),(26,'hop@po.ru','444528fc68f99ea0f4fe027cb6cbd262f2a707fe'),(27,'ccc@ddd.ru','7c4a8d09ca3762af61e59520943dc26494f8941b'),(28,'z@d.ru','7c4a8d09ca3762af61e59520943dc26494f8941b'),(29,'lol@ddd.ru','$2y$10$B8BABKqlkUPO0PqFLLMKEuTcbF1C.5D/7sy/BUQ4HdkrRFISIiBO2');
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

-- Dump completed on 2021-02-04 11:47:10
