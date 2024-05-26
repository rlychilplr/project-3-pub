-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2024 at 09:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chans`
--

-- --------------------------------------------------------

-- Table structure for table `likes`
CREATE TABLE IF NOT EXISTS `likes` (
  `like-id` int(255) NOT NULL AUTO_INCREMENT,
  `user-id` int(255) NOT NULL,
  `message-id` int(255) NOT NULL,
  PRIMARY KEY (`like-id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Table structure for table `medewerker`
CREATE TABLE IF NOT EXISTS `medewerker` (
  `user-id` int(255) NOT NULL,
  `moderator` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Table structure for table `messages`
CREATE TABLE IF NOT EXISTS `messages` (
  `message-id` int(255) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `user-id` int(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `edited` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`message-id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Table structure for table `user`
CREATE TABLE IF NOT EXISTS `user` (
  `user-id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `password-salt` varchar(60) NOT NULL,
  `displayname` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `creation-date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user-id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
