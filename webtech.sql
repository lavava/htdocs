-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2015 at 04:57 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webtech`
--
CREATE DATABASE IF NOT EXISTS `webtech` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `webtech`;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `title` varchar(50) NOT NULL,
  `user` varchar(40) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `sold` tinyint(1) NOT NULL,
  `path` varchar(50) NOT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`title`, `user`, `artist`, `sold`, `path`, `time`, `id`) VALUES
('Mona Lisa', 'user@user.com', 'Leonardo Da Vinci', 0, 'images/user@user.com/mona.jpg', '0000-00-00 00:00:00', 'Leomon1429'),
('The Starry Night', 'user@user.com', 'Vincent Van Gogh', 0, 'images/user@user.com/star.jpg', '0000-00-00 00:00:00', 'Vinsta1429');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `first_name`, `last_name`, `dob`) VALUES
('admin@admin.com', 'admin', 'Akash', 'Goel', '1993-09-18'),
('user@user.com', 'user', 'Anmol', 'Jaggi', '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
