# ************************************************************
# Host: 127.0.0.1 (MySQL 5.7.20)
# Database: basic-rest
# Generation Time: 2017-11-21 21:57:16 +0000
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

CREATE TABLE `offers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `discount` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table recipients
# ------------------------------------------------------------

CREATE TABLE `recipients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table vouchers
# ------------------------------------------------------------

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




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
