/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 5.1.72-community : Database - energeek-fullstack
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `application` */

DROP TABLE IF EXISTS `application`;

CREATE TABLE `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `position` int(11) NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `birthyear` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`position`),
  KEY `fk_application_position` (`position`),
  CONSTRAINT `fk_application_position` FOREIGN KEY (`position`) REFERENCES `position` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `application` */

insert  into `application`(`id`,`email`,`position`,`phone`,`birthyear`,`created_at`) values 
(1,'rizqinur2010@gmail.com',1,'1231-2312-3123',1231,'2022-05-21 07:48:54');

/*Table structure for table `position` */

DROP TABLE IF EXISTS `position`;

CREATE TABLE `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `position` */

insert  into `position`(`id`,`name`) values 
(1,'Frontend Web Programmer'),
(2,'Fullstack Web Programmer'),
(3,'Quality Control');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
