-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2020 at 05:23 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcm`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_log`
--

CREATE TABLE `access_log` (
  `id` int(4) NOT NULL,
  `email` varchar(40) NOT NULL,
  `timestamp` varchar(40) NOT NULL,
  `ip` varchar(80) NOT NULL,
  `browser` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_log`
--

INSERT INTO `access_log` (`id`, `email`, `timestamp`, `ip`, `browser`) VALUES
(17, 'it.skbehera@optcl.co.in', '09-08-2020 13:35', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(18, 'ele.rmansingh@gridco.co.in', '09-08-2020 13:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(19, 'ele.ckdash@optcl.co.in', '09-08-2020 13:54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(20, 'it.skbehera@optcl.co.in', '09-08-2020 13:54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(21, 'it.skbehera@optcl.co.in', '09-08-2020 14:22', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(22, 'ele.rmansingh@gridco.co.in', '09-08-2020 14:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(23, 'it.skbehera@optcl.co.in', '09-08-2020 19:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(24, 'it.skbehera@optcl.co.in', '09-08-2020 19:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(25, 'ehtm.cle.jpr@optcl.co.in', '09-08-2020 19:51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(26, 'it.skbehera@optcl.co.in', '09-08-2020 19:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(27, 'it.skbehera@optcl.co.in', '09-08-2020 19:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(28, 'it.skbehera@optcl.co.in', '09-08-2020 19:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(29, 'it.skbehera@optcl.co.in', '09-08-2020 20:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(30, 'it.skbehera@optcl.co.in', '09-08-2020 20:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(31, 'it.skbehera@optcl.co.in', '09-08-2020 20:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(32, 'it.skbehera@optcl.co.in', '09-08-2020 20:02', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(33, 'ele.rmansingh@gridco.co.in', '09-08-2020 20:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(34, 'it.skbehera@optcl.co.in', '09-08-2020 20:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(35, 'it.skbehera@optcl.co.in', '09-08-2020 20:27', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(36, 'it.skbehera@optcl.co.in', '09-08-2020 20:54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(37, 'ele.rmansingh@gridco.co.in', '09-08-2020 21:02', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(38, 'it.skbehera@optcl.co.in', '09-08-2020 21:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(39, 'ele.ckdash@optcl.co.in', '09-08-2020 21:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(40, 'it.skbehera@optcl.co.in', '09-08-2020 21:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(41, 'ele.rmansingh@gridco.co.in', '09-08-2020 21:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(42, 'ehtm.cle.bbs@optcl.co.in', '09-08-2020 21:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(43, 'ehtm.cle.bbs@optcl.co.in', '09-08-2020 21:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(44, 'it.skbehera@optcl.co.in', '09-08-2020 21:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(45, 'it.skbehera@optcl.co.in', '10-08-2020 18:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(46, 'it.skbehera@optcl.co.in', '12-08-2020 14:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(47, 'ele.rmansingh@gridco.co.in', '12-08-2020 14:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(48, 'grid.ss.jngr@optcl.co.in', '12-08-2020 14:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(49, 'it.skbehera@optcl.co.in', '12-08-2020 15:09', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(50, 'it.skbehera@optcl.co.in', '12-08-2020 20:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(51, 'it.skbehera@optcl.co.in', '13-08-2020 20:59', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(52, 'it.skbehera@optcl.co.in', '13-08-2020 22:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.12'),
(53, 'it.skbehera@optcl.co.in', '13-08-2020 22:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.12'),
(54, 'it.skbehera@optcl.co.in', '15-08-2020 19:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(55, 'it.skbehera@optcl.co.in', '15-08-2020 19:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(56, 'it.skbehera@optcl.co.in', '15-08-2020 19:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.12'),
(57, 'it.skbehera@optcl.co.in', '16-08-2020 17:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(58, 'it.skbehera@optcl.co.in', '17-08-2020 11:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(59, 'ele.akmoharana@optcl.co.in', '17-08-2020 18:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(60, 'ele.akmoharana@optcl.co.in', '17-08-2020 18:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(61, 'ele.ckdash@optcl.co.in', '17-08-2020 18:45', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(62, 'it.sspatra@optcl.co.in', '18-08-2020 11:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(63, 'it.smalla@optcl.co.in', '18-08-2020 11:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(64, 'it.smalla@optcl.co.in', '18-08-2020 11:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(65, 'it.skbehera@optcl.co.in', '18-08-2020 11:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(66, 'it.smalla@optcl.co.in', '18-08-2020 11:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(67, 'it.sspatra@optcl.co.in', '18-08-2020 11:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(68, 'ele.ckdash@optcl.co.in', '18-08-2020 11:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(69, 'it.skbehera@optcl.co.in', '18-08-2020 11:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(70, 'it.sspatra@optcl.co.in', '18-08-2020 13:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(71, 'it.skbehera@optcl.co.in', '18-08-2020 13:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(72, 'it.skbehera@optcl.co.in', '20-08-2020 08:57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(73, 'it.skbehera@optcl.co.in', '20-08-2020 13:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(74, 'ele.msahoo@gridco.co.in', '21-08-2020 11:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(75, 'it.sspatra@optcl.co.in', '21-08-2020 11:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(76, 'it.skbehera@optcl.co.in', '21-08-2020 11:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(77, 'it.skbehera@optcl.co.in', '22-08-2020 20:08', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(78, 'it.sspatra@optcl.co.in', '22-08-2020 20:21', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(79, 'it.smalla@optcl.co.in', '22-08-2020 20:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(80, 'ele.rmansingh@gridco.co.in', '22-08-2020 20:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(81, 'ehtm.cle.bbs@optcl.co.in', '22-08-2020 20:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(82, 'it.skbehera@optcl.co.in', '22-08-2020 20:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(83, 'it.sspatra@optcl.co.in', '23-08-2020 10:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(84, 'it.skbehera@optcl.co.in', '23-08-2020 10:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(85, 'it.skbehera@optcl.co.in', '23-08-2020 13:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(86, 'ele.rmansingh@gridco.co.in', '23-08-2020 13:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(87, 'it.skbehera@optcl.co.in', '23-08-2020 13:41', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(88, 'it.skbehera@optcl.co.in', '24-08-2020 09:01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(89, 'it.skbehera@optcl.co.in', '25-08-2020 11:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(90, 'it.skbehera@optcl.co.in', '25-08-2020 16:54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(91, 'it.sspatra@optcl.co.in', '25-08-2020 21:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(92, 'it.skbehera@optcl.co.in', '25-08-2020 21:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(93, 'ele.rmansingh@gridco.co.in', '25-08-2020 21:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(94, 'it.skbehera@optcl.co.in', '25-08-2020 21:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(95, 'it.smalla@optcl.co.in', '25-08-2020 21:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(96, 'it.skbehera@optcl.co.in', '25-08-2020 21:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(97, 'it.skbehera@optcl.co.in', '26-08-2020 10:26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(98, 'it.skbehera@optcl.co.in', '26-08-2020 11:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.13'),
(99, 'it.skbehera@optcl.co.in', '27-08-2020 09:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(100, 'ele.rmansingh@gridco.co.in', '27-08-2020 10:56', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0'),
(101, 'it.skbehera@optcl.co.in', '27-08-2020 11:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `user_id` int(3) NOT NULL,
  `source_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`user_id`, `source_id`) VALUES
(3, 1),
(3, 3),
(3, 11),
(3, 14),
(5, 3),
(5, 4),
(5, 5),
(5, 11),
(8, 19),
(9, 11),
(10, 18),
(11, 4),
(11, 5),
(11, 21),
(12, 9);

-- --------------------------------------------------------

--
-- Table structure for table `power_sector`
--

CREATE TABLE `power_sector` (
  `sector_id` int(1) NOT NULL,
  `sector_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `power_sector`
--

INSERT INTO `power_sector` (`sector_id`, `sector_name`) VALUES
(1, 'STATE'),
(2, 'CENTRAL'),
(3, 'OTHER');

-- --------------------------------------------------------

--
-- Table structure for table `power_source`
--

CREATE TABLE `power_source` (
  `source_id` int(5) NOT NULL,
  `sector_type_id` int(1) NOT NULL,
  `power_type_id` int(1) NOT NULL,
  `short_name` varchar(30) NOT NULL,
  `details` varchar(200) DEFAULT NULL,
  `start_date` date NOT NULL,
  `active` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `power_source`
--

INSERT INTO `power_source` (`source_id`, `sector_type_id`, `power_type_id`, `short_name`, `details`, `start_date`, `active`) VALUES
(3, 1, 1, 'CHIPILIMA', NULL, '2020-08-16', 'Y'),
(1, 1, 1, 'HIRAKUD', 'OHPC-Hirakud', '2020-08-21', 'Y'),
(2, 1, 1, 'MACHHKUND', 'OHPC Machhakund', '2020-08-23', 'Y'),
(18, 1, 1, 'UPPER KOLAB', NULL, '2020-08-22', 'Y'),
(9, 1, 2, 'IB-THERMAL-2ND-UNIT', NULL, '2020-08-18', 'Y'),
(8, 1, 2, 'NTPC KANIHA UNIT', NULL, '2020-08-16', 'Y'),
(4, 1, 2, 'OPGC', NULL, '2020-08-18', 'Y'),
(21, 1, 4, 'SHALIVAN GREEN ENERGY LIMITED', NULL, '2020-08-20', 'Y'),
(17, 1, 5, 'ODISHA WIND', NULL, '2020-08-22', 'Y'),
(13, 1, 6, 'NALCO', NULL, '2020-08-18', 'Y'),
(10, 1, 6, 'NINL', NULL, '2020-08-18', 'Y'),
(19, 1, 7, 'ADITYA ALUMINA', NULL, '2020-08-16', 'Y'),
(11, 1, 7, 'NALCO', NULL, '2020-08-16', 'Y'),
(12, 2, 3, 'ARIAN SOLAR 5MW', NULL, '2020-08-18', 'Y'),
(5, 2, 3, 'SWSOLAR', NULL, '2020-08-18', 'Y'),
(6, 2, 4, 'BIODOM', NULL, '2020-08-25', 'Y'),
(20, 2, 4, 'BIOINDIA', NULL, '2020-08-19', 'Y'),
(7, 2, 5, 'GUJWIND', NULL, '2020-08-18', 'Y'),
(14, 2, 8, 'PGCIL', NULL, '2020-08-18', 'Y'),
(16, 3, 8, 'ADJUSTMENTS', NULL, '2020-08-18', 'Y'),
(15, 3, 8, 'OVERDRAWL', NULL, '2020-08-18', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `power_type`
--

CREATE TABLE `power_type` (
  `power_type_id` int(1) NOT NULL,
  `power_type_name` varchar(10) NOT NULL,
  `power_type_abr` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `power_type`
--

INSERT INTO `power_type` (`power_type_id`, `power_type_name`, `power_type_abr`) VALUES
(1, 'HYDRO', 'HD'),
(2, 'THERMAL', 'TH'),
(3, 'SOLAR', 'SL'),
(4, 'BIOMASS', 'BM'),
(5, 'WIND', 'WN'),
(6, 'CGP', 'CG'),
(7, 'IPP', 'IP'),
(8, 'OTHER', 'OT');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(70) NOT NULL,
  `type` char(1) NOT NULL,
  `active` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `type`, `active`) VALUES
(2, 'ele.ckdash@optcl.co.in', 'Chinmay Kumar Dash', 'A', 'Y'),
(4, 'ele.mdhar@gridco.co.in', 'Murchhana Dhar', 'C', 'Y'),
(8, 'ele.msahoo@gridco.co.in', 'Madhusudan Sahoo', 'C', 'Y'),
(3, 'ele.rmansingh@gridco.co.in', 'Rutupurna Mansingh', 'C', 'Y'),
(10, 'ele.rpatra@optcl.co.in', 'Ranjit Patra', 'C', 'Y'),
(11, 'ele.smohapatra@optcl.co.in', 'Shovan Mahapatra', 'C', 'Y'),
(7, 'it.akojha@optcl.co.in', 'Abhay Kumar Ojha', 'C', 'Y'),
(9, 'it.aparida@optcl.co.in', 'Arindam Parida', 'C', 'Y'),
(12, 'it.mkbehera@optcl.co.in', 'Manoj Kumar Behera', 'C', 'Y'),
(1, 'it.skbehera@optcl.co.in', 'Santosh Kumar Behera', 'A', 'Y'),
(5, 'it.smalla@optcl.co.in', 'Sarmistha Malla', 'C', 'Y'),
(6, 'it.sspatra@optcl.co.in', 'Sonali Satarupa Patra', 'C', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_log`
--
ALTER TABLE `access_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`user_id`,`source_id`);

--
-- Indexes for table `power_sector`
--
ALTER TABLE `power_sector`
  ADD PRIMARY KEY (`sector_id`);

--
-- Indexes for table `power_source`
--
ALTER TABLE `power_source`
  ADD PRIMARY KEY (`sector_type_id`,`power_type_id`,`short_name`) USING BTREE,
  ADD KEY `power_type_id` (`power_type_id`);

--
-- Indexes for table `power_type`
--
ALTER TABLE `power_type`
  ADD PRIMARY KEY (`power_type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_log`
--
ALTER TABLE `access_log`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `power_source`
--
ALTER TABLE `power_source`
  ADD CONSTRAINT `power_source_ibfk_1` FOREIGN KEY (`power_type_id`) REFERENCES `power_type` (`power_type_id`),
  ADD CONSTRAINT `power_source_ibfk_2` FOREIGN KEY (`sector_type_id`) REFERENCES `power_sector` (`sector_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
