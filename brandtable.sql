/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.1.25-MariaDB : Database - erl
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`erl` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `erl`;

/*Table structure for table `stockproductbrand` */

DROP TABLE IF EXISTS `stockproductbrand`;

CREATE TABLE `stockproductbrand` (
  `brandid` int(8) NOT NULL AUTO_INCREMENT,
  `productid` int(8) DEFAULT NULL,
  `brandname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `createuser` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`brandid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `stockproductbrand` */

insert  into `stockproductbrand`(`brandid`,`productid`,`brandname`,`createdate`,`createuser`) values 
(1,10,'Segate','2021-11-08 23:30:08',''),
(2,10,'Transcend','2021-11-08 23:31:05',NULL),
(3,10,'Samsung','2021-11-08 23:31:22',NULL),
(4,10,'Twinmos','2021-11-08 23:32:25',NULL),
(5,22,'Samsung','2021-11-08 23:32:25',NULL),
(6,22,'Twinmos','2021-11-08 23:32:25',NULL),
(7,22,'Transcend','2021-11-08 23:32:25',NULL),
(8,10,'Western Digital','2021-11-08 23:32:25',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
