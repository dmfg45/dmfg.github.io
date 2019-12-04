-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: onlinestore
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `about_us`
--

DROP TABLE IF EXISTS `about_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `about_us` (
  `about_id` int(11) NOT NULL AUTO_INCREMENT,
  `about_heading` text,
  `about_short_desc` text,
  `about_desc` text,
  PRIMARY KEY (`about_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_us`
--

LOCK TABLES `about_us` WRITE;
/*!40000 ALTER TABLE `about_us` DISABLE KEYS */;
INSERT INTO `about_us` VALUES (1,'About Us','<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>','<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>');
/*!40000 ALTER TABLE `about_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL,
  `admin_image` text,
  `admin_contact` varchar(255) DEFAULT NULL,
  `admin_country` text,
  `admin_job` varchar(255) DEFAULT NULL,
  `admin_about` text,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (2,'Administrator','twiterhatch@gmail.com','$2y$10$9EMNb6BeHbTTD2GGTtaGA.rgtf6nHASMYnB7Cm5nEg5O6fQ/9dsYO','fg.png','917913244','Portugal','Web Developer','Something');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boxes_section`
--

DROP TABLE IF EXISTS `boxes_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `boxes_section` (
  `box_id` int(10) NOT NULL AUTO_INCREMENT,
  `box_title` text,
  `box_desc` text,
  PRIMARY KEY (`box_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boxes_section`
--

LOCK TABLES `boxes_section` WRITE;
/*!40000 ALTER TABLE `boxes_section` DISABLE KEYS */;
INSERT INTO `boxes_section` VALUES (1,'\'BEST PRICES\', \'You can check on all others sites about the prices and than compare with us.\'','\'BEST PRICES\', \'You can check on all others sites about the prices and than compare with us.\''),(2,'\'100% SATISFACTION GUARANTEED From Us\', \'Free returns on everything for 3 months. \'','\'100% SATISFACTION GUARANTEED From Us\', \'Free returns on everything for 3 months. \''),(3,'\'WE LOVE OUR CUSTOMERS\', \' We are known to provide best possible service ever\'','\'WE LOVE OUR CUSTOMERS\', \' We are known to provide best possible service ever\'');
/*!40000 ALTER TABLE `boxes_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bundle_product_relations`
--

DROP TABLE IF EXISTS `bundle_product_relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `bundle_product_relations` (
  `rel_id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_title` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `bundle_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`rel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bundle_product_relations`
--

LOCK TABLES `bundle_product_relations` WRITE;
/*!40000 ALTER TABLE `bundle_product_relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `bundle_product_relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) DEFAULT NULL,
  `ip_add` varchar(255) DEFAULT NULL,
  `p_price` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `p_size` text,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (10,2,'::1','50',3,'Large'),(11,4,'::1','75',3,'Extra Large');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_title` text,
  `cat_top` text,
  `cat_image` text,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Men','no','levis_casaco_masculino_stretch-harrington-jacket-74586-0000_indigo_1.jpg'),(2,'Women','yes','1083686cd283ae0fc52b519bfb24e2caa0ddfde6_CLT7231_1.jpg'),(3,'Kids','no','53398795.jpg');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_email` text,
  `contact_heading` text,
  `contact_description` text,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_us`
--

LOCK TABLES `contact_us` WRITE;
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
INSERT INTO `contact_us` VALUES (1,'twiterhatch@gmail.com','Contact  To Us','If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.');
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'AF','Afghanistan'),(2,'AL','Albania'),(3,'DZ','Algeria'),(4,'DS','American Samoa'),(5,'AD','Andorra'),(6,'AO','Angola'),(7,'AI','Anguilla'),(8,'AQ','Antarctica'),(9,'AG','Antigua and Barbuda'),(10,'AR','Argentina'),(11,'AM','Armenia'),(12,'AW','Aruba'),(13,'AU','Australia'),(14,'AT','Austria'),(15,'AZ','Azerbaijan'),(16,'BS','Bahamas'),(17,'BH','Bahrain'),(18,'BD','Bangladesh'),(19,'BB','Barbados'),(20,'BY','Belarus'),(21,'BE','Belgium'),(22,'BZ','Belize'),(23,'BJ','Benin'),(24,'BM','Bermuda'),(25,'BT','Bhutan'),(26,'BO','Bolivia'),(27,'BA','Bosnia and Herzegovina'),(28,'BW','Botswana'),(29,'BV','Bouvet Island'),(30,'BR','Brazil'),(31,'IO','British Indian Ocean Territory'),(32,'BN','Brunei Darussalam'),(33,'BG','Bulgaria'),(34,'BF','Burkina Faso'),(35,'BI','Burundi'),(36,'KH','Cambodia'),(37,'CM','Cameroon'),(38,'CA','Canada'),(39,'CV','Cape Verde'),(40,'KY','Cayman Islands'),(41,'CF','Central African Republic'),(42,'TD','Chad'),(43,'CL','Chile'),(44,'CN','China'),(45,'CX','Christmas Island'),(46,'CC','Cocos (Keeling) Islands'),(47,'CO','Colombia'),(48,'KM','Comoros'),(49,'CG','Congo'),(50,'CK','Cook Islands'),(51,'CR','Costa Rica'),(52,'HR','Croatia (Hrvatska)'),(53,'CU','Cuba'),(54,'CY','Cyprus'),(55,'CZ','Czech Republic'),(56,'DK','Denmark'),(57,'DJ','Djibouti'),(58,'DM','Dominica'),(59,'DO','Dominican Republic'),(60,'TP','East Timor'),(61,'EC','Ecuador'),(62,'EG','Egypt'),(63,'SV','El Salvador'),(64,'GQ','Equatorial Guinea'),(65,'ER','Eritrea'),(66,'EE','Estonia'),(67,'ET','Ethiopia'),(68,'FK','Falkland Islands (Malvinas)'),(69,'FO','Faroe Islands'),(70,'FJ','Fiji'),(71,'FI','Finland'),(72,'FR','France'),(73,'FX','France, Metropolitan'),(74,'GF','French Guiana'),(75,'PF','French Polynesia'),(76,'TF','French Southern Territories'),(77,'GA','Gabon'),(78,'GM','Gambia'),(79,'GE','Georgia'),(80,'DE','Germany'),(81,'GH','Ghana'),(82,'GI','Gibraltar'),(83,'GK','Guernsey'),(84,'GR','Greece'),(85,'GL','Greenland'),(86,'GD','Grenada'),(87,'GP','Guadeloupe'),(88,'GU','Guam'),(89,'GT','Guatemala'),(90,'GN','Guinea'),(91,'GW','Guinea-Bissau'),(92,'GY','Guyana'),(93,'HT','Haiti'),(94,'HM','Heard and Mc Donald Islands'),(95,'HN','Honduras'),(96,'HK','Hong Kong'),(97,'HU','Hungary'),(98,'IS','Iceland'),(99,'IN','India'),(100,'IM','Isle of Man'),(101,'ID','Indonesia'),(102,'IR','Iran (Islamic Republic of)'),(103,'IQ','Iraq'),(104,'IE','Ireland'),(105,'IL','Israel'),(106,'IT','Italy'),(107,'CI','Ivory Coast'),(108,'JE','Jersey'),(109,'JM','Jamaica'),(110,'JP','Japan'),(111,'JO','Jordan'),(112,'KZ','Kazakhstan'),(113,'KE','Kenya'),(114,'KI','Kiribati'),(115,'KP','Korea, Democratic People\'s Republic of'),(116,'KR','Korea, Republic of'),(117,'XK','Kosovo'),(118,'KW','Kuwait'),(119,'KG','Kyrgyzstan'),(120,'LA','Lao People\'s Democratic Republic'),(121,'LV','Latvia'),(122,'LB','Lebanon'),(123,'LS','Lesotho'),(124,'LR','Liberia'),(125,'LY','Libyan Arab Jamahiriya'),(126,'LI','Liechtenstein'),(127,'LT','Lithuania'),(128,'LU','Luxembourg'),(129,'MO','Macau'),(130,'MK','Macedonia'),(131,'MG','Madagascar'),(132,'MW','Malawi'),(133,'MY','Malaysia'),(134,'MV','Maldives'),(135,'ML','Mali'),(136,'MT','Malta'),(137,'MH','Marshall Islands'),(138,'MQ','Martinique'),(139,'MR','Mauritania'),(140,'MU','Mauritius'),(141,'TY','Mayotte'),(142,'MX','Mexico'),(143,'FM','Micronesia, Federated States of'),(144,'MD','Moldova, Republic of'),(145,'MC','Monaco'),(146,'MN','Mongolia'),(147,'ME','Montenegro'),(148,'MS','Montserrat'),(149,'MA','Morocco'),(150,'MZ','Mozambique'),(151,'MM','Myanmar'),(152,'NA','Namibia'),(153,'NR','Nauru'),(154,'NP','Nepal'),(155,'NL','Netherlands'),(156,'AN','Netherlands Antilles'),(157,'NC','New Caledonia'),(158,'NZ','New Zealand'),(159,'NI','Nicaragua'),(160,'NE','Niger'),(161,'NG','Nigeria'),(162,'NU','Niue'),(163,'NF','Norfolk Island'),(164,'MP','Northern Mariana Islands'),(165,'NO','Norway'),(166,'OM','Oman'),(167,'PK','Pakistan'),(168,'PW','Palau'),(169,'PS','Palestine'),(170,'PA','Panama'),(171,'PG','Papua New Guinea'),(172,'PY','Paraguay'),(173,'PE','Peru'),(174,'PH','Philippines'),(175,'PN','Pitcairn'),(176,'PL','Poland'),(177,'PT','Portugal'),(178,'PR','Puerto Rico'),(179,'QA','Qatar'),(180,'RE','Reunion'),(181,'RO','Romania'),(182,'RU','Russian Federation'),(183,'RW','Rwanda'),(184,'KN','Saint Kitts and Nevis'),(185,'LC','Saint Lucia'),(186,'VC','Saint Vincent and the Grenadines'),(187,'WS','Samoa'),(188,'SM','San Marino'),(189,'ST','Sao Tome and Principe'),(190,'SA','Saudi Arabia'),(191,'SN','Senegal'),(192,'RS','Serbia'),(193,'SC','Seychelles'),(194,'SL','Sierra Leone'),(195,'SG','Singapore'),(196,'SK','Slovakia'),(197,'SI','Slovenia'),(198,'SB','Solomon Islands'),(199,'SO','Somalia'),(200,'ZA','South Africa'),(201,'GS','South Georgia South Sandwich Islands'),(202,'SS','South Sudan'),(203,'ES','Spain'),(204,'LK','Sri Lanka'),(205,'SH','St. Helena'),(206,'PM','St. Pierre and Miquelon'),(207,'SD','Sudan'),(208,'SR','Suriname'),(209,'SJ','Svalbard and Jan Mayen Islands'),(210,'SZ','Swaziland'),(211,'SE','Sweden'),(212,'CH','Switzerland'),(213,'SY','Syrian Arab Republic'),(214,'TW','Taiwan'),(215,'TJ','Tajikistan'),(216,'TZ','Tanzania, United Republic of'),(217,'TH','Thailand'),(218,'TG','Togo'),(219,'TK','Tokelau'),(220,'TO','Tonga'),(221,'TT','Trinidad and Tobago'),(222,'TN','Tunisia'),(223,'TR','Turkey'),(224,'TM','Turkmenistan'),(225,'TC','Turks and Caicos Islands'),(226,'TV','Tuvalu'),(227,'UG','Uganda'),(228,'UA','Ukraine'),(229,'AE','United Arab Emirates'),(230,'GB','United Kingdom'),(231,'US','United States'),(232,'UM','United States minor outlying islands'),(233,'UY','Uruguay'),(234,'UZ','Uzbekistan'),(235,'VU','Vanuatu'),(236,'VA','Vatican City State'),(237,'VE','Venezuela'),(238,'VN','Vietnam'),(239,'VG','Virgin Islands (British)'),(240,'VI','Virgin Islands (U.S.)'),(241,'WF','Wallis and Futuna Islands'),(242,'EH','Western Sahara'),(243,'YE','Yemen'),(244,'ZR','Zaire'),(245,'ZM','Zambia'),(246,'ZW','Zimbabwe');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `coupon_title` varchar(255) DEFAULT NULL,
  `coupon_price` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_limit` int(11) DEFAULT NULL,
  `coupon_used` int(11) DEFAULT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_pass` varchar(255) DEFAULT NULL,
  `customer_country` text,
  `customer_city` text,
  `customer_contact` varchar(255) DEFAULT NULL,
  `customer_address` text,
  `customer_image` text,
  `customer_ip` varchar(255) DEFAULT NULL,
  `customer_confirm_code` text,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'André Graça','twiterhatch@gmail.com','$2y$10$Vlfutgf8pxzYUx0IVXY5qO/DLrqCIvbzLDoGRlWCZFz7A.FtiFMP.','PT','Pataias','917913244','Estrada Dos Pisões n8','59ee375fe8bc24.0683008359ee375fd9eed7.71716536.jpg','::1','');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_addresses`
--

DROP TABLE IF EXISTS `customers_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `customers_addresses` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `billing_first_name` text,
  `billing_last_name` text,
  `billing_country` text,
  `billing_address_1` text,
  `billing_address_2` text,
  `billing_state` text,
  `billing_city` text,
  `billing_postcode` text,
  `shipping_first_name` text,
  `shipping_last_name` text,
  `shipping_country` text,
  `shipping_address_1` text,
  `shipping_address_2` text,
  `shipping_state` text,
  `shipping_city` text,
  `shipping_postcode` text,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_addresses`
--

LOCK TABLES `customers_addresses` WRITE;
/*!40000 ALTER TABLE `customers_addresses` DISABLE KEYS */;
INSERT INTO `customers_addresses` VALUES (1,1,'André','Filipe','PT','Estrada dos pisões n8','','Leiria','Pataias','2445','','','','','','','','');
/*!40000 ALTER TABLE `customers_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_orders`
--

DROP TABLE IF EXISTS `customers_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `customers_orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) DEFAULT NULL,
  `due_amount` int(100) DEFAULT NULL,
  `invoice_number` int(100) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `size` text,
  `order_date` timestamp NULL DEFAULT NULL,
  `order_status` text,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_orders`
--

LOCK TABLES `customers_orders` WRITE;
/*!40000 ALTER TABLE `customers_orders` DISABLE KEYS */;
INSERT INTO `customers_orders` VALUES (1,1,160,1031805761,2,'Medium','2019-06-15 23:38:29','complete',3),(2,1,240,1044603322,3,'Large','2019-06-15 23:59:04','pending',3),(3,2,160,1325865531,2,'Medium','2019-06-24 20:55:46','pending',3);
/*!40000 ALTER TABLE `customers_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enquiry_types`
--

DROP TABLE IF EXISTS `enquiry_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `enquiry_types` (
  `enquiry_id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`enquiry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquiry_types`
--

LOCK TABLES `enquiry_types` WRITE;
/*!40000 ALTER TABLE `enquiry_types` DISABLE KEYS */;
INSERT INTO `enquiry_types` VALUES (1,'Order and Delivery Support'),(2,'Technical Support'),(3,'Price Concern');
/*!40000 ALTER TABLE `enquiry_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `icons`
--

DROP TABLE IF EXISTS `icons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `icons` (
  `icon_id` int(11) NOT NULL AUTO_INCREMENT,
  `icon_product` int(11) DEFAULT NULL,
  `icon_title` varchar(255) DEFAULT NULL,
  `icon_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`icon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `icons`
--

LOCK TABLES `icons` WRITE;
/*!40000 ALTER TABLE `icons` DISABLE KEYS */;
/*!40000 ALTER TABLE `icons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `manufacturers` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_title` text,
  `manufacturer_top` text,
  `manufacturer_image` text,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES (1,'Ford','yes','fordperformance-test.png'),(2,'Honda','no','honda-6-202784.png'),(3,'Mercedes Benz','no','transferir.png'),(4,'Suzuki','','suzuki-282144.png'),(5,'Nike','','180781b59c.png');
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `payments` (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(10) DEFAULT NULL,
  `amount` int(10) DEFAULT NULL,
  `payment_mode` text,
  `ref_no` int(10) DEFAULT NULL,
  `payment_code` int(10) DEFAULT NULL,
  `payment_date` text,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pending_orders`
--

DROP TABLE IF EXISTS `pending_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `pending_orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) DEFAULT NULL,
  `invoice_number` int(10) DEFAULT NULL,
  `product_id` text,
  `qty` int(10) DEFAULT NULL,
  `size` text,
  `order_status` text,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pending_orders`
--

LOCK TABLES `pending_orders` WRITE;
/*!40000 ALTER TABLE `pending_orders` DISABLE KEYS */;
INSERT INTO `pending_orders` VALUES (1,1,1031805761,'3',2,'Medium','pending'),(2,1,1044603322,'3',3,'Large','pending'),(3,1,1325865531,'3',2,'Medium','pending');
/*!40000 ALTER TABLE `pending_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `product_categories` (
  `p_cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `p_cat_title` text,
  `p_cat_top` text,
  `p_cat_image` text,
  PRIMARY KEY (`p_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (2,'Helmets','no','bilt_techno20_helmet.jpg'),(3,'Wheels','no','images.jpg'),(4,'Jackets','no','apparel_outerwear_tsm_fleece-varsity_black_01_1024x1024.jpg'),(5,'Gloves','yes','gloves.png'),(6,'Boots','no','61kj4y4Ff+L._SX425_.jpg');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `p_cat_id` int(10) DEFAULT NULL,
  `cat_id` int(10) DEFAULT NULL,
  `manufacturer_id` int(10) DEFAULT NULL,
  `prod_date` timestamp NULL DEFAULT NULL,
  `product_title` text,
  `product_seo_desc` text,
  `product_url` text,
  `product_img1` text,
  `product_img2` text,
  `product_img3` text,
  `product_price` int(10) DEFAULT NULL,
  `product_psp_price` int(100) DEFAULT NULL,
  `product_description` text,
  `product_features` text,
  `product_video` text,
  `product_keywords` text,
  `product_label` text,
  `product_type` text,
  `product_weight` decimal(10,1) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,4,1,5,'2019-06-13 01:45:06','Jacket 1','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsa','jacket-1','Blog-Image.jpg','Blog-Image.jpg','Blog-Image.jpg',50,45,'<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>','<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.','Jackect, Blue','','physicalProduct',0.4,'product'),(2,4,1,5,'2019-06-13 01:46:32','Jacket 2','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsa','jacket-2','gK7xgWOmtO.jpg','gK7xgWOmtO.jpg','gK7xgWOmtO.jpg',50,45,'<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>','','','Jackect, Black','','physicalProduct',0.4,'product'),(3,4,1,5,'2019-06-13 01:50:10','Jackect 3','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsa','jackect-3','images.jpg','images.jpg','images.jpg',80,70,'<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>','','','Jackect, Black','','physicalProduct',0.4,'product'),(4,4,1,5,'2019-06-13 01:51:29','Jackect 4','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsa','jackect-4','p10035-stylish-men-s-fleece-jacket-black.jpg','p10035-stylish-men-s-fleece-jacket-black.jpg','p10035-stylish-men-s-fleece-jacket-black.jpg',75,55,'<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>','','','Jackect, Black','','physicalProduct',0.4,'product');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_title` varchar(255) DEFAULT NULL,
  `service_image` varchar(255) DEFAULT NULL,
  `service_description` text,
  `service_button` varchar(255) DEFAULT NULL,
  `service_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (4,'Gift Package ','service-1.jpg','<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>','Contact For Details and Rates','http://www.computerfever.com'),(5,'Sport Surprisre','service-2.jpg','<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>','Contact For Details and Rates','http://www.computerfever.com'),(6,'Radical Package','service-3.jpg','<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>','Contact For Details and Rates','http://www.computerfever.com');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_type` int(11) DEFAULT NULL,
  `shipping_zone` int(11) DEFAULT NULL,
  `shipping_country` varchar(2) DEFAULT NULL,
  `shipping_weight` decimal(10,0) DEFAULT NULL,
  `shipping_cost` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`shipping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping`
--

LOCK TABLES `shipping` WRITE;
/*!40000 ALTER TABLE `shipping` DISABLE KEYS */;
INSERT INTO `shipping` VALUES (1,3,5,NULL,1,5),(2,1,5,NULL,1,10),(3,2,0,'PT',1,14),(4,3,0,'PT',1,25);
/*!40000 ALTER TABLE `shipping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_types`
--

DROP TABLE IF EXISTS `shipping_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `shipping_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` text,
  `type_default` text,
  `type_local` text,
  `type_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_types`
--

LOCK TABLES `shipping_types` WRITE;
/*!40000 ALTER TABLE `shipping_types` DISABLE KEYS */;
INSERT INTO `shipping_types` VALUES (1,'New Day (orders placed before 7pm)','yes','yes',1),(2,'Speedy 1-2 days','no','yes',2),(3,'Standard 3-5 days','no','yes',3),(4,'Economy 5-7 days','no','yes',4),(5,'Express Internacional','yes','no',2),(6,'Standard Internacional','no','no',1);
/*!40000 ALTER TABLE `shipping_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `slider` (
  `slider_id` int(10) NOT NULL AUTO_INCREMENT,
  `slide_url` varchar(255) DEFAULT NULL,
  `slide_name` varchar(255) DEFAULT NULL,
  `slider_image` text,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES (2,'https://www.automag.pt/','slide1','C545B486-E99F-4977-9DFB-F115AFC52633.jpeg'),(3,'https://www.honda.pt/motorcycles.html','slide2','blog-steeltown-review-002.jpg'),(4,'http://www.motogp.com/','slide3','BLOG-MOTOGP-CHAMPS-005.jpg'),(5,'https://www.suzukimoto.pt/pt/inicio','slide4','Moto2-Francesco-Bagnaia-larga-na-pole-position-no-GP-da-Grã-Bretanha-e1535216941709.jpg');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `terms` (
  `term_id` int(10) NOT NULL AUTO_INCREMENT,
  `term_title` varchar(100) DEFAULT NULL,
  `term_link` varchar(100) DEFAULT NULL,
  `term_desc` text,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms`
--

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
INSERT INTO `terms` VALUES (1,'Rules And Regulations','rules','<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.&nbsp;</p>'),(2,'Refund Policy','link2','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).Why do we use it?It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on'),(3,'Pricing and Promotions Policy','link3','It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).Why do we use it?It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on');
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`wishlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zone_locations`
--

DROP TABLE IF EXISTS `zone_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `zone_locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) DEFAULT NULL,
  `location_code` text,
  `location_type` text,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zone_locations`
--

LOCK TABLES `zone_locations` WRITE;
/*!40000 ALTER TABLE `zone_locations` DISABLE KEYS */;
INSERT INTO `zone_locations` VALUES (14,6,'PT','country'),(15,6,'1300','postcode'),(16,6,'1311','postcode'),(17,6,'1200','postcode'),(18,7,'FR','country'),(19,7,'NL','country'),(20,7,'ES','country'),(21,7,'GB','country'),(24,5,'PT','country'),(25,5,'2460','postcode'),(26,5,'2410','postcode'),(27,5,'2445','postcode'),(28,5,'2145','postcode');
/*!40000 ALTER TABLE `zone_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `zones` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_name` text,
  `zone_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones`
--

LOCK TABLES `zones` WRITE;
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` VALUES (5,'Leiria',1),(6,'Lisbon',3),(7,'Europe',2);
/*!40000 ALTER TABLE `zones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-23  5:27:39
