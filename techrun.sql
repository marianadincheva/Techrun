-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techrun`
--

-- --------------------------------------------------------

--
-- Структура на таблица `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `email` text CHARACTER SET utf8,
  `phone` text CHARACTER SET utf8,
  `website` text CHARACTER SET utf8,
  `logo` text CHARACTER SET utf8,
  `runners` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `races` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `companies`
--

INSERT INTO `companies` (`company_id`, `name`, `email`, `phone`, `website`, `logo`, `runners`, `points`, `races`) VALUES
(1, 'SAP', 'sap@abv.bg', '0866955427', 'www.sap-labs.de', '', 5, 200, 2),
(2, 'Musala', 'musala@abv.bg', '0882755233', 'www.musala.com', '', 10, 240, 2),
(3, 'TechHuddle', 'techhuddle@abv.bg', '0886266955', 'www.techhuddle.com', '', 7, 300, 3),
(4, 'Nemetschek Bg', 'nemetschek@abv.bg', '0889578085', 'www.nemetschek.com', '', 3, 230, 1),
(5, 'Axway Bg', 'axway@abv.bg', '0888076565', 'www.axway.com', '', 6, 240, 2);

-- --------------------------------------------------------

--
-- Структура на таблица `races`
--

CREATE TABLE `races` (
  `race_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `runners` int(11) NOT NULL,
  `distance` double NOT NULL,
  `sex` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `races`
--

INSERT INTO `races` (`race_id`, `name`, `runners`, `distance`, `sex`) VALUES
(1, 'Pancharevo', 0, 10, 'M'),
(2, 'Pancharevo', 0, 10, 'F'),
(3, 'Pancharevo', 0, 21.1, 'M'),
(4, 'Pancharevo', 0, 21.1, 'F'),
(5, 'Pancharevo', 0, 43, 'M'),
(6, 'Pancharevo', 0, 43, 'F'),
(7, 'Kalandja', 0, 11, 'M'),
(8, 'Kalandja', 0, 11, 'F'),
(9, 'Kalandja', 0, 21.3, 'M'),
(10, 'Kalandja', 0, 21.3, 'F'),
(11, 'Kalandja', 0, 43, 'M'),
(12, 'Kalandja', 0, 43, 'F'),
(13, 'Businessrun', 5, 4, 'M'),
(14, 'Businessrun', 2, 4, 'F');

-- --------------------------------------------------------

--
-- Структура на таблица `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `race_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `time` time NOT NULL,
  `place` int(11) NOT NULL,
  `sex` enum('M','F') NOT NULL,
  `email` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `runners`
--

CREATE TABLE `runners` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `birth_date` date DEFAULT NULL,
  `sex` enum('male','female') NOT NULL,
  `email` text NOT NULL,
  `phone` text,
  `company` text,
  `points` int(11) DEFAULT NULL,
  `races` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`race_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `runners`
--
ALTER TABLE `runners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
  MODIFY `race_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `runners`
--
ALTER TABLE `runners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
