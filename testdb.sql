-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for test
CREATE DATABASE IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `test`;


-- Dumping structure for table test.albums
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table test.albums: ~0 rows (approximately)
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` (`id`, `name`, `artist_id`) VALUES
	(1, 'Artist_1-Album_1', 1),
	(2, 'Artist_1-Album_2', 1),
	(3, 'Artist_1-Album_3', 1),
	(4, 'Artist_2-Album_1', 2),
	(5, 'Artist_2-Album_2', 2),
	(6, 'Artist_3-Album_1', 3),
	(7, 'Artist_4-Album_1', 4);
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;


-- Dumping structure for table test.artists
CREATE TABLE IF NOT EXISTS `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table test.artists: ~0 rows (approximately)
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` (`id`, `name`, `country`) VALUES
	(1, 'Artist-1', 'Canada'),
	(2, 'Artist-2', 'USA'),
	(3, 'Artist-3', 'Japan'),
	(4, 'Artist-4', 'China');
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;


-- Dumping structure for table test.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `channel` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table test.orders: ~4 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `order_id`, `channel`) VALUES
	(1, 'Order-1', 'Amazon'),
	(2, 'Order-2', 'Amazon'),
	(3, 'Order-3', 'eBay'),
	(4, 'Order-4', 'Newegg');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;


-- Dumping structure for table test.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table test.order_items: ~7 rows (approximately)
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` (`id`, `order_id`, `sku`, `qty`, `price`) VALUES
	(1, 'Order-1', 'O1-Item-1', 1, 11.11),
	(2, 'Order-1', 'O1-Item-2', 1, 11.22),
	(3, 'Order-1', 'O1-Item-3', 1, 11.33),
	(4, 'Order-2', 'O2-Item-1', 2, 22.11),
	(5, 'Order-2', 'O2-Item-2', 2, 22.22),
	(6, 'Order-3', 'O3-Item-1', 3, 33.11),
	(7, 'Order-4', 'O4-Item-1', 4, 44.11);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;


-- Dumping structure for table test.order_shipping_address
CREATE TABLE IF NOT EXISTS `order_shipping_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table test.order_shipping_address: ~4 rows (approximately)
/*!40000 ALTER TABLE `order_shipping_address` DISABLE KEYS */;
INSERT INTO `order_shipping_address` (`id`, `order_id`, `name`, `address`) VALUES
	(1, 'Order-1', 'Name-1', 'Address-1'),
	(2, 'Order-2', 'Name-2', 'Address-2'),
	(3, 'Order-3', 'Name-3', 'Address-3'),
	(4, 'Order-4', 'Name-4', 'Address-4');
/*!40000 ALTER TABLE `order_shipping_address` ENABLE KEYS */;


-- Dumping structure for table test.parts
CREATE TABLE IF NOT EXISTS `parts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table test.parts: ~6 rows (approximately)
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` (`id`, `name`) VALUES
	(1, 'Part-1'),
	(2, 'Part-2'),
	(3, 'Part-3'),
	(4, 'Part-a'),
	(5, 'Part-b'),
	(6, 'Part-c');
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;


-- Dumping structure for table test.robots
CREATE TABLE IF NOT EXISTS `robots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `type` varchar(32) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table test.robots: ~3 rows (approximately)
/*!40000 ALTER TABLE `robots` DISABLE KEYS */;
INSERT INTO `robots` (`id`, `name`, `type`, `year`) VALUES
	(1, 'Robot-1', 'Type-1', 2016),
	(2, 'Robot-2', 'Type-2', 2015),
	(3, 'Robot-3', 'Type-3', 2014);
/*!40000 ALTER TABLE `robots` ENABLE KEYS */;


-- Dumping structure for table test.robots_parts
CREATE TABLE IF NOT EXISTS `robots_parts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `robots_id` int(10) NOT NULL,
  `parts_id` int(10) NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `robots_id` (`robots_id`),
  KEY `parts_id` (`parts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table test.robots_parts: ~6 rows (approximately)
/*!40000 ALTER TABLE `robots_parts` DISABLE KEYS */;
INSERT INTO `robots_parts` (`id`, `robots_id`, `parts_id`, `created_at`) VALUES
	(1, 1, 1, '2016-10-22'),
	(2, 1, 4, '2016-10-22'),
	(3, 2, 2, '2016-10-22'),
	(4, 2, 5, '2016-10-22'),
	(5, 3, 3, '2016-10-22'),
	(6, 3, 6, '2016-10-22');
/*!40000 ALTER TABLE `robots_parts` ENABLE KEYS */;


-- Dumping structure for table test.songs
CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) NOT NULL DEFAULT '0',
  `album_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(40) DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table test.songs: ~0 rows (approximately)
/*!40000 ALTER TABLE `songs` DISABLE KEYS */;
INSERT INTO `songs` (`id`, `artist_id`, `album_id`, `name`, `duration`) VALUES
	(1, 1, 1,  'Artist_1-Album_1-Song_1', '111'),
	(2, 1, 1,  'Artist_1-Album_1-Song_2', '112'),
	(3, 1, 2,  'Artist_1-Album_2-Song_1', '121'),
	(4, 1, 2,  'Artist_1-Album_2-Song_2', '122'),
	(5, 1, 3,  'Artist_1-Album_3-Song_1', '131'),
	(6, 1, 3,  'Artist_1-Album_3-Song_2', '132'),
	(7, 2, 1,  'Artist_2-Album_1-Song_1', '211'),
	(8, 2, 1,  'Artist_2-Album_1-Song_2', '212'),
	(9, 2, 2,  'Artist_2-Album_2-Song_1', '221'),
	(10, 2, 2, 'Artist_2-Album_2-Song_2', '222'),
	(11, 3, 1, 'Artist_3-Album_1-Song_1', '311'),
	(12, 3, 1, 'Artist_3-Album_1-Song_2', '312'),
	(13, 4, 1, 'Artist_4-Album_1-Song_1', '411'),
	(14, 4, 1, 'Artist_4-Album_1-Song_2', '412');
/*!40000 ALTER TABLE `songs` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
