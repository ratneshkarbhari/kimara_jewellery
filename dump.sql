-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: kimaradb
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `material` text NOT NULL,
  `size` text NOT NULL,
  `quantity` int NOT NULL,
  `ip_address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (13,8,'silver','small',6,'::1'),(14,9,'silver','small',2,'::1');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `featured_image_rect` varchar(500) NOT NULL,
  `featured_image_square` varchar(500) NOT NULL,
  `parent` int NOT NULL,
  `visibility` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (2,'Designs under 15K ','new-random-slug','Designs under 15K','1604458314_b0e773a1fe6d80697db2.jpg','1604249283_245e3d4e1e7e952f8eb6.jpg',0,'visible'),(3,'Gorgeous Studs','gorgeous-studs','Gorgeous Studs description','1604311461_dd45c6b595d40fea7b93.jpg','1604311461_ae3aa787ed2c13644cb9.jpg',0,'visible');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `public_order_id` text NOT NULL,
  `products_qty_json` longtext NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_details` longtext NOT NULL,
  `customer_email` varchar(500) NOT NULL,
  `customer_name` longtext NOT NULL,
  `mode` text NOT NULL,
  `contact_number` text NOT NULL,
  `shipping_address` longtext NOT NULL,
  `billing_address` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'5','[{\"product_id\":\"9\",\"quantity\":\"5\",\"material\":\"silver\",\"sie\":\"small\"}]',5000.00,'placed','Order is placed by payment made via RazorPay','','Ratnesh Karbhari','prepaid','','',''),(2,'5','[{\"product_id\":\"9\",\"quantity\":\"5\",\"material\":\"silver\",\"sie\":\"small\"}]',5000.00,'placed','Order is placed by payment made via RazorPay','','Ratnesh Karbhari','prepaid','','',''),(3,'5','[{\"product_id\":\"9\",\"quantity\":\"5\",\"material\":\"silver\",\"sie\":\"small\"}]',5000.00,'placed','Order is placed by payment made via RazorPay','','Ratnesh Karbhari','prepaid','','',''),(4,'5','[{\"product_id\":\"9\",\"quantity\":\"5\",\"material\":\"silver\",\"sie\":\"small\"}]',5000.00,'placed','Order is placed by payment made via RazorPay','','Ratnesh Karbhari','prepaid','','',''),(5,'5','[{\"product_id\":\"9\",\"quantity\":\"6\",\"material\":\"silver\",\"sie\":\"small\"},{\"product_id\":\"8\",\"quantity\":\"1\",\"material\":\"silver\",\"sie\":\"small\"}]',6500.00,'placed','Order is placed by payment made via RazorPay','','Ratnesh Karbhari','prepaid','','',''),(6,'5fa3ecd97967a','[{\"product_id\":\"8\",\"quantity\":\"6\",\"material\":\"silver\",\"sie\":\"small\"},{\"product_id\":\"9\",\"quantity\":\"1\",\"material\":\"silver\",\"sie\":\"small\"}]',4000.00,'placed','Order is placed by payment made via RazorPay','','Ratnesh Karbhari','prepaid','','',''),(7,'5fa3ee08a0396','[{\"product_id\":\"8\",\"quantity\":\"6\",\"material\":\"silver\",\"sie\":\"small\"},{\"product_id\":\"9\",\"quantity\":\"1\",\"material\":\"silver\",\"sie\":\"small\"}]',40.00,'placed','Order is placed by payment made via RazorPay','','Ratnesh Karbhari','prepaid','','',''),(8,'5fa50e1a4981a','[{\"product_id\":\"8\",\"quantity\":\"6\",\"material\":\"silver\",\"sie\":\"small\"},{\"product_id\":\"9\",\"quantity\":\"2\",\"material\":\"silver\",\"sie\":\"small\"}]',5000.00,'placed','Order is placed by payment made via RazorPay','ratneshkarbhari7@gmail.com','Ratnesh Karbhari','prepaid','undefined','Vikhroli East','Vikhroli East'),(9,'5fa50e7a76d44','[{\"product_id\":\"8\",\"quantity\":\"6\",\"material\":\"silver\",\"sie\":\"small\"},{\"product_id\":\"9\",\"quantity\":\"2\",\"material\":\"silver\",\"sie\":\"small\"}]',5000.00,'placed','Order is placed by payment made via RazorPay','ratneshkarbhari7@gmail.com','Ratnesh Karbhari','prepaid','undefined','Vikhroli East','Vikhroli East'),(10,'5fa50ecc03954','[{\"product_id\":\"8\",\"quantity\":\"6\",\"material\":\"silver\",\"sie\":\"small\"},{\"product_id\":\"9\",\"quantity\":\"2\",\"material\":\"silver\",\"sie\":\"small\"}]',0.50,'placed','Order is placed by payment made via RazorPay','ratneshkarbhari7@gmail.com','Ratnesh Karbhari','prepaid','undefined','Vikhroli East','Vikhroli East'),(11,'5fa50ef90ef21','[{\"product_id\":\"8\",\"quantity\":\"6\",\"material\":\"silver\",\"sie\":\"small\"},{\"product_id\":\"9\",\"quantity\":\"2\",\"material\":\"silver\",\"sie\":\"small\"}]',50.00,'placed','Order is placed by payment made via RazorPay','ratneshkarbhari7@gmail.com','Ratnesh Karbhari','prepaid','undefined','Vikhroli East','vikroli East');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `category` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `featured_image` varchar(500) NOT NULL,
  `gallery_images` longtext NOT NULL,
  `gallery_videos` longtext NOT NULL,
  `stock_count` int NOT NULL,
  `featured` varchar(100) NOT NULL,
  `visibility` varchar(50) NOT NULL,
  `sizes` text NOT NULL,
  `materials` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (8,'Random Test Product 2','random-product-1','Random Product Description',2,10.00,5.00,'1604468903_3ada8ddb6a0dd7aee7ff.jpg','1604468903_4267ab0380e4d849c9de.jpg,1604468903_fdc363dbb5861a664a04.jpg,1604468903_a9aaed66761edbe73bf9.jpg','1604468700_545726f6aba59ec3aefe.jpg,1604468700_3c2f0615ee6a8f23ddd7.jpg,1604468700_d288dfb272f40ff743c0.jpg',1,'yes','visible','small,medium,large','silver,gold,rosegold'),(9,'Random Test Product 2','random-product-2','Product Description',3,20.00,10.00,'1604469243_997a9668fe6fd90c20d3.jpg','1604469243_f13753ce3cb951588d3b.jpg,1604469243_6a8b28ef23c42897c562.jpg','1604469243_1d439554724f9c5d4a7a.jpg,1604469243_f6030a7dd7b469cdac2b.jpg',1000,'yes','visible','small,medium,large','silver,gold,rosegold');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(500) NOT NULL,
  `mobile_number` text NOT NULL,
  `addresses_json` longtext NOT NULL,
  `email_verified` varchar(50) NOT NULL,
  `mobile_verified` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ratnesh','Karbhari','rkarbhari23@gmail.com','','','','','admin','$2y$10$AYXjG2FBvN8nM54JmCHV5OTUVLvnG7VnrrqmEf3v1/aZ5LaWIIVTa'),(2,'Ratnesh','Karbhari','ratneshkarbhari7@gmail.com','','','','','customer','$2y$10$PkiB//6UoRbc1LTeuezEtOYg4TMZKLX3GhZ//jU03mYtJbHL/0Idy');
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

-- Dump completed on 2020-11-06 14:28:12
