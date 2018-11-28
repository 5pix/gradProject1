-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.23 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных burgers
CREATE DATABASE IF NOT EXISTS `burgers` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `burgers`;

-- Дамп структуры для таблица burgers.users_order_info
CREATE TABLE IF NOT EXISTS `users_order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(256) NOT NULL,
  `userName` varchar(35) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `street` varchar(256) NOT NULL,
  `houseNumber` varchar(25) NOT NULL,
  `corps` varchar(25) NOT NULL,
  `flatNumber` varchar(25) NOT NULL,
  `floorNumber` varchar(25) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `backMoney` varchar(55) DEFAULT NULL,
  `notCall` varchar(55) NOT NULL,
  `countOrder` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='информация пользователя сделавшего заказ';

-- Экспортируемые данные не выделены.
-- Дамп структуры для таблица burgers.users_registration
CREATE TABLE IF NOT EXISTS `users_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(35) NOT NULL,
  `userEmail` varchar(256) NOT NULL,
  `usersPhone` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='заказы от пользователей';

-- Экспортируемые данные не выделены.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
