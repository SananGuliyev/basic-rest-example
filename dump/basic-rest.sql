# ************************************************************
# Host: 127.0.0.1 (MySQL 5.7.20)
# Database: basic-rest
# Generation Time: 2017-11-21 08:06:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table offers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `offers`;

CREATE TABLE `offers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `discount` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;

INSERT INTO `offers` (`id`, `name`, `discount`)
VALUES
	(1,'New Year',25);

/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table recipients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `recipients`;

CREATE TABLE `recipients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `recipients` WRITE;
/*!40000 ALTER TABLE `recipients` DISABLE KEYS */;

INSERT INTO `recipients` (`id`, `name`, `email`)
VALUES
	(1,'Sanan','sanan@guliev.info'),
	(2,'Carolin','maiwald@newsletter2go.com');

/*!40000 ALTER TABLE `recipients` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vouchers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vouchers`;

CREATE TABLE `vouchers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) unsigned NOT NULL,
  `recipient_id` int(11) unsigned NOT NULL,
  `code` varchar(50) NOT NULL DEFAULT '',
  `expiration` date NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `used_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offer_id` (`offer_id`),
  KEY `recipient_id` (`recipient_id`),
  CONSTRAINT `vouchers_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `vouchers_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `recipients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `vouchers` WRITE;
/*!40000 ALTER TABLE `vouchers` DISABLE KEYS */;

INSERT INTO `vouchers` (`id`, `offer_id`, `recipient_id`, `code`, `expiration`, `is_used`, `used_at`)
VALUES
	(1,1,1,'QWERTYUI','2017-12-12',0,NULL),
	(2,1,1,'ASDFGHJK','2017-12-12',0,NULL);

/*!40000 ALTER TABLE `vouchers` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
