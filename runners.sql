-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2016 at 11:00 AM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `techrun`
--

-- --------------------------------------------------------

--
-- Table structure for table `runners`
--

CREATE TABLE IF NOT EXISTS `runners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `birth_date` date NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `company` text NOT NULL,
  `points` int(11) NOT NULL,
  `races` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `runners`
--

INSERT INTO `runners` (`id`, `first_name`, `last_name`, `birth_date`, `sex`, `email`, `phone`, `company`, `points`, `races`) VALUES
(1, 'Иван ', 'Иванов ', '1988-02-28', 'male', 'ivanovf@abv.bg', '0887569657', 'Musala', 100, '2'),
(2, 'Георги ', 'Георгиев', '1990-05-17', 'male', 'georgi@abv.bg', '0887563954', 'Musala', 86, '1'),
(3, 'Димо', 'Димов', '1992-01-29', 'male', 'dimo@abv.bg', '0882359686', 'TechHuddle', 120, '2'),
(4, 'Мария', 'Иванова', '1994-12-20', 'female', 'maria@abv.bg', '0885423635', 'Axway Bg', 85, '1'),
(5, 'Василена ', 'Красимирова', '1987-12-15', 'female', 'vasilena@abv.bg', '0896123656', 'SAP', 90, '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
