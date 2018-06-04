-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2018 at 09:47 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employees`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(9) NOT NULL,
  `name` varchar(100) NOT NULL,
  `recruitment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `recruitment_date`) VALUES
(0, 'Migeur', '2018-06-04 19:07:45'),
(1, 'Larry', '2018-06-04 16:59:54'),
(2, 'jyjyjyjy', '2018-06-04 16:56:30'),
(3, 'hjfyjyjyj', '2018-06-04 16:56:58'),
(4, 'gjffmmt', '2018-06-04 16:57:31'),
(5, 'rhtdzjzt', '2018-06-04 16:58:00'),
(6, 'yyytktyyyt', '2018-06-04 16:58:32'),
(12, 'Lopim', '2018-06-04 18:32:10'),
(111, 'eertyu', '2018-06-04 18:03:13'),
(543, 'Meeerp', '2018-06-04 16:52:26'),
(544, 'Neerp', '2018-06-04 16:51:52'),
(545, 'HurpDurp', '2018-06-04 16:51:00'),
(546, 'Durrr', '2018-05-28 21:00:00'),
(633, 'Course test 2', '2018-05-28 21:00:00'),
(1000, 'louis', '2018-06-03 05:02:00'),
(8975, 'Plumbus 101', '2018-05-28 21:00:00'),
(12223, 'Mattew', '2018-06-04 18:45:12'),
(12436, 'dave', '2018-06-04 18:36:25'),
(34635, 'jfmnxd', '2018-06-03 04:47:47'),
(46844, 'Course test 2', '2018-05-28 21:00:00'),
(54645, 'Luurtp', '2018-06-04 16:49:24'),
(89754, 'Bob Mk V', '2018-06-04 16:17:39'),
(121112, 'magdg', '2018-06-04 18:46:38'),
(122233, 'Mattew', '2018-06-04 18:45:49'),
(124557, 'Dave', '2018-06-04 18:37:26'),
(546456, 'Lurrp', '2018-06-04 16:48:44'),
(897545, 'Lurrr', '2018-06-04 16:46:04'),
(1457347, 'werty', '2018-06-04 19:47:01'),
(8647235, 'dhtjf', '2018-05-28 21:00:00'),
(45875321, 'Plumbus 101', '2018-06-04 18:04:45'),
(2147483647, 'Test', '2018-06-03 05:41:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `id_3` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
