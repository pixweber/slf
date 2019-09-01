-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 19, 2019 at 07:43 AM
-- Server version: 5.7.27-0ubuntu0.19.04.1
-- PHP Version: 7.2.19-0ubuntu0.19.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slf_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `slf_persons`
--

CREATE TABLE `slf_persons` (
  `person_id` bigint(20) NOT NULL,
  `first_name` varchar(120) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(120) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `address_plus` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `city` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `parental_permission_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slf_persons`
--

INSERT INTO `slf_persons` (`person_id`, `first_name`, `last_name`, `sex`, `birthdate`, `address`, `address_plus`, `postcode`, `city`, `email`, `phone`, `mobile`, `parental_permission_file`, `created_at`, `updated_at`) VALUES
(1, 'The Hau', 'LE', 1, '1986-08-25', '17 Rue Germain Tillion', '0', '45100', 'Orleans', 'lethehau@gmail.com', '0', '0767973163', NULL, '2019-08-17 15:56:27', '2019-08-17 15:56:27'),
(2, 'Benjamin', 'DALLARD', 1, '1994-09-20', '5 rue micolon', 'Bâtiment F', '94140', 'ALFORTVILLE', 'benjamin@dallard.tech', '0', '0661454510', NULL, '2019-08-17 16:27:09', '2019-08-17 16:27:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `slf_persons`
--
ALTER TABLE `slf_persons`
  ADD PRIMARY KEY (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `slf_persons`
--
ALTER TABLE `slf_persons`
  MODIFY `person_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
