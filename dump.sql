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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (50,11,'silver','small',1,'162.158.166.59'),(52,10,'silver','small',1,'162.158.165.198'),(53,10,'silver','small',1,'162.158.166.131'),(57,10,'silver','small',2,'162.158.165.22'),(58,11,'silver','small',2,'162.158.166.145'),(59,10,'silver','small',1,'172.69.135.72'),(60,11,'silver','small',1,'172.69.135.70'),(61,10,'silver','small',1,'172.69.135.70'),(62,11,'silver','small',5,'162.158.119.107'),(63,10,'silver','small',1,'162.158.191.184'),(64,13,'silver','small',1,'162.158.119.107'),(65,10,'silver','small',1,'162.158.119.163'),(66,10,'silver','small',1,'162.158.119.171'),(67,10,'silver','small',1,'162.158.165.32'),(68,11,'silver','small',5,'162.158.165.32');
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
  `featured_image_circular` varchar(500) NOT NULL,
  `parent` int NOT NULL,
  `visibility` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (4,'Gorgeous Studs','gorgeous-studs','Gorgeous Studs','1604844860_388ad11bcc5482c6faf9.jpg','1604844860_4e0f8008a51332a48bb4.jpg','1604844860_14bd7b1a227cef6416f0.png',0,'visible'),(5,'Everyday wear Bracelets','everyday-wear-bracelets','Every Day wear bracelets','1604906123_29cb61534f16e18b2bd2.jpg','1604844966_f8cbb366eacce0cc6548.jpg','1604945285_4b40bd1fa2c98bf9c0c1.png',0,'visible');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collections`
--

DROP TABLE IF EXISTS `collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `collections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` varchar(500) NOT NULL,
  `products` longtext NOT NULL,
  `featured_image` varchar(500) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collections`
--

LOCK TABLES `collections` WRITE;
/*!40000 ALTER TABLE `collections` DISABLE KEYS */;
INSERT INTO `collections` VALUES (4,'Best Sellers','best sellers collection','10,11','1604905146_843893bc6af4a30264f5.jpg','Best Sellers Collection'),(5,'Top Rated Collection','top rated collection','12,13','1604905188_6e8eb1320de9ffe2a71e.jpg','Top rated collection');
/*!40000 ALTER TABLE `collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(500) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'percentage',
  `value` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homepage_slides`
--

DROP TABLE IF EXISTS `homepage_slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `homepage_slides` (
  `id` int NOT NULL AUTO_INCREMENT,
  `link` longtext NOT NULL,
  `image_desktop` varchar(500) NOT NULL,
  `image_touch` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homepage_slides`
--

LOCK TABLES `homepage_slides` WRITE;
/*!40000 ALTER TABLE `homepage_slides` DISABLE KEYS */;
/*!40000 ALTER TABLE `homepage_slides` ENABLE KEYS */;
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
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'5fa661af62a86','[{\"product_id\":\"9\",\"quantity\":\"4\",\"material\":\"silver\",\"size\":\"small\"}]',40.00,'placed','Order is placed by payment made via RazorPay','ratneshkarbhari7@gmail.com','Ratnesh Karbhari','prepaid','09137976398','Vikhroli East','Vikhroli East','11-07-2020');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otps`
--

DROP TABLE IF EXISTS `otps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `otps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otps`
--

LOCK TABLES `otps` WRITE;
/*!40000 ALTER TABLE `otps` DISABLE KEYS */;
/*!40000 ALTER TABLE `otps` ENABLE KEYS */;
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
  `daily_deal` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (10,'Gorgeous Studs Product','gorgeous-studs-product','Product Description',4,10.00,3.00,'1604860325_1d0829cb262cc979b60a.jpg','1604860325_e2a3386ddf3080a649c5.jpg,1604860325_7e8e184c23530b12ab9e.jpg','1604860325_a30034a31085b736ba17.jpg,1604860325_595ad8a45912f1bf43b3.jpg',1001,'yes','visible','small,medium,large','silver,gold,rosegold','yes'),(11,'Everyday wear Bracelets Product','everyday-wear-bracelets','Product 2 Description',5,10.00,3.00,'1604903343_268aef789da04a4cf324.jpg','1604903343_019428b7eab04e9c8535.jpg,1604903343_ef201e504a3f08018c41.jpg','1604903343_c7cc324e16a8d43b05e9.jpg,1604903343_cfe90fc44025b360929f.jpg',1000,'yes','visible','small,medium,large','silver,gold,rosegold','yes'),(12,'Demo Product 3','demo-product-three','Demo Product 3 description',5,90.00,34.00,'1604905001_53b63297f4e8b94c4794.jpg','1604905001_ae99176b5813045c8bc2.jpg,1604905001_42ecd6d30a04d9a7f1a2.jpg','1604905001_2ea1e031a53cbc50575c.jpg,1604905001_504e9dbdf64e9292bc69.jpg',1000,'no','visible','small,medium,large','silver,gold,rosegold','yes'),(13,'Demo Product 4','demo-product-four','Demo product 4 description',4,56.00,24.00,'1604905053_ad99828e8db79d31beff.jpg','1604905053_dd856315a7425fd0ad19.jpg,1604905053_136861aef76f81c3aa50.jpg','1604905053_263abb84b823cbab3233.jpg,1604905053_118142e685b7e0a0ffdc.jpg',1000,'yes','visible','small,medium,large','silver,gold,rosegold','');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slides` (
  `id` int NOT NULL AUTO_INCREMENT,
  `desktop_image` varchar(500) NOT NULL,
  `touch_image` varchar(500) NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slides`
--

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
INSERT INTO `slides` VALUES (1,'1605013068_8072b78cbdbad9dd44e1.jpg','1605013068_11703c7e4ee576a66ef5.jpg','https://www.youtube.com/'),(2,'1605013135_7a8d1d46685736824325.webp','1605013135_1c7782aaf49d2ddde410.jpg','https://www.facebook.com/');
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
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
  `role` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ratnesh','Karbhari','rkarbhari23@gmail.com','','admin','$2y$10$AYXjG2FBvN8nM54JmCHV5OTUVLvnG7VnrrqmEf3v1/aZ5LaWIIVTa'),(2,'Ratnesh','Karbhari','ratneshkarbhari7@gmail.com','09137976398','customer','$2y$10$PkiB//6UoRbc1LTeuezEtOYg4TMZKLX3GhZ//jU03mYtJbHL/0Idy'),(4,'Ratnesh','Karbhari','rkarbhari23@gmail.com','','customer','ratnesh@47'),(5,'Ankit','Shah','info.iamjeweller@gmail.com','9022906690','customer','$2y$10$jUmVNu6ylymyx5qBjWPqheepuR9JZ6EM800MGKD7cNEem6azX9yru'),(6,'Ratnesh','Karbhari','codesevaco@gmail.com','','customer','$2y$10$txuFPzWVTc3XbnKbG1MqYe6GcsizREyZGVKjZJModZnJnipDzsLOK');
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

-- Dump completed on 2020-11-11 15:17:27
