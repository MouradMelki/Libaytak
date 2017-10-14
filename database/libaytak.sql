-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2016 at 04:51 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libaytak`
--

-- --------------------------------------------------------

--
-- Table structure for table `habitat`
--

DROP TABLE IF EXISTS `habitat`;
CREATE TABLE IF NOT EXISTS `habitat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `NbrOfPers` int(11) DEFAULT NULL,
  `RentBuy` tinyint(1) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `NbrOfRooms` int(11) DEFAULT NULL,
  `NbrOfToilets` int(11) DEFAULT NULL,
  `NbrOfBeds` int(11) DEFAULT NULL,
  `NbrOfBathrooms` int(11) DEFAULT NULL,
  `surface` bigint(20) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type` (`id_type`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `habitat`
--

INSERT INTO `habitat` (`id`, `id_type`, `id_user`, `NbrOfPers`, `RentBuy`, `description`, `NbrOfRooms`, `NbrOfToilets`, `NbrOfBeds`, `NbrOfBathrooms`, `surface`, `price`) VALUES
(1, 1, 4, 3, 1, '482 BHAMDOUN is a calm residential project ln Bhamdoun village in a calm & luxury neighboring & non stop mountain view, has a unique modern architect touch & deluxe finishing\r\n\r\n-2 parking spots in GF', 3, 1, 3, 2, 145, 209960),
(2, 1, 4, 3, 1, 'Only 2 minutes away from the beach, Cap Sur Mer is a luxurious resort that can be easily accessed through the highway and is surrounded by all necessities you need from shops, beaches, restaurants, kinder-gardens, schools, hospitals', 2, 1, 2, 1, 99, 141750),
(3, 1, 4, 3, 1, 'The building is under construction\r\nThe apartment is based on the S/S1 floor includes a kitchen open to living & dinning room, with garden 16 sqm + storage room + 2 parkings . It has an amazing open valley view.', 2, 2, 2, 2, 121, 137000),
(4, 1, 4, 3, 1, 'The concept of space is changing all over the world.\r\nThe global trend of smaller apartments has come to the heart of Beirut thanks to the creative and innovative firm Cityscape.', 4, 3, 4, 3, 149, 660000),
(5, 6, 4, 3, 1, 'The concept of space is changing all over the world.\r\nThe global trend of smaller apartments has come to the heart of Beirut thanks to the creative and innovative firm Cityscape', 4, 6, 4, 6, 188, 1050000);

-- --------------------------------------------------------

--
-- Table structure for table `habitatpics`
--

DROP TABLE IF EXISTS `habitatpics`;
CREATE TABLE IF NOT EXISTS `habitatpics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_habitat` int(11) NOT NULL,
  `directoryPIC` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_habitat` (`id_habitat`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `habitatpics`
--

INSERT INTO `habitatpics` (`id`, `id_habitat`, `directoryPIC`) VALUES
(1, 1, '../images/habitat/65048-2d3efo.jpg'),
(2, 1, '../images/habitat/65048-60997o.jpg'),
(3, 2, '../images/habitat/100740-60d22o.jpg'),
(4, 2, '../images/habitat/100740-140a3o.jpg'),
(5, 3, '../images/habitat/105461-e27eao.jpg'),
(6, 3, '../images/habitat/105461-fadado.jpg'),
(7, 4, '../images/habitat/95332-49f24o.jpg'),
(8, 4, '../images/habitat/95332-22541o.jpg'),
(9, 5, '../images/habitat/33670-7268bo.jpg'),
(10, 5, '../images/habitat/33670-d61dco.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `habitattypes`
--

DROP TABLE IF EXISTS `habitattypes`;
CREATE TABLE IF NOT EXISTS `habitattypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `habType` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `habitattypes`
--

INSERT INTO `habitattypes` (`id`, `habType`) VALUES
(1, 'Apartment'),
(2, 'Villa'),
(3, 'Townhouse'),
(4, 'Penthouse'),
(5, 'Compound'),
(6, 'Duplex'),
(7, 'Chalet'),
(8, 'Studio'),
(9, 'Full floor'),
(10, 'Half floor'),
(11, 'Bungalow');

-- --------------------------------------------------------

--
-- Table structure for table `loccity`
--

DROP TABLE IF EXISTS `loccity`;
CREATE TABLE IF NOT EXISTS `loccity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(50) DEFAULT NULL,
  `imagepath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loccity`
--

INSERT INTO `loccity` (`id`, `city`, `imagepath`) VALUES
(1, 'Beirut', '../images/beirut.jpg'),
(2, 'Bint Jbeil', NULL),
(3, 'Hasbaya', NULL),
(4, 'Marjeyoun', NULL),
(5, 'Nabatieh', NULL),
(6, 'Baalbeck', '../images/baalbeck.jpg'),
(7, 'Hermel', NULL),
(8, 'Rashaya', NULL),
(9, 'Beqaa', NULL),
(10, 'Zahle', NULL),
(11, 'Akkar', NULL),
(12, 'Batroun', NULL),
(13, 'Bsharri', NULL),
(14, 'Koura', NULL),
(15, 'Miniyeh-Danniyeh', NULL),
(16, 'Tripoli', '../images/tripoli.jpg'),
(17, 'Zgharta', NULL),
(18, 'Aley', '../images/aley.jpg'),
(19, 'Baabda', NULL),
(20, 'Jbeil', '../images/jbeil.jpg'),
(21, 'Chouf', NULL),
(22, 'Keserwan', NULL),
(23, 'Matn', NULL),
(24, 'Jezzine', '../images/jezzine.jpg'),
(25, 'Sidon', '../images/sidon.jpg'),
(26, 'Tyre', '../images/tyre.jpg'),
(27, 'Jounieh', '../images/jounieh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lochabitat`
--

DROP TABLE IF EXISTS `lochabitat`;
CREATE TABLE IF NOT EXISTS `lochabitat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_locCity` int(11) NOT NULL,
  `coorX` float DEFAULT NULL,
  `coorY` float DEFAULT NULL,
  `id_habitat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_locCity` (`id_locCity`),
  KEY `id_habitat` (`id_habitat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lochabitat`
--

INSERT INTO `lochabitat` (`id`, `id_locCity`, `coorX`, `coorY`, `id_habitat`) VALUES
(1, 18, 33.8084, 35.6607, 1),
(2, 27, 33.9877, 35.6389, 2),
(3, 20, 34.131, 35.67, 3),
(4, 1, 33.8989, 35.4734, 4),
(5, 1, 33.8989, 35.4734, 5);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `stars` float DEFAULT NULL,
  `id_habitat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_habitat` (`id_habitat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `passwd` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `age` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passwd`, `email`, `phone`, `age`, `gender`) VALUES
(4, 'emilehoyek', 'fe70503616b8cb1ea7ca2b33015d3e27b00f97287ba4397ecd888b4a9aa1ef52', 'emile@emile', 321321, '1994-05-24', 0),
(6, 'samerhamadeh', '4c23a533f9cc073e1c1d9356e1718b8d32627a65ca8411fa7171e00edbb2dcd6', 'samer@samer', 71789177, '1994-06-29', 1),
(7, 'mouradmelki', '1fc48f2de1a0bf391e57853f719f7d30a9a5ef90b110c25813dfcc22da95f063', 'mourad@mourad', 9999999, '1994-03-03', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `habitat`
--
ALTER TABLE `habitat`
  ADD CONSTRAINT `habitat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `habitat_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `habitattypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `habitatpics`
--
ALTER TABLE `habitatpics`
  ADD CONSTRAINT `habitatpics_ibfk_1` FOREIGN KEY (`id_habitat`) REFERENCES `habitat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lochabitat`
--
ALTER TABLE `lochabitat`
  ADD CONSTRAINT `lochabitat_ibfk_1` FOREIGN KEY (`id_locCity`) REFERENCES `loccity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lochabitat_ibfk_2` FOREIGN KEY (`id_habitat`) REFERENCES `habitat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`id_habitat`) REFERENCES `habitat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
