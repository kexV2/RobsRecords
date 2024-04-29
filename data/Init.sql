-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.3.0 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for robsrecords
CREATE DATABASE IF NOT EXISTS `robsrecords` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `robsrecords`;

-- Dumping structure for table robsrecords.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `adminid` int NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `adminusername` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table robsrecords.admins: ~3 rows (approximately)
INSERT INTO `admins` (`adminid`, `firstname`, `lastname`, `adminusername`, `email`, `password`) VALUES
	(1, 'David', 'Mcguirk', 'DavidMcGuirk_Admin', 'DavidMcGuirk@robsrecords.ie', 'Test1234'),
	(2, 'Dylan', 'Keogh', 'DylanKeogh_Admin', 'DylanKeogh@robsrecords.ie', 'Test1234'),
	(3, 'Reece', 'OBrien', 'ReeceOBrien_Admin', 'ReeceOBrien@robsrecords.ie', 'Test1234');

-- Dumping structure for table robsrecords.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `CustomerId` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`CustomerId`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table robsrecords.customers: ~1 rows (approximately)
INSERT INTO `customers` (`CustomerId`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
	(30, 'David', 'mcguirk', 'NotFios', 'davidmcguirk65@gmail.com', 'sfsf');

-- Dumping structure for table robsrecords.deliveries
CREATE TABLE IF NOT EXISTS `deliveries` (
  `deliveryid` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `delivery_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`deliveryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table robsrecords.deliveries: ~0 rows (approximately)

-- Dumping structure for table robsrecords.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `employeeid` int NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `employeeUsername` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`employeeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table robsrecords.employees: ~0 rows (approximately)

-- Dumping structure for table robsrecords.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `album_duration` time DEFAULT NULL,
  `imgur` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table robsrecords.products: ~6 rows (approximately)
INSERT INTO `products` (`id`, `name`, `artist`, `price`, `genre`, `stock`, `album_duration`, `imgur`) VALUES
	(1, 'Rodeo', 'Travis Scott', 40.00, 'Rap', 10, '01:15:00', 'https://images-ext-1.discordapp.net/external/Ki4bJd59sGMrkzoSODezI7-rkAOIX0f6pqw5QVsSuN0/https/images.genius.com/c4bb8ce84ca234c188ef096bda62ca4b.1000x1000x1.jpg?format=webp&width=676&height=676'),
	(2, 'Good Intentions', 'Nav', 69.42, 'Rap', 5, '00:49:57', 'https://images-ext-1.discordapp.net/external/80VSn4jj52ON9_OT1zBoCNYNuWN60J_NNxSt3xGw9Os/https/upload.wikimedia.org/wikipedia/en/d/d4/Nav_-_Good_Intentions.png?format=webp&quality=lossless'),
	(3, 'Dark side of the moon', 'Pink Floyd', 25.00, 'Rock', 50, '00:42:36', 'https://images-ext-1.discordapp.net/external/uRvhGU1FGbDmn3ojUqDumWeTwA02GSDQG4J5_iRo3wU/https/silveradostar.com/wp-content/uploads/2021/01/dark-side-of-the-moon.jpg?format=webp&width=676&height=676'),
	(4, 'Thriller', 'Michael Jackson', 29.99, 'Disco Pop', 20, '00:42:21', 'https://images-ext-1.discordapp.net/external/9eBGUzF8kzZ0CZGl1Un_yc4HAwLUbD-5MADozhwBfx8/https/static.dw.com/image/63920593_605.jpg?format=webp'),
	(5, 'Continuum', 'John Mayer', 1.99, 'Blues', 22, '00:49:52', 'https://images-ext-1.discordapp.net/external/DR9QiY7eNnKqjngw9rpMJlWqy_fYF4Y1VB6Xg2pxLqk/https/m.media-amazon.com/images/I/51HwBgmgwWL._UF1000%2C1000_QL80_DpWeblab_.jpg?format=webp&width=769&height=676'),
	(6, 'American Dream', '21 Savage', 21.21, 'Rap', 21, '00:50:00', 'https://images-ext-1.discordapp.net/external/qxw6907MD_MUC7UNjuh81l4wGfsRB-yzI8g85Yfv3pM/https/upload.wikimedia.org/wikipedia/en/7/7b/AmericanDream.jpeg?format=webp');

-- Dumping structure for table robsrecords.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `ReviewId` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `message` text,
  `rating` decimal(3,2) DEFAULT NULL,
  `reviewedItem` int DEFAULT NULL,
  PRIMARY KEY (`ReviewId`),
  KEY `reviewedItem` (`reviewedItem`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`reviewedItem`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table robsrecords.reviews: ~1 rows (approximately)
INSERT INTO `reviews` (`ReviewId`, `username`, `message`, `rating`, `reviewedItem`) VALUES
	(1, 'example_username', 'This is a great product!', 5.00, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
