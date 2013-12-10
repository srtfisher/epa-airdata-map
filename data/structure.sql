/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table emissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `emissions`;

CREATE TABLE `emissions` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` bigint(11) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT '',
  `amount` bigint(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table pollutants
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pollutants`;

CREATE TABLE `pollutants` (
  `type` varchar(100) NOT NULL DEFAULT '',
  `description` text,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table site
# ------------------------------------------------------------

DROP TABLE IF EXISTS `site`;

CREATE TABLE `site` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `facility_id` bigint(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `state` varchar(100) NOT NULL DEFAULT '',
  `zip` int(100) NOT NULL,
  `address` varchar(100) NOT NULL DEFAULT '',
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `industry` varchar(100) DEFAULT '',
  `monitor` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
