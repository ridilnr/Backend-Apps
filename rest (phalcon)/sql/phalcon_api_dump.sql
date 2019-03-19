# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.9)
# Database: phalcon_api
# Generation Time: 2016-03-31 12:34:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cars
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cars`;

CREATE TABLE `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_name` varchar(45) NOT NULL,
  `reg_date` datetime NOT NULL,
  `license_plate_no` char(7) NOT NULL,
  `engine_no` int(11) NOT NULL,
  `tax_payment` datetime DEFAULT NULL,
  `car_model` varchar(20) DEFAULT NULL,
  `car_model_year` year(4) DEFAULT NULL,
  `seating_capacity` tinyint(1) DEFAULT NULL,
  `horse_power` smallint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `license_plate_no_UNIQUE` (`license_plate_no`),
  UNIQUE KEY `engine_no_UNIQUE` (`engine_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;

INSERT INTO `cars` (`id`, `owner_name`, `reg_date`, `license_plate_no`, `engine_no`, `tax_payment`, `car_model`, `car_model_year`, `seating_capacity`, `horse_power`)
VALUES
	(1,'Manish Kumar','1997-09-08 00:00:00','ABC-007',3488057,'2016-06-30 00:00:00','Cini Mooper','1995',4,1800),
	(2,'John Doe','2006-09-08 00:00:00','EFG-123',3488058,'2016-06-30 00:00:00','MOYOTA MOROLLA','2005',4,1200),
	(3,'James Bond','2016-01-01 00:00:00','XYZ-007',3488059,'2016-06-30 00:00:00','Mston Aartin','2016',4,2000);

/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
