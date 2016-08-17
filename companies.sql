-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2016 at 10:58 AM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `techrun`	//@ Only companies table is exported, I need the whole Database. Click on the database from the list on the left side of the screen in phpmyadmin before clicking export.
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
