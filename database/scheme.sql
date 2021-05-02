/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.14-MariaDB : Database - pharamcy
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pharamcy` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `pharamcy`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(512) COLLATE utf8_bin NOT NULL,
  `password` varchar(1024) COLLATE utf8_bin NOT NULL,
  `status` varchar(1024) COLLATE utf8_bin DEFAULT 'PENDING',
  `role` varchar(1024) COLLATE utf8_bin DEFAULT 'USER',
  `user_id` int(10) unsigned zerofill NOT NULL,
  `token` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `token_created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_accounts_email` (`email`),
  KEY `fk_accounts_users` (`user_id`),
  CONSTRAINT `fk_accounts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `accounts` */

insert  into `accounts`(`id`,`email`,`password`,`status`,`role`,`user_id`,`token`,`token_created_at`) values 
(1,'example1111@gmail.com','123','PENDING','USER',0000000001,NULL,NULL),
(2,'sanida@gmail.com','202cb962ac59075b964b07152d234b70','ACTIVE','ADMIN',0000000002,NULL,NULL),
(4,'sunita@gmail.com','202cb962ac59075b964b07152d234b70','PENDING','USER',0000000005,NULL,NULL),
(6,'samija@gmail.com','202cb962ac59075b964b07152d234b70','ACTIVE','USER_READ_ONLY',0000000006,NULL,NULL),
(59,'example@gmail.com','202cb962ac59075b964b07152d234b70','ACTIVE','USER',0000000002,NULL,'2021-05-01 22:14:56'),
(60,'user1@gmail.com','123','PENDING','USER',0000000002,'1eca88b9679012c89e69ee026cf7afe0',NULL),
(62,'example123@gmail.com','123','PENDING','USER',0000000055,'0dee454e3b3eeef1b8351eacc947c707',NULL),
(65,'ajla1@gmail.com','123','PENDING','USER',0000000058,'4a02d78166fb5e7e528d4cfab708dc21',NULL),
(67,'ajla12@gmail.com','123','PENDING','USER',0000000060,'7a99ecce3c6b0198b0209913126189e1',NULL),
(68,'work@gmail.com','202cb962ac59075b964b07152d234b70','ACTIVE','USER',0000000061,'64610ba7d4964966d2342d1b4a6c398c',NULL),
(70,'example1@gmail.com','202cb962ac59075b964b07152d234b70','PENDING','USER',0000000063,'303eb6d6ac618640117a211ac0766f8b',NULL),
(87,'naida@gmail.com','202cb962ac59075b964b07152d234b70','PENDING','USER',0000000078,'9378c139c797bb1ec12c44337debd4f9',NULL),
(90,'naida.fatic@gmail.com','202cb962ac59075b964b07152d234b70','ACTIVE','USER',0000000081,NULL,'2021-04-10 15:29:09'),
(94,'naidafatic@gmail.com','202cb962ac59075b964b07152d234b70','ACTIVE','USER',0000000085,NULL,'2021-05-02 14:47:00');

/*Table structure for table `carts` */

DROP TABLE IF EXISTS `carts`;

CREATE TABLE `carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(11) DEFAULT 1,
  `status` varchar(32) NOT NULL DEFAULT 'IN_CART',
  `medicine_id` int(11) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_accounts_carts` (`account_id`),
  KEY `fk_medicines_carts` (`medicine_id`),
  CONSTRAINT `fk_accounts_carts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `fk_medicines_carts` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;

/*Data for the table `carts` */

insert  into `carts`(`id`,`quantity`,`status`,`medicine_id`,`account_id`) values 
(3,1,'PURCHASED',1,2),
(4,10,'PURCHASED',3,2),
(5,10,'PURCHASED',1,2),
(6,1,'PURCHASED',10,2),
(17,1,'PURCHASED',1,59),
(18,1,'PURCHASED',10,59),
(19,1,'PURCHASED',10,59),
(20,1,'PURCHASED',10,59),
(21,1,'PURCHASED',10,59),
(22,1,'PURCHASED',1,59),
(23,1,'BOUGHT',1,2),
(24,1,'BOUGHT',1,2),
(25,1,'PURCHASED',1,59),
(26,1,'PURCHASED',1,59),
(27,1,'PURCHASED',1,59),
(28,1,'PURCHASED',1,59),
(29,1,'PURCHASED',17,59),
(30,1,'PURCHASED',17,59),
(31,1,'PURCHASED',1,59),
(32,10,'PURCHASED',1,59),
(33,1,'PURCHASED',1,59),
(34,5,'PURCHASED',5,94),
(35,5,'PURCHASED',5,94),
(36,5,'PURCHASED',5,94),
(37,5,'PURCHASED',5,94),
(38,1,'PURCHASED',5,94),
(39,5,'PURCHASED',5,94),
(40,5,'PURCHASED',5,94),
(41,5,'PURCHASED',5,94),
(42,5,'PURCHASED',5,94),
(43,5,'PURCHASED',5,94),
(44,5,'PURCHASED',5,94),
(45,5,'PURCHASED',5,94),
(46,5,'PURCHASED',5,94),
(47,5,'PURCHASED',5,94),
(48,5,'PURCHASED',5,94),
(49,2,'PURCHASED',5,94),
(50,2,'PURCHASED',5,94),
(51,5,'PURCHASED',5,94),
(52,5,'PURCHASED',5,94),
(53,5,'PURCHASED',1,94);

/*Table structure for table `medicines` */

DROP TABLE IF EXISTS `medicines`;

CREATE TABLE `medicines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) COLLATE utf8_bin NOT NULL,
  `company_name` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `price` double NOT NULL,
  `description` text COLLATE utf8_bin DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `on_stock` tinyint(1) NOT NULL DEFAULT 1,
  `quantity` int(11) NOT NULL DEFAULT 10,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `medicines` */

insert  into `medicines`(`id`,`name`,`company_name`,`price`,`description`,`added_at`,`on_stock`,`quantity`) values 
(1,'new name','company name',0,'description','2021-05-02 21:24:03',1,0),
(3,'kafetin','123',3.99,'for pain','2021-03-20 20:16:27',1,10),
(4,'kafetin','123',3.99,'for pain','2021-03-20 20:16:27',1,10),
(5,'kafetin','123',3.99,'for pain','2021-05-02 17:10:11',1,0),
(6,'vitamin E','bosnalijek',7.99,'for corona','2021-03-20 21:09:24',1,10),
(7,'tablete2','bosnalijek',100.99,'for corona','2021-03-20 20:30:56',1,10),
(8,'tablete3','company',100.99,'for corona','2021-03-20 20:31:20',1,10),
(9,'name','company name',0,'description','2021-04-05 20:00:27',1,10),
(10,'moderna','moederna',50.01,'its corona time','2021-04-05 20:01:32',1,10),
(11,'moderna','moederna',50.01,'its corona time','2021-04-05 20:03:25',1,10),
(12,'moderna','moederna',50.01,'its corona time','2021-04-05 20:04:52',1,10),
(13,'name','company name',0,'description','2021-04-05 22:05:45',1,10),
(14,'name','company name',0,'description','2021-04-05 22:21:26',1,10),
(15,'NULL','company name',0,'description','2021-04-05 22:21:35',1,10),
(16,'nn','company name',0,'description','2021-04-05 22:22:29',1,10),
(17,'name','company name',0,'description','2021-04-10 13:18:08',1,0),
(18,'name','company name',0,'description','2021-04-05 22:32:03',1,10),
(19,'name','company name',0,'description','2021-05-01 21:33:04',1,10);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) COLLATE utf8_bin NOT NULL,
  `image_url` varchar(1024) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `category` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`image_url`,`price`,`category`) values 
(1,'Mate Wrist Waterproof Bluetooth Smart Watch For Android HTC Samsung iPhone iOS','https://i.ebayimg.com/images/g/VZQAAOSwocxgAX5c/s-l1600.png',26.13,'Jewelry & Watches'),
(2,'Samsung Galaxy Note10 - 256GB','https://i.ebayimg.com/images/g/T2IAAOSw0OVf-hZk/s-l1600.jpg',425,'Cell Phones & Accessories'),
(3,'Adidas Yeezy 500, New in box, US 10, F36640','https://i.ebayimg.com/images/g/Y-QAAOSwzw9gYOw9/s-l1600.png',210,'Clothing, Shoes & Accessories');

/*Table structure for table `purchases` */

DROP TABLE IF EXISTS `purchases`;

CREATE TABLE `purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(512) COLLATE utf8_bin NOT NULL,
  `zip` varchar(512) COLLATE utf8_bin NOT NULL,
  `phone_number` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_id` int(10) unsigned NOT NULL,
  `cart_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_accounts_purchases` (`account_id`),
  KEY `fk_carts_purchases` (`cart_id`),
  CONSTRAINT `fk_accounts_purchases` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `fk_carts_purchases` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `purchases` */

insert  into `purchases`(`id`,`city`,`zip`,`phone_number`,`date`,`account_id`,`cart_id`) values 
(2,'Sarajevo','71000',337,'2021-03-13 16:21:14',2,3),
(3,'Sarajevo','71000',337,'2021-03-13 16:45:25',2,3),
(4,'Sarajevo','71000',337,'2021-03-13 16:48:10',2,3),
(5,'Sarajevo','17000',33033033,'2021-04-09 20:54:47',59,22),
(7,'Sarajevo','17000',33033033,'2021-04-09 21:40:33',59,19),
(11,'Sarajevo','17000',33033033,'2021-04-09 21:57:01',59,19),
(12,'Sarajevo','17000',33033033,'2021-04-09 21:57:28',59,19),
(13,'Sarajevo','17000',33033033,'2021-04-09 21:57:28',59,20),
(14,'Sarajevo','17000',33033033,'2021-04-09 21:57:28',59,21),
(15,'Sarajevo','17000',33033033,'2021-04-09 21:57:28',59,22),
(16,'Sarajevo','17000',33033033,'2021-04-09 22:00:45',59,19),
(17,'Sarajevo','17000',33033033,'2021-04-09 22:00:45',59,20),
(18,'Sarajevo','17000',33033033,'2021-04-09 22:00:45',59,21),
(20,'Sarajevo','17000',33033033,'2021-04-09 23:49:57',2,3),
(21,'Sarajevo','17000',33033033,'2021-04-09 23:49:57',2,4),
(22,'Sarajevo','17000',33033033,'2021-04-09 23:49:57',2,5),
(23,'Sarajevo','17000',33033033,'2021-04-09 23:49:57',2,6),
(24,'Sarajevo','17000',33033033,'2021-04-09 23:53:09',2,3),
(25,'Sarajevo','17000',33033033,'2021-04-09 23:53:09',2,4),
(26,'Sarajevo','17000',33033033,'2021-04-09 23:53:09',2,5),
(27,'Sarajevo','17000',33033033,'2021-04-09 23:53:09',2,6),
(28,'Sarajevo','17000',33033033,'2021-04-10 11:09:19',59,17),
(29,'Sarajevo','17000',33033033,'2021-04-10 11:09:19',59,18),
(30,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,17),
(31,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,18),
(32,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,19),
(33,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,20),
(34,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,21),
(35,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,22),
(36,'Mostar','17000',33033033,'2021-04-25 16:53:49',59,25),
(37,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,26),
(38,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,27),
(39,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,28),
(40,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,29),
(41,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,30),
(42,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,31),
(43,'Sarajevo','17000',33033033,'2021-04-10 13:19:04',59,32),
(44,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,17),
(45,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,18),
(46,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,19),
(47,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,20),
(48,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,21),
(49,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,22),
(50,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,25),
(51,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,26),
(52,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,27),
(53,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,28),
(54,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,29),
(55,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,30),
(56,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,31),
(57,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,32),
(58,'Sarajevo','17000',33033033,'2021-05-01 21:29:17',59,33),
(59,'Sarajevo','17000',33033033,'2021-05-02 14:49:07',94,34),
(60,'Sarajevo','17000',33033033,'2021-05-02 17:30:01',94,34),
(61,'Sarajevo','17000',33033033,'2021-05-02 17:30:01',94,35),
(62,'Sarajevo','17000',33033033,'2021-05-02 17:40:56',94,34),
(63,'Sarajevo','17000',33033033,'2021-05-02 17:40:56',94,35),
(64,'Sarajevo','17000',33033033,'2021-05-02 17:40:56',94,36),
(65,'Sarajevo','17000',33033033,'2021-05-02 17:53:00',94,34),
(66,'Sarajevo','17000',33033033,'2021-05-02 17:53:00',94,35),
(67,'Sarajevo','17000',33033033,'2021-05-02 17:53:00',94,36),
(68,'Sarajevo','17000',33033033,'2021-05-02 17:53:00',94,37),
(69,'Sarajevo','17000',33033033,'2021-05-02 18:16:20',94,34),
(70,'Sarajevo','17000',33033033,'2021-05-02 18:16:20',94,35),
(71,'Sarajevo','17000',33033033,'2021-05-02 18:16:20',94,36),
(72,'Sarajevo','17000',33033033,'2021-05-02 18:16:20',94,37),
(73,'Sarajevo','17000',33033033,'2021-05-02 18:16:20',94,38),
(74,'Sarajevo','17000',33033033,'2021-05-02 18:16:20',94,39),
(75,'Sarajevo','17000',33033033,'2021-05-02 18:31:03',94,34),
(76,'Sarajevo','17000',33033033,'2021-05-02 18:31:03',94,35),
(77,'Sarajevo','17000',33033033,'2021-05-02 18:31:03',94,36),
(78,'Sarajevo','17000',33033033,'2021-05-02 18:31:03',94,37),
(79,'Sarajevo','17000',33033033,'2021-05-02 18:31:03',94,38),
(80,'Sarajevo','17000',33033033,'2021-05-02 18:31:03',94,39),
(81,'Sarajevo','17000',33033033,'2021-05-02 18:31:03',94,40),
(82,'Sarajevo','17000',33033033,'2021-05-02 18:31:03',94,41),
(83,'Sarajevo','17000',33033033,'2021-05-02 18:31:03',94,42),
(84,'Sarajevo','17000',33033033,'2021-05-02 18:48:18',94,34),
(85,'Sarajevo','17000',33033033,'2021-05-02 18:48:18',94,35),
(86,'Sarajevo','17000',33033033,'2021-05-02 18:48:18',94,36),
(87,'Sarajevo','17000',33033033,'2021-05-02 18:48:18',94,37),
(88,'Sarajevo','17000',33033033,'2021-05-02 18:48:18',94,38),
(89,'Sarajevo','17000',33033033,'2021-05-02 18:48:18',94,39),
(90,'Sarajevo','17000',33033033,'2021-05-02 18:48:18',94,40),
(91,'Sarajevo','17000',33033033,'2021-05-02 18:48:18',94,41),
(92,'Sarajevo','17000',33033033,'2021-05-02 18:48:18',94,42),
(93,'Sarajevo','17000',33033033,'2021-05-02 18:48:18',94,43),
(94,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,34),
(95,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,35),
(96,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,36),
(97,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,37),
(98,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,38),
(99,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,39),
(100,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,40),
(101,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,41),
(102,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,42),
(103,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,43),
(104,'Sarajevo','17000',33033033,'2021-05-02 18:48:52',94,44),
(105,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,34),
(106,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,35),
(107,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,36),
(108,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,37),
(109,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,38),
(110,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,39),
(111,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,40),
(112,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,41),
(113,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,42),
(114,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,43),
(115,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,44),
(116,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,45),
(117,'Sarajevo','17000',33033033,'2021-05-02 19:04:09',94,46),
(118,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,34),
(119,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,35),
(120,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,36),
(121,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,37),
(122,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,38),
(123,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,39),
(124,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,40),
(125,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,41),
(126,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,42),
(127,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,43),
(128,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,44),
(129,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,45),
(130,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,46),
(131,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,47),
(132,'Sarajevo','17000',33033033,'2021-05-02 20:59:03',94,48),
(133,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,34),
(134,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,35),
(135,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,36),
(136,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,37),
(137,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,38),
(138,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,39),
(139,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,40),
(140,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,41),
(141,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,42),
(142,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,43),
(143,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,44),
(144,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,45),
(145,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,46),
(146,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,47),
(147,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,48),
(148,'Sarajevo','17000',33033033,'2021-05-02 21:07:57',94,49),
(149,'Sarajevo','17000',33033033,'2021-05-02 21:08:40',94,50),
(150,'Sarajevo','17000',33033033,'2021-05-02 21:23:00',94,51),
(151,'Sarajevo','17000',33033033,'2021-05-02 21:24:25',94,52),
(152,'Sarajevo','17000',33033033,'2021-05-02 21:24:25',94,53);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) COLLATE utf8_bin NOT NULL,
  `surname` varchar(512) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`surname`) values 
(1,'Naida_ADMIN','Fatic'),
(2,'Sanida','Fatic'),
(5,'Sunita','Bektasevic'),
(6,'Samija','Kustura'),
(7,'Lamija','Babović'),
(19,'ajla','smajic'),
(21,'ajla','smajic'),
(54,'name','surname'),
(55,'name','surname'),
(56,'name','surname'),
(57,'ajla','smajic'),
(58,'ajla','smajic'),
(59,'ajla','smajic'),
(60,'ajla','smajic'),
(61,'work','work'),
(62,'work','work'),
(63,'name1','surnam1e'),
(71,'Naida','Fatic'),
(72,'Naida','Fatic'),
(73,'Naida','Fatic'),
(74,'Naida','Fatic'),
(75,'name','surname'),
(76,'name','surname'),
(77,'name','surname'),
(78,'name','surname'),
(79,'name','surname'),
(80,'name','surname'),
(81,'name','surname'),
(82,'naida.fatic','fff'),
(83,'name','surname'),
(84,'name','surname'),
(85,'name','surname');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
