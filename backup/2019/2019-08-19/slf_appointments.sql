-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 19, 2019 at 07:44 AM
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
-- Table structure for table `slf_appointments`
--

CREATE TABLE `slf_appointments` (
  `appointment_id` bigint(20) NOT NULL,
  `person_id` bigint(20) NOT NULL,
  `hour` varchar(5) DEFAULT NULL,
  `participants` int(2) DEFAULT NULL,
  `for_me` tinyint(1) NOT NULL DEFAULT '0',
  `for_my_family_members` tinyint(1) NOT NULL DEFAULT '0',
  `for_other_family_members` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slf_appointments`
--

INSERT INTO `slf_appointments` (`appointment_id`, `person_id`, `hour`, `participants`, `for_me`, `for_my_family_members`, `for_other_family_members`) VALUES
(1, 1, '09h30', 5, 1, 1, 0),
(2, 2, '09h30', 5, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `slf_appointments`
--
ALTER TABLE `slf_appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `slf_appointments`
--
ALTER TABLE `slf_appointments`
  MODIFY `appointment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
