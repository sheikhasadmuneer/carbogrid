/*
SQLyog Community v8.55 
MySQL - 5.1.36-community-log : Database - carbo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `city` */

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `city` */

insert  into `city`(`id`,`country_id`,`name`) values (1,NULL,'Târgu Mureș');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `opinion` text COLLATE utf8_unicode_ci,
  `city` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `ip_address` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` time DEFAULT NULL,
  `pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`age`,`active`,`opinion`,`city`,`start_time`,`end_time`,`ip_address`,`time`,`pic`) values (1,'lajos',30,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'dioslaska',25,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'geza',20,0,'Not so good.',1,NULL,NULL,NULL,NULL,NULL),(18,'lajoska',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'kecske',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'eleonora',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'vizi',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'hegyi',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'halmi',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'korti',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'alamala',25,0,'Good.',NULL,NULL,NULL,NULL,NULL,NULL),(25,'alaja',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,'kiss',15,0,NULL,1,NULL,NULL,NULL,NULL,NULL),(30,'kelemen',20,0,'Niceee',1,NULL,NULL,NULL,NULL,NULL),(32,'aaaaa',40,1,NULL,1,'2011-11-04 12:37:00',NULL,'127.0.0.1','14:38:00','Penguins.jpg'),(35,'lajossss',123,1,NULL,NULL,'2011-11-08 13:20:00',NULL,'127.0.0.1',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
