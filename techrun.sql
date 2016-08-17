-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2016 at 04:55 PM
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
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `email` text CHARACTER SET utf8 NOT NULL,
  `phone` text CHARACTER SET utf8 NOT NULL,
  `website` text CHARACTER SET utf8 NOT NULL,
  `logo` text CHARACTER SET utf8 NOT NULL,
  `runners` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `races` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `phone`, `website`, `logo`, `runners`, `points`, `races`) VALUES
(1, 'SAP', 'sap@abv.bg', '0866955427', 'www.sap-labs.de', '', 5, 200, 2),
(2, 'Musala', 'musala@abv.bg', '0882755233', 'www.musala.com', '', 10, 240, 2),
(3, 'TechHuddle', 'techhuddle@abv.bg', '0886266955', 'www.techhuddle.com', '', 7, 300, 3),
(4, 'Nemetschek Bg', 'nemetschek@abv.bg', '0889578085', 'www.nemetschek.com', '', 3, 230, 1),
(5, 'Axway Bg', 'axway@abv.bg', '0888076565', 'www.axway.com', '', 6, 240, 2);

-- --------------------------------------------------------

--
-- Table structure for table `races`
--

CREATE TABLE IF NOT EXISTS `races` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `runners` int(11) NOT NULL,
  `distance` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `races`
--

INSERT INTO `races` (`id`, `name`, `runners`, `distance`) VALUES
(1, 'Marathon Stara Zagora', 330, 21),
(2, 'Marathon Pancharevo', 300, 42),
(3, 'Marathon Pleven', 50, 21),
(4, 'Vitosha 100', 1000, 94),
(5, 'Sofia morning run', 500, 20);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `race_id` int(11) NOT NULL,
  `runner_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `ranking` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `race_id`, `runner_id`, `time`, `ranking`) VALUES
(1, 2, 1, '02:35:25', 30),
(2, 5, 4, '02:15:00', 41),
(3, 3, 3, '03:45:00', 50),
(4, 1, 5, '02:00:55', 10),
(5, 4, 2, '03:45:00', 26);

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
